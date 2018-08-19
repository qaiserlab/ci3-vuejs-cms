<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserController extends MY_Controller {
  private $model = 'UserModel';

  public function __construct() {
    parent::__construct();

    $this->load->Model($this->model, 'Model');
  }

  public function readAllData() {
    $this->authen(AT_FREE);
    $request = $this->input->post();

    // Query

    $result = $this->Model->findAll($request);

    // Output
    $this->success('DATA_READ', $result);
  }

  public function readOneData($id = '') {
    $this->authen(AT_FREE);
    $request = $this->input->post();

    // Query

    $result = $this->Model->findOne($id);

    // Output
    $this->success('DATA_READ', $result);
  }

  private function validate($data, $scenario = '') {

    $errors = [];

    if (empty($data['firstName']))
      $errors[] = lang('FIRST_NAME_REQUIRED');

    if (empty($data['lastName']))
      $errors[] = lang('LAST_NAME_REQUIRED');

    if ($scenario == 'CREATE_DATA') {
      if (empty($data['username']))
        $errors[] = lang('USERNAME_REQUIRED');

      if (empty($data['email']))
        $errors[] = lang('EMAIL_REQUIRED');

      if (empty($data['password']))
        $errors[] = lang('PASSWORD_REQUIRED');

      if (empty($data['retypePassword']))
        $errors[] = lang('RETYPE_PASSWORD_REQUIRED');

      if ($data['password'] != $data['retypePassword'])
        $errors[] = lang('RETYPE_PASSWORD_NOT_MATCH');
    }

    if (count($errors) > 0)
      return $errors;
  }

  public function createData() {
    $this->authen(AT_USER);
    $request = $this->input->post();

    // Validation

    $errors = $this->validate($request, 'CREATE_DATA');

    if ($errors)
      $this->invalid($errors);

    // Prepare

    $firstName = $request['firstName'];
    $lastName = $request['lastName'];

    $photo = $request['photo'];
    if (!empty($photo)) $this->store($photo);

    $username = $request['username'];
    $email = $request['email'];

    $salt = $this->encrypt();
    $password = $this->encrypt($request['password'], $salt);
    $registeredOn = date('Y-m-d h:i:s');

    $activationId = $request['activationId'];

    // Map

    $data = [
      'firstName' => $firstName,
      'lastName' => $lastName,
      'photo' => $photo,
      'username' => $username,
      'email' => $email,
      'password' => $password,
      'salt' => $salt,
      'registeredOn' => $registeredOn,
      'activationId' => $activationId,
    ];

    // Query

    $this->Model->insert($data);
    $result = $this->Model->findOne($this->db->insert_id());

    // Output

    $this->success('DATA_CREATED', $result);

  }

  public function updateData() {
    $this->authen(AT_USER);

    $request = $this->input->post();
    $id = $this->input->post('id');

    // Validation

    $errors = $this->validate($request);

    if ($errors)
      $this->invalid($errors);

    // Prepare

    $firstName = $request['firstName'];
    $lastName = $request['lastName'];

    $photo = $request['photo'];

    if (!empty($photo)) {
      if (!file_exists('writable/archives/'.$photo))
        $this->store($photo);
    }

    $activationId = $request['activationId'];

    // Map

    $data = [
      'firstName' => $firstName,
      'lastName' => $lastName,
      'photo' => $photo,
      'activationId' => $activationId,
    ];

    // Query

    $this->Model->set($data)
      ->where('id', $id)
      ->update();
    $result = $this->Model->findOne($id);

    // Output

    $this->success('DATA_UPDATED', $result);
  }

  public function deleteData() {
    $id = $this->input->post('id');

    // Query

    $row = $this->Model->findOne([
      'where' => [
        'id' => $id,
      ]
    ]);

    if (!empty($row['photo'])) {
      $file = 'writable/archives/'.$row['photo'];
      if (file_exists($file))
      unlink($file);
    }

    $this->Model->where([
      'id' => $id,
    ])->delete();

    // Output

    $this->success('DATA_DELETED');
  }

}
