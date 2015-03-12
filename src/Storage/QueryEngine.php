<?php
/**
 * @file
 */

namespace Micmod\Storage;

interface QueryEngine {

  public function setTable($table);

  public function execute();

}
