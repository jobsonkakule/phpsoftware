<?php
namespace App\Entity;

use DateTime;

class User {

    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $username;
    /**
     * @var string
     */
    private $password;

    private $confirm;

    private $pseudo;

    private $email;

    private $description;

    private $image;

    private $role;

    private $created_at;

    private $uploadPath =  UPLOAD_PATH . DIRECTORY_SEPARATOR . 'users';

    private $oldImage;

    private $pendingUpload = false;

    /**
     * Get the value of username
     *
     * @return  string
     */ 
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * Set the value of username
     *
     * @param  string  $username
     *
     * @return  self
     */ 
    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get the value of password
     *
     * @return  string
     */ 
    public function getPassword()
    {
        return null;
    }

    /**
     * Get the value of password
     *
     * @return  string
     */ 
    public function getHashPassword(): ?string
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @param  string  $password
     *
     * @return  self
     */ 
    public function setPassword(string $password): self
    {
        $this->password = password_hash($password, PASSWORD_BCRYPT);
        return $this;
    }

    /**
     * Get the value of id
     *
     * @return  int|null
     */ 
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @param  int  $id
     *
     * @return  self
     */ 
    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Get the value of pseudo
     */ 
    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    /**
     * Set the value of pseudo
     *
     * @return  self
     */ 
    public function setPseudo($pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email): self
    {
        $this->email = $email;

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
        return '/uploads/users/' . $this->image . '_' . $format . '.jpg';
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

    /**
     * Get the value of role
     */ 
    public function getRole(): ?string
    {
        return $this->role;
    }

    /**
     * Set the value of role
     *
     * @return  self
     */ 
    public function setRole($role): self
    {
        $this->role = $role;

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
     * Get the value of description
     */ 
    public function getDescription(): ?string
    {
        return $this->description;
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
     * Get the value of confirm
     */ 
    public function getConfirm(): ?string
    {
        return $this->confirm;
    }

    /**
     * Set the value of confirm
     *
     * @return  self
     */ 
    public function setConfirm($confirm): self
    {
        $this->confirm = $confirm;
        return $this;
    }

    /**
     * Get the value of uploadPath
     */ 
    public function getUploadPath()
    {
        return $this->uploadPath;
    }
}