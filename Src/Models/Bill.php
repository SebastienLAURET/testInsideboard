<?php
class Bill {
  public $lines = [];

  public function initByCSV($handle) {
    $header = fgetcsv($handle, 1000, ",");
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
      $newLine = new Line;
      $newLine->initByCSV($data);
      array_push($this->lines, $newLine);
    }
  }
}
 ?>
