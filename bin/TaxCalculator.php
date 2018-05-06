<?php
require ("Src/TaxCalculator.php");

if (count($argv) == 2) {
  $controller = new TaxCalculatorController;
  $controller->initByCSV($argv[1]);
  $controller->start();
} else {
  echo "[require] input filename \n";
}
 ?>
