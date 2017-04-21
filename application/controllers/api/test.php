<?php defined ('BASEPATH') OR exit ('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2017 OA Wu Design
 * @link        http://www.ioa.tw/
 */

class Test extends Api_controller {

  public function __construct () {
    parent::__construct ();
  }
  public function index () {
    return $this->output_json (array (
        'key' => 'Hello World!'
      ));
  }
}
