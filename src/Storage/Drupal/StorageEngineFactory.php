<?php
/**
 * @file
 */

namespace Micmod\Storage\Drupal;

class StorageEngineFactory implements \Micmod\Storage\StorageEngineFactory {

  /**
   * @return InsertQueryEngine
   */
  public function getInsertQuery() {
    return new InsertQueryEngine();
  }

  /**
   * @return SelectQueryEngine
   */
  public function getSelectQuery() {
    return new SelectQueryEngine();
  }

  /**
   * @return UpdateQueryEngine
   */
  public function getUpdateQuery() {
    return new UpdateQueryEngine();
  }

  /**
   * @return DeleteQueryEngine
   */
  public function getDeleteQuery() {
    return new DeleteQueryEngine();
  }

}
