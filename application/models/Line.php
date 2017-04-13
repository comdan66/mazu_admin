<?php defined ('BASEPATH') OR exit ('No direct script access allowed');

use LINE\LINEBot;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2016 OA Wu Design
 * @link        http://www.ioa.tw/
 */

class Line extends OaLineModel {

  static $table_name = 'lines';

  static $has_one = array (
  );

  static $has_many = array (
  );

  static $belongs_to = array (
  );

  const STATUS_1 = 1;
  const STATUS_2 = 2;

  static $statusNames = array (
    self::STATUS_1     => '尚未回應',
    self::STATUS_2     => '回應成功',
  );

  public function __construct ($attributes = array (), $guard_attributes = true, $instantiating_via_find = false, $new_record = true) {
    parent::__construct ($attributes, $guard_attributes, $instantiating_via_find, $new_record);
  }
  public static function pushMessage ($message) {
    $user_id = Cfg::setting ('line', 'user_id');
    $channel_secret = Cfg::setting ('line', 'channel', 'secret');
    $token = Cfg::setting ('line', 'channel', 'token');

    $httpClient = new CurlHTTPClient ($token);
    $bot = new LINEBot ($httpClient, ['channelSecret' => $channel_secret]);

    $textMessageBuilder = new TextMessageBuilder ($message);
    $response = $bot->pushMessage ($user_id, $textMessageBuilder);
  }
  public function setStatus ($status) {
    if (!(isset ($this->id, $this->status) && in_array ($status, array_keys (Log::$statusNames)))) return false;
    $this->status = $status;
    return $this->save ();
  }
}