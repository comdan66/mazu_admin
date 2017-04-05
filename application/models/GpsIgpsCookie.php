<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2016 OA Wu Design
 */

class GpsIgpsCookie extends OaModel {

  static $table_name = 'gps_igps_cookies';

  static $has_one = array (
  );

  static $has_many = array (
  );

  static $belongs_to = array (
  );

  public function __construct ($attributes = array (), $guard_attributes = true, $instantiating_via_find = false, $new_record = true) {
    parent::__construct ($attributes, $guard_attributes, $instantiating_via_find, $new_record);
  }

  public static function val () {
    $start = date ('Y-m-d H:i:s', strtotime (date ('Y-m-d H:i:s') . ' - ' . (60 * 1) . ' minutes'));

    if ($cookie = GpsIgpsCookie::find ('one', array ('select' => 'val', 'conditions' => array ('created_at BETWEEN ? AND ?', $start, date ('Y-m-d H:i:s')))))
      return $cookie->val;

    $time = 'gps_igps_cookies_' . time ();
    if (!Task::start ('Cookie/val', $time)) 
      return Task::error ('初始化失敗', $time);

    $ci =& get_instance ();
    $ci->load->library ('phpQuery');

    $url = 'http://igps.tw/car/Default.aspx';
    if (!($get_html_str = str_replace ('&amp;', '&', urldecode (file_get_contents ($url)))))
      return Task::error ('取不到原始碼！', $time);

    $query = phpQuery::newDocument ($get_html_str);
    $__VIEWSTATEGENERATOR = pq ("#__VIEWSTATEGENERATOR", $query);
    $__EVENTVALIDATION = pq ("#__EVENTVALIDATION", $query);
    $__VIEWSTATE = pq ("#__VIEWSTATE", $query);
    
    if (!($__VIEWSTATEGENERATOR->val () && $__EVENTVALIDATION->val () && $__VIEWSTATE->val ()))
      return Task::error ('Form 格式有誤！', $time);

    $url = 'http://igps.tw/car/Default.aspx?ReturnUrl=%2fcar%2fshowmap.aspx';
    $options = array (
      CURLOPT_URL => $url,
      CURLOPT_USERAGENT => PointGeter::userAgent (),
      CURLOPT_POSTFIELDS => http_build_query (array (
        '__EVENTTARGET' => '',
        '__EVENTARGUMENT' => '',
        '__VIEWSTATE' => $__VIEWSTATE->val (),
        '__VIEWSTATEGENERATOR' => $__VIEWSTATEGENERATOR->val (),
        '__EVENTVALIDATION' => $__EVENTVALIDATION->val (),
        'LoginView1$Login1$UserName' => '03811209',
        'LoginView1$Login1$Password' => '03811209',
        'LoginView1$Login1$LoginButton' => '登入'
      )),
      CURLOPT_POST => true, CURLOPT_HEADER => true, CURLOPT_TIMEOUT => 120, CURLOPT_MAXREDIRS => 10, CURLOPT_AUTOREFERER => true, CURLOPT_CONNECTTIMEOUT => 30, CURLOPT_RETURNTRANSFER => true, CURLOPT_FOLLOWLOCATION => true,
    );

    $ch = curl_init ($url);
    curl_setopt_array ($ch, $options);
    $data = curl_exec ($ch);
    $error = curl_error ($ch);
    curl_close ($ch);

    if ($error) return Task::error ('Login 有誤(0)！Msg:' . $error, $time);
    if (!$data) return Task::error ('Login 有誤(1)！', $time);

    preg_match_all ('/^Set-Cookie:\s*([^;]*)/mi', $data, $matches);
    if (!isset ($matches[1][2])) return Task::error ('Login 有誤(2)！', $time);
    
    $val = $matches[1][2];
    if (!(GpsIgpsCookie::transaction (function () use (&$cookie, $val) { return verifyCreateOrm ($cookie = GpsIgpsCookie::create (array ('val' => $val))); }) && $cookie)) return Task::error ('新增 Cookie 有誤！', $time);    

    Task::finish ($time);
    return $cookie->val;
  }
}