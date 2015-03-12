<?php
/**
 * @file
 */

namespace Micmod\Storage\Drupal;

class UpdateQueryEngine implements \Micmod\Storage\UpdateQueryEngine {

  /**
   * @var \UpdateQuery
   */
  protected $updateQuery;

  /**
   * @var array
   */
  protected $fields;

  public function setTable($table) {
    $this->updateQuery = db_update($table);
  }

  public function setFieldValue($column, $value) {
    $this->fields[$column] = $value;
  }

  public function setCondition($column, $value) {
    $this->updateQuery->condition($column, $value);
  }

  public function execute() {
    $this->updateQuery->fields($this->fields);
    $this->updateQuery->execute();
  }

}
