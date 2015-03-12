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

  /**
   * @return SelectQueryEngine
   */
  public function getSelectQuery();

  /**
   * @return UpdateQueryEngine
   */
  public function getUpdateQuery();

  /**
   * @return DeleteQueryEngine
   */
  public function getDeleteQuery();

}
