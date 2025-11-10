<?php
global $sbi_config_path;

$sbi_config_path = rtrim( dirname( __FILE__ ), '/\\' ) . '/config.php';

require_once $sbi_config_path;

function sbi_get_url( $connected_account, $endpoint_slug, $params ) {
	$num = ! empty( $params['num'] ) ? (int)$params['num'] : 100;

	$num = max( $num, 10 );
	$account_type = $connected_account['account_type'];
	$page = '';
	if ( isset( $params['after'] ) ) {
		$page = '&after=' . $params['after'];
	}

    echo "<pre>" . __FILE__ . " LINE: ".__LINE__."</pre>";
	print_r($connected_account);
	echo "</pre>";

	// The new API has a max of 100 per request
	$num = min( $num, 100 );

	if ( $account_type === 'basic' ) {
		if ( $endpoint_slug === 'access_token' ) {
			$url = 'https://graph.instagram.com/refresh_access_token?grant_type=ig_refresh_token&&access_token=' . $connected_account['access_token'];
		} elseif ( $endpoint_slug === 'header' ) {
			$url = 'https://graph.instagram.com/me?fields=id,username,media_count&access_token=' . $connected_account['access_token'];
		} else {
			$url = 'https://graph.instagram.com/' . $connected_account['user_id'] . '/media?fields=media_url,thumbnail_url,caption,id,media_type,timestamp,username,comments_count,like_count,permalink,children{media_url,id,media_type,timestamp,permalink,thumbnail_url}&limit='.$num.'&access_token=' . $connected_account['access_token'] . $page;
		}
	} else {
		if ( $endpoint_slug === 'header' ) {
			$url = 'https://graph.facebook.com/' . $connected_account['user_id'] . '?fields=biography,id,username,website,followers_count,media_count,profile_picture_url,name&access_token=' .  $connected_account['access_token'];
		} elseif ( $endpoint_slug === 'stories' ) {
			$url = 'https://graph.facebook.com/'.$connected_account['user_id'].'/stories?fields=media_url,caption,id,media_type,permalink,children{media_url,id,media_type,permalink}&limit=100&access_token='. $connected_account['access_token'];
		} elseif ( $endpoint_slug === 'hashtags_top' ) {
			$url = 'https://graph.facebook.com/v7.0/'.$params['hashtag_id'].'/top_media?user_id='.$connected_account['user_id'].'&fields=media_url,timestamp,caption,id,media_type,comments_count,like_count,permalink,children{media_url,id,media_type,permalink}&limit='.$num.'&access_token='. $connected_account['access_token'] . $page;
		} elseif ( $endpoint_slug === 'hashtags_recent' ) {
			$url = 'https://graph.facebook.com/v7.0/'.$params['hashtag_id'].'/recent_media?user_id='.$connected_account['user_id'].'&fields=media_url,timestamp,caption,id,media_type,comments_count,like_count,permalink,children{media_url,id,media_type,permalink}&limit='.$num.'&access_token='. $connected_account['access_token'];
		} elseif ( $endpoint_slug === 'recently_searched_hashtags' ) {
			$url = 'https://graph.facebook.com/'.$connected_account['user_id'].'/recently_searched_hashtags?access_token='. $connected_account['access_token'].'&limit=40';
		} elseif ( $endpoint_slug === 'tagged' ) {
			$url = 'https://graph.facebook.com/'.$connected_account['user_id'].'/tags?user_id='.$connected_account['user_id'].'&fields=media_url,caption,id,media_type,comments_count,like_count,permalink,children{media_url,id,media_type,permalink}&limit='.$num.'&access_token='. $connected_account['access_token'];
		} elseif ( $endpoint_slug === 'ig_hashtag_search' ) {
			$url = 'https://graph.facebook.com/ig_hashtag_search?user_id='.$connected_account['user_id'].'&q='.urlencode( $params['hashtag'] ).'&access_token='. $connected_account['access_token'];
		} elseif ( $endpoint_slug === 'comments' ) {
			$url = 'https://graph.facebook.com/'.$params['post_id'].'/comments?fields=text,username&access_token='. $connected_account['access_token'];
		} else {
			$url = 'https://graph.facebook.com/' . $connected_account['user_id'] . '/media?fields=media_url,thumbnail_url,caption,id,media_type,timestamp,username,comments_count,like_count,permalink,children{media_url,id,media_type,timestamp,permalink,thumbnail_url}&limit='.$num.'&access_token=' .  $connected_account['access_token'] . $page;
		}
	}

	return $url;
}

function sbi_remote_get( $url ) {
	$br = curl_init( $url );

	curl_setopt( $br, CURLOPT_URL, $url );
	curl_setopt( $br, CURLOPT_RETURNTRANSFER, true );
	curl_setopt( $br, CURLOPT_TIMEOUT, 10 );
	curl_setopt( $br, CURLOPT_SSL_VERIFYPEER, false ); // must be false to connect without signed certificate
	curl_setopt( $br, CURLOPT_ENCODING, '' );

	$json = curl_exec( $br );

	if ( curl_errno( $br ) ){
		$errno = curl_errno( $br );

		$error_message = curl_strerror( $errno );

		$return = array(
			'error' => array(
				'message' => "cURL error ({$errno}):\n {$error_message}",
				'dir' => 'Take a look <a href="https://smashballoon.com/instagram-feed/docs/errors/">at this page</a> for help'
			)
		);

		echo json_encode( $return );
		die();
	}

	curl_close( $br );

	return $json;
}

function sbi_process_raw_json( $api_json, $request_id, $settings ) {
	$data = json_decode( str_replace( '%22', '&rdquo;', $api_json ), true );

	if ( isset( $data['data'] ) ) {

		if ( $settings['type'] === 'comments' ) {
			$comments = array();
			foreach ( $data['data'] as $comment ) {

				$this_comment = array(
					'id' => $comment['id'],
					'username' => isset( $comment['username'] ) ? htmlspecialchars( $comment['username'] ) : '',
					'text' => isset( $comment['text'] ) ? str_replace( "\n", '<br>', htmlspecialchars( $comment['text'] ) ) : ''
				);

				$comments[] = $this_comment;
			}

			$return = array( 'data' => $comments );

			return $return;
		} else {
			$posts = array();
			foreach ( $data['data'] as $post ) {

				$media_urls = array();
				$permalink = isset( $post['permalink'] ) ? $post['permalink'] : '';

				if ( $post['media_type'] === 'CAROUSEL_ALBUM' || $post['media_type'] === 'VIDEO' ) {
					if ( isset( $post['thumbnail_url'] ) ) {
						$media_urls['640'] = $post['thumbnail_url'];
						$video = $post['media_url'];
					} elseif ( isset( $post['media_url'] ) && ! strpos( $post['media_url'], '.mp4' ) ) {
						$media_urls['640'] = $post['media_url'];
					} elseif ( isset( $post['children'] ) ) {
						$i = 0;
						$full_size = '';
						foreach ( $post['children']['data'] as $carousel_item ) {
							if ( $carousel_item['media_type'] === 'IMAGE' && empty( $full_size ) ) {
								if ( isset( $carousel_item['media_url'] ) ) {
									$full_size = $carousel_item['media_url'];
								}
							} elseif ( $carousel_item['media_type'] === 'VIDEO' && empty( $full_size ) ) {
								if ( isset( $carousel_item['thumbnail_url'] ) ) {
									$full_size = $carousel_item['thumbnail_url'];
								}
							}

							$i++;
						}
						if ( empty( $full_size ) ) {
							$full_size = 'thumb-placeholder.png';
						}
						$media_urls['640'] = $full_size;
					} else {
						if ( $post['media_type'] === 'VIDEO' && isset( $post['media_url'] ) ) {
							$video = $post['media_url'];
						}
						$media_urls['640'] = 'thumb-placeholder.png';
					}
				} else {
					$media_urls['640'] = $post['media_url'];
				}
				$media_urls['150'] = $media_urls['640'];
				$media_urls['320'] = $media_urls['640'];

				if ( isset( $post['children'] ) ) {
					$children = array();
					foreach ( $post['children']['data'] as $child ) {
						$new_child = array();
						if ( $child['media_type'] === 'VIDEO' ) {
							if ( isset( $post['thumbnail_url'] ) ) {
								$new_child['images'] = array(
									'standard_resolution' => array(
										'url' => $post['thumbnail_url']
									),
								);
								$new_child['videos'] = array(
									'standard_resolution' => array(
										'url' => $child['media_url']
									),
								);
							}

							$video = isset( $post['media_url'] ) ? $post['media_url'] : '';
						} else {
							$new_child['images'] = array(
								'standard_resolution' => array(
									'url' => $child['media_url']
								),
							);
						}

						$children[] = $new_child;
					}

				}

				$this_post = array(
					'id' => $post['id'],
					'user' => isset( $post['username'] ) ? array( 'username' => $post['username'] ) : array( 'username' => '' ),
					'likes' => array(
						'count' => isset( $post['like_count'] ) ? $post['like_count'] : ''
					),
					'comments' => array(
						'count' => isset( $post['comments_count'] ) ? $post['comments_count'] : ''
					),
					'link' => ! empty( $permalink ) ? $permalink : 'https://www.instagram.com/',
					'images' => array(
						'thumbnail' => array(
							'url' => $media_urls['150']
						),
						'low_resolution' => array(
							'url' => $media_urls['320']
						),
						'standard_resolution' => array(
							'url' => $media_urls['640']
						),
					),

					'caption' => array(
						'text' => isset( $post['caption'] ) ? htmlspecialchars( htmlspecialchars( $post['caption'] ) ) : ''
					),
					'type' => strtolower( str_replace( '_ALBUM', '', $post['media_type'] ) ),
					'created_time' => isset( $post['timestamp'] ) ? strtotime( trim( str_replace( array('T', '+', ' 0000' ), ' ', $post['timestamp'] ) ) ) : 0,
				);

				if ( isset( $video ) ) {
					$this_post['videos'] = array(
						'standard_resolution' => array(
							'url' => $video
						)
					);
				}

				if ( isset( $children ) ) {
					$this_post['carousel_media'] = $children;
				}

				$posts[] = $this_post;
			}
			$return = array(
				'data' => $posts,
				'pagination' => array( 'next_url' => $request_id . '.' . $data['paging']['cursors']['after'] )
			);

			if ( $settings['num'] > count( $posts ) ) {
				$return['pagination'] = '';
			}
		}



		return $return;
	} elseif ( isset( $data['username'] ) ) {

		$return = array(
			'data' => array(
				'bio' => isset( $data['biography'] ) ? htmlspecialchars( htmlspecialchars( $data['biography'] ) ) : '',
				'full_name' => isset( $data['name'] ) ? $data['name'] : '',
				'id' => $data['id'],
				'profile_picture' => isset( $data['profile_picture_url'] ) ? $data['profile_picture_url'] : '',
				'website' => isset( $data['website'] ) ? $data['website'] : '',
				'username' => $data['username'],
				'counts' => array(
					'followed_by' => isset( $data['followers_count'] ) ? $data['followers_count'] : '',
					'media' => isset( $data['media_count'] ) ? $data['media_count'] : ''
				)
			)

		);

		return $return;
	} else {

		if ( isset( $data['error'] ) ) {
			$return = array(
				'error' => array(
					'message' => $data['error']['message'],
					'dir' => 'There may be a problem with the access token in your config.php file. Otherwise, take a look <a href="https://smashballoon.com/instagram-feed/docs/errors/">at this page</a> for help'
				),
			);
		} else {
			$return = array(
				'error' => array(
					'message' => 'No connected account found for this feed type.',
					'dir' => 'Please update your config.php file with a valid user ID and access token.'
				),
			);
		}


		return $return;
	}
}

