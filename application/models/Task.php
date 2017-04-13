<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2016 OA Wu Design
 */

class Task extends OaModel {

  static $table_name = 'tasks';

  private static $task = array ();

  static $has_one = array (
  );

  static $has_many = array (
  );

  static $belongs_to = array (
  );

  public function __construct ($attributes = array (), $guard_attributes = true, $instantiating_via_find = false, $new_record = true) {
    parent::__construct ($attributes, $guard_attributes, $instantiating_via_find, $new_record);
  }
  public static function start ($m, $time = '') {
    return verifyCreateOrm (Task::$task[$time] = Task::create (array (
        'title' => $m,
        'msg' => '開始執行中..',
      ))) && Task::$task[$time];
  }
  public static function error ($m, $time = '') {
    if (!(isset (Task::$task[$time]) && Task::$task[$time])) return false;

    Task::$task[$time]->msg = $m;
    Task::$task[$time]->save ();

    if ($m) Line::pushMessage ('[' . Task::$task[$time]->title . "]\n" . $m . "\n" . Task::$task[$time]->updated_at->format ('Y-m-d H:i:s'));

    return false;
  }
  public static function finish ($time = '') {
    Task::error ('', $time);
    return true;
  }
}