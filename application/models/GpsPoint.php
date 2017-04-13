<?php defined ('BASEPATH') OR exit ('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2017 OA Wu Design
 * @link        http://www.ioa.tw/
 */

class GpsPoint extends OaModel {

  static $table_name = 'gps_points';

  static $has_one = array (
  );

  static $has_many = array (
  );

  static $belongs_to = array (
  );


  const ACTIVE_1 = 1;
  const ACTIVE_2 = 2;

  static $activeNames = array (
    self::ACTIVE_1 => '二媽 金順安',
    self::ACTIVE_2 => '莊儀團',
  );
  static $activeGodRoadCodes = array (
    self::ACTIVE_1 => '608069',
    self::ACTIVE_2 => '608369',
  );
  static $activeIconUrl = array (
    self::ACTIVE_1 => 'https://pic.mazu.ioa.tw/icons/1.png',
    self::ACTIVE_2 => 'https://pic.mazu.ioa.tw/icons/2.png',
  );

  public function __construct ($attributes = array (), $guard_attributes = true, $instantiating_via_find = false, $new_record = true) {
    parent::__construct ($attributes, $guard_attributes, $instantiating_via_find, $new_record);
  }
  public function destroy () {
    return $this->delete ();
  }
}