<?php
//***********************************************************************
// Routes Configuration
// Description: Defines all application routes and maps them to controller actions.
// Uses the Router class to handle URL routing.
//***********************************************************************

$router = new Router();
$homeController = new HomeController();
$worksheetController = new WorkSheetController();

// GET Routes

// Home page - displays 3 level cards
$router->add('GET', '', function() use ($homeController) {
    $homeController->index();
});

// Index page (alternative URL)
$router->add('GET', 'index', function() use ($homeController) {
    $homeController->index();
});

// Level page - displays worksheets for a specific CEFR level
$router->add('GET', 'level', function() use ($homeController) {
    $homeController->level();
});

// Worksheet page - displays individual worksheet exercises
$router->add('GET', 'worksheet', function() use ($worksheetController) {
    $worksheetController->show();
});

// POST Routes

// Worksheet form submission - process answers
$router->add('POST', 'worksheet', function() use ($worksheetController) {
    $worksheetController->show();
});