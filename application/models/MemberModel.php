<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MemberModel extends MY_Model {

  protected $table = 'tb_member';
  protected $view = 'vi_member';

  public function validate($data, $scenario = '') {
    $errors = array();

    if (empty($data['firstName']))
      $errors[]='First Name required';

    if (empty($data['lastName']))
      $errors[]='Last Name required';

    if (empty($data['username']))
      $errors[]='Username required';

    if (empty($data['email']))
      $errors[]='Email required';

    if (!empty($data['username'])) {
      $found = $this->query()
                  ->where('username', $data['username'])
                  ->count_all_results();

      if ($found >= 1)
        $errors[]='Username already taken';
    }

    if (!empty($data['email'])) {
      $found = $this->query()
                  ->where('email', $data['email'])
                  ->count_all_results();

      if ($found >= 1)
        $errors[]='Email already registered';
    }

    if (empty($data['password']))
      $errors[]='Password required';

    if (empty($data['retypePassword']))
      $errors[]='Retype Password required';

    if (!empty(($data['password']))) {
      if (strlen($data['password']) < 6)
        $errors[]='Password must be more than 6 character';
    }

    if (!empty($data['password']) && !empty($data['retypePassword'])) {

      if ($data['password'] != $data['retypePassword'])
        $errors[]='Retype Password not match';
    }

    if (count($errors) > 0)
      return $errors;
    else
      return false;
  }

}
