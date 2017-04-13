<?php defined ('BASEPATH') OR exit ('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2016 OA Wu Design
 * @link        http://www.ioa.tw/
 */
require_once FCPATH . 'vendor/autoload.php';

use LINE\LINEBot;
use LINE\LINEBot\Constant\EventSourceType;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
use LINE\LINEBot\Constant\HTTPHeader;
use LINE\LINEBot\Event\MessageEvent\TextMessage;
use LINE\LINEBot\Event\MessageEvent\VideoMessage;
use LINE\LINEBot\Event\MessageEvent\StickerMessage;
use LINE\LINEBot\Event\MessageEvent\LocationMessage;
use LINE\LINEBot\Event\MessageEvent\ImageMessage;
use LINE\LINEBot\Event\MessageEvent\AudioMessage;

use LINE\LINEBot\MessageBuilder\TextMessageBuilder;
class Callback extends Api_controller {

  public function __construct () {
    parent::__construct ();
    
  }
  public function test () {
    // preg_match_all ("/(?P<c>清除\s*tmp)/i", '清除TMP', $result);
    // echo '<meta http-equiv="Content-type" content="text/html; charset=utf-8" /><pre>';
    // var_dump ($result['c']['0']);
    // exit ();

            $this->load->helper ('directory');
            directory_delete (FCPATH . 'temp', false);

    // Line::pushMessage ('asd');
    // echo $response->getHTTPStatus () . ' ' . $response->getRawBody ();
  }
  public function index () {
    $path = FCPATH . 'temp/input.json';
    $channel_id = Cfg::setting ('line', 'channel', 'id');
    $channel_secret = Cfg::setting ('line', 'channel', 'secret');
    $token = Cfg::setting ('line', 'channel', 'token');

    if (!isset ($_SERVER["HTTP_" . HTTPHeader::LINE_SIGNATURE])) {
      write_file ($path, '===> Error, Header Error!' . "\n", FOPEN_READ_WRITE_CREATE);
      exit ();
    }

    $httpClient = new CurlHTTPClient ($token);
    $bot = new LINEBot ($httpClient, ['channelSecret' => $channel_secret]);

    $signature = $_SERVER["HTTP_" . HTTPHeader::LINE_SIGNATURE];
    $body = file_get_contents ("php://input");

    try {
      $events = $bot->parseEventRequest ($body, $signature);
    } catch (Exception $e) {
      write_file ($path, '===> Error, Events Error! Msg:' . $e->getMessage () . "\n", FOPEN_READ_WRITE_CREATE);
      exit ();
    }

    foreach ($events as $event) {
      $instanceof = '';

      if ($event instanceof TextMessage) $instanceof = 'TextMessage';
      if ($event instanceof LocationMessage) $instanceof = 'LocationMessage';
      
      if ($event instanceof VideoMessage) $instanceof = 'VideoMessage';
      if ($event instanceof StickerMessage) $instanceof = 'StickerMessage';
      if ($event instanceof ImageMessage) $instanceof = 'ImageMessage';
      if ($event instanceof AudioMessage) $instanceof = 'AudioMessage';
      
      $params = array (
          'type' => $event->getType (),
          'instanceof' => $instanceof,
          'reply_token' => $event->getType () == 'unfollow' ? '' : $event->getReplyToken (),
          'source_id' => $event->getEventSourceId (),
          'source_type' => $event->isUserEvent() ? EventSourceType::USER : ($event->isGroupEvent () ? EventSourceType::GROUP : EventSourceType::ROOM),
          'timestamp' => $event->getTimestamp (),
          'message_type' => $event->getType () == 'message' ? $event->getMessageType () : '',
          'message_id' => $event->getType () == 'message' ? $event->getMessageId () : '',
          'status' => Line::STATUS_1,
          'package_id' => '',
          'sticker_id' => '',
          'text' => $instanceof == 'TextMessage' ? $event->getText () : '',
        );
      if (!Line::transaction (function () use (&$line, $params) { return verifyCreateOrm ($line = Line::create ( array_intersect_key ($params, Line::table ()->columns))); })) return false;

      if ($event->getType () != 'message') continue;

      switch ($line->instanceof) {
        case 'TextMessage':
          if (($line->text == 'gps 開啟') || ($line->text == 'GPS 開啟') || ($line->text == '開啟 GPS') || ($line->text == '開啟 gps')) {
            if ($s = GpsSetting::find ('one', array ('conditions' => array ('k = ?', 'gps')))) {
              $s->v = '1';
              $s->save ();
            } else {
              GpsSetting::create (array ('k' => 'gps', 'v' => '1'));
            }
            $bot->replyMessage ($line->reply_token, new TextMessageBuilder ('已經開啟！'));
          }
          if (($line->text == 'gps 關閉') || ($line->text == 'GPS 關閉') || ($line->text == '關閉 GPS') || ($line->text == '關閉 gps')) {
            if ($s = GpsSetting::find ('one', array ('conditions' => array ('k = ?', 'gps')))) {
              $s->v = '0';
              $s->save ();
            } else {
              GpsSetting::create (array ('k' => 'gps', 'v' => '0'));
            }
            $bot->replyMessage ($line->reply_token, new TextMessageBuilder ('已經關閉！'));
          }


          preg_match_all ("/設定開啟\s*(?P<c>[0-9,\s]+)?/", $line->text, $result);
          if (isset ($result['c'][0]) && ($result['c'][0] = implode(', ', array_filter (preg_split ("/[\s,]+/", $result['c']['0']))))) {
            if ($s = GpsSetting::find ('one', array ('conditions' => array ('k = ?', 'ons')))) {
              $s->v = $result['c'][0];
              $s->save ();
            } else {
              GpsSetting::create (array ('k' => 'ons', 'v' => $result['c'][0]));
            }
            $bot->replyMessage ($line->reply_token, new TextMessageBuilder ('已經設定 ' . $result['c'][0] . ''));
          }
          preg_match_all ("/js 版本\s*(?P<c>\d+)?/i", $line->text, $result);
          if (isset ($result['c'][0]) && is_numeric ($result['c'][0])) {
            if ($s = GpsSetting::find ('one', array ('conditions' => array ('k = ?', 'jsv')))) {
              $s->v = $result['c'][0];
              $s->save ();
            } else {
              GpsSetting::create (array ('k' => 'jsv', 'v' => $result['c'][0]));
            }
            $bot->replyMessage ($line->reply_token, new TextMessageBuilder ('js 版本目前是 ' . $result['c'][0] . ''));
          }

          preg_match_all ("/設定目前路線\s*(?P<c>\d+)?/i", $line->text, $result);
          if (isset ($result['c'][0]) && is_numeric ($result['c'][0]) && in_array ($result['c'][0], array_keys (Path::$typeNames))) {
            if ($s = GpsSetting::find ('one', array ('conditions' => array ('k = ?', 'now')))) {
              $s->v = $result['c'][0];
              $s->save ();
            } else {
              GpsSetting::create (array ('k' => 'now', 'v' => $result['c'][0]));
            }
            $bot->replyMessage ($line->reply_token, new TextMessageBuilder ('目前路線 ' . $result['c'][0] . ''));
          }

          preg_match_all ("/(?P<c>清除\s*tmp)/i", $line->text, $result);
          if (isset ($result['c'][0]) && $result['c'][0]) {
            $this->load->helper ('directory');
            directory_delete (FCPATH . 'temp', false);

            $bot->replyMessage ($line->reply_token, new TextMessageBuilder ('已經清除 TMP 資料夾！'));
          }

          if (($line->text == '回報狀態') || ($line->text == '回報')) {
            $gps = GpsSetting::find ('one', array ('conditions' => array ('k = ?', 'gps')));
            $ons = GpsSetting::find ('one', array ('conditions' => array ('k = ?', 'ons')));
            $jsv = GpsSetting::find ('one', array ('conditions' => array ('k = ?', 'jsv')));
            $now = GpsSetting::find ('one', array ('conditions' => array ('k = ?', 'now')));

            $bot->replyMessage ($line->reply_token, new TextMessageBuilder (
              "目前狀態\n" .
              'GPS 排程：' . ($gps && $gps->v == '1' ? '開啟' : '關閉') . "\n" .
              '開啟路線：' . ($ons && $ons->v ? $ons->v : '沒有設定') . "\n" .
              'JS 版本：' . ($jsv && $jsv->v ? $jsv->v : 0) . "\n" .
              '目前路關：' . ($now && $now->v ? $now->v : 0)
              ));
          }
          if (($line->text == '提示') || ($line->text == '?')) {

            $bot->replyMessage ($line->reply_token, new TextMessageBuilder (
              "指令提示\n" .
              'GPS 排程：[gps 關閉][gps 開起][關閉 gps][開起 gps]' . "\n" .
              '開啟路線：設定開啟 1,2' . "\n" .
              'JS 版本：js 版本 1' . "\n" .
              '目前路關：設定目前路線 1' . "\n" .
              '清除 tmp' . "\n" .
              '回報' . "\n" .
              '提示'
              ));
          }

          echo 'Succeeded!';
          break;
        case 'LocationMessage':
        case 'StickerMessage':
        case 'VideoMessage': 
        case 'ImageMessage': 
        case 'AudioMessage': 
        default:
          echo 'Succeeded!';
          break;
      }
    }
  }
}
