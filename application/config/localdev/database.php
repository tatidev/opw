<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$active_group = 'default';
$query_builder = TRUE;

$db['default'] = array(
		'dsn'	=> '',
		'hostname' => 'host.docker.internal',
        'username' => 'pklopuzen',
        'password' => 'localdev',
        'database' => 'opuzen_loc_master_app',
		'dbdriver' => 'mysqli',
		'dbprefix' => '',
		'pconnect' => FALSE,
		'db_debug' => (ENVIRONMENT !== 'production'),
		'cache_on' => FALSE,
		'cachedir' => '',
		'char_set' => 'utf8',
		'dbcollat' => 'utf8_general_ci',
		'swap_pre' => '',
		'encrypt' => FALSE,
		'compress' => FALSE,
		'stricton' => FALSE,
		'failover' => array(),
		'save_queries' => TRUE
	);


// Add this block at the end
if (isset($db['default']) && $db['default']['dbdriver'] === 'mysqli') {
    $db['default']['init_query'] = [
        "SET GLOBAL sql_mode = REPLACE(@@GLOBAL.sql_mode, 'ONLY_FULL_GROUP_BY', '')",
        "SET SESSION sql_mode = REPLACE(@@SESSION.sql_mode, 'ONLY_FULL_GROUP_BY', '')"
    ];
}
