<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MenuModel extends MY_Model {

  protected $table = 'tb_menu';

  public function map($data) {
    $data['menu'] = $this->getMenu($data);

    return $data;
  }

  private function getMenu($data) {
    return json_decode($data['menu'], true);
  }

}
