<?php defined ('BASEPATH') OR exit ('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2017 OA Wu Design
 * @link        http://www.ioa.tw/
 */

class Path_infos extends Admin_controller {
  private $uri_1 = null;
  private $obj = null;

  public function __construct () {
    parent::__construct ();
    
    if (!User::current ()->in_roles (array ('maps')))
      return redirect_message (array ('admin'), array ('_flash_danger' => '您的權限不足，或者頁面不存在。'));
    
    $this->uri_1 = 'admin/path_infos';

    if (in_array ($this->uri->rsegments (2, 0), array ('edit', 'update', 'destroy')))
      if (!(($id = $this->uri->rsegments (3, 0)) && ($this->obj = PathInfo::find ('one', array ('conditions' => array ('id = ?', $id))))))
        return redirect_message (array ($this->uri_1), array ('_flash_danger' => '找不到該筆資料。'));

    $this->add_param ('uri_1', $this->uri_1)
         ->add_param ('now_url', base_url ($this->uri_1))
         ;

  }
  public function index ($offset = 0) {
    $columns = array ( 
        array ('key' => 'content',   'title' => '內容', 'sql' => 'content LIKE ?'), 
      );

    $configs = array_merge (explode ('/', $this->uri_1), array ('%s'));
    $conditions = conditions ($columns, $configs);

    $limit = 10;
    $total = PathInfo::count (array ('conditions' => $conditions));
    $objs = PathInfo::find ('all', array ('offset' => $offset < $total ? $offset : 0, 'limit' => $limit, 'order' => 'id DESC', 'conditions' => $conditions));

    return $this->load_view (array (
        'objs' => $objs,
        'columns' => $columns,
        'pagination' => $this->_get_pagination ($limit, $total, $configs),
      ));
  }
  public function add () {
    $posts = Session::getData ('posts', true);

    return $this->load_view (array (
        'posts' => $posts,
        'paths' => array_combine (array_keys (Path::$typeNames), array_map (function ($type) {
          $path = Path::find_by_type ($type);
          return $path->points ();
        }, array_keys (Path::$typeNames)))
      ));
  }
  public function create () {
    if (!$this->has_post ())
      return redirect_message (array ($this->uri_1, 'add'), array ('_flash_danger' => '非 POST 方法，錯誤的頁面請求。'));

    $posts = OAInput::post ();
    $posts['content'] = OAInput::post ('content', true);

    if ($msg = $this->_validation_create ($posts))
      return redirect_message (array ($this->uri_1, 'add'), array ('_flash_danger' => $msg, 'posts' => $posts));

    if (!PathInfo::transaction (function () use (&$obj, $posts) { return verifyCreateOrm ($obj = PathInfo::create (array_intersect_key ($posts, PathInfo::table ()->columns))); }))
      return redirect_message (array ($this->uri_1, 'add'), array ('_flash_danger' => '新增失敗！', 'posts' => $posts));

    return redirect_message (array ($this->uri_1), array ('_flash_info' => '新增成功！'));
  }
  public function edit () {
    $posts = Session::getData ('posts', true);

    return $this->load_view (array (
        'posts' => $posts,
        'obj' => $this->obj,
        'paths' => array_combine (array_keys (Path::$typeNames), array_map (function ($type) {
          $path = Path::find_by_type ($type);
          return $path->points ();
        }, array_keys (Path::$typeNames)))
      ));
  }
  public function update () {
    $obj = $this->obj;

    if (!$this->has_post ())
      return redirect_message (array ($this->uri_1, $obj->id, 'edit'), array ('_flash_danger' => '非 POST 方法，錯誤的頁面請求。'));

    $posts = OAInput::post ();
    $posts['content'] = OAInput::post ('content', true);

    if ($msg = $this->_validation_update ($posts))
      return redirect_message (array ($this->uri_1, $obj->id, 'edit'), array ('_flash_danger' => $msg, 'posts' => $posts));

    if ($columns = array_intersect_key ($posts, $obj->table ()->columns))
      foreach ($columns as $column => $value)
        $obj->$column = $value;
    
    if (!PathInfo::transaction (function () use ($obj, $posts) { return $obj->save (); }))
      return redirect_message (array ($this->uri_1, $obj->id, 'edit'), array ('_flash_danger' => '更新失敗！', 'posts' => $posts));

    return redirect_message (array ($this->uri_1), array ('_flash_info' => '更新成功！'));
  }

  public function destroy () {
    $obj = $this->obj;
    if (!PathInfo::transaction (function () use ($obj) { return $obj->destroy (); }))
      return redirect_message (array ($this->uri_1), array ('_flash_danger' => '刪除失敗！'));

    return redirect_message (array ($this->uri_1), array ('_flash_info' => '刪除成功！'));
  }
  private function _validation_create (&$posts) {
    if (!isset ($posts['lat'])) return '沒有 緯度';
    if (!(is_string ($posts['lat']) && is_numeric ($posts['lat'] = trim ($posts['lat'])) && ($posts['lat'] >= -90) && ($posts['lat'] <= 90))) return '緯度 格式錯誤！';
    
    if (!isset ($posts['lng'])) return '沒有 經度';
    if (!(is_string ($posts['lng']) && is_numeric ($posts['lng'] = trim ($posts['lng'])) && ($posts['lng'] >= -180) && ($posts['lng'] <= 180))) return '經度 格式錯誤！';
    
    if (!isset ($posts['content'])) return '沒有填寫 內容！';
    if (!(is_string ($posts['content']) && ($posts['content'] = trim ($posts['content'])))) return '內容 格式錯誤！';
    
    if (!isset ($posts['type'])) return '沒有 類型';
    if (!(isset ($posts['type']) && in_array ($posts['type'], array_keys (Path::$typeNames)))) return '類型格式錯誤！';

    return '';
  }

  private function _validation_update (&$posts) {
    return $this->_validation_create ($posts);
  }
}
