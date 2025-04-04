<?php
#require_once '../models/Recipe.php';
require_once __DIR__ . '/../models/Recipe.php';

#../src/models/Recipe.php
class RecipeController {
    public function listRecipes() {
        echo json_encode(Recipe::getAll());
    }

    public function createRecipe() {
        $data = json_decode(file_get_contents('php://input'), true);
        echo json_encode(Recipe::create($data));
    }

    public function getRecipe($id) {
        echo json_encode(Recipe::getById($id));
    }

    public function updateRecipe($id) {
        $data = json_decode(file_get_contents('php://input'), true);
        echo json_encode(Recipe::update($id, $data));
    }

    public function deleteRecipe($id) {
        echo json_encode(Recipe::delete($id));
    }

    public function rateRecipe($id) {
        $data = json_decode(file_get_contents('php://input'), true);
        echo json_encode(Recipe::rate($id, $data['rating']));
    }

    public function searchRecipes() {
        $query = $_GET['query'] ?? '';
        echo json_encode(Recipe::search($query));
    }
}
?>