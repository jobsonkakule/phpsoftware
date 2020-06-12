<?php
namespace App\Entity;

use DateTime;

class Quote {

    private $id;

    private $name;

    private $content;

    private $created_at;

    private $image;

    private $oldImage;

    private $pendingUpload = false;

    private $uploadPath =  UPLOAD_PATH . DIRECTORY_SEPARATOR . 'quotes';

    /**
     * Get the value of id
     */ 
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get the value of name
     */ 
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Get the value of content
     */ 
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Get the value of created_at
     */ 
    public function getCreatedAt(): DateTime
    {
        return new DateTime($this->created_at);
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

    /**
     * Set the value of content
     *
     * @return  self
     */ 
    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
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
     * Get the value of image
     */ 
    public function getImage(): ?string
    {
        return $this->image;
    }

    public function getImageURL (string $format): ?string
    {
        if (empty($this->image)) {
            return null;
        }
        return '/uploads/quotes/' . $this->image . '_' . $format . '.jpg';
    }

    /**
     * Set the value of image
     *
     * @return  self
     */ 
    public function setImage($image)
    {
        if (is_array($image) && !empty($image['tmp_name'])) {
            if (!empty($this->image)) {
                $this->oldImage = $this->image;
            }
            $this->image = $image['tmp_name'];
            $this->pendingUpload = true;
        }
        if (is_string($image) && !empty($image)) {
            $this->image = $image;
        }
        return $this;
    }

    /**
     * Get the value of oldImage
     */ 
    public function getOldImage(): ?string
    {
        return $this->oldImage;
    }

    /**
     * Get the value of pendingUpload
     */ 
    public function shouldUpload(): bool
    {
        return $this->pendingUpload;
    }

    /**
     * Get the value of uploadPath
     */ 
    public function getUploadPath()
    {
        return $this->uploadPath;
    }
}