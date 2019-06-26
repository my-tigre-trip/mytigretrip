<?php

/**
 * uses the file
 */
class ProductFinder{
  public function __constructor() {
    $files = scandir('data', SCANDIR_SORT_DESCENDING);
    $newest_file = $files[0];
  }
}