<?php
/**
 * @file
 */

namespace Micmod\Storage;

interface UpdateQueryEngine extends QueryEngine {

  public function setFieldValue($column, $value);

  public function setCondition($column, $value);

}
