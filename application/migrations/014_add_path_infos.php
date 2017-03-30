<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2016 OA Wu Design
 */

class Migration_Add_path_infos extends CI_Migration {
  public function up () {
    $this->db->query (
      "CREATE TABLE `path_infos` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
        `type` tinyint(4) unsigned NOT NULL DEFAULT 0 COMMENT '類型',

        `lat` DOUBLE NOT NULL COMMENT '原始緯度',
        `lng` DOUBLE NOT NULL COMMENT '原始經度',
        `content` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '內容',

        `updated_at` datetime NOT NULL DEFAULT '" . date ('Y-m-d H:i:s') . "' COMMENT '更新時間',
        `created_at` datetime NOT NULL DEFAULT '" . date ('Y-m-d H:i:s') . "' COMMENT '新增時間',
        PRIMARY KEY (`id`)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;"
    );
  }
  public function down () {
    $this->db->query (
      "DROP TABLE `path_infos`;"
    );
  }
}