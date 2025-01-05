<?php
require_once '../classes/database.php';
require_once '../classes/user.php';

class authentification {
    private $db;

    public function __construct() {
        try {
            $this->db = database::getInstance()->getConnection();
        } catch (Exception $e) {
            throw new Exception("Database connection failed: " . $e->getMessage());
        }
    }

    public function login($email, $password) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['role_id'] = $user['role_id'];
            return true;
        }
        return false;
    }

    public function register($username, $email, $password) {
        $stmt = $this->db->prepare("SELECT user_id FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        if ($stmt->fetch()) {
            return false;
        }

        $stmt = $this->db->prepare("SELECT user_id FROM users WHERE user_name = :username");
        $stmt->execute(['username' => $username]);
        if ($stmt->fetch()) {
            return false;
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare("INSERT INTO users (user_name, email, password, role_id) VALUES (:username, :email, :password, 2)");
        
        if ($stmt->execute([
            ':username' => $username,
            ':email' => $email,
            ':password' => $hashedPassword
        ])) {
            $userId = $this->db->lastInsertId();
            return new User($userId, $username, $email, $hashedPassword, 2);
        }
        return false;
    }

    public function validateRegistration($username, $email, $password, $confirm_password) {
        $errors = [];
        
        if (empty($username)) {
            $errors[] = "Le nom d'utilisateur est requis";
        } else {
            $stmt = $this->db->prepare("SELECT user_id FROM users WHERE user_name = :username");
            $stmt->execute([':username' => $username]);
            if ($stmt->fetch()) {
                $errors[] = "Ce nom d'utilisateur existe déjà";
            }
        }

        if (empty($email)) {
            $errors[] = "L'email est requis";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Format d'email invalide";
        } else {
            $stmt = $this->db->prepare("SELECT user_id FROM users WHERE email = :email");
            $stmt->execute([':email' => $email]);
            if ($stmt->fetch()) {
                $errors[] = "Cet email existe déjà";
            }
        }

        if (empty($password)) {
            $errors[] = "Le mot de passe est requis";
        } elseif (strlen($password) < 6) {
            $errors[] = "Le mot de passe doit contenir au moins 6 caractères";
        }

        if ($password !== $confirm_password) {
            $errors[] = "Les mots de passe ne correspondent pas";
        }
        
        return $errors;
    }

    public function validateLogin($email, $password) {
        $errors = [];
        
        if (empty($email)) {
            $errors[] = "L'email est requis";
        }
        
        if (empty($password)) {
            $errors[] = "Le mot de passe est requis";
        }

        if (empty($errors) && !$this->login($email, $password)) {
            $errors[] = "Email ou mot de passe incorrect";
        }

        return $errors;
    }



    public function getUserByEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
    
        return $stmt->fetch(PDO::FETCH_ASSOC);  // Retourne les données de l'utilisateur
    }
}