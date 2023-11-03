<?php
require_once("app/config/config.php");
require_once("app/controller/Main_Controller.php");

// Function to load controllers dynamically
function loadController($controllerName)
{
    $controllerFile = "app/controller/{$controllerName}Controller.php";

    if (file_exists($controllerFile)) {
        require_once $controllerFile;
        return true;
    }
    return false;
}

function __load_assets__($classname, $type) {
    $mainController = new Main_Controller();

    $mainController->load_assets($classname, $type);

}

$url = isset($_GET['url']) ? $_GET['url'] : '';

// Split the URL into an array
$urlParts = explode('/', $url);

// The first part of the URL will be the controller
$controller = array_shift($urlParts);

if (empty($controller)) {
    $controller = 'default'; // Set a default controller if none provided
}

$action = array_shift($urlParts);

// If there's an action, call it, otherwise assume it's the index method
$action = !empty($action) ? $action : 'index';

// Load the controller
if (loadController($controller)) {
    $controller .= 'Controller';
    $controllerInstance = new $controller();

    // Check if the method exists in the controller
    if (method_exists($controllerInstance, $action)) {
        // Pass remaining URL parts as arguments to the method
        call_user_func_array([$controllerInstance, $action], $urlParts);
    } else {
        echo "Method {$action} not found in controller {$controller}.";
    }
} else {
    echo "Controller {$controller} not found.";
}
