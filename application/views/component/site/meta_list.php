<?php defined ('BASEPATH') OR exit ('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2017 OA Wu Design
 * @link        http://www.ioa.tw/
 */

if ($meta_list) foreach ($meta_list as $meta) echo oa_meta ($meta) . (ENVIRONMENT !== 'production' ? "\n" : '');
