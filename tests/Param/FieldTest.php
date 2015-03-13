<?php
/**
 * @file
 */

class FieldTest extends PHPUnit_Framework_TestCase {

  public function testFieldProperties() {
    $field = new \Micmod\Param\Field('prop', 'col');

    $this->assertEquals($field->getColumn(), 'col');
    $field->setColumn('col2');
    $this->assertEquals($field->getColumn(), 'col2');

    $this->assertEquals($field->getProperty(), 'prop');
    $field->setProperty('prop2');
    $this->assertEquals($field->getProperty(), 'prop2');

    $this->assertNull($field->getValue());
    $field->setValue('val');
    $this->assertEquals($field->getValue(), 'val');
  }

}
