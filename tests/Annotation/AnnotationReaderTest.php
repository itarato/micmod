<?php
use Micmod\Annotation\AnnotationReader;

/**
 * @file
 */

class AnnotationReaderTest extends PHPUnit_Framework_TestCase {

  protected $class;

  protected $prop;

  public function setUp() {
    parent::setUp();
    $this->class = 'FoobarAnnotation';
    $this->prop = 'foo';
  }

  public function testHasClassAnnotation() {
    $this->assertTrue(AnnotationReader::hasClassTag($this->class, 'tagwithoutvalue'));
    $this->assertTrue(AnnotationReader::hasClassTag($this->class, 'tagwithvalue'));
    $this->assertFalse(AnnotationReader::hasClassTag($this->class, 'notatag'));
    $this->assertFalse(AnnotationReader::hasClassTag($this->class, 'nonexisting'));
  }

  public function testGetTagFromClass() {
    $this->assertEmpty(AnnotationReader::getClassValue($this->class, 'notatag'));
    $this->assertEmpty(AnnotationReader::getClassValue($this->class, 'nonexisting'));
    $this->assertEmpty(AnnotationReader::getClassValue($this->class, 'tagwithoutvalue'));
    $this->assertEquals(AnnotationReader::getClassValue($this->class, 'tagwithvalue'), 'value');
  }

  public function testHasPropertyAnnotation() {
    $this->assertTrue(AnnotationReader::hasPropertyTag($this->class, $this->prop, 'tagwithoutvalue'));
    $this->assertTrue(AnnotationReader::hasPropertyTag($this->class, $this->prop, 'tagwithvalue'));
    $this->assertFalse(AnnotationReader::hasPropertyTag($this->class, $this->prop, 'notatag'));
    $this->assertFalse(AnnotationReader::hasPropertyTag($this->class, $this->prop, 'nonexisting'));
  }

  public function testGetTagFromProperty() {
    $this->assertEmpty(AnnotationReader::getPropertyValue($this->class, $this->prop, 'tagwithoutvalue'));
    $this->assertEmpty(AnnotationReader::getPropertyValue($this->class, $this->prop, 'notatag'));
    $this->assertEmpty(AnnotationReader::getPropertyValue($this->class, $this->prop, 'nonexisting'));
    $this->assertEquals(AnnotationReader::getPropertyValue($this->class, $this->prop, 'tagwithvalue'), 'value');
  }

}
