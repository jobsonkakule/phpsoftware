<?php
namespace App\Table;

use App\Entity\Disease;
use App\PaginatedQuery;
use Exception;

class DiseaseTable extends Table {

    protected $table = "disease";
    protected $class = Disease::class;

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

}

