<?php defined ('BASEPATH') OR exit ('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2017 OA Wu Design
 * @link        http://www.ioa.tw/
 */

class Main extends Admin_controller {

  public function index ($type = 'schedules', $offset = 0) {

    return $this->add_param ('now_url', base_url ('admin'))
                ->load_view ();
  }
}
