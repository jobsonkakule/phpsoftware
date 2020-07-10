<?php
namespace App\Entity;

use Cocur\Slugify\Slugify;
use DateTime;

class Stat{

    private $id;

    private $cases;

    private $deaths;

    private $recoveries;

    private $city_id;

    private $disease_id;

    private $created_at;
    
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

    public function getDeaths(): ?int
    {
        return $this->deaths;
    }

    public function setDeaths(int $deaths): self
    {
        $this->deaths = $deaths;
        return $this;
    }

    public function getRecoveries(): ?int
    {
        return $this->recoveries;
    }

    public function setRecoveries(int $recoveries): self
    {
        $this->recoveries = $recoveries;
        return $this;
    }
    

    /**
     * Get the value of city_id
     */ 
    public function getCityId(): ?int
    {
        return $this->city_id;
    }

    /**
     * Set the value of city_id
     *
     * @return  self
     */ 
    public function setCityId(int $city_id): self
    {
        $this->city_id = $city_id;

        return $this;
    }

    /**
     * Get the value of disease_id
     */ 
    public function getDiseaseId(): ?int
    {
        return $this->disease_id;
    }

    /**
     * Set the value of disease_id
     *
     * @return  self
     */ 
    public function setDiseaseId(int $disease_id): self
    {
        $this->disease_id = $disease_id;

        return $this;
    }

    /**
     * Get the value of created_at
     */ 
    public function getCreatedAt(): DateTime
    {
        return new DateTime($this->created_at);
    }

    /**
     * Set the value of created_at
     *
     * @return  self
     */ 
    public function setCreatedAt($created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * Get the value of cases
     */ 
    public function getCases(): ?int
    {
        return $this->cases;
    }

    /**
     * Set the value of cases
     *
     * @return  self
     */ 
    public function setCases(int $cases): self
    {
        $this->cases = $cases;

        return $this;
    }
}