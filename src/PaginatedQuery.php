<?php
namespace App;

use PDO;
use Exception;

class PaginatedQuery {

    private $query;
    private $queryCount;
    private $pdo;
    private $perPage;
    private $count;
    private $items;

    public function __construct(
        string $query,
        string $queryCount,
        ?PDO $pdo = null,
        int $perPage = 12
    )
    {
        $this->query = $query;
        $this->queryCount = $queryCount;
        $this->pdo = $pdo ?: Connection::getPDO();
        $this->perPage = $perPage;
    }

    public function getItems(string $classMapping): array
    {
        if ($this->items === null) {
            $pages = $this->getPages();
            $currentPage =$this->getCurrentPage();
            if ($currentPage > $pages) {
                throw new Exception('Cette page n\'existe pas');
            }
            $offset = $this->perPage * ($currentPage -1);
            $this->items =  $this->pdo->query(
                $this->query . 
                " LIMIT {$this->perPage} OFFSET $offset ")
                ->fetchAll(PDO::FETCH_CLASS, $classMapping);
        }
        return $this->items;
    }

    public function previousLink(string $link): ?string
    {
        $currentPage =$this->getCurrentPage();
        if ($currentPage <= 1) {
            return <<<HTML
        <a href="{$link}" class="btn btn-primary disabled mr-2">&laquo; Page précédente</a>
HTML;
        }
        if ($currentPage > 2 ) $link .= '?page=' . ($currentPage - 1);
        return <<<HTML
        <a href="{$link}" class="btn btn-primary">&laquo; Page précédente</a>
HTML;
    }

    public function nextLink(string $link): ?string
    {
        $currentPage =$this->getCurrentPage();
        $pages = $this->getPages();
        if ($currentPage >= $pages) {
            return <<<HTML
            <a href="{$link}" class="btn btn-primary ml-2 disabled">Page suivante &raquo; </a>
    HTML;
        }
        $link .= '?page=' . ($currentPage + 1);
        return <<<HTML
        <a href="{$link}" class="btn btn-primary ml-2">Page suivante &raquo; </a>
HTML;
    }

    private function getCurrentPage(): int
    {
        return URL::getPositiveInt('page', 1);
    }

    private function getPages (): int
    {
        if ($this->count === null) {
            $this->count = (int)$this->pdo
                ->query($this->queryCount)
                ->fetch(PDO::FETCH_NUM)[0];
        }
        return ceil($this->count / $this->perPage);
    }
}