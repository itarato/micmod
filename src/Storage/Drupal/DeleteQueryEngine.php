<?php
/**
 * @file
 */

namespace Micmod\Storage\Drupal;

class DeleteQueryEngine implements \Micmod\Storage\DeleteQueryEngine {

  /**
   * @var \DeleteQuery
   */
  protected $deleteQuery;

  public function setCondition($column, $value) {
    $this->deleteQuery->condition($column, $value);
  }

  public function setTable($table) {
    $this->deleteQuery = db_delete($table);
  }

  public function execute() {
    $this->deleteQuery->execute();
  }

}
