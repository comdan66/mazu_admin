<?php defined ('BASEPATH') OR exit ('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2017 OA Wu Design
 * @link        http://www.ioa.tw/
 */

if ($js_list) foreach ($js_list as $js) echo script_tag ($js) . (ENVIRONMENT !== 'production' ? "\n" : '');
