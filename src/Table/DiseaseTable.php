<?php
namespace App\Table;

use PDO;
use Exception;
use App\Entity\Disease;
use App\PaginatedQuery;

class DiseaseTable extends Table {

    protected $table = "disease";
    protected $class = Disease::class;

    public function all(string $limit = null): array 
    {
        $sql = "
            SELECT d.id id, name, state, flag, description, first_at, image, coalesce(sum(s.cases),0) cases, coalesce(sum(s.deaths),0) deaths, coalesce(sum(s.deaths),0) recoveries, count(distinct p.id) province
            FROM {$this->table} d 
                LEFT JOIN stat s ON d.id = s.disease_id 
                LEFT JOIN city c ON s.city_id = c.id 
                LEFT JOIN province p on c.province_id = p.id
            GROUP BY d.id ORDER BY d.id DESC";
        if ($limit) {
            $sql .= " LIMIT $limit";
        }
        return $this->pdo->query($sql, PDO::FETCH_CLASS, $this->class)->fetchAll();
    }

    public function updateDisease(Disease $disease): void
    {
        $this->update([
            'name' => $disease->getName(),
            'state' => $disease->getState(),
            'flag' => $disease->getFlag(), 
            'description' => $disease->getDescription(),
            'first_at' => $disease->getFirstAt()->format('Y-m-d H:i:s'),
            'image' => $disease->getImage()
        ], $disease->getId());
    }

    public function createDisease(Disease $disease): void
    {
        $id = $this->create([
            'name' => $disease->getName(),
            'state' => $disease->getState(),
            'flag' => $disease->getFlag(), 
            'description' => $disease->getDescription(),
            'first_at' => $disease->getFirstAt()->format('Y-m-d H:i:s'),
            'image' => $disease->getImage()
        ]);
        $disease->setId($id);
    }

    public function list (): array
    {
        $sql = "SELECT * FROM {$this->table}  ORDER BY name ASC";
        $diseases = $this->pdo->query($sql, PDO::FETCH_CLASS, $this->class)->fetchAll();
        // $diseases = array_reverse($this->all());
        $results = [];
        foreach ($diseases as $disease) {
            $results[$disease->getId()] = $disease->getName();
        }
        return $results;
    }

}

