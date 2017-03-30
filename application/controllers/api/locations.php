<?php defined ('BASEPATH') OR exit ('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2016 OA Wu Design
 * @link        http://www.ioa.tw/
 */

class Locations extends Api_controller {

  public function index () {
    $gets = OAInput::get ();

    if ($msg = $this->_validation_create ($gets))
      return $this->output_error_json ($msg);

    if (!verifyCreateOrm ($location = Location::create (array_intersect_key ($gets, Location::table ()->columns))))
      return $this->output_error_json ('新增失敗！');

    return $this->output_json (array (
        'i' => $location->id,
      ));
  }

  private function _validation_create (&$gets) {
    if (!isset ($gets['lat'])) return '沒有 緯度';
    if (!(is_string ($gets['lat']) && is_numeric ($gets['lat'] = trim ($gets['lat'])) && ($gets['lat'] >= -90) && ($gets['lat'] <= 90))) return '緯度 格式錯誤！';
    
    if (!isset ($gets['lng'])) return '沒有 經度';
    if (!(is_string ($gets['lng']) && is_numeric ($gets['lng'] = trim ($gets['lng'])) && ($gets['lng'] >= -180) && ($gets['lng'] <= 180))) return '經度 格式錯誤！';
    
    $gets['acc'] = isset ($gets['acc']) && is_string ($gets['acc']) && is_numeric ($gets['acc'] = trim ($gets['acc'])) && $gets['acc'] > 0 && $gets['acc'] < 255 ? $gets['acc'] : 255;
    $gets['ip'] = $this->input->ip_address ();
    return '';
  }
}
