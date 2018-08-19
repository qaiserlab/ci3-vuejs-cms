<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProductCategoryModel extends MY_Model {

  protected $table = 'tb_product_category';

  public function map($data) {

    $data['permalink'] = $this->getPermalink($data);

    return $data;
  }

  private function getPermalink($data) {

    $slug = $data['slug'];
    $permalink = base_url('category/'.$slug);

    return $permalink;
  }

}
