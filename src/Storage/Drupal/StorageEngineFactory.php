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

}
