<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserLogModel extends MY_Model {

  protected $table = 'tb_user_login';
  protected $view = 'vi_user_log';

  public function map($data) {

    $data['loginOn'] = $this->getLoginOn($data);
    $data['logoutOn'] = $this->getLogoutOn($data);

    return $data;
  }

  private function getLoginOn($data) {
    $loginOn = date_create($data['loginOn']);
    return date_format($loginOn, 'd/m/Y h:i:s');
  }

  private function getLogoutOn($data) {
    $logoutOn = date_create($data['logoutOn']);
    return date_format($logoutOn, 'd/m/Y h:i:s');
  }

}
