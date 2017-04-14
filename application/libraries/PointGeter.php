<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2016 OA Wu Design
 */

class PointGeter {
  private static $ci = null;

  const NO_ENABLED = 0;
  const IS_ENABLED = 1;
  const RE_COUNt   = 5;

  static $enabledNames = array (
    self::NO_ENABLED => '關閉',
    self::IS_ENABLED => '啟用',
  );

  const MIN = 1;
  const MAX = 1000;

  public function __construct () {
  }

  public static function userAgent () {
    $t = array (
      'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1',
      'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.76 Safari/537.36',
      'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36',
      'Mozilla/5.0 (Linux; Android 4.3; Nexus 7 Build/JSS15Q) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36',
      'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1',
    );
    return $t[array_rand ($t)];
  }
  private static function ci () {
    if (self::$ci !== null) return self::$ci;
    self::$ci =& get_instance ();
    return self::$ci;
  }
  public static function length ($aa, $an, $ba, $bn) {
    $aa = deg2rad ($aa); $bb = deg2rad ($an); $cc = deg2rad ($ba); $dd = deg2rad ($bn);
    return (2 * asin (sqrt (pow (sin (($aa - $cc) / 2), 2) + cos ($aa) * cos ($cc) * pow (sin(($bb - $dd) / 2), 2)))) * 6378137;
  }
  public static function isInRange ($a, $n) {
    return is_numeric ($a) && is_numeric ($n) && $a >= 22 && $a <= 24 && $n >= 120 && $n <= 121;
  }

  private static function pointIgps ($code) {
    if (!$cookie = GpsIgpsCookie::val ())
      return 'Cookie 錯誤！';

    $url = 'http://igps.tw/car/myHandler/qrycardata.ashx';
    $options = array (
      CURLOPT_URL => $url,
      CURLOPT_COOKIE => $cookie,
      CURLOPT_USERAGENT => self::userAgent (),
      CURLOPT_POSTFIELDS => http_build_query (array ('cn' => 'GPRS' . $code)),
      CURLOPT_TIMEOUT => 120, CURLOPT_HEADER => false, CURLOPT_POST => true, CURLOPT_MAXREDIRS => 10, CURLOPT_AUTOREFERER => true, CURLOPT_CONNECTTIMEOUT => 30, CURLOPT_RETURNTRANSFER => true, CURLOPT_FOLLOWLOCATION => true,
    );

    $ch = curl_init ($url);
    curl_setopt_array ($ch, $options);
    $data = curl_exec ($ch);
    $error = curl_error ($ch);
    curl_close ($ch);

    if ($error) return $error;
    if (!isJson ($data)) return '格式有誤(1)！';
    if (!(($data = json_decode ($data, true)) && isset ($data['rtime']) && $data['rtime'] && ($date = DateTime::createFromFormat ('Y/m/d H:i:s', $data['rtime'])) !== false && isset ($data['latlng']) && $data['latlng'] && count ($data['latlng'] = explode (',', $data['latlng'])) == 2 && is_numeric ($data['latlng'][0]) && is_numeric ($data['latlng'][1]) && self::isInRange ($data['latlng'][0], $data['latlng'][1]))) return '格式有誤(2)！';

    return array (
        'lat' => $data['latlng'][0],
        'lng' => $data['latlng'][1],
        'time' => $date
      );
  }

