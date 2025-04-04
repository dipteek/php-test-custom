<?php
require_once __DIR__ . '/../config/Database.php';

class Recipe {
    public static function getAll() {
        $db = Database::getConnection();
        $query = "SELECT * FROM recipes";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function create($data) {
        $db = Database::getConnection();
        $query = "INSERT INTO recipes (name, prep_time, difficulty, vegetarian) 
                  VALUES (:name, :prep_time, :difficulty, :vegetarian)";

        $stmt = $db->prepare($query);
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':prep_time', $data['prep_time']);
        $stmt->bindParam(':difficulty', $data['difficulty']);
        $vegetarian = filter_var($data['vegetarian'], FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) ?? false;
$stmt->bindParam(':vegetarian', $vegetarian, PDO::PARAM_BOOL);


        if ($stmt->execute()) {
            return ["message" => "Recipe created successfully"];
        } else {
            return ["error" => "Failed to insert recipe"];
        }
    }

    public static function getById($id) {
        $db = Database::getConnection();
        $query = "SELECT * FROM recipes WHERE id = :id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function update($id, $data) {
        $db = Database::getConnection();
        $query = "UPDATE recipes SET name=:name, prep_time=:prep_time, 
                  difficulty=:difficulty, vegetarian=:vegetarian WHERE id=:id";

        $stmt = $db->prepare($query);
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':prep_time', $data['prep_time']);
        $stmt->bindParam(':difficulty', $data['difficulty']);
        $stmt->bindParam(':vegetarian', $data['vegetarian']);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            return ["message" => "Recipe updated successfully"];
        } else {
            return ["error" => "Failed to update recipe"];
        }
    }

    public static function delete($id) {
        $db = Database::getConnection();
        $query = "DELETE FROM recipes WHERE id = :id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            return ["message" => "Recipe deleted successfully"];
        } else {
            return ["error" => "Failed to delete recipe"];
        }
    }

    public static function rate($id, $rating) {
        $db = Database::getConnection();
        $query = "INSERT INTO ratings (recipe_id, rating) VALUES (:id, :rating)";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':rating', $rating);

        if ($stmt->execute()) {
            return ["message" => "Rating added"];
        } else {
            return ["error" => "Failed to add rating"];
        }
    }

    public static function search($query) {
        $db = Database::getConnection();
        $query = "SELECT * FROM recipes WHERE name LIKE :search";
        $stmt = $db->prepare($query);
        $searchQuery = "%{$query}%";
        $stmt->bindParam(':search', $searchQuery);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
