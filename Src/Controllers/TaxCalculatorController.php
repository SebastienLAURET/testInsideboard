<?php
class TaxCalculatorController {
  public $bill;

  public function initByCSV($filename) {
    if (($handle = fopen($filename, "r")) !== FALSE) {
      $this->bill = new Bill;
      $this->bill->initByCSV($handle);
      fclose($handle);
    }
  }

  public function start() {
    foreach ($this->bill->lines as $line) {
      $price = $line->calculatePriceWithTaxe();
      echo "{$line->description} : {$price}\n";
    }
  }

}
 ?>
