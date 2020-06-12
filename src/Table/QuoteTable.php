<?php
namespace App\Table;

use App\Entity\Quote;
use App\PaginatedQuery;
use Exception;

class QuoteTable extends Table {

    protected $table = "quote";
    protected $class = Quote::class;

    public function updateQuote(Quote $quote): void
    {
        $this->update([
            'name' => $quote->getName(),
            'content' => $quote->getContent(),
            'image' => $quote->getImage()
        ], $quote->getId());
    }

    public function createQuote(Quote $quote): void
    {
        $id = $this->create([
            'name' => $quote->getName(),
            'content' => $quote->getContent(),
            'created_at' => $quote->getCreatedAt()->format('Y-m-d H:i:s'),
            'image' => $quote->getImage()
        ]);
        $quote->setId($id);
    }
    
    public function findPaginated ()
    {
        $paginatedQuery = new PaginatedQuery(
            "SELECT * FROM {$this->table} ORDER BY created_at DESC",
            "SELECT COUNT(id) FROM {$this->table}",
            $this->pdo
        );
        $quotes = $paginatedQuery->getItems(Quote::class);
        return [$quotes, $paginatedQuery];
    }

}

