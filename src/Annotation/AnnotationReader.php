<?php
/**
 * @file
 */

namespace Micmod\Annotation;

use ReflectionClass;
use ReflectionProperty;

class AnnotationReader {

  protected static function getTagFromDoc($doc, $tag) {
    $matches = NULL;
    preg_match('/@' . $tag . ' (?P<tag>[^\n]*)/s', $doc, $matches);
    return isset($matches['tag']) ? trim($matches['tag']) : '';
  }

  protected static function hasTagInDoc($doc, $tag) {
    return (bool) preg_match('/@' . $tag . '[ \n\r]/s', $doc);
  }

  public static function getClassValue($class, $tag) {
    $classRef = new ReflectionClass($class);
    return static::getTagFromDoc($classRef->getDocComment(), $tag);
  }

  public static function getPropertyValue($class, $property, $tag) {
    $propertyRef = new ReflectionProperty($class, $property);
    return static::getTagFromDoc($propertyRef->getDocComment(), $tag);
  }

  public static function hasPropertyTag($class, $property, $tag) {
    $propertyRef = new ReflectionProperty($class, $property);
    return self::hasTagInDoc($propertyRef->getDocComment(), $tag);
  }

  public static function hasClassTag($class, $tag) {
    $classRef = new ReflectionClass($class);
    return self::hasTagInDoc($classRef->getDocComment(), $tag);
  }

}
