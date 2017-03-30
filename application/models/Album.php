<?php defined ('BASEPATH') OR exit ('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2016 OA Wu Design
 * @link        http://www.ioa.tw/
 */

class Album extends OaModel {

  static $table_name = 'albums';

  static $has_one = array (
  );

  static $has_many = array (
    array ('sources', 'class_name' => 'AlbumSource', 'order' => 'sort ASC'),
    array ('images', 'class_name' => 'AlbumImage', 'order' => 'sort DESC'),
  );

  static $belongs_to = array (
    array ('user', 'class_name' => 'User'),
  );

  public function __construct ($attributes = array (), $guard_attributes = true, $instantiating_via_find = false, $new_record = true) {
    parent::__construct ($attributes, $guard_attributes, $instantiating_via_find, $new_record);
    OrmImageUploader::bind ('cover', 'AlbumCoverImageUploader');
  }
  public function destroy () {
    if ($this->sources)
      foreach ($this->sources as $source)
        if (!$source->destroy ())
          return false;

    if ($this->images)
      foreach ($this->images as $image)
        if (!$image->destroy ())
          return false;

    return $this->delete ();
  }
  
  public function mini_title ($length = 50) {
    if (!isset ($this->title)) return '';
    return $length ? mb_strimwidth (remove_ckedit_tag ($this->title), 0, $length, '…','UTF-8') : remove_ckedit_tag ($this->content);
  }
  public function mini_content ($length = 100) {
    if (!isset ($this->content)) return '';
    return $length ? mb_strimwidth (remove_ckedit_tag ($this->content), 0, $length, '…','UTF-8') : remove_ckedit_tag ($this->content);
  }
}