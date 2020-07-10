<?php
namespace App\Table;

use PDO;
use Exception;
use App\Entity\Province;

class ProvinceTable extends Table {

    protected $table = "province";
    protected $class = Province::class;
}