function sbi_refresh_time_has_passed_threshold( $connected_account ) {
	$expiration_timestamp = isset( $connected_account['expires_timestamp'] ) ? $connected_account['expires_timestamp'] : time();
	$current_time = time();

	$refresh_threshold = $expiration_timestamp - (40 * 86400);

	if ( $refresh_threshold < $current_time ) {
		return true;
	}
	return false;
}

function sbi_refresh_token( $connected_account ) {

	if ( $connected_account['account_type'] !== 'basic' ) {
		return false;
	}

	$url = sbi_get_url( $connected_account, 'access_token', array() );
	$json = sbi_remote_get( $url );
	$update_data = json_decode( $json, true );
	if ( isset( $update_data['access_token'] ) ) {
		sbi_update_config( $connected_account, $update_data );

		$update_access_token = substr_replace( $update_data['access_token'], '634hgdf83hjdj2', 15, 0 );
		$expires_in = $update_data['expires_in'];
		$update_expires_timestamp = time() + $expires_in;
		$connected_account['access_token'] = $update_data['access_token'];
		$connected_account['at_raw'] = $update_access_token;
		$connected_account['expires_timestamp'] = $update_expires_timestamp;

		return $connected_account;

	}
	return false;
}

function sbi_update_config( $connected_account, $update_data ) {
	$access_token = $connected_account['at_raw'];
	$user_id = $connected_account['user_id'];
	$user_name = $connected_account['username'];
	$expires_timestamp = $connected_account['expires_timestamp'];

	$search_token = $user_name  . '||' . $user_id . '.' . $access_token . '.' . $expires_timestamp;

	$update_access_token = substr_replace( $update_data['access_token'], '634hgdf83hjdj2', 15, 0 );
	$expires_in = $update_data['expires_in'];
	$update_expires_timestamp = time() + $expires_in;

	$update_token = $user_name  . '||' . $user_id . '.' . $update_access_token . '.' . $update_expires_timestamp;

	global $sbi_config_path;
	$path_to_config = $sbi_config_path;

	$handle = fopen( $path_to_config, "rb" );

	$new_config = '';
	if ( $handle ) {
		while ( ( $line = fgets( $handle ) ) !== false ) {
			if ( strpos( $line, $search_token ) !== false ) {
				$new_config .= str_replace( $search_token, $update_token, $line );
			} else {
				$new_config .= $line;
			}
		}

		fclose( $handle );
	} else {
		$return = array(
			'error' => array(
				'message' => 'Unable to update Access Token.',
				'dir' => 'Please make sure your config.php file is able to be written to.'
			),
		);

		echo json_encode( $return );
		die();
	}

	file_put_contents( $path_to_config, $new_config );
}

function sbi_parse_connected_accounts( $connected_accounts ) {
	$return_accounts = array();

	foreach ( $connected_accounts as $connected_account_string ) {

		if ( strpos( $connected_account_string, '.' ) !== false ) {
			$split_up_username = explode( '||', $connected_account_string );
			$username = $split_up_username[0];
			$the_rest_of_string = explode( '.', $split_up_username[1] );
			$user_id = $the_rest_of_string[0];
			$access_token_raw = $the_rest_of_string[1];
			$account_type = strpos( $access_token_raw, '634hgdf83hjdj2') !== false ? 'basic' : 'business';
			$access_token = str_replace( '634hgdf83hjdj2', '', $access_token_raw );
			$expires_timestamp = isset( $the_rest_of_string[2] ) ?  $the_rest_of_string[2] : time();

			$return_accounts[] = array(
				'username' => $username,
				'user_id' => $user_id,
				'access_token' => $access_token,
				'at_raw' => $access_token_raw,
				'account_type' => $account_type,
				'expires_timestamp' => $expires_timestamp
			);
		}

	}

	return $return_accounts;
}

function sbi_delete_files( $cache_path ) {
	if(is_dir($cache_path)){
		$files = glob( $cache_path . '*', GLOB_MARK ); //GLOB_MARK adds a slash to directories returned

		foreach( $files as $file ){
			sbi_delete_files( $file );
		}
		if(is_dir($cache_path)) {
			rmdir( $cache_path );
		}
	} elseif(is_file($cache_path)) {
		unlink( $cache_path );
	}
}

function sbi_delete_cache_file( $key ) {
	$cache_path = rtrim( dirname( __FILE__ ), '/\\' ) . '/cache';
	if ( !file_exists( $cache_path ) ) {
		mkdir( $cache_path, 0755 );
	}

	// Set the caching file name
	$maybe_cache_file_url = $cache_path . '/'. $key .'.txt';

	// If the file exists and is less than X minutes old then use it
	if ( file_exists( $maybe_cache_file_url ) ) {
		sbi_delete_files( $maybe_cache_file_url );
	}
}

function sbi_standalone_maybe_clear_cache() {
	$cache_path = rtrim( dirname( __FILE__ ), '/\\' ) . '/cache';

	// Set the caching file name
	$maybe_cache_file_url = $cache_path . '/clear.txt';
	// If the file exists and is less than X minutes old then use it
	$cached_data = false;
	if ( file_exists( $maybe_cache_file_url ) && ( (int)file_get_contents( $maybe_cache_file_url ) < time() ) ) {
		sbi_delete_files( $cache_path );
	} elseif ( ! file_exists( $maybe_cache_file_url ) ) {
		if ( !file_exists( $cache_path ) ) {
			mkdir( $cache_path, 0755 );
		}

		$contents = time() + (30 * 24 * 60 * 60);

		return file_put_contents( $maybe_cache_file_url, $contents );
	}

	return $cached_data;
}

