<?php
class Line {
  public $quantity;
  public $description;
  public $amount;
  public $type;
  public $extern;

  public function initByCSV($data) {
    $this->quantity = intval ($data[0]);
    $this->description = $data[1];
    $this->amount = floatval ($data[2]);
    $this->type = $data[3];
    $this->extern = ($data[4] == "true");
  }

  public function calculatePriceWithTaxe() {
    $price = $this->calculatePriceWithoutTaxe();
    return $price + round($price * $this->calculateTax(), 2, PHP_ROUND_HALF_ODD);
  }

  public function calculatePriceWithoutTaxe() {
    return $this->amount * $this->quantity;
  }

  private function calculateTax() {
    return (in_array($this->type, NOT_TAXED) ? 0.1 : 0) + ($this->extern ? 0.05 : 0);
  }
}
 ?>
