<?php defined ('BASEPATH') OR exit ('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2016 OA Wu Design
 * @link        http://www.ioa.tw/
 */

class Album_images extends Admin_controller {
  private $uri_1 = null;
  private $uri_2 = null;
  private $parent = null;
  private $icon = null;

  public function __construct () {
    parent::__construct ();
    
    if (!User::current ()->in_roles (array ('media')))
      return redirect_message (array ('admin'), array ('_flash_danger' => '您的權限不足，或者頁面不存在。'));

    $this->uri_1 = 'admin/album';
    $this->uri_2 = 'images';

    if (!(($id = $this->uri->rsegments (3, 0)) && ($this->parent = Album::find_by_id ($id))))
      return redirect_message (array ('admin', 'work-tags'), array ('_flash_danger' => '找不到該筆資料。'));

    if (in_array ($this->uri->rsegments (2, 0), array ('edit', 'update', 'destroy', 'sort')))
      if (!(($id = $this->uri->rsegments (4, 0)) && ($this->obj = AlbumImage::find_by_id ($id))))
        return redirect_message (array ($this->uri_1, $this->parent_tag->id, $this->uri_2), array ('_flash_danger' => '找不到該筆資料。'));

    $this->add_param ('uri_1', $this->uri_1)
         ->add_param ('uri_2', $this->uri_2)
         ->add_param ('parent', $this->parent)
         ->add_param ('now_url', base_url ('admin', 'albums'));
  }
  public function index ($id, $offset = 0) {
    $columns = array ( 
        array ('key' => 'title', 'title' => '標題', 'sql' => 'title LIKE ?'), 
      );

    $configs = array_merge (explode ('/', $this->uri_1), array ($this->parent->id, $this->uri_2, '%s'));
    $conditions = conditions ($columns, $configs);
    OaModel::addConditions ($conditions, 'album_id = ?', $this->parent->id);

    $limit = 25;
    $total = AlbumImage::count (array ('conditions' => $conditions));
    $objs = AlbumImage::find ('all', array ('offset' => $offset < $total ? $offset : 0, 'limit' => $limit, 'include' => array ('user', 'album'), 'order' => 'sort DESC', 'conditions' => $conditions));

    return $this->load_view (array (
        'objs' => $objs,
        'columns' => $columns,
        'pagination' => $this->_get_pagination ($limit, $total, $configs),
      ));
  }
  public function add () {
    return $this->load_view (array (
        'posts' => Session::getData ('posts', true)
      ));
  }
  public function create () {
    $parent = $this->parent;

    if (!$this->has_post ())
      return redirect_message (array ($this->uri_1, $parent->id, $this->uri_2, 'add'), array ('_flash_danger' => '非 POST 方法，錯誤的頁面請求。'));

    $posts = OAInput::post ();
    $name = OAInput::file ('name');

    if ($msg = $this->_validation_create ($posts, $name))
      return redirect_message (array ($this->uri_1, $parent->id, $this->uri_2, 'add'), array ('_flash_danger' => $msg, 'posts' => $posts));

    $posts['sort'] = AlbumImage::count (array ('conditions' => array ('album_id = ?', $parent->id)));
    $posts['album_id'] = $parent->id;

    if (!AlbumImage::transaction (function () use (&$obj, $posts, $name) { return verifyCreateOrm ($obj = AlbumImage::create (array_intersect_key ($posts, AlbumImage::table ()->columns))) && $obj->name->put ($name); }))
      return redirect_message (array ($this->uri_1, $parent->id, $this->uri_2, 'add'), array ('_flash_danger' => '新增失敗！', 'posts' => $posts));

    return redirect_message (array ($this->uri_1, $parent->id, $this->uri_2), array ('_flash_info' => '新增成功！'));
  }

  public function edit () {
    return $this->load_view (array (
        'posts' => Session::getData ('posts', true),
        'obj' => $this->obj
      ));
  }
  public function update () {
    $obj = $this->obj;
    $parent = $this->parent;

    if (!$this->has_post ())
      return redirect_message (array ($this->uri_1, $parent->id, $this->uri_2, $obj->id, 'edit'), array ('_flash_danger' => '非 POST 方法，錯誤的頁面請求。'));

    $posts = OAInput::post ();
    $name = OAInput::file ('name');

    if ($msg = $this->_validation_update ($posts, $name, $obj))
      return redirect_message (array ($this->uri_1, $parent->id, $this->uri_2, $obj->id, 'edit'), array ('_flash_danger' => $msg, 'posts' => $posts));

    if ($columns = array_intersect_key ($posts, $obj->table ()->columns))
      foreach ($columns as $column => $value)
        $obj->$column = $value;

    if (!AlbumImage::transaction (function () use ($obj, $name, $posts) { if (!$obj->save () || ($name && !$obj->name->put ($name))) return false; return true; }))
      return redirect_message (array ($this->uri_1, $parent->id, $this->uri_2, $obj->id, 'edit'), array ('_flash_danger' => '更新失敗！', 'posts' => $posts));

    return redirect_message (array ($this->uri_1, $parent->id, $this->uri_2), array ('_flash_info' => '更新成功！'));
  }

  public function destroy () {
    $obj = $this->obj;
    $parent = $this->parent;

    if (!AlbumImage::transaction (function () use ($obj) { return $obj->destroy (); }))
      return redirect_message (array ($this->uri_1, $parent->id, $this->uri_2), array ('_flash_danger' => '刪除失敗！'));

    return redirect_message (array ($this->uri_1, $parent->id, $this->uri_2), array ('_flash_info' => '刪除成功！'));
  }

  public function sort ($tag_id, $obj_id, $sort) {
    $obj = $this->obj;
    $parent = $this->parent;

    if (!in_array ($sort, array ('up', 'down')))
      return redirect_message (array ($this->uri_1, $parent->id, $this->uri_2), array ('_flash_danger' => '排序失敗！'));

    OaModel::addConditions ($conditions, 'album_id = ?', $parent->id);
    $total = AlbumImage::count (array ('conditions' => $conditions));

    switch ($sort) {
      case 'up': $sort = $obj->sort; $obj->sort = $obj->sort + 1 >= $total ? 0 : $obj->sort + 1; break;
      case 'down': $sort = $obj->sort; $obj->sort = $obj->sort - 1 < 0 ? $total - 1 : $obj->sort - 1; break;
    }

    $change = array ();
    array_push ($change, array ('id' => $obj->id, 'old' => $sort, 'new' => $obj->sort));
    OaModel::addConditions ($conditions, 'sort = ?', $obj->sort);

    if (!AlbumImage::transaction (function () use ($conditions, $obj, $sort, &$change) { if (($next = AlbumImage::find ('one', array ('conditions' => $conditions))) && array_push ($change, array ('id' => $next->id, 'old' => $next->sort, 'new' => $sort))) { $next->sort = $sort; if (!$next->save ()) return false; } return $obj->save (); }))
      return redirect_message (array ($this->uri_1, $parent->id, $this->uri_2), array ('_flash_danger' => '排序失敗！'));

    return redirect_message (array ($this->uri_1, $parent->id, $this->uri_2), array ('_flash_info' => '排序成功！'));
  }
  private function _validation_create (&$posts, &$name) {
    if (!isset ($posts['title'])) $posts['title'] = '';
    
    if (!isset ($name)) return '沒有選擇 文章封面！';
    if (!is_upload_image_format ($name, 20 * 1024 * 1024, array ('gif', 'jpeg', 'jpg', 'png'))) return '文章封面 格式錯誤！';
    return '';
  }
  private function _validation_update (&$posts, &$name, $obj) {
    if (!isset ($posts['title'])) $posts['title'] = '';
    if (!((string)$obj->name || isset ($name))) return '沒有選擇 文章封面！';
    if ($name && !is_upload_image_format ($name, 20 * 1024 * 1024, array ('gif', 'jpeg', 'jpg', 'png'))) return '文章封面 格式錯誤！';
  }
}