function sbi_standalone_maybe_get_cache( $key, $cache_time = 30 ) {
	$cache_time_seconds = $cache_time * 60;
	$cache_path = rtrim( dirname( __FILE__ ), '/\\' ) . '/cache';
	if ( !file_exists( $cache_path ) ) {
		mkdir( $cache_path, 0755 );
	}

	// Set the caching file name
	$maybe_cache_file_url = $cache_path . '/'. $key .'.txt';

	// If the file exists and is less than X minutes old then use it
	$cached_data = false;
	if ( file_exists( $maybe_cache_file_url ) && ( filemtime($maybe_cache_file_url) > ( time() - $cache_time_seconds ) ) ) {
		$cached_data = file_get_contents( $maybe_cache_file_url );
	}

	return $cached_data;
}

function sbi_standalone_maybe_set_cache( $key, $json, $access_token = '{blank}' ) {
	$cache_path = rtrim( dirname( __FILE__ ), '/\\' ) . '/cache';
	if ( !file_exists( $cache_path ) ) {
		mkdir( $cache_path, 0755 );
	}
	$maybe_cache_file_url = $cache_path . '/'. $key .'.txt';

	$json = str_replace( $access_token, '{access_token}', $json );

	return file_put_contents( $maybe_cache_file_url, $json );
}

function sbi_get_transient_name( $connected_account, $type, $params ) {

	$transient = $connected_account['user_id'] . $type;
	foreach ( $params as $key => $value ) {
		if ( $key !== 'num' && $key !== 'after' ) {
			$transient .= substr( $key, 0, 2 ) . substr( $value, 0, 4 );
		}
	}


	$transient = substr( $transient, 0, 45 );

	if ( isset( $params['after'] ) ) {
		$transient .= substr( $params['after'], 5, 25 );
	}
	if ( isset( $params['num'] ) ) {
		$transient .= '#' . $params['num'];
	}

	return $transient;
}

if ( empty( $_POST['type'] ) ) {
	die('Invalid');
}

$type = isset( $_POST['type'] ) ? htmlentities( $_POST['type'] ) : 'user';
$term = isset( $_POST['term'] ) ? htmlentities( $_POST['term'] ) : '';
$cachetime = isset( $_POST['cachetime'] ) ? (int)$_POST['cachetime'] : 30;
$num = isset( $_POST['params']['num'] ) ? (int)$_POST['params']['num'] : 100;
$doing_paging = false;
$params = array();

sbi_standalone_maybe_clear_cache();

if ( isset( $_POST['params'] ) && is_array( $_POST['params'] ) ) {

	foreach ( $_POST['params'] as $key => $val ) {
		$params[ $key ] = htmlentities( $val );
	}

}

if ( strpos( $term, '.' ) !== false ) {
	$splitup = explode( '.', $term );
	$term = htmlentities( $splitup[0] );
	$page = htmlentities( $splitup[1] );
	$params['after'] = $page;
	$doing_paging = true;
}

$this_connected_account = $connected_accounts[0];
$connected_accounts = sbi_parse_connected_accounts( $connected_accounts );

if ( $type !== 'hashtag' ) {
	$term = str_replace( 'PERIOD', '.', $term );
	foreach ( $connected_accounts as $connected_account ) {

		if ( $term === $connected_account['username'] ) {
			$this_connected_account = $connected_account;
		} elseif ( $term === $connected_account['user_id'] ) {
			$this_connected_account = $connected_account;
		}

	}
} else {
	foreach ( $connected_accounts as $connected_account ) {

		if ( $connected_account['account_type'] === 'business' ) {
			$this_connected_account = $connected_account;
		}

	}
}



// quit early if basic account
if ( $type === 'comments' && $this_connected_account['account_type'] === 'basic' ) {
	echo '{}';
	die();
}

