<?php


class Category { 
    private $table = 'categories';
    private $conn;

    public $id;
    public $name;
    public $created_at;

    



    public function __construct ($db) {
        $this->conn = $db;
    }


    public function read () {
        
        $query = 'SELECT 
        id, 
        name,
        created_at 
        FROM '. $this->table . '
        ORDER BY
        created_at DESC';

        $stmt = $this->conn->prepare($query);


        $stmt->execute();

        return $stmt;

    }
    
    
    public function create () {
        $query = 'INSERT INTO '. $this->table .'
         SET name = :name';


        $stmt = $this->conn->prepare($query);
        
        
        $this->name = htmlspecialchars(strip_tags($this->name));

        $stmt->bindParam(':name', $this->name);

        $stmt->execute();

        if ($stmt->execute()) {
            return true;
        }

        printf("Error: %s. \n", $stmt->error);
        return false;
    }


    public function update () {
        $query = 'UPDATE ' . $this->table. '
        SET name = :name
        WHERE id = :id';


        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->id = htmlspecialchars(strip_tags($this->id));
        
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':id', $this->id);


        if ($stmt->execute()) {
            return true;
        }

        printf("Error: %s. \n", $stmt->error);
        return false;


    }


    public function delete () {
        $query = 'DELETE FROM '. $this->table .'
        WHERE id = :id';


        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            return true;
        }

        printf("Error: %s. \n", $stmt->error);
        return false;
        
    }
}