<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2017 OA Wu Design
 */

class PathInfo extends OaModel {

  static $table_name = 'path_infos';

  static $has_one = array (
  );

  static $has_many = array (
  );

  static $belongs_to = array (
  );

  public function __construct ($attributes = array (), $guard_attributes = true, $instantiating_via_find = false, $new_record = true) {
    parent::__construct ($attributes, $guard_attributes, $instantiating_via_find, $new_record);
  }
  public function minfy ($min = false) {
    if (!(isset ($this->lat) && isset ($this->lng) && isset ($this->content))) return array ();
    
    return array (
      $this->content,
      !$min ? array ($this->lat, $this->lng) : array (
          round ($this->lat - 23, 6) * pow (10, 6), round ($this->lng - 120, 6) * pow (10, 6)
        )
      );
  }
  public function destroy () {
    return $this->delete ();
  }

  public function mini_content ($length = 100) {
    if (!isset ($this->content)) return '';
    return $length ? mb_strimwidth (remove_ckedit_tag ($this->content), 0, $length, '…','UTF-8') : remove_ckedit_tag ($this->content);
  }
}