<?php

class User {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function existsByUsername($username) {
        $stmt = $this->db->prepare("SELECT id FROM blog_users WHERE username = ?");
        $stmt->execute([$username]);
        return $stmt->fetch() !== false;
    }

    public function register($username, $email, $password) {
        $stmt = $this->db->prepare("
            INSERT INTO blog_users (username, email, password)
            VALUES (?, ?, ?)
        ");
        return $stmt->execute([$username, $email, $password]);
    }

    public function findByUsername($username) {
        $stmt = $this->db->prepare("SELECT * FROM blog_users WHERE username = ?");
        $stmt->execute([$username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}