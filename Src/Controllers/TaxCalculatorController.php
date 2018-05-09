<?php
class TaxCalculatorController {
  public $bill;

  function __construct($filename) {
    $this->initByCSV($filename);
  }


  public function start() {
    $totalPriceTTC = 0;
    $totalTax = 0;
    foreach ($this->bill->lines as $line) {
      $tax = $line->calculateTax();
      $totalTax += $tax;

      $priceTTC = $line->calculatePriceWithTaxe();
      $totalPriceTTC += $priceTTC;

      echo "{$line->quantity} {$line->description} : {$priceTTC}\n";
    }
    echo "Montant des taxes : {$totalTax}\n";
    echo "Total : {$totalPriceTTC}\n";
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
