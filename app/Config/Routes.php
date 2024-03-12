<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->group("api", function($routes)
{
$routes->post("add-employee", "ApiController::addEmployee");
$routes->get("list-employee", "ApiController::listEmployee");
$routes->get("single-employee/(:num)", "ApiController::getSingleEmployee/$1");
$routes->put("update-employee/(:num)", "ApiController::updateEmployee/$1");
$routes->delete("delete-employee/(:num)", "ApiController::deleteEmployee/$1");

});
