<?php
/**
 * @file
 */

namespace Micmod\Storage;

interface StorageEngineFactory {

  /**
   * @return InsertQueryEngine
   */
  public function getInsertQuery();

}
