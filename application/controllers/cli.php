<?php defined ('BASEPATH') OR exit ('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2017 OA Wu Design
 * @link        http://www.ioa.tw/
 */

class Cli extends Oa_controller {

  public function __construct () {
    parent::__construct ();
    
    if (!$this->input->is_cli_request ()) {
      echo 'Request 錯誤！';
      exit ();
    }
  }
  public function clean_query () {
    $this->load->helper ('file');
    write_file (FCPATH . 'application/logs/query.log', '', FOPEN_READ_WRITE_CREATE_DESTRUCTIVE);
  }
  
  public function gps () {
    $s = GpsSetting::find ('one', array ('conditions' => array ('k = ?', 'gps')));

    if ($s && $s->v == '1') {
      $this->load->library ('PointGeter');
      PointGeter::getByGodRoad (GpsPoint::ACTIVE_1);
      PointGeter::getByGodRoad (GpsPoint::ACTIVE_2);
      PointGeter::up ();
    }
  }
  
  public function ga () {
    Online::get ();
  }
  public function up () {
    $this->load->library ('PointGeter');
    PointGeter::up ();
  }

  public function power ($code) {
    $this->load->library ('PointGeter');

    $url = 'http://118.163.200.188/gprs/httppe1.ashx?h=mazu,03811209,03811209,' . $code;
    $options = array (CURLOPT_URL => $url, CURLOPT_TIMEOUT => 120, CURLOPT_HEADER => false, CURLOPT_MAXREDIRS => 10, CURLOPT_AUTOREFERER => true, CURLOPT_CONNECTTIMEOUT => 30, CURLOPT_RETURNTRANSFER => true, CURLOPT_FOLLOWLOCATION => true, CURLOPT_USERAGENT => PointGeter::userAgent ());

    $ch = curl_init ($url);
    curl_setopt_array ($ch, $options);
    $data = curl_exec ($ch);
    $error = curl_error ($ch);
    curl_close ($ch);

    if ($error) return $error;
    if (!$data) return '取得位置失敗！';
    if (!isJson ($data)) return '格式錯誤！';

    $data = json_decode ($data, true);

    if (!(isset ($data['state']) && is_string ($data['state']) && ($data['state'] == 'ok') && isset ($data['gps']) && is_array ($data['gps']) && $data['gps'] && isset ($data['gps'][0]['lat']) && isset ($data['gps'][0]['lng']) && PointGeter::isInRange ($data['gps'][0]['lat'], $data['gps'][0]['lng']) && isset ($data['gps'][0]['rectime']) && $data['gps'][0]['rectime'] && ($date = DateTime::createFromFormat ('Y/m/d H:i:s', $data['gps'][0]['rectime'])) !== false && isset ($data['gps'][0]['v'])))
      return '位置格式有誤！';

    return array (
      " -> 電力：" . $data['gps'][0]['v'],
      " -> 時間：" . $date->format ('Y-m-d H:i:s'),
      );
  }
  public function re () {
    $gps = GpsSetting::find ('one', array ('conditions' => array ('k = ?', 'gps')));
    $ons = GpsSetting::find ('one', array ('conditions' => array ('k = ?', 'ons')));
    $jsv = GpsSetting::find ('one', array ('conditions' => array ('k = ?', 'jsv')));
    $now = GpsSetting::find ('one', array ('conditions' => array ('k = ?', 'now')));

    $s = GpsSetting::find ('one', array ('conditions' => array ('k = ?', 'ons')));
    if ($s && $s->v) {
      $enableActives = array_filter (preg_split ("/[\s,]+/", $s->v));
    } else {
      $enableActives = array ();
    }
    $that = $this;
    $data = array_values (array_filter (array_map (function ($active) use ($that) {
      if (!(isset (GpsPoint::$activeNames[$active]) && isset (GpsPoint::$activeGodRoadCodes[$active]))) return null;
      $power = $that->power (GpsPoint::$activeGodRoadCodes[$active]);

      return GpsPoint::$activeNames[$active] . ":\n" . (is_array ($power) ? implode ("\n", $power) : $power);
    }, $enableActives)));

    Line::pushMessage (
      "目前狀態\n" .
      'GPS 排程：' . ($gps && $gps->v == '1' ? '打開' : '關閉') . "\n" .
      '開啟的 GPS：' . ($ons && $ons->v ? $ons->v : '沒有設定') . "\n" .
      'JS 版本：' . ($jsv && $jsv->v ? $jsv->v : 0) . "\n" .
      '目前路關：' . ($now && $now->v ? $now->v : 0) . "\n" .
      '--------------' . "\n" .
      implode("\n\n", $data)
      );
  }
}
