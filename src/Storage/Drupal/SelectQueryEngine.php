<?php
/**
 * @file
 */

namespace Micmod\Storage\Drupal;

class SelectQueryEngine implements \Micmod\Storage\SelectQueryEngine {

  /**
   * @var \SelectQuery
   */
  protected $selectQuery;

  public function setTable($table) {
    $this->selectQuery = db_select($table);
    $this->selectQuery->fields($table);
  }

  public function setCondition($column, $value) {
    $this->selectQuery->condition($column, $value);
  }

  public function setLimit($limit) {
    $this->selectQuery->range(0, $limit);
  }

  public function execute() {
    return $this->selectQuery->execute()->fetchObject();
  }

}
