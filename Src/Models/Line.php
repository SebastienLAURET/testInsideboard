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

  public function toCSV() {
    $priceHT = $this->calculatePriceWithoutTaxe();
    $percentTax = $this->calculatePercenTax();
    $tax = $this->calculateTax();
    $priceTTC = $this->calculatePriceWithTaxe();
    $externStr = $this->extern ? "true" : "false";
    return "{$this->quantity},{$this->description},{$this->amount},{$this->type},{$externStr},{$priceHT},{$percentTax},{$tax},{$priceTTC}\n";
  }

  public function calculatePriceWithTaxe() {
    return $this->calculatePriceWithoutTaxe() + $this->calculateTax();
  }

  public function calculatePriceWithoutTaxe() {
    return $this->amount * $this->quantity;
  }

  public function calculateTax() {
    return $this->roundTax($this->calculatePriceWithoutTaxe() * $this->calculatePercenTax());
  }

  public function calculatePercenTax() {
    $basicTax = (in_array($this->type, NOT_TAXED) ? 0 : 0.1);
    $externTax = ($this->extern ? 0.05 : 0);
    return $basicTax + $externTax;
  }

  private function roundTax($tax) {
    $tax = intval(round($tax, 2) * 100);
    if ($tax % 5  > 0) {
      $tax +=  5 - $tax % 5;
    }
    return $tax / 100;
  }

}
 ?>
