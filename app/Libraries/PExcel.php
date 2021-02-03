<?php

namespace App\Libraries;

use PHPExcel;
use PHPExcel_IOFactory;

require_once dirname(__FILE__) . '/PHPExcel/Classes/PHPExcel.php';

class PExcel extends PHPExcel
{
    public function load($file){
        return PHPExcel_IOFactory::load($file);
    }
}
