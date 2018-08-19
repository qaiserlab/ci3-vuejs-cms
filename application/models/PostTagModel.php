<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PostTagModel extends MY_Model {

  protected $table = 'tb_post_tag';

  public function map($data) {

    $data['permalink'] = $this->getPermalink($data);

    return $data;
  }

  private function getPermalink($data) {
    $slug = $data['slug'];
    $permalink = base_url('tag/'.$slug);

    return $permalink;
  }

}
