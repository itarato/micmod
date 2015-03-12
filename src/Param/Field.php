<?php
/**
 * @file
 */

namespace Micmod\Param;

class Field {

  private $property;

  private $column;

  /**
   * @var null
   */
  private $value;

  public function __construct($property, $column, $value = NULL) {
    $this->property = $property;
    $this->column = $column;
    $this->value = $value;
  }

  /**
   * @return mixed
   */
  public function getProperty() {
    return $this->property;
  }

  /**
   * @param mixed $property
   */
  public function setProperty($property) {
    $this->property = $property;
  }

  /**
   * @return mixed
   */
  public function getColumn() {
    return $this->column;
  }

  /**
   * @param mixed $column
   */
  public function setColumn($column) {
    $this->column = $column;
  }

  /**
   * @return null
   */
  public function getValue() {
    return $this->value;
  }

  /**
   * @param null $value
   */
  public function setValue($value) {
    $this->value = $value;
  }

}
