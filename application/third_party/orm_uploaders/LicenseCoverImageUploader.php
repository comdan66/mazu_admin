<?php defined ('BASEPATH') OR exit ('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2017 OA Wu Design
 * @link        http://www.ioa.tw/
 */

class LicenseCoverImageUploader extends OrmImageUploader {

  public function getVersions () {
    return array (
        '' => array (),
        '600x315c' => array ('adaptiveResizeQuadrant', 600, 315, 'c'),
        '1200x630c' => array ('adaptiveResizeQuadrant', 1200, 630, 'c'),
      );
  }
}