  private static function pointGodroad ($code) {
    $url = 'http://118.163.200.188/gprs/httppe1.ashx?h=mazu,03811209,03811209,' . $code;

    $options = array (CURLOPT_URL => $url, CURLOPT_TIMEOUT => 120, CURLOPT_HEADER => false, CURLOPT_MAXREDIRS => 10, CURLOPT_AUTOREFERER => true, CURLOPT_CONNECTTIMEOUT => 30, CURLOPT_RETURNTRANSFER => true, CURLOPT_FOLLOWLOCATION => true, CURLOPT_USERAGENT => self::userAgent ());

    $ch = curl_init ($url);
    curl_setopt_array ($ch, $options);
    $data = curl_exec ($ch);
    $error = curl_error ($ch);
    curl_close ($ch);

    if ($error) return $error;
    if (!$data) return '取得位置失敗！';
    if (!isJson ($data)) return '格式錯誤！';

    $data = json_decode ($data, true);

    if (!(isset ($data['state']) && is_string ($data['state']) && ($data['state'] == 'ok') && isset ($data['gps']) && is_array ($data['gps']) && $data['gps'] && isset ($data['gps'][0]['lat']) && isset ($data['gps'][0]['lng']) && self::isInRange ($data['gps'][0]['lat'], $data['gps'][0]['lng']) && isset ($data['gps'][0]['rectime']) && $data['gps'][0]['rectime'] && ($date = DateTime::createFromFormat ('Y/m/d H:i:s', $data['gps'][0]['rectime'])) !== false))
      return '位置格式有誤！';

    return array (
        'lat' => $data['gps'][0]['lat'],
        'lng' => $data['gps'][0]['lng'],
        'time' => $date,
      );
  }
  public static function getByGodRoad ($active) {
    $time = $active . '_' . time ();
    if (!Task::start ('get/' . $active, $time)) 
      return Task::error ('初始化失敗', $time);

    if (!isset (GpsPoint::$activeGodRoadCodes[$active]))
      return Task::error ('錯誤的 活動編號', $time);

    if (!((is_array ($data = self::pointGodroad (GpsPoint::$activeGodRoadCodes[$active])) || is_array ($data = self::pointIgps (GpsPoint::$activeGodRoadCodes[$active]))) && isset ($data['lat']) && isset ($data['lng']) && isset ($data['time'])))
      return Task::error ($data, $time);

    $enable = self::IS_ENABLED;
    $memo = '';

    if ($last = GpsPoint::find ('one', array ('order' => 'id desc', 'conditions' => array ('active = ? AND enable = ?', $active, self::IS_ENABLED)))) {
      $l = strtotime ($last->time_at->format ('Y-m-d H:i:s'));
      $n = strtotime ($data['time']->format ('Y-m-d H:i:s'));

      if ($enable && $l > $n) {
        $enable &= self::NO_ENABLED;
        $memo = '時間錯誤';
      }
      if ($enable && $l == $n && $data['lat'] == $last->lat && $data['lng'] == $last->lng) {
        $enable &= self::NO_ENABLED;
        $memo = '資料一樣';
      }

      $l = self::length ($last->lat, $last->lng, $data['lat'], $data['lng']);
      if ($enable && $l < self::MIN) {
        $enable &= self::NO_ENABLED;
        $memo = '距離太短(' . $l . 'm)';
      }

      if ($enable && $l > self::MAX) {
        $enable &= self::NO_ENABLED;
        $memo = '距離太長(' . $l . 'm)';
      }
    }

    $enable = ($enable == self::IS_ENABLED) || !array_filter (GpsPoint::find ('all', array ('select' => 'enable', 'order' => 'id DESC', 'limit' => PointGeter::RE_COUNt, 'conditions' => array ('active = ?', $active))), function ($a) { return $a->enable == PointGeter::IS_ENABLED; }) ? PointGeter::IS_ENABLED : PointGeter::NO_ENABLED;

    $params = array (
        'active' => $active,
        'lat' => $data['lat'],
        'lng' => $data['lng'],
        'lat2' => '',
        'lng2' => '',
        'enable' => $enable,
        'memo' => $memo,
        'time_at' => $data['time']->format ('Y-m-d H:i:s')
      );

    if (!GpsPoint::transaction (function () use ($params, &$point) { return verifyCreateOrm ($point = GpsPoint::create (array_intersect_key ($params, GpsPoint::table ()->columns))); }))
      return Task::error ('新增資料庫失敗', $time);

    return Task::finish ($time) && $point ? $point : false;
  }
  public static function up () {
    $time = 'point_up' . '_' . time ();
    if (!Task::start ('up/active', $time)) 
      return Task::error ('初始化失敗', $time);
    
    $path = FCPATH . 'temp/p.json';
    $s3_path = ENVIRONMENT === 'production' ? 'api/p.json' : 'api/dev/p.json';

    if (file_exists ($path)) {
      return Task::error ('上次檔案未刪除', $time);
    }

    $s = GpsSetting::find ('one', array ('conditions' => array ('k = ?', 'ons')));
    if ($s && $s->v) {
      $enableActives = array_filter (preg_split ("/[\s,]+/", $s->v));
    } else {
      $enableActives = array ();
    }

    $points_list = array_values (array_filter (array_map (function ($active) {
      return isset (GpsPoint::$activeNames[$active]) && isset (GpsPoint::$activeIconUrl[$active]) ? array (
        GpsPoint::$activeNames[$active],
        GpsPoint::$activeIconUrl[$active],
        array_2d_to_1d (array_map (function ($point) {
          return array (
              round (($point->lat2 ? $point->lat2 : $point->lat) - 23, 6) * pow (10, 6),
              round (($point->lng2 ? $point->lng2 : $point->lng) - 120, 6) * pow (10, 6),
              strtotime ($point->time_at->format ('Y-m-d H:i:s'))
            );
        }, GpsPoint::find ('all', array ('order' => 'id desc', 'limit' => 30, 'conditions' => array ('active = ? AND enable = ?', $active, PointGeter::IS_ENABLED)))))) : array ();
    }, $enableActives)));

    $s = GpsSetting::find ('one', array ('conditions' => array ('k = ?', 'jsv')));
    $j = $s && $s->v ? $s->v : 0;

    $s = GpsSetting::find ('one', array ('conditions' => array ('k = ?', 'now')));
    $n = $s && $s->v ? $s->v : 0;

    if (!write_file ($path, json_encode (array_merge (array (
        $j, // v
        $n, // n
      ), $points_list))))
      return Task::error ('寫入檔案失敗', $time);

    if (!put_s3 ($path, $s3_path))
      return Task::error ('上傳 S3 失敗', $time);

    if (!@unlink ($path))
      return Task::error ('刪除檔案失敗', $time);


    Task::finish ($time);

    $time = 'point_up' . '_' . time ();

    if (!Task::start ('up/api', $time)) 
      return Task::error ('初始化失敗', $time);

    $path = FCPATH . 'temp/api.json';
    $s3_path = ENVIRONMENT === 'production' ? 'api/api.json' : 'api/dev/api.json';

    $points_list = array_map (function ($t) {
      return array (
          'name' => $t[0],
          'position' => $t[2] ? array (
              $t[2][0] / pow (10, 6) + 23, $t[2][1] / pow (10, 6) + 120
            ) : array ()
        );
    }, $points_list);


    if (!write_file ($path, json_encode ($points_list)))
      return Task::error ('寫入檔案失敗', $time);

    if (!put_s3 ($path, $s3_path))
      return Task::error ('上傳 S3 失敗', $time);

    if (!@unlink ($path))
      return Task::error ('刪除檔案失敗', $time);

    Task::finish ($time);
  }
}