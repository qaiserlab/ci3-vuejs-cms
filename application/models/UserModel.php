<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends MY_Model {

  protected $table = 'tb_user';
  protected $view = 'vi_user';

  protected $shield =
  'id, firstName, lastName, photo, username, email, registeredOn, activationId, activation';

  public function map($data) {

    // registeredOn

    $registeredOn = date_create($data['registeredOn']);
    $_registeredOn = date_format($registeredOn, 'd/m/Y h:i:s');
    $registeredDate = date_format($registeredOn, 'd/m/Y');
    $registeredTime = date_format($registeredOn, 'h:i:s');
    $registeredYear = date_format($registeredOn, 'Y');
    $registeredMonth = date_format($registeredOn, 'm');
    $registeredDay = date_format($registeredOn, 'd');

    // Output

    $data['fullName'] = $this->getFullName($data);
    $data['_photo'] = $this->getPhoto($data);
    $data['_registeredOn'] = $this->getRegisteredOn($data);
    $data['registeredDate'] = $this->getRegisteredDate($data);
    $data['registeredTime'] = $this->getRegisteredTime($data);
    $data['registeredYear'] = $this->getRegisteredYear($data);
    $data['registeredMonth'] = $this->getRegisteredMonth($data);
    $data['registeredDay'] = $this->getRegisteredDay($data);

    return $data;
  }

  private function getFullName($data) {
    return $data['firstName'].' '.$data['lastName'];
  }

  private function getPhoto($data) {
    if (!empty($data['photo']))
      $photo = base_url('writable/archives/'.$data['photo']);
    else
      $photo = '';

    return $photo;
  }

  private function getRegisteredOn($data) {
    $registeredOn = date_create($data['registeredOn']);
    $_registeredOn = date_format($registeredOn, 'd/m/Y h:i:s');

    return $_registeredOn;
  }

  private function getRegisteredDate($data) {
    $registeredOn = date_create($data['registeredOn']);
    $registeredDate = date_format($registeredOn, 'd/m/Y');

    return $registeredDate;
  }

  private function getRegisteredTime($data) {
    $registeredOn = date_create($data['registeredOn']);
    $registeredTime = date_format($registeredOn, 'h:i:s');

    return $registeredTime;
  }

  private function getRegisteredYear($data) {
    $registeredOn = date_create($data['registeredOn']);
    $registeredYear = date_format($registeredOn, 'Y');

    return $registeredYear;
  }

  private function getRegisteredMonth($data) {
    $registeredOn = date_create($data['registeredOn']);
    $registeredMonth = date_format($registeredOn, 'm');

    return $registeredMonth;
  }

  private function getRegisteredDay($data) {
    $registeredOn = date_create($data['registeredOn']);
    $registeredDay = date_format($registeredOn, 'd');

    return $registeredDay;
  }

}
