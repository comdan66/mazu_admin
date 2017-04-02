<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2017 OA Wu Design
 */

class Migration_Add_locations extends CI_Migration {
  public function up () {
    $this->db->query (
      "CREATE TABLE `locations` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,

        `ip` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0.0.0.0' COMMENT 'IP',
        `lat` DOUBLE NOT NULL COMMENT '緯度',
        `lng` DOUBLE NOT NULL COMMENT '經度',
        `acc` tinyint(4) unsigned  DEFAULT '255' COMMENT '準確度(m)',

        `updated_at` datetime NOT NULL DEFAULT '" . date ('Y-m-d H:i:s') . "' COMMENT '更新時間',
        `created_at` datetime NOT NULL DEFAULT '" . date ('Y-m-d H:i:s') . "' COMMENT '新增時間',
        PRIMARY KEY (`id`),
        KEY `created_at_index` (`created_at`)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;"
    );
  }
  public function down () {
    $this->db->query (
      "DROP TABLE `locations`;"
    );
  }
}