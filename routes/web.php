<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});
// Matches "/api/register
$router->post('register', 'AuthController@register');
    // Matches "/api/login
$router->post('login', 'AuthController@login');

// Get Caregories
$router->get('/categories', ['uses' => 'CategoryController@showAllCategories']);
$router->get('/categories/{categoria_id}', ['uses' => 'CategoryController@showOneCategory']);

// Caregories CRUD
$router->post('/categories', ['uses' => 'CategoryController@createCategory']);
$router->put('/categories/{categoria_id}', ['uses' => 'CategoryController@updateCategory']);
$router->delete('/categories/{categoria_id}', ['uses' => 'CategoryController@deleteCategory']);

// Book CRUD
$router->post('/categories/{categoria_id}/products', ['uses' => 'CategoryController@createProduct']);
// <GET Products
$router->get('/products', ['uses' => 'CategoryController@showAllProducts']);
$router->get('/categories/{categoria_id}/products', ['uses' => 'CategoryController@showAllProductsFromCategory']);
$router->get('/categories/{categoria_id}/products/{product_id}', ['uses' => 'CategoryController@showOneProduct']);
//Put Products
$router->put('/categories/{categoria_id}/products/{product_id}', ['uses' => 'CategoryController@updateProduct']);
//Delete Products
$router->delete('/categories/{categoria_id}/products/{product_id}', ['uses' => 'CategoryController@deleteProduct']);

