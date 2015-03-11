<?php
/**
 * @file
 */

namespace Micmod\Model;

use Micmod\Annotation\AnnotationReader;
use Micmod\Storage\StorageEngineFactory;
use ReflectionClass;

abstract class AbstractModel {

  /**
   * @return StorageEngineFactory
   */
  abstract function getStorageEngine();

  public function save() {
    $insertQuery = $this->getStorageEngine()->getInsertQuery();

    $class = get_class($this);
    $table = AnnotationReader::getClassValue($class, 'table');

    if (!$table) {
      throw new \Exception('Missing @table definition on class: ' . $class);
    }

    $insertQuery->setTable($table);

    $refl = new ReflectionClass($class);
    foreach (array_keys($refl->getDefaultProperties()) as $property) {
      $column = AnnotationReader::getPropertyValue($class, $property, 'column');
      if (!$column) {
        continue;
      }

      // @todo think about adding option to prepare the value for the query
      // maybe a getter annotation tag
      $insertQuery->setFieldValue($column, $this->{$property});
    }

    $insertQuery->execute();
  }

}
