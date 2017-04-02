<?php defined ('BASEPATH') OR exit ('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2017 OA Wu Design
 * @link        http://www.ioa.tw/
 */

class Pv extends Api_controller {

  public function __construct () {
    parent::__construct ();
  }
  public function index ($k = '', $id = 0) {
    $orm = OAInput::post ('orm');
    $id = OAInput::post ('id');

    if (!(class_exists ($orm) && $id && is_numeric ($id) && $id > 0 && in_array ($orm, array ('Album', 'AlbumImage', 'Article', 'Home', 'Author', 'License', 'Youtube', 'CkeditorImage')) && ($obj = $orm::find_by_id ($id, array ('select' => 'id, pv'))))) return $this->output_error_json ('呼叫錯誤！');

    $obj->pv += 1;
    if (!$update = $orm::transaction (function () use ($obj) { return $obj->save (); })) return $this->output_error_json ('呼叫錯誤！');
    return $this->output_json ('呼叫成功！');
  }
}
