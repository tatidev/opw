<?php

function str_replace_for_view($text)
{
    $search = array('/', '-', ' ');
    return str_replace($search, '', strtolower($text));
}

function asset_url()
{
    return base_url() . 'assets/';
}

// EXAMPLE
// if (!function_exists('get_asset_storage_url')) {
//     function get_asset_storage_url() {
//         // Get the CodeIgniter instance
//         $CI =& get_instance();
// 
//         // Access the config item
//         return $CI->config->item('asset_pub_image_storage');
//     }
// }

if (!function_exists('showcase_path')) {
    function showcase_path() {
        // Get the CodeIgniter instance
        $CI =& get_instance();

        // Access the config item
        return $CI->config->item('asset_showcase_storage');
    }
}

if (!function_exists('images_folder')) {
    function images_folder() {
        // Get the CodeIgniter instance
        $CI =& get_instance();

        // Access the config item
        return $CI->config->item('asset_pub_image_storage');
    }
}

// LEGACY
// function showcase_path()
// {
//     return 'https://www.opuzen.com/showcase/';
// }
// LEGACY
// function images_folder()
// {
//     return 'images/';
//     
// }


if (!function_exists('placeholder_image')) {
    function placeholder_image($size = 'big') {
        switch ($size) {
            case 'big':
                return images_folder() . '/placeholder.jpg';
            case 'thumb':
                return images_folder() . '/placeholder400.jpg';
            default:
                return images_folder() . '/placeholder.jpg';

        }
    }
}

// LEGACY
// function placeholder_image($size = 'big')
// {
//     switch ($size) {
//         case 'big':
//             return asset_url() . 'images/placeholder.jpg';
//         case 'thumb':
//             return asset_url() . 'images/placeholder400.jpg';
//         default:
//             return asset_url() . 'images/placeholder.jpg';
//     }
// 
// }

function image_src_path($purpose, $size = '')
{
    switch ($purpose) {

        case 'fabrics':
        case 'sc_grounds':
            $folder = 'images_pattern/';
            break;

        case 'digital_grounds':
        case 'fabrics_items':
            switch ($size) {
                case 'thumb':
                    $folder = 'images_items/big/';
                    break;
                case 'big':
                    $folder = 'images_items/big/';
                    break;
                case 'hd':
                    $folder = 'images_items_hd/';
                    break;
                default:
                    $folder = 'images_items/big/';
                    break;
            }
            break;

        case 'digital_styles':
            $folder = 'images_dp_styles/';
            break;

        case 'digital_styles_items':
            $folder = 'images_dp_items/big/';
            break;

        case 'portfolio':
            $folder = 'press/';
            break;

        case 'portfolio_thumb':
            $folder = 'press/thumb/';
            break;

        case 'screenprints':
            switch ($size) {
                case 'full_repeat':
                    $folder = 'images_print/full_repeat/';
                    break;

                case 'actual_scale':
                    $folder = 'images_print/actual_scale/';
                    break;

                case 'additional1':
                    $folder = 'images_print/additional1/';
                    break;

                case 'additional2':
                    $folder = 'images_print/additional2/';
                    break;

                default:
                    $folder = 'images_print/thumbnail/';
                    break;
            }
            break;

        /*
        case 'digital_grounds':
          switch($size){
            case 'big':
              $folder = 'images_dp_grounds_styles/';
              break;
            case 'hd':
              $folder = 'images_dp_grounds_styles_hd/';
              break;
            default:
              $folder = 'images_dp_grounds_styles/';
              break;
          }
          break;
              */

        default:
            $folder = '';
            break;
    }
    // LEGACY
    // return showcase_path() . images_folder() . $folder;
    return images_folder() . $folder;

}

function include_pdf_library()
{
    require_once('pdf/fpdf.php');
    require_once('pdf/fpdf-custom.php');
}

function my_file_exists($file)
{
    $file_headers = @get_headers($file);
    if ($file_headers[0] == 'HTTP/1.1 404 Not Found') {
        return false;
    } else {
        return true;
    }
}

function str_like_in_array($arr, $str)
{
    foreach ($arr as $a) {
        if (strpos($a, $str) !== false) {
            return true;
        }
    }
    return false;
}

function sort_by_key(&$array, $key, $ascending = true)
{

    $build_sorter = function ($key, $ascending) {
        $order_f = function ($item1, $item2) {
            if ($item1 == $item2) return 0;
            return $item1 > $item2 ? -1 : 1;
        };
        if ($ascending) {
            $order_f = function ($item1, $item2) {
                if ($item1 == $item2) return 0;
                return $item1 < $item2 ? -1 : 1;
            };
        }
        return function ($a, $b) use ($key, $order_f) {
            return $order_f($a[$key], $b[$key]);
        };
    };

    usort($array, $build_sorter($key, $ascending));
    return $array;
}


?>