# WEBSITE IMAGE STORAGE HANDELING NOTES

#### ../application/config/<env>/config.php

```
// AWS S3 Bucket Configuration
$assets_bucket_name = 'opuzen-web-assets-public';
$config['asset_storage']='https://'.$assets_bucket_name.'.s3.us-west-1.amazonaws.com';
$config['asset_showcase_storage'] = $config['asset_storage'].'/showcase';
$config['asset_pub_image_storage'] = $config['asset_showcase_storage'] . '/images';
$config['asset_pub_thumbs'] = '/thumbs';
$config['asset_pub_collection_storage'] = $config['asset_pub_image_storage'] = '/collection';
```

### how to use the config'd variable
```
class ExampleController extends CI_Controller {

    public function index() {
        // Load the configuration item
        $assetUrl = $this->config->item('asset_pub_image_storage');

        // Pass it to the view
        $data['assetUrl'] = $assetUrl;

        $this->load->view('example_view', $data);
    }
}
```

...app'/helpers/utility_helper.php::  function image_src_path($purpose, $size = '')

...app'/helpers/utility_helper.php::  function showcase_path()
{
    //return 'https://www.opuzen.com/showcase/';
    return 
}

...app'/helpers/utility_helper.php::  function images_folder()
{
    return 'images/';
}

