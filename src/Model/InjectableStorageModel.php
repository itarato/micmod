<?php
/**
 * @file
 */

namespace Micmod\Model;

use Micmod\Storage\StorageEngineFactory;

class InjectableStorageModel extends AbstractModel {

  /**
   * @var \Micmod\Storage\StorageEngineFactory
   */
  private $storageEngineFactory;

  public function __construct(StorageEngineFactory $storageEngineFactory) {
    $this->storageEngineFactory = $storageEngineFactory;
  }

  /**
   * @return StorageEngineFactory
   */
  function getStorageEngine() {
    return $this->storageEngineFactory;
  }

}
