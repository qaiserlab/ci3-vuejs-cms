<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AccountController extends MY_Controller {

  public function signUp() {
    $this->authen(AT_FREE);

    // Request

    $data = $this->input->post();

    // Library

    $this->load->library('email');

    // Model

    $this->load->model('MemberModel');

    // Validate

    $errors = $this->MemberModel->validate($data);

    if ($errors)
      $this->invalid($errors);

    // Create

    $result = $this->MemberModel->create($data);

    // Email

    // $this->email->from('developer@typerun.net', 'Typerun');
    // $this->email->to($data['email'], $data['firstName'].' '.$data['lastName']);
    // $this->email->subject('Welcome As Member At Typerun.net');
    // $this->email->message('Congratulation, you are registered as a Member on <a href="http://typerun.net">Typerun.net</a>');
    //
    // $mailError = '';
    //
    // try {
    //    $this->email->send();
    // } catch(Exception $e){
    //    $mailError = $e->getMessage();
    // }

    // Output

    $this->success('SIGNUP_SUCCESS', $result);
  }

  public function validateSignIn($data, $scenario = '') {

    $errors = [];

    if (empty($data['email']))
      $errors[] = 'Username/Email required';

    if (empty($data['password']))
      $errors[] = 'Password required';

    if (!empty($data['email'])) {

      $found = $this->MemberModel->select()
        ->where('email', $data['email'])
        ->count_all_results();

      if ($found <= 0) {

        $found = $this->MemberModel->select()
          ->where('username', $data['email'])
          ->count_all_results();

        if ($found <= 0)
          $errors[] = 'Email not registered';
        else {
          $rowUser = $this->MemberModel->select()
            ->where('username', $data['email'])
            ->get()
            ->row_array();

          $password = $this->encrypt($data['password'], $rowUser['salt']);

          if (!empty($data['password'])) {
            if ($password != $rowUser['password'])
              $errors[] = 'Invalid Password';
          }
        }

      }
      else {
        $rowUser = $this->MemberModel->select()
                      ->where('email', $data['email'])
                      ->get()
                      ->row_array();

        $password = $this->encrypt($data['password'], $rowUser['salt']);

        if (!empty($data['password'])) {
          if ($password != $rowUser['password'])
            $errors[] = 'Invalid Password';
        }
      }
    }

    if (count($errors) > 0)
      return $errors;

  }

  public function signIn() {
    $this->authen(AT_FREE);

    // Request

    $data = [
      'email' => $this->input->post('email'),
      'password' => $this->input->post('password'),
    ];

    // Model

    $this->load->model('MemberModel');
    $errors = $this->validateSignIn($data);

    if ($errors)
      $this->invalid($errors);

    // Register Session

    $rowMember = $this->MemberModel->findOne('email', $data['email']);

    if (empty($rowMember))
      $rowMember = $this->MemberModel->findOne('username', $data['email']);

    $_SESSION['authKey'] = $this->encrypt();
    $_SESSION['authType'] = AT_MEMBER;
    $_SESSION['id'] = $rowMember['id'];
    $_SESSION['firstName'] = $rowMember['firstName'];
    $_SESSION['lastName'] = $rowMember['lastName'];
    $_SESSION['name'] = $rowMember['name'];
    $_SESSION['username'] = $rowMember['username'];
    $_SESSION['email'] = $rowMember['email'];

    // Output

    $this->success('LOGIN_SUCCESS', $_SESSION);
  }

  public function signOut() {
    $this->authen(AT_MEMBER);

    session_destroy();
      $this->success('LOGOUT_SUCCESS');
  }

  private function validateLogin($data, $scenario = '') {

    $errors = [];

    if (empty($data['email']))
      $errors[] = lang('USERNAME_EMAIL_REQUIRED');

    if (empty($data['password']))
      $errors[] = lang('PASSWORD_REQUIRED');

    if (!empty($data['email'])) {

      $found = $this->UserModel->select('password, salt')
              ->where('email', $data['email'])
              ->count_all_results();

      if ($found <= 0) {

        $found = $this->UserModel->select('password, salt')
                    ->where('username', $data['email'])
                    ->count_all_results();

        if ($found <= 0)
          $errors[] = lang('EMAIL_NOT_REGISTERED');
        else {

          $rowUser = $this->UserModel->select('password, salt')
                        ->where('username', $data['email'])
                        ->get()
                        ->row_array();

          $password = $this->encrypt($data['password'], $rowUser['salt']);

          if (!empty($data['password'])) {
            if ($password != $rowUser['password'])
              $errors[] = lang('INVALID_PASSWORD');
          }
        }

      }
      else {
        $rowUser = $this->UserModel->select('password, salt')
                      ->where('email', $data['email'])
                      ->get()
                      ->row_array();

        $password = $this->encrypt($data['password'], $rowUser['salt']);

        if (!empty($data['password'])) {
          if ($password != $rowUser['password'])
            $errors[] = lang('INVALID_PASSWORD');
        }
      }
    }

    if (count($errors) > 0)
      return $errors;
  }

  public function login() {
    $this->authen(AT_FREE);

    // Request

    $data = [
      'email' => $this->input->post('email'),
      'password' => $this->input->post('password'),
    ];

    // Model

    $this->load->model('UserModel');
    $this->load->model('UserLogModel');

    // Validate

    $errors = $this->validateLogin($data);

    if ($errors)
      $this->invalid($errors);

    // Register Session

    $rowUser = $this->UserModel->findOne('email', $data['email']);

    if (!$rowUser)
      $rowUser = $this->UserModel->findOne('username', $data['email']);

    $userId = $rowUser['id'];
    $authType = AT_USER;
    $authKey = $this->encrypt();

    $_SESSION['id'] = $userId;
    $_SESSION['authType'] = $authType;
    $_SESSION['authKey'] = $authKey;
    $_SESSION['firstName'] = $rowUser['firstName'];
    $_SESSION['lastName'] = $rowUser['lastName'];
    $_SESSION['fullName'] = $rowUser['fullName'];
    $_SESSION['photo'] = $rowUser['_photo'];
    $_SESSION['username'] = $rowUser['username'];
    $_SESSION['email'] = $rowUser['email'];
    $_SESSION['registeredOn'] = $rowUser['registeredOn'];
    $_SESSION['registeredDate'] = $rowUser['registeredDate'];
    $_SESSION['registeredTime'] = $rowUser['registeredTime'];

    // $this->UserLogModel->create([
    //   'userId' => $userId,
    //   'authType' => $authType,
    //   'authKey' => $authKey,
    // ]);

    // User logging

    $loginOn = date('Y-m-d h:i:s');

    $data = [
      'userId' => $userId,
      'authType' => $authType,
      'authKey' => $authKey,
      'loginOn' => $loginOn,
    ];

    $this->UserLogModel->insert($data);

    // Output

    $this->success('LOGIN_SUCCESS', $_SESSION);
  }

  public function logout() {
    $this->authen(AT_FREE);

    $this->load->model('UserLogModel');
    $authKey = $this->input->post('authKey');

    session_destroy();

    // $this->UserLogModel->update([
    //   'authKey' => $authKey,
    // ]);

    // User logging

    $row = $this->UserLogModel->select('id')
      ->where('authKey', $authKey)
      ->get()
      ->row_array();

    $userLoginId = $row['id'];
    $logoutOn = date('Y-m-d h:i:s');

    $data = [
      'userLoginId' => $userLoginId,
      'logoutOn' => $logoutOn,
    ];

    // Execute

    $this->db->insert('tb_user_logout', $data);

    $this->success('LOGOUT_SUCCESS');
  }

}
