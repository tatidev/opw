<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logs_model extends MY_Model {
  
  
  function __construct(){
    parent::__construct();
  	$this->tbl_logs_product_page = $this->db_log . '.T_PRODUCT_PAGE_LOG';
  	$this->tbl_logs_search = $this->db_log . '.T_SEARCH_LOG';
  	$this->tbl_logs_access = $this->db_log . '.TLOG_IP';
  	$this->tbl_logs_404 = $this->db_log . '.TLOG_IP_404';
  }
 
  function add_product_page_log($category, $product){
    $data = array(
      'category' => $category,
      'product' => $product
    );
    $this->db->insert($this->tbl_logs_product_page, $data);
  }
  
  function add_search_log($str){
    $data = array(
      'application' => 'frontend_new',
      'X_DESC' => $str
    );
    $this->db->insert($this->tbl_logs_search, $data);
  }
  
  function add_access_log($ip, $url, $country, $state, $city, $address, $browser){
    $data = array(
      'ip' => $ip,
      'application' => 'frontend_new',
      'page' => $url,
      'country' => $country,
      'state' => $state,
      'city' => $city,
      'address' => $address,
      'browser' => $browser
    );
    $this->db->insert($this->tbl_logs_access, $data);
  }
 
  function add_log_404($ip, $application, $country, $state, $city, $address, $status='', $browser, $url_original){
    $data = array(
      'ip' => $ip,
      'application' => $application,
      'error_code' => '404',
      'country' => $country,
      'state' => $state,
      'city' => $city,
      'address' => $address,
      'status' => $status,
      'browser' => $browser,
      'url_original' => $url_original
    );
    $this->db->insert($this->tbl_logs_404, $data);
  }
  
}