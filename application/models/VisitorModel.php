<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class VisitorModel extends MY_Model {

  protected $table = 'tb_visitor';

  public function hit() {

    // Prepare

    $ipAddress = $_SERVER['REMOTE_ADDR'];
    $url = (isset($_SERVER['HTTPS'])?"https":"http").
      "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    $hit = 1;

    $visitOn = date('Y-m-d');

    // Map

    $data = [
      'ipAddress' => $ipAddress,
      'url' => $url,
      'hit' => $hit,
      'visitOn' => $visitOn,
    ];

    // Execute

    $row = $this->findOne([
      'where' => [
        'ipAddress' => $ipAddress,
        'url' => $url,
        'visitOn' => $visitOn,
      ]
    ]);

    if (!$row)
      $this->insert($data);
    else {
      $id = $row['id'];
      $data['hit'] = $row['hit'] + 1;

      $this->set($data)
        ->where($this->primaryKey, $id)
        ->update();
    }

    return $this->findOne($this->db->insert_id());
  }

}
