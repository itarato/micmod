<?php
/**
 * @file
 */

namespace Micmod\Storage;

interface InsertQueryEngine extends QueryEngine {

  public function setFieldValue($column, $value);

}
