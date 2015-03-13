<?php
/**
 * @file
 */

class PrimaryKeyFilterTest extends PHPUnit_Framework_TestCase {

  public function testValidation() {
    $validator = new \Micmod\Filter\PrimaryKeyFilter();
    $this->assertTrue($validator->isValid('FoobarAnnotation', 'id'));
    $this->assertFalse($validator->isValid('FoobarAnnotation', 'foo'));
  }

}
