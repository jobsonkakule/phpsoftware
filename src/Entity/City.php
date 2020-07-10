<?php
namespace App\Entity;

class City {

    private $id;
    private $title;
    private $province_id;

    /**
     * Get the value of id
     */ 
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of title
     */ 
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */ 
    public function setTitle($title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of province_id
     */ 
    public function getProvinceId(): ?int
    {
        return $this->province_id;
    }

    /**
     * Set the value of province_id
     *
     * @return  self
     */ 
    public function setProvinceId($province_id): self
    {
        $this->province_id = $province_id;

        return $this;
    }
}