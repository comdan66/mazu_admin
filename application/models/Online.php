<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2017 OA Wu Design
 */
require_once FCPATH . '/application/libraries/Google/autoload.php';

class Online extends OaModel {

  static $table_name = 'onlines';

  static $has_one = array (
  );

  static $has_many = array (
  );

  static $belongs_to = array (
  );

  public function __construct ($attributes = array (), $guard_attributes = true, $instantiating_via_find = false, $new_record = true) {
    parent::__construct ($attributes, $guard_attributes, $instantiating_via_find, $new_record);
  }
  public static function get () {
    $time = 'ga' . '_' . time ();
    if (!Task::start ('get/' . 'ga', $time)) 
      return Task::error ('初始化失敗', $time);

    $error = '';
    $count = self::ga ($error);
    if ($error) return Task::error ($error, $time);

    $params = array ('cnt' => $count);

    if (!Online::transaction (function () use ($params, &$point) { return verifyCreateOrm ($point = Online::create (array_intersect_key ($params, Online::table ()->columns))); }))
      return Task::error ('新增資料庫失敗', $time);

    return Task::finish ($time);
  }
  private static function ga (&$msg) {
    $online = 0;

    $p12 = Cfg::setting ('ga', 'oauth', 'path');

    if (!(file_exists ($p12) && is_readable($p12))) {
      $msg = '沒有 P12 Files';
      $online = 0;
    }

    $client_id = Cfg::setting ('ga', 'client_id');
    $mail      = Cfg::setting ('ga', 'mail');
    $scrpe     = Cfg::setting ('ga', 'scrpe');
    $p_id      = Cfg::setting ('ga', 'p_id');

    $client = new Google_Client ();
    $client->setClientId ($client_id);
    $client->setAssertionCredentials (new Google_Auth_AssertionCredentials ($mail, array ($scrpe), file_get_contents ($p12)));
    $service = new Google_Service_Analytics ($client);

    try {
      $result = $service->data_realtime->get ($p_id, 'rt:activeVisitors');
      
      if (!isset ($result->totalsForAllResults['rt:activeVisitors']))
        throw new Exception('失敗！');
      
      $msg = '';
      $online = $result->totalsForAllResults['rt:activeVisitors'];
    } catch(Exception $e) {
      $msg = $e->getMessage ();
      $online = 0;
    }

    return $online;
  }
}