<?php

namespace Shohjahon\RentSrc;
use PDO;

class Auth
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = DB::connect();
    }
    public function checkUserLogin(string $username, string $password): bool
    {
        $user = (new User())->getByUser($username);

        $query = "SELECT users.*, user_roles.role_id
                  FROM users
                    JOIN user_roles ON users.id = user_roles.user_id
                  WHERE users.id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['id' => $user['id']]);
        $userWithRoles = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (password_verify($password, $user['password'])) {
            if ($userWithRoles[0]['role_id'] == Roles::ADMIN->value) {
                $_SESSION['username'] = $user['username'];
                $_SESSION['password'] = $user['password'];
                $_SESSION['id'] = $user['id'];
                $_SESSION['role_id'] = $userWithRoles[0]['role_id'];
                redirect('/profile');
            }
            return true;
        }
        return false;

    }
    public function checkUserRegister(string $phone)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE phone = :phone");
        $stmt->bindParam(':phone', $phone);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}