if ( empty( $this_connected_account )
     || ! isset( $this_connected_account['user_id'] )
     || ! isset( $this_connected_account['access_token'] )
     || strlen( $this_connected_account['access_token'] ) < 35 ) {

	$return = array(
		'error' => array(
			'message' => 'No connected account found for this feed type.',
			'dir' => 'Please update your config.php file with a valid access token for this user.'
		),
	);

	echo json_encode( $return );
	die();
} elseif ( $type === 'hashtag' && $this_connected_account['account_type'] !== 'business' ) {
	$return = array(
		'error' => array(
			'message' => 'No connected business account.',
			'dir' => 'Hashtag feeds require a business account. See <a href="https://smashballoon.com/instagram-business-profiles/">this FAQ</a> for getting an business account.'
		),
	);

	echo json_encode( $return );
	die();
}

if ( sbi_refresh_time_has_passed_threshold( $this_connected_account ) ) {
	$refreshed = sbi_refresh_token( $this_connected_account );

	if ( $refreshed ) {
		$this_connected_account = $refreshed;
	}

}

if ( $type === 'hashtag' ) {
	if ( $doing_paging ) {
		$params['hashtag_id'] = $term;
		$params['num'] = 100;
		$url = sbi_get_url( $this_connected_account, 'hashtags_top', $params );
		$json = sbi_remote_get( $url );
		$return = sbi_process_raw_json( $json, $term, array( 'num' => $num, 'type' => $type ) );
		if ( isset( $return['error'] ) ) {
			sbi_delete_cache_file( $transient_name );
		}
		$return_json = json_encode( $return );
		echo $return_json;
		die();
	}
	$params['hashtag'] = $term;

	$transient_name = sbi_get_transient_name( $this_connected_account, $type, $params );
	$transient_name = sbi_get_transient_name( $this_connected_account, $type, $params );
	$maybe_cache = false;
	if ( $cachetime > 0 ) {
		$maybe_cache = sbi_standalone_maybe_get_cache( $transient_name, $cachetime );
	}

	if ( $maybe_cache ) {
		$json = $maybe_cache;
	} else {
		$url = sbi_get_url( $this_connected_account, 'ig_hashtag_search', $params );

		$json = sbi_remote_get( $url );

		sbi_standalone_maybe_set_cache( $transient_name, $json, $this_connected_account['access_token'] );
	}


	$data = json_decode( str_replace( '%22', '&rdquo;', $json ), true );

	if ( isset( $data['data'] ) ) {
		$hashtag_id = $data['data'][0]['id'];
		$params['hashtag_id'] = $hashtag_id;
		$transient_name = sbi_get_transient_name( $this_connected_account, $type, $params );
		$transient_name = sbi_get_transient_name( $this_connected_account, $type, $params );
		$maybe_cache = false;
		if ( $cachetime > 0 ) {
			$maybe_cache = sbi_standalone_maybe_get_cache( $transient_name, $cachetime );
		}

		if ( $maybe_cache ) {
			$json = $maybe_cache;
		} else {
			$url = sbi_get_url( $this_connected_account, 'hashtags_top', $params );
			$json = sbi_remote_get( $url );

			sbi_standalone_maybe_set_cache( $transient_name, $json, $this_connected_account['access_token'] );
		}

		$return = sbi_process_raw_json( $json, $hashtag_id, array( 'num' => $num, 'type' => $type ) );
		if ( isset( $return['error'] ) ) {
			sbi_delete_cache_file( $transient_name );
		}
		$return_json = json_encode( $return );

		echo $return_json;
		die();
	} else {
		$return = array(
			'error' => array(
				'message' => 'Unable to retrieve hashtag ID for hashtag '.$term.'.',
				'dir' => 'You may be over the 30 hashtag per week limit or there may be no posts made to this hashtag yet.'
			),
		);

		echo json_encode( $return );
		die();
	}
}
$transient_name = sbi_get_transient_name( $this_connected_account, $type, $params );
$maybe_cache = false;
if ( $cachetime > 0 ) {
	$maybe_cache = sbi_standalone_maybe_get_cache( $transient_name, $cachetime );
}

if ( $maybe_cache ) {
	$json = $maybe_cache;
} else {
	$url = sbi_get_url( $this_connected_account, $type, $params );
	$json = sbi_remote_get( $url );
	sbi_standalone_maybe_set_cache( $transient_name, $json, $this_connected_account['access_token'] );
}

$return = sbi_process_raw_json( $json, $this_connected_account['user_id'], array( 'num' => $num, 'type' => $type ) );
if ( isset( $return['error'] ) ) {
	sbi_delete_cache_file( $transient_name );
}
$return_json = json_encode( $return );
echo $return_json;

die();