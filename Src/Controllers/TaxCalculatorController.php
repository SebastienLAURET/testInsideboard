<?php
class TaxCalculatorController {
  public $bill;

  function __construct($filename) {
    $this->initByCSV($filename);
  }


  public function start() {
    foreach ($this->bill->lines as $line) {
      $priceHT = $line->calculatePriceWithoutTaxe();
      $tax = $line->calculateTax();
      $priceTTC = $line->calculatePriceWithTaxe();
      echo "{$line->description} : {$priceHT} + {$tax} = {$priceTTC}\n";
    }
    $this->witeResult();
  }


  private function initByCSV($filename) {
    if (($handle = fopen($filename, "r")) !== FALSE) {
      $this->bill = new Bill;
      $this->bill->initByCSV($handle);
      fclose($handle);
    }
  }

  private function witeResult() {
    if (($handle = fopen("./Example/output.csv", "w")) !== FALSE) {
      $txt = $this->bill->toCSV();

      fwrite($handle, $txt);
      fclose($handle);
    }
  }
}
 ?>
