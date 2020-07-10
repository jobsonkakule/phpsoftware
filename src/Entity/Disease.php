<?php
namespace App\Entity;

use DateTime;
use App\Helpers\Text;
use Cocur\Slugify\Slugify;

class Disease {

    private $id;

    private $name;

    private $description;

    private $state;

    private $flag;

    private $first_at;

    private $image;

    private $oldImage;

    private $pendingUpload = false;

    private $uploadPath =  UPLOAD_PATH . DIRECTORY_SEPARATOR . 'diseases';

    private $cases;
    private $deaths;
    private $recoveries;
    private $province;

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
     * Get the value of name
     */ 
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of slug
     */ 
    public function getSlug(): ?string
    {
        return (new Slugify())->slugify($this->name);
    }

    /**
     * Get the value of description
     */ 
    public function getDescription(): ?string
    {
        return $this->description;
    } 

    public function getFormattedDescription(): ?string
    {
        return nl2br(e($this->description));
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of state
     */ 
    public function getState(): ?string
    {
        return $this->state;
    }

    /**
     * Set the value of state
     *
     * @return  self
     */ 
    public function setState($state): self
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get the value of flag
     */ 
    public function getFlag(): ?string
    {
        return $this->flag;
    }

    /**
     * Set the value of flag
     *
     * @return  self
     */ 
    public function setFlag($flag): self
    {
        $this->flag = $flag;

        return $this;
    }

    /**
     * Get the value of first_at
     */ 
    public function getFirstAt()
    {
        return new DateTime($this->first_at);
    }

    /**
     * Set the value of first_at
     *
     * @return  self
     */ 
    public function setFirstAt($first_at): self
    {
        $this->first_at = $first_at;

        return $this;
    }

    /**
     * Get the value of image
     */ 
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * Set the value of image
     *
     * @return  self
     */ 
    public function setImage($image): self
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

    public function getExcerpt (): ? string
    {
        if ($this->content) {
            return nl2br(htmlentities(Text::excerpt($this->description)));
        }
        return null;
    }

    public function getImageURL (string $format): ?string
    {
        if (empty($this->image)) {
            return null;
        }
        return '/uploads/diseases/' . $this->image . '_' . $format . '.jpg';
    }

    /**
     * Get the value of pendingUpload
     */ 
    public function shouldUpload(): bool
    {
        return $this->pendingUpload;
    }

    /**
     * Get the value of oldImage
     */ 
    public function getOldImage(): ?string
    {
        return $this->oldImage;
    }

    /**
     * Get the value of uploadPath
     */ 
    public function getUploadPath()
    {
        return $this->uploadPath;
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
    public function setCases($cases)
    {
        $this->cases = $cases;

        return $this;
    }

    /**
     * Get the value of deaths
     */ 
    public function getDeaths(): ?int
    {
        return $this->deaths;
    }

    /**
     * Set the value of deaths
     *
     * @return  self
     */ 
    public function setDeaths($deaths)
    {
        $this->deaths = $deaths;

        return $this;
    }

    /**
     * Get the value of recoveries
     */ 
    public function getRecoveries(): ?int
    {
        return $this->recoveries;
    }

    /**
     * Set the value of recoveries
     *
     * @return  self
     */ 
    public function setRecoveries($recoveries)
    {
        $this->recoveries = $recoveries;

        return $this;
    }

    /**
     * Get the value of province
     */ 
    public function getProvince()
    {
        return $this->province;
    }

    /**
     * Set the value of province
     *
     * @return  self
     */ 
    public function setProvince($province)
    {
        $this->province = $province;

        return $this;
    }
}