<?php
/**
 * @file
 */

/**
 * notatag
 * @tagwithoutvalue
 * @tagwithvalue value
 *
 * @table foobar
 */
class FoobarAnnotation extends \Micmod\Model\InjectableStorageModel {

  /**
   * notatag
   * @tagwithoutvalue
   * @tagwithvalue value
   *
   * @column foocol
   */
  public $foo;

  /**
   * @column idcol
   * @primary-key
   */
  public $id;

  public $not_model;

}

class NoTableFoobarAnnotations extends \Micmod\Model\InjectableStorageModel {

  /**
   * notatag
   * @tagwithoutvalue
   * @tagwithvalue value
   *
   * @column foocol
   */
  public $foo;

  /**
   * @column idcol
   * @primary-key
   */
  public $id;

  public $not_model;

}

/**
 * notatag
 * @tagwithoutvalue
 * @tagwithvalue value
 *
 * @table foobar
 */
class NoPKFoobarAnnotations extends \Micmod\Model\InjectableStorageModel {

  /**
   * notatag
   * @tagwithoutvalue
   * @tagwithvalue value
   *
   * @column foocol
   */
  public $foo;

  /**
   * @column idcol
   */
  public $id;

  public $not_model;

}
