<?php
/**
 * @file
 */

namespace Micmod\Model;

use Micmod\Annotation\AnnotationReader;
use Micmod\Exception\ModelException;
use Micmod\Filter\FieldFilter;
use Micmod\Filter\Not;
use Micmod\Filter\PrimaryKeyFilter;
use Micmod\Param\Field;
use Micmod\Storage\StorageEngineFactory;
use ReflectionClass;

abstract class AbstractModel {

  /**
   * @return StorageEngineFactory
   */
  abstract function getStorageEngine();

  /**
   * @param FieldFilter[] $filters
   * @return \Micmod\Param\Field[]
   */
  private function getFields(array $filters = array()) {
    $fields = array();
    $class = get_class($this);
    $refl = new ReflectionClass($class);

    foreach (array_keys($refl->getDefaultProperties()) as $property) {
      $column = AnnotationReader::getPropertyValue($class, $property, 'column');
      if (!$column) {
        continue;
      }

      foreach ($filters as $filter) {
        if (!$filter->isValid($class, $property)) {
          continue 2;
        }
      }

      $fields[] = new Field($property, $column, $this->{$property});
    }
    return $fields;
  }

  private function getTable() {
    $class = get_class($this);
    $table = AnnotationReader::getClassValue($class, 'table');

    if (!$table) {
      throw new ModelException('Missing @table definition on class: ' . $class);
    }

    return $table;
  }

  public function save() {
    $insertQuery = $this->getStorageEngine()->getInsertQuery();
    $insertQuery->setTable($this->getTable());

    foreach ($this->getFields() as $field) {
      // @todo think about adding option to prepare the value for the query
      // maybe a getter annotation tag
      $insertQuery->setFieldValue($field->getColumn(), $field->getValue());
    }

    $insertQuery->execute();

    // @todo handle when a PK is auto increment (load or return AIPK)
  }

  public function load() {
    $selectQuery = $this->getStorageEngine()->getSelectQuery();
    $selectQuery->setTable($this->getTable());
    $selectQuery->setLimit(1);

    $primaryKeyFields = $this->getFields(array(new PrimaryKeyFilter()));

    if (empty($primaryKeyFields)) {
      throw new ModelException('Load can be used only when there are primary keys');
    }

    foreach ($primaryKeyFields as $primaryKeyField) {
      if (($value = $primaryKeyField->getValue()) === NULL) {
        throw new ModelException('Primary key <' . $primaryKeyField->getProperty() . '> must not be null when loading the record');
      }

      $selectQuery->setCondition($primaryKeyField->getColumn(), $value);
    }

    $record = $selectQuery->execute();
    if (!$record) {
      // @todo would be nice to log
      // @todo make it obvious it's not found
      return NULL;
    }

    $fields = $this->getFields();
    foreach ($fields as $field) {
      $this->{$field->getProperty()} = $record->{$field->getColumn()};
    }
  }

  public function update() {
    $updateQuery = $this->getStorageEngine()->getUpdateQuery();
    $updateQuery->setTable($this->getTable());

    $primaryKeyFields = $this->getFields(array(new PrimaryKeyFilter()));
    if (empty($primaryKeyFields)) {
      throw new ModelException('Missing primary key fields from ' . __CLASS__);
    }

    foreach ($primaryKeyFields as $primaryKeyField) {
      if (($value = $primaryKeyField->getValue()) === NULL) {
        throw new ModelException('Primary key <' . $primaryKeyField->getProperty() . '> must not be null');
      }
      $updateQuery->setCondition($primaryKeyField->getColumn(), $value);
    }

    $fields = $this->getFields(array(new Not(new PrimaryKeyFilter())));
    if (empty($fields)) {
      // Nothing to update.
      return;
    }

    foreach ($fields as $field) {
      $updateQuery->setFieldValue($field->getColumn(), $field->getValue());
    }

    $updateQuery->execute();
  }

  public function delete() {
    $deleteQuery = $this->getStorageEngine()->getDeleteQuery();
    $deleteQuery->setTable($this->getTable());

    $primaryKeyFields = $this->getFields(array(new PrimaryKeyFilter()));
    if (empty($primaryKeyFields)) {
      throw new ModelException('Missing primary key fields from ' . __CLASS__);
    }

    foreach ($primaryKeyFields as $primaryKeyField) {
      if (($value = $primaryKeyField->getValue()) === NULL) {
        throw new ModelException('Primary key <' . $primaryKeyField->getProperty() . '> must not be null');
      }
      $deleteQuery->setCondition($primaryKeyField->getColumn(), $primaryKeyField->getValue());
    }

    $deleteQuery->execute();
  }

}
