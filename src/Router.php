<?php
require_once 'controllers/RecipeController.php';

class Router {
    public function handleRequest() {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];

        $controller = new RecipeController();

        switch (true) {
            case $method === 'GET' && $uri === '/recipes':
                $controller->listRecipes();
                break;
            case $method === 'POST' && $uri === '/recipes':
                $controller->createRecipe();
                break;
            case preg_match('/^\/recipes\/(\d+)$/', $uri, $matches) && $method === 'GET':
                $controller->getRecipe($matches[1]);
                break;
            case preg_match('/^\/recipes\/(\d+)$/', $uri, $matches) && in_array($method, ['PUT', 'PATCH']):
                $controller->updateRecipe($matches[1]);
                break;
            case preg_match('/^\/recipes\/(\d+)$/', $uri, $matches) && $method === 'DELETE':
                $controller->deleteRecipe($matches[1]);
                break;
            case preg_match('/^\/recipes\/(\d+)\/rating$/', $uri, $matches) && $method === 'POST':
                $controller->rateRecipe($matches[1]);
                break;
            case $method === 'GET' && strpos($uri, '/recipes/search') === 0:
                $controller->searchRecipes();
                break;
            default:
                http_response_code(404);
                echo json_encode(["error" => "Not Found"]);
        }
    }
}
?>
