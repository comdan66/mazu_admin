<?php defined ('BASEPATH') OR exit ('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2017 OA Wu Design
 * @link        http://www.ioa.tw/
 */

class Cli extends Oa_controller {

  public function __construct () {
    parent::__construct ();
    
    if (!$this->input->is_cli_request ()) {
      echo 'Request 錯誤！';
      exit ();
    }
  }
  public function clean_query () {
    $this->load->helper ('file');
    write_file (FCPATH . 'application/logs/query.log', '', FOPEN_READ_WRITE_CREATE_DESTRUCTIVE);
  }
  
  public function test () {
    $s = GpsSetting::find ('one', array ('conditions' => array ('k = ?', 'gps')));

    if ($s && $s->v == '1') {
      $this->load->library ('PointGeter');
      PointGeter::getByGodRoad (GpsPoint::ACTIVE_1);
      PointGeter::getByGodRoad (GpsPoint::ACTIVE_2);
      PointGeter::up ();
    }
  }
  
  public function ga () {
    Online::get ();
  }
  public function up () {
    $this->load->library ('PointGeter');
    PointGeter::up ();
  }
}
