<?php
/**
 * @file
 */

namespace Micmod\Filter;

class Not implements FieldFilter {

  /**
   * @var \Micmod\Filter\FieldFilter
   */
  private $originalFilter;

  public function __construct(FieldFilter $originalFilter) {
    $this->originalFilter = $originalFilter;
  }

  public function isValid($class, $property) {
    return !$this->originalFilter->isValid($class, $property);
  }

}
