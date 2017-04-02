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
    // $a = Article::last ();
    // echo '<meta http-equiv="Content-type" content="text/html; charset=utf-8" /><pre>';
    // var_dump ($a->pics ());
    // exit ();
    $this->load->helper ('directory_helper');
    $this->load->library ('DeployTool');

    $api = FCPATH . 'api' . DIRECTORY_SEPARATOR;
    @directory_delete ($api, false);

    DeployTool::api_article ($api);
    DeployTool::api_paths ($api);
    DeployTool::api_albums ($api);
    DeployTool::api_youtubes ($api);
    DeployTool::api_homes ($api);
    DeployTool::api_authors ($api);
    DeployTool::api_licenses ($api);
  }
  
  public function ga () {
    Online::get ();
  }
}
