<?php defined ('BASEPATH') OR exit ('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2017 OA Wu Design
 * @link        http://www.ioa.tw/
 */

class Albums extends Admin_controller {
  private $uri_1 = null;
  private $obj = null;

  public function __construct () {
    parent::__construct ();
    
    if (!User::current ()->in_roles (array ('media')))
      return redirect_message (array ('admin'), array ('_flash_danger' => '您的權限不足，或者頁面不存在。'));
    
    $this->uri_1 = 'admin/albums';

    if (in_array ($this->uri->rsegments (2, 0), array ('show', 'edit', 'update', 'destroy', 'sort')))
      if (!(($id = $this->uri->rsegments (3, 0)) && ($this->obj = Album::find ('one', array ('conditions' => array ('id = ?', $id))))))
        return redirect_message (array ($this->uri_1), array ('_flash_danger' => '找不到該筆資料。'));

    $this->add_param ('uri_1', $this->uri_1)
         ->add_param ('now_url', base_url ($this->uri_1));
  }
  public function index ($offset = 0) {
    $columns = array ( 
        array ('key' => 'content', 'title' => '內容', 'sql' => 'content LIKE ?'), 
        array ('key' => 'title',   'title' => '標題', 'sql' => 'title LIKE ?'), 
      );

    $configs = array_merge (explode ('/', $this->uri_1), array ('%s'));
    $conditions = conditions ($columns, $configs);

    $limit = 10;
    $total = Album::count (array ('conditions' => $conditions));
    $objs = Album::find ('all', array ('offset' => $offset < $total ? $offset : 0, 'limit' => $limit, 'order' => 'sort DESC', 'include' => array ('user'), 'conditions' => $conditions));

    return $this->load_view (array (
        'objs' => $objs,
        'columns' => $columns,
        'pagination' => $this->_get_pagination ($limit, $total, $configs),
      ));
  }
  public function add () {
    $posts = Session::getData ('posts', true);
    $sources = isset ($posts['sources']) ? $posts['sources'] : array ();
    
    return $this->load_view (array (
        'posts' => $posts,
        'sources' => $sources,
      ));
  }
  public function create () {
    if (!$this->has_post ())
      return redirect_message (array ($this->uri_1, 'add'), array ('_flash_danger' => '非 POST 方法，錯誤的頁面請求。'));

    $posts = OAInput::post ();
    $posts['content'] = OAInput::post ('content', false);
    $cover = OAInput::file ('cover');
    $images = OAInput::file ('images[]');

    if ($msg = $this->_validation_create ($posts, $cover, $images))
      return redirect_message (array ($this->uri_1, 'add'), array ('_flash_danger' => $msg, 'posts' => $posts));

    $posts['sort'] = Album::count ();
    if (!Album::transaction (function () use (&$obj, $posts, $cover) { return verifyCreateOrm ($obj = Album::create (array_intersect_key ($posts, Album::table ()->columns))) && $obj->cover->put ($cover); }))
      return redirect_message (array ($this->uri_1, 'add'), array ('_flash_danger' => '新增失敗！', 'posts' => $posts));

    if ($posts['sources'])
      foreach ($posts['sources'] as $i => $source)
        AlbumSource::transaction (function () use ($i, $source, $obj) { return verifyCreateOrm (AlbumSource::create (array_intersect_key (array_merge ($source, array ('sort' => $i, 'album_id' => $obj->id)), AlbumSource::table ()->columns))); });

    if ($images)
      foreach ($images as $image)
        AlbumImage::transaction (function () use ($image, $obj, $posts) { return verifyCreateOrm ($img = AlbumImage::create (array_intersect_key (array ('album_id' => $obj->id, 'title' => '', 'name' => '', 'user_id' => $posts['user_id']), AlbumImage::table ()->columns))) && $img->name->put ($image); });

    return redirect_message (array ($this->uri_1), array ('_flash_info' => '新增成功！'));
  }
  public function edit () {
    $posts = Session::getData ('posts', true);

    return $this->load_view (array (
        'posts' => $posts,
        'sources' => isset ($posts['sources']) ? $posts['sources'] : array_map (function ($source) { return array ('title' => $source->title, 'href' => $source->href); }, $this->obj->sources),
        'obj' => $this->obj,
      ));
  }
  public function update () {
    $obj = $this->obj;

    if (!$this->has_post ())
      return redirect_message (array ($this->uri_1, $obj->id, 'edit'), array ('_flash_danger' => '非 POST 方法，錯誤的頁面請求。'));

    $posts = OAInput::post ();
    $posts['content'] = OAInput::post ('content', false);
    $cover = OAInput::file ('cover');
    $images = OAInput::file ('images[]');

    if ($msg = $this->_validation_update ($posts, $cover, $images, $obj))
      return redirect_message (array ($this->uri_1, $obj->id, 'edit'), array ('_flash_danger' => $msg, 'posts' => $posts));

    if ($columns = array_intersect_key ($posts, $obj->table ()->columns))
      foreach ($columns as $column => $value)
        $obj->$column = $value;

    if (!Album::transaction (function () use ($obj, $posts, $cover) { if (!$obj->save () || ($cover && !$obj->cover->put ($cover))) return false; return true; }))
      return redirect_message (array ($this->uri_1, $obj->id, 'edit'), array ('_flash_danger' => '更新失敗！', 'posts' => $posts));

    if ($obj->sources)
      foreach ($obj->sources as $source)
        AlbumSource::transaction (function () use ($source) { return $source->destroy (); });

    if ($posts['sources'])
      foreach ($posts['sources'] as $i => $source)
        AlbumSource::transaction (function () use ($i, $source, $obj) { return verifyCreateOrm (AlbumSource::create (array_intersect_key (array_merge ($source, array ('sort' => $i, 'album_id' => $obj->id)), AlbumSource::table ()->columns))); });

    if (($del_ids = array_diff (column_array ($obj->images, 'id'), $posts['oldimg'])) && ($imgs = AlbumImage::find ('all', array ('select' => 'id, name', 'conditions' => array ('id IN (?)', $del_ids)))))
      foreach ($imgs as $img)
        AlbumImage::transaction (function () use ($img) { return $img->destroy (); });

    if ($images)
      foreach ($images as $image)
        AlbumImage::transaction (function () use ($image, $obj, $posts) { return verifyCreateOrm ($img = AlbumImage::create (array_intersect_key (array ('album_id' => $obj->id, 'title' => '', 'name' => '', 'user_id' => $posts['user_id']), AlbumImage::table ()->columns))) && $img->name->put ($image); });

    return redirect_message (array ($this->uri_1), array ('_flash_info' => '更新成功！'));
  }
  public function sort ($id, $sort) {
    $obj = $this->obj;

    if (!in_array ($sort, array ('up', 'down')))
      return redirect_message (array ($this->uri_1), array ('_flash_danger' => '排序失敗！'));

    $conditions = array ();
    $total = Album::count (array ('conditions' => $conditions));

    switch ($sort) {
      case 'up': $sort = $obj->sort; $obj->sort = $obj->sort + 1 >= $total ? 0 : $obj->sort + 1; break;
      case 'down': $sort = $obj->sort; $obj->sort = $obj->sort - 1 < 0 ? $total - 1 : $obj->sort - 1; break;
    }

    $change = array ();
    array_push ($change, array ('id' => $obj->id, 'old' => $sort, 'new' => $obj->sort));
    OaModel::addConditions ($conditions, 'sort = ?', $obj->sort);

    if (!Album::transaction (function () use ($conditions, $obj, $sort, &$change) { if (($next = Album::find ('one', array ('conditions' => $conditions))) && array_push ($change, array ('id' => $next->id, 'old' => $next->sort, 'new' => $sort))) { $next->sort = $sort; if (!$next->save ()) return false; } return $obj->save (); }))
      return redirect_message (array ($this->uri_1), array ('_flash_danger' => '排序失敗！'));

    return redirect_message (array ($this->uri_1), array ('_flash_info' => '排序成功！'));
  }
  public function destroy () {
    $obj = $this->obj;

    if (!Album::transaction (function () use ($obj) { return $obj->destroy (); }))
      return redirect_message (array ($this->uri_1), array ('_flash_danger' => '刪除失敗！'));

    return redirect_message (array ($this->uri_1), array ('_flash_info' => '刪除成功！'));
  }

  private function _validation_create (&$posts, &$cover, &$images) {
    if (!isset ($posts['user_id'])) return '沒有選擇 文章作者！';
    if (!isset ($posts['title'])) return '沒有填寫 文章標題！';
    if (!isset ($cover)) return '沒有選擇 文章封面！';
    
    if (!(is_numeric ($posts['user_id'] = trim ($posts['user_id'])) && User::find ('one', array ('select' => 'id', 'conditions' => array ('id = ?', $posts['user_id']))))) return '文章作者 不存在！';
    if (!(is_string ($posts['title']) && ($posts['title'] = trim ($posts['title'])))) return '文章標題 格式錯誤！';
    if (!is_upload_image_format ($cover, 20 * 1024 * 1024, array ('gif', 'jpeg', 'jpg', 'png'))) return '文章封面 格式錯誤！';
    
    if (!isset ($posts['content'])) $posts['content'] = '';
    
    $posts['cover'] = '';
    $posts['sources'] = isset ($posts['sources']) && is_array ($posts['sources']) && $posts['sources'] ? array_values (array_filter ($posts['sources'], function ($source) { return isset ($source['href']) && is_string ($source['href']) && ($source['href'] = trim ($source['href'])); })) : array ();
    $images = array_filter ($images, function ($image) { return is_upload_image_format ($image, 20 * 1024 * 1024, array ('gif', 'jpeg', 'jpg', 'png')); });
    
    return '';
  }
  private function _validation_update (&$posts, &$cover, &$images, $obj) {
    if (!isset ($posts['user_id'])) return '沒有選擇 文章作者！';
    if (!isset ($posts['title'])) return '沒有填寫 文章標題！';
    if (!((string)$obj->cover || isset ($cover))) return '沒有選擇 文章封面！';

    if (!(is_numeric ($posts['user_id'] = trim ($posts['user_id'])) && User::find ('one', array ('select' => 'id', 'conditions' => array ('id = ?', $posts['user_id']))))) return '文章作者 不存在！';
    if (!(is_string ($posts['title']) && ($posts['title'] = trim ($posts['title'])))) return '文章標題 格式錯誤！';
    if ($cover && !is_upload_image_format ($cover, 20 * 1024 * 1024, array ('gif', 'jpeg', 'jpg', 'png'))) return '文章封面 格式錯誤！';
    
    if (!isset ($posts['content'])) $posts['content'] = '';
    $posts['sources'] = isset ($posts['sources']) && is_array ($posts['sources']) && $posts['sources'] ? array_values (array_filter ($posts['sources'], function ($source) { return isset ($source['href']) && is_string ($source['href']) && ($source['href'] = trim ($source['href'])); })) : array ();
    $images = array_filter ($images, function ($image) { return is_upload_image_format ($image, 20 * 1024 * 1024, array ('gif', 'jpeg', 'jpg', 'png')); });
    $posts['oldimg'] = isset ($posts['oldimg']) ? $posts['oldimg'] : array ();

    return '';
  }
}
