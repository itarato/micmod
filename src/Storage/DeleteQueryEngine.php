<?php
/**
 * @file
 */

namespace Micmod\Storage;

interface DeleteQueryEngine extends QueryEngine {

  public function setCondition($column, $value);

}
