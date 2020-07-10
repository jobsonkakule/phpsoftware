<?php
namespace App\Table;

use PDO;
use Exception;
use App\Entity\City;

class CityTable extends Table {

    protected $table = "city";
    protected $class = City::class;

    public function list (): array
    {
        $sql = "SELECT * FROM {$this->table}  ORDER BY title ASC";
        $cities = $this->pdo->query($sql, PDO::FETCH_CLASS, $this->class)->fetchAll();
        // $cities = array_reverse($this->all());
        $results = [];
        foreach ($cities as $city) {
            $results[$city->getId()] = $city->getTitle();
        }
        return $results;
    }

}