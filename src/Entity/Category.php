<?php
namespace App\Entity;

use Cocur\Slugify\Slugify;

class Category{

    private $id;

    private $slug;

    private $name;

    private $post_id;
    
    private $post;

    /**
     * Get the value of id
     */ 
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get the value of slug
     */ 
    public function getSlug(): ?string
    {
        return (new Slugify())->slugify($this->name);
    }

    /**
     * Get the value of name
     */ 
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Get the value of post_id
     */ 
    public function getPostId(): ?int
    {
        return $this->post_id;
    }

    /**
     * Set the value of post
     *
     * @return  self
     */ 
    public function setPost(Post $post)
    {
        $this->post = $post;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}