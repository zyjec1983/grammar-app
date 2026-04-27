<?php
//***********************************************************************
// Grammar App - Entry Point
// Description: Main application entry point.
// Loads all required files, initializes the router, and dispatches the request.
//***********************************************************************

session_start();

// Include Required Files

// Application configuration
require_once __DIR__ . '/../config/app.php';

// Core MVC classes
require_once __DIR__ . '/../src/core/Router.php';
require_once __DIR__ . '/../src/core/Controller.php';

// Controllers
require_once __DIR__ . '/../src/controllers/HomeController.php';
require_once __DIR__ . '/../src/controllers/WorkSheetController.php';

// Models
require_once __DIR__ . '/../src/models/WorksheetModel.php';

// Route definitions
require_once __DIR__ . '/../routes/web.php';

// Dispatch the Request
$router->dispatch($_SERVER['REQUEST_URI']);