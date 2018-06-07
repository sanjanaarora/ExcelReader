<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

$inputFileName = 'example1.xlsx';
$sheetname = 'Data Sheet #3';
/** Load $inputFileName to a Spreadsheet Object  **/
$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);
$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
class MyReadFilter implements \PhpOffice\PhpSpreadsheet\Reader\IReadFilter {

    public function readCell($column, $row, $worksheetName = '') {
        // Read title row and rows 20 - 30
        if ($row == 1 || ($row >= 20 && $row <= 30)) {
            return true;
        }
        return false;
    }
}

/**  Create a new Reader of the type defined in $inputFileType  **/
$reader = IOFactory::createReader('Xlsx');
/**  Advise the Reader that we only want to load cell data  **/
$reader->setReadDataOnly(true);
$reader->setLoadSheetsOnly($sheetname);
/**  Load $inputFileName to a Spreadsheet Object  **/
$spreadsheet = $reader->load($inputFileName);


$sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
?>
<pre>
    <?php
    print_r($sheetData);
    ?>
</pre>
