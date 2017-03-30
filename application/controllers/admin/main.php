<?php defined ('BASEPATH') OR exit ('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2016 OA Wu Design
 * @link        http://www.ioa.tw/
 */
if (!function_exists ('oasort')) {
  function oasort ($n, $b = true) {
    if ($n == 0) return array ();
    if ($n == 1) return array (1);
    if ($n == 2) return array (2);
    if ($n == 3) return array (3);
    if (!($n % 3) && ($n / 3) < 4) return array_merge (array (3), oasort ($n - 3));
    $s = $b ? 2 : 3;
    $v = $n - $s;
    return array_merge (array ($s), oasort ($v, !$b));
  }
}

class Main extends Admin_controller {

  public function index ($type = 'schedules', $offset = 0) {

    return $this->add_param ('now_url', base_url ('admin', 'my'))
                ->load_view ();
  }
}
