<?php 	
require_once __DIR__.'/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

use Scandiweb\Lib\Core\Router;
use Scandiweb\Lib\Core\Response;
use Scandiweb\App\Controllers\ProductController;

$router = new Router();

$router->get('/', [ProductController::class, 'index']);
$router->get('/add-product', [ProductController::class, 'addProductForm']);
$router->post('/add-product', [ProductController::class, 'addProduct']);
$router->post('/mass-delete', [ProductController::class, 'massDelete']);

$router->resolve();
