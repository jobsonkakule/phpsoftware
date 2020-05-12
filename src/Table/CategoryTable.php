<?php
namespace App\Table;

use PDO;
use Exception;
use App\Entity\Post;
use App\Entity\Category;

class CategoryTable extends Table {

    protected $table = "category";
    protected $class = Category::class;
    
    /**
     * hydratePosts
     *
     * @param  Post[] $posts
     * @return void
     */
    public function hydratePosts (array $posts): void
    {
        $postsByID = [];
        foreach($posts as $post) {
            $post->setCategories([]);
            $postsByID[$post->getId()] = $post;
        }
        $categories = $this->pdo
            ->query(
                'SELECT c.*, pc.post_id
                FROM post_category pc
                JOIN category c ON c.id = pc.category_id
                WHERE pc.post_id IN (' . implode(',', array_keys($postsByID)) . ')'
            )->fetchAll(PDO::FETCH_CLASS, $this->class);
        
        foreach ($categories as $category) {
            $postsByID[$category->getPostId()]->addCategory($category);
        }
    }

    public function list (): array
    {
        $sql = "SELECT * FROM {$this->table}  ORDER BY name ASC";
        $categories = $this->pdo->query($sql, PDO::FETCH_CLASS, $this->class)->fetchAll();
        // $categories = array_reverse($this->all());
        $results = [];
        foreach ($categories as $category) {
            $results[$category->getId()] = $category->getName();
        }
        return $results;
    }

}