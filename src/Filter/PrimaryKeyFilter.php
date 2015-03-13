<?php
/**
 * @file
 */

namespace Micmod\Filter;

use Micmod\Annotation\AnnotationReader;

class PrimaryKeyFilter implements FieldFilter {

  public function isValid($class, $property) {
    // @todo depends on annotation reader, add di
    return AnnotationReader::hasPropertyTag($class, $property, 'primary-key');
  }

}
