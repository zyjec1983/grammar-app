<?php
//***********************************************************************
// Router Class
// Description: Simple URL router that matches requests to controllers.
// Handles GET and POST methods, strips base path, and dispatches to callbacks.
//***********************************************************************

class Router
{
    protected $routes = [];

    // Add a route to the router
    public function add($method, $route, $callback)
    {
        $this->routes[] = [
            'method' => strtoupper($method),
            'route' => $route,
            'callback' => $callback
        ];
    }

    // Dispatch the request to the appropriate route
    public function dispatch($uri)
    {
        // Remove query string and base path from URI
        $uri = parse_url($uri, PHP_URL_PATH);
        $basePath = '/grammar-app/public/';
        if (strpos($uri, $basePath) === 0) {
            $uri = substr($uri, strlen($basePath));
        }
        $uri = trim($uri, '/');

        // Get path only (ignore query string for route matching)
        $pathOnly = explode('?', $uri)[0];

        // Find matching route
        foreach ($this->routes as $route) {
            if ($_SERVER['REQUEST_METHOD'] !== $route['method']) {
                continue;
            }

            if ($route['route'] === $pathOnly) {
                call_user_func($route['callback']);
                return;
            }
        }

        http_response_code(404);
        echo "404 - Page not found";
    }
}