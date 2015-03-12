<?php
/**
 * @file
 */

namespace Micmod\Storage;

interface SelectQueryEngine extends QueryEngine {

  public function setCondition($column, $value);

  public function setLimit($limit);

}
