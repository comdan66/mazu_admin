<?php defined ('BASEPATH') OR exit ('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2016 OA Wu Design
 * @link        http://www.ioa.tw/
 */

class Api_controller extends Oa_controller {

  public function __construct () {
    parent::__construct ();

    if (ENVIRONMENT === 'production') header ("Access-Control-Allow-Origin: https://mazu.ioa.tw");
    else header ("Access-Control-Allow-Origin: https://dev.mazu.ioa.tw");

    $class  = $this->get_class ();
    $method = $this->get_method ();

    $this->set_componemt_path ('component', 'site')
         ->set_frame_path ('frame', 'site')
         ->set_content_path ('content', 'site')
         ->set_public_path ('public')
         ;
  }
}