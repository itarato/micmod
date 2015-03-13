<?php
/**
 * @file
 */

class NotTest extends PHPUnit_Framework_TestCase {

  public function testNot() {
    $trueFilter = new FixedFilter(TRUE);
    $falseFilter = new FixedFilter(FALSE);
    $notTrueFilter = new \Micmod\Filter\Not($trueFilter);
    $notFalseFilter = new \Micmod\Filter\Not($falseFilter);

    $this->assertTrue($trueFilter->isValid('', ''));
    $this->assertFalse($falseFilter->isValid('', ''));
    $this->assertTrue($notFalseFilter->isValid('', ''));
    $this->assertFalse($notTrueFilter->isValid('', ''));
  }

}

class FixedFilter implements Micmod\Filter\FieldFilter {

  private $return;

  public function __construct($return) {
    $this->return = $return;
  }

  public function isValid($class, $property) {
    return $this->return;
  }

}
