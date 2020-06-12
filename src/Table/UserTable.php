<?php
namespace App\Table;

use PDO;
use App\Entity\User;
use App\PaginatedQuery;
use App\Table\Exception\NotFoundException;

class UserTable extends Table {

    protected $table = "user";
    protected $class = User::class;

    public function findByUsername (string $username)
    {
        $query = $this->pdo->prepare('SELECT * FROM ' . $this->table . ' WHERE username = :username');
        $query->execute(['username' => $username]);
        $query->setFetchMode(PDO::FETCH_CLASS, $this->class);
        $result = $query->fetch();
        if ($result === false) {
            throw new NotFoundException($this->table, $username);
        }
        return $result;

    }

    public function updateUser(User $user): void
    {
        $this->update([
            'username' => $user->getUsername(),
            'password' => $user->getHashPassword(),
            'pseudo' => $user->getPseudo(),
            'email' => $user->getEmail(),
            'description' => $user->getDescription(),
            'image' => $user->getImage()
        ], $user->getId());
    }
    

    public function grantUser(User $user): void
    {
        $this->update([
            'role' => $user->getRole()
        ], $user->getId());
    }

    public function createUser(User $user): void
    {
        $id = $this->create([
            'username' => $user->getUsername(),
            'password' => $user->getPassword(),
            'created_at' => $user->getCreatedAt()->format('Y-m-d H:i:s'),
        ]);
        $user->setId($id);
    }
    
    public function findPaginated ()
    {
        $paginatedQuery = new PaginatedQuery(
            "SELECT * FROM {$this->table} ORDER BY created_at DESC",
            "SELECT COUNT(id) FROM {$this->table}",
            $this->pdo
        );
        $users = $paginatedQuery->getItems(User::class);
        return [$users, $paginatedQuery];
    }

    public function findPaginatedForRole(string $role)
    {
        $paginatedQuery = new PaginatedQuery(
            "SELECT u.* 
                FROM user u
                WHERE p.role = {$role}
                ORDER BY created_at DESC",
            "SELECT COUNT(id) FROM user"
        );
        $users = $paginatedQuery->getItems(User::class);
        
        (new CategoryTable($this->pdo))->hydratePosts($users);
        return [$users, $paginatedQuery];
    }
}

