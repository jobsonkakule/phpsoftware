<?php
namespace App\Table;

use PDO;
use App\Entity\Stat;

class StatTable extends Table {

    protected $table = "stat";
    protected $class = Stat::class;

    public function updateStat(Stat $stat): void
    {
        $this->update([
            'cases' => $stat->getCases(),
            'deaths' => $stat->getDeaths(),
            'recoveries' => $stat->getRecoveries(),
            'city_id' => $stat->getCityId(),
            'disease_id' => $stat->getDiseaseId(),
        ], $stat->getId());
    }

    public function createStat(Stat $stat): void
    {
        $id = $this->create([
            'cases' => $stat->getCases(),
            'deaths' => $stat->getDeaths(),
            'recoveries' => $stat->getRecoveries(),
            'city_id' => $stat->getCityId(),
            'disease_id' => $stat->getDiseaseId(),
            'created_at' => $stat->getCreatedAt()->format('Y-m-d H:i:s'),
        ]);
        $stat->setId($id);
    }

    public function list (string $fromTable = 'stat'): array
    {
        $sql = "SELECT * FROM $fromTable  ORDER BY id DESC";
        $provinces = $this->pdo->query($sql, PDO::FETCH_CLASS, $this->class)->fetchAll();
        // $provinces = array_reverse($this->all());
        $results = [];
        foreach ($provinces as $province) {
            $results[$province->getId()] = $province->getTitle();
        }
        return $results;
    }

}