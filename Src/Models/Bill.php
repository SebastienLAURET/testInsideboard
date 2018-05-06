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

  public function toCSV() {
    $csvStr = "nb,description,prix unitaire,type,externe,prix HT,percent taxe,taxe,prix TTC\n";
    foreach ($this->lines as $line) {
      $csvStr .= $line->toCSV();
    }
    return $csvStr;
  }
}
 ?>
