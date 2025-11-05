<?php
require_once './config/routes.php';

$routes_names = array_keys(ROUTES);

if (isset($_GET['page']) && in_array($_GET['page'], $routes_names, true)) {
    $controller = ROUTES[$_GET['page']];
} else {
    $controller = DEFAULT_ROUTE;
}

require './controllers/' . $controller;