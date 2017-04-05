<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2016 OA Wu Design
 */

class Migration_Add_gps_points extends CI_Migration {
  public function up () {
    $this->db->query (
      "CREATE TABLE `gps_points` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
        
        `active` tinyint(4) unsigned NOT NULL DEFAULT 0 COMMENT 'Active Code',

        `lat` DOUBLE NOT NULL COMMENT '原始緯度',
        `lng` DOUBLE NOT NULL COMMENT '原始經度',
        `lat2` DOUBLE NOT NULL COMMENT '校正緯度',
        `lng2` DOUBLE NOT NULL COMMENT '校正經度',
        
        `enable` tinyint(1) unsigned NOT NULL DEFAULT 1 COMMENT '是否採用，1 採用，0 不採用',
        `memo` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '備註',
        `time_at` datetime NOT NULL DEFAULT '" . date ('Y-m-d H:i:s') . "' COMMENT '時間',

        `updated_at` datetime NOT NULL DEFAULT '" . date ('Y-m-d H:i:s') . "' COMMENT '更新時間',
        `created_at` datetime NOT NULL DEFAULT '" . date ('Y-m-d H:i:s') . "' COMMENT '新增時間',
        PRIMARY KEY (`id`)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;"
    );
  }
  public function down () {
    $this->db->query (
      "DROP TABLE `gps_points`;"
    );
  }
}