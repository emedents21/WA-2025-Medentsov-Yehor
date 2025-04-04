<?php

class Player {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function create($name, $position, $age, $nationality) {
        
        // Dvojtečka označuje pojmenovaný parametr => Místo přímých hodnot se používají placeholdery.
        // PDO je pak nahradí skutečnými hodnotami při volání metody execute().
        // Chrání proti SQL injekci (bezpečnější než přímé vložení hodnot).
        $sql = "INSERT INTO players (name, position, age, nationality) 
                VALUES (:name, :position, :age, :nationality)";
        
        $stmt = $this->db->prepare($sql);
        
        return $stmt->execute([
            ':name' => $name,
            ':position' => $position,
            ':age' => $age,
            ':nationality' => $nationality,
        ]);
    }

    public function getAll() {
        $sql = "SELECT * FROM players ORDER BY created_at DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}