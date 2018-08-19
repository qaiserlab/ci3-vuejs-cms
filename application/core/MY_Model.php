<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Model extends CI_Model {

  protected $table = '';
  protected $view = '';

  protected $primaryKey = 'id';
  protected $shield = '*';

  public $action = '';
  public $scenario = '';

  public function __construct() {
    parent::__construct();

    if (empty($this->view))
      $this->view = $this->table;
  }

  public function model($table, $view = '') {
    $model = new MY_Model();

    $model->table = $table;
    $model->view = $view;

    return $model;
  }

  public function entity() {
    $this->db->from($this->table);
    return $this->db;
  }

  public function virtual() {
    $this->db->from($this->view);
    return $this->db;
  }

  public function select($fields = '') {

    if (empty($fields))
      $fields = $this->shield;

    $q = $this->virtual()->select($fields, true);

    return $q;
  }

  public function where($condition) {
    return $this->entity()->where($condition);
  }

  public function insert($data) {
    $this->db->insert($this->table, $data);
  }

  public function set($data) {
    return $this->entity()->set($data);
  }

  protected function map($data) {
    return $data;
  }

  public function findAll($criteria = []) {

    $q = $this->select($this->shield);

    if (isset($criteria['where']))
      $q->where($criteria['where']);

    if (isset($criteria['whereIn']))
      $q->where_in($criteria['whereIn']);

    if (isset($criteria['orWhere'])) {
      $q->group_start();
      $q->or_where($criteria['orWhere']);
      $q->group_end();
    }

    if (isset($criteria['orderBy']))
      $q->order_by($criteria['orderBy']);

    if (isset($criteria['limit'])) {

      if (!is_array($criteria['limit']))
        $q->limit($criteria['limit']);
      elseif (count($criteria['limit']) == 1)
        $q->limit($criteria['limit'][0]);
      elseif (count($criteria['limit']) == 2)
        $q->limit($criteria['limit'][0], $criteria['limit'][1]);

    }

    $rs = $q->get()->result_array();

    if (isset($criteria['remap'])) {
      if ($criteria['remap'] === true || $criteria['remap'] === 'true') {

        $_rs = [];

        foreach ($rs as $row) {
          $_row = $this->map($row);
          $_rs[] = $_row;
        }

        $rs = $_rs;

      }
    }

    return $rs;
  }

  public function findOne($field, $id = '', $map = true) {

    $q = $this->select($this->shield);

    if (is_array($field)) {

      $criteria = $field;

      if (isset($criteria['where']))
        $q->where($criteria['where']);

      if (isset($criteria['orderBy']))
        $q->order_by($criteria['orderBy']);

      if (isset($criteria['limit'])) {

        if (!is_array($criteria['limit']))
          $q->limit($criteria['limit']);
        elseif (count($criteria['limit']) == 1)
          $q->limit($criteria['limit'][0]);
        elseif (count($criteria['limit']) == 2)
          $q->limit($criteria['limit'][0], $criteria['limit'][1]);
      }

      if (isset($criteria['remap'])) $map = $criteria['remap'];

    }
    elseif (empty($id)) {
      $id = $field;
      $field = $this->primaryKey;

      $q->where($field, $id);
    }
    else
      $q->where($field, $id);

    $row = $q->get()->row_array();

    if ($row && ($map === true || $map === 'true'))
      $row = $this->map($row);

    return $row;
  }

  public function count($criteria = '') {
    $q = $this->db->
      select('count(*) as totalCount', true)->
      from($this->view);

    if (!empty($criteria)) {
      if (isset($criteria['where']))
        $q->where($criteria['where']);

      if (isset($criteria['orWhere'])) {
        $q->group_start();
        $q->or_where($criteria['orWhere']);
        $q->group_end();
      }
    }

    $row = $q->get()->row_array();

    return $row['totalCount'];
  }

}
