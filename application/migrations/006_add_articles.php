<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2017 OA Wu Design
 */

class Migration_Add_articles extends CI_Migration {
  public function up () {
    $this->db->query (
      "CREATE TABLE `articles` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
        `user_id` int(11) unsigned NOT NULL COMMENT 'User ID',
        `tag` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT '分類',
        `cover` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT '封面',
        `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '標題',
        `content` text COMMENT '內容',
        `sort` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '排列順序，上至下 DESC',
        `pv` int(11) unsigned NOT NULL DEFAULT 0 COMMENT 'Page View',
        `updated_at` datetime NOT NULL DEFAULT '" . date ('Y-m-d H:i:s') . "' COMMENT '更新時間',
        `created_at` datetime NOT NULL DEFAULT '" . date ('Y-m-d H:i:s') . "' COMMENT '新增時間',
        PRIMARY KEY (`id`)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;"
    );
  }
  public function down () {
    $this->db->query (
      "DROP TABLE `articles`;"
    );
  }
}