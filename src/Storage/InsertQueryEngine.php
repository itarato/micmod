<?php
/**
 * @file
 */

namespace Micmod\Storage;

abstract class InsertQueryEngine {

  abstract public function setTable($table);

  abstract public function setFieldValue($column, $value);

  abstract public function execute();

}
