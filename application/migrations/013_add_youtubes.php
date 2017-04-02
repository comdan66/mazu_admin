<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2017 OA Wu Design
 */

class Migration_Add_youtubes extends CI_Migration {
  public function up () {
    $this->db->query (
      "CREATE TABLE `youtubes` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
        `user_id` int(11) unsigned NOT NULL COMMENT 'User ID',
        
        `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '標題',
        `content` text COMMENT '內容',
        
        `url` text COMMENT '原始網址',
        `vid` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Yotube ID',
        
        `pv` int(11) unsigned NOT NULL DEFAULT 0 COMMENT 'Page View',

        `updated_at` datetime NOT NULL DEFAULT '" . date ('Y-m-d H:i:s') . "' COMMENT '更新時間',
        `created_at` datetime NOT NULL DEFAULT '" . date ('Y-m-d H:i:s') . "' COMMENT '新增時間',
        PRIMARY KEY (`id`)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;"
    );
  }
  public function down () {
    $this->db->query (
      "DROP TABLE `youtubes`;"
    );
  }
}