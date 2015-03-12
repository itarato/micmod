<?php
/**
 * @file
 */

namespace Micmod\Filter;

interface FieldFilter {

  public function isValid($class, $property);

}
