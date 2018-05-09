# testInsideboard
## Launch
```bash
cd /path/to/the/project
php ./bin/TaxCalculator.php ./Example/input_1.csv 
```

### Data Structure

### Input
Create csv file:

|nb|description|prixunitaire|type|externe| 
|---|---|---|---|---|
|Integer|String|Integer|eTaxType|String(boolean)|

### Output

See in Example folder output file is created ```output.csv```

|nb|description|prixunitaire|type|externe|prix HT|percent taxe|taxe|prix TTC|
|---|---|---|---|---|---|---|---|---|
|Integer|String|Float|eTaxType|String(boolean)|Float|Float|Float|Float|


### Enum Tax Type

|eTaxType|
|---|
|livre|
|alimentation|
|médicament|
|autre|
