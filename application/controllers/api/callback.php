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
    Line::pushMessage ('asd');
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
          if (($line->text == '開啟 GPS') || ($line->text == '開啟 gps')) {
            if ($s = GpsSetting::find ('one', array ('conditions' => array ('k = ?', 'gps')))) {
              $s->v = '1';
              $s->save ();
            } else {
              GpsSetting::create (array ('k' => 'gps', 'v' => '1'));
            }
            $bot->replyMessage ($line->reply_token, new TextMessageBuilder ('已經開啟！'));
          }
          if (($line->text == '關閉 GPS') || ($line->text == '關閉 gps')) {
            if ($s = GpsSetting::find ('one', array ('conditions' => array ('k = ?', 'gps')))) {
              $s->v = '0';
              $s->save ();
            } else {
              GpsSetting::create (array ('k' => 'gps', 'v' => '0'));
            }
            $bot->replyMessage ($line->reply_token, new TextMessageBuilder ('已經關閉！'));
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
