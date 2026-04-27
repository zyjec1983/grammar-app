<?php
//***********************************************************************
// Controller Class
// Description: Base controller class. All other controllers extend this.
// Provides the method to render views.
//***********************************************************************

class Controller
{
    // Load and render a view file
    protected function view($view, $data = [])
    {
        extract($data);
        $file = __DIR__ . "/../views/{$view}.php";
        if (file_exists($file)) {
            require $file;
        } else {
            die("View {$view} not found");
        }
    }
}