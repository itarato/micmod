<?php
/**
 * @file
 */

namespace Micmod\Model;

use Micmod\Storage\StorageEngineFactory;

class DrupalModel extends AbstractModel {

  /**
   * @return StorageEngineFactory
   */
  function getStorageEngine() {
    return new \Micmod\Storage\Drupal\StorageEngineFactory();
  }

}
