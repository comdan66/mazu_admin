<?php defined ('BASEPATH') OR exit ('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2017 OA Wu Design
 * @link        http://www.ioa.tw/
 */

class Main extends Site_controller {

  public function index () {
    return redirect ('https://mazu.ioa.tw/', 'refresh');
    $this->load_view ();
  }
}
