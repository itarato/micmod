<?php
/**
 * @file
 */

namespace Micmod\Filter;

use Micmod\Annotation\AnnotationReader;

class PrimaryKeyFilter implements FieldFilter {

  public function isValid($class, $property) {
    return AnnotationReader::hasPropertyTag($class, $property, 'primary-key');
  }

}
