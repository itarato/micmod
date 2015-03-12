<?php
/**
 * @file
 */

namespace Micmod\Storage\Drupal;

class InsertQueryEngine implements \Micmod\Storage\InsertQueryEngine {

  /**
   * @var \InsertQuery
   */
  protected $insertQuery = NULL;

  protected $fields = NULL;

  public function setTable($table) {
    $this->insertQuery = db_insert($table);
  }

  public function setFieldValue($column, $value) {
    $this->fields[$column] = $value;
  }

  public function execute() {
    $this->insertQuery->fields($this->fields);
    $this->insertQuery->execute();
  }

}
