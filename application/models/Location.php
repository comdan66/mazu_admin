<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2016 OA Wu Design
 */

class Location extends OaModel {

  static $table_name = 'locations';

  static $has_one = array (
  );

  static $has_many = array (
  );

  static $belongs_to = array (
  );

  public function __construct ($attributes = array (), $guard_attributes = true, $instantiating_via_find = false, $new_record = true) {
    parent::__construct ($attributes, $guard_attributes, $instantiating_via_find, $new_record);
  }

  // public static function heat () {
  //   $time = time ();
  //   if (!Task::start ('Location/heat', $time)) 
  //     return Task::error ('初始化失敗', $time);

  //   $heatmaps = self::heatmaps (1);

  //   $path = FCPATH . 'temp/heatmaps.json';
  //   $s3_path = ENVIRONMENT === 'production' ? 'heatmaps.json' : 'dev/heatmaps.json';

  //   if (file_exists ($path)) {
  //     if ($admins = Cfg::setting ('admins')) {
  //       $ci =& get_instance ();
  //       $ci->load->library ('OAMail');

  //       $content = $ci->load->view ('mails/content', array (
  //           'details' => array (
  //               array ('title' => 'Heatmap 上次檔案未刪除', 'value' => '刪除點擊：<a href="' . base_url ('api', 'clean', 'heatmaps') . '" style="display: inline-block; color: rgba(42, 90, 149, 0.7); font-weight: normal; text-decoration: none; padding: 0 2px; padding-bottom: 0; -moz-transition: all 0.3s; -o-transition: all 0.3s; -webkit-transition: all 0.3s; transition: all 0.3s;">這裡</a> (' . date ('Y-m-d H:i:s') . ')')
  //             )
  //         ), true);
  //       $mail = OAMail::create ()->setSubject ('[Heatmap/錯誤]')
  //                                ->setBody ($content);

  //       foreach ($admins as $m => $name)
  //         $mail->addTo ($m, $name);

  //     if (ENVIRONMENT === 'production') $mail->send ();
  //     }
  //     return Task::error ('上次檔案未刪除', $time);
  //   }

  //   if (!write_file ($path, json_encode ($heatmaps)))
  //     return Task::error ('寫入檔案失敗', $time);

  //   if (!put_s3 ($path, $s3_path))
  //     return Task::error ('上傳 S3 失敗', $time);

  //   if (!@unlink ($path))
  //     return Task::error ('刪除檔案失敗', $time);
    
  //   return Task::finish ($time);
  // }

  // public static function x ($t) {
  //   return array (
  //       $t[0] + (rand (-5000, 5000) / 20000000),
  //       $t[1] + (rand (-5000, 5000) / 20000000)
  //     );
  // }
  // private static function heatmaps ($q = 0) {
  //   $unit = 60; //sec

  //   $end = date ('Y-m-d H:i:s', strtotime (date ('Y-m-d H:i:s') . ' - ' . (0) . ' minutes'));
  //   $start = date ('Y-m-d H:i:s', strtotime (date ('Y-m-d H:i:s') . ' - ' . ($unit * $q) . ' minutes'));

  //   $users = Location::find ('all', array ('select' => 'lat,lng', 'conditions' => array ('created_at BETWEEN ? AND ?', $start, $end)));

  //   $temp = null;
  //   $qs = array ();
  //   $u = intval (count ($users) / 500);
  //   foreach ($users as $i => $user)
  //     if (!$temp || ($temp->lat != $user->lat) || ($temp->lng != $user->lng))
  //       if (($temp = $user) && !($i % $u))
  //         array_push ($qs, array (round ($temp->lat - 24, 8) * 10, round ($temp->lng - 120, 8) * 10));

  //   $qs = count ($qs) < 400 * 3 ? 
  //           count ($qs) < 200 * 3 ? 
  //             count ($qs) < 100 * 3 ? 
  //               count ($qs) < 50 * 3 ? 
  //                 array_merge ($qs, array_map ('Location::x', $qs), array_map ('Location::x', $qs), array_map ('Location::x', $qs), array_map ('Location::x', $qs), array_map ('Location::x', $qs)) : 
  //                 array_merge ($qs, array_map ('Location::x', $qs), array_map ('Location::x', $qs), array_map ('Location::x', $qs), array_map ('Location::x', $qs)) : 
  //                 array_merge ($qs, array_map ('Location::x', $qs), array_map ('Location::x', $qs), array_map ('Location::x', $qs)) : 
  //                 array_merge ($qs, array_map ('Location::x', $qs), array_map ('Location::x', $qs)) :
  //                 array_merge ($qs, array_map ('Location::x', $qs))
  //                 ;

  //   array_rand ($qs);

  //   return array_2d_to_1d ($qs);
  // }
}