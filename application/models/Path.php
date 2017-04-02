<?php defined ('BASEPATH') OR exit ('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2017 OA Wu Design
 * @link        http://www.ioa.tw/
 */

class Path extends OaModel {

  static $table_name = 'paths';

  static $has_one = array (
  );

  static $has_many = array (
  );

  static $belongs_to = array (
  );


  const TYPE_D19B = 1;
  const TYPE_D19C = 2;
  const TYPE_D20B = 3;
  const TYPE_D20C = 4;
  const TYPE_I19B = 5;
  const TYPE_I19C = 6;
  const TYPE_I20B = 7;
  const TYPE_I20C = 8;
  const TYPE_I21C = 9;
  const TYPE_I22C = 10;
  const TYPE_I23C = 11;

  static $typeNames = array(
    self::TYPE_D19B => '三月十九 下午',
    self::TYPE_D19C => '三月十九 晚間',
    self::TYPE_D20B => '三月二十 下午',
    self::TYPE_D20C => '三月二十 晚間',
    self::TYPE_I19B => '三月十九 下午',
    self::TYPE_I19C => '三月十九 晚間',
    self::TYPE_I20B => '三月二十 下午',
    self::TYPE_I20C => '三月二十 晚間',
    self::TYPE_I21C => '三月廿一 晚間',
    self::TYPE_I22C => '三月廿二 晚間',
    self::TYPE_I23C => '三月廿三 晚間',
  );

  static $struct = array(
    '陣頭' => array (
        self::TYPE_D19B,
        self::TYPE_D19C,
        self::TYPE_D20B,
        self::TYPE_D20C,
      ),
    '藝閣' => array (
        self::TYPE_I19B,
        self::TYPE_I19C,
        self::TYPE_I20B,
        self::TYPE_I20C,
        self::TYPE_I21C,
        self::TYPE_I22C,
        self::TYPE_I23C,
      )
  );

  public function __construct ($attributes = array (), $guard_attributes = true, $instantiating_via_find = false, $new_record = true) {
    parent::__construct ($attributes, $guard_attributes, $instantiating_via_find, $new_record);
  }
  public function destroy () {
    return $this->delete ();
  }
  public function points ($min = false) {
    if (!isset ($this->points)) return array ();
    
    return array_map (function ($t) use ($min) {
      return !$min ? $t : array (
          round ($t[0] - 23, 6) * pow (10, 6), round ($t[1] - 120, 6) * pow (10, 6)
        );
    }, json_decode ($this->points, true));
  }
}