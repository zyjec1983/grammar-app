<?php
//***********************************************************************
// HomeController Class
// Description: Controller for the home page and level listing pages.
// Handles displaying the 3 level cards and the worksheet list by level.
//***********************************************************************

class HomeController extends Controller
{
    private $model;

    // Constructor - Initialize the worksheet model
    public function __construct()
    {
        $this->model = new WorksheetModel();
    }

    // Index action - Display the home page with 3 level cards
    public function index()
    {
        $this->view('layouts/header', ['title' => 'Grammar App - Learn English']);
        $this->view('home/index');
        $this->view('layouts/footer');
    }

    // Level action - Display worksheets for a specific level
    public function level()
    {
        // Get level from query string, default to a1-a2
        $level = isset($_GET['level']) ? $_GET['level'] : 'a1-a2';
        $allowed = ['a1-a2', 'b1-b2', 'c1-c2'];
        if (!in_array($level, $allowed)) {
            $level = 'a1-a2';
        }

        $worksheets = $this->model->getByLevel($level);
        
        // Level display titles
        $levelTitles = [
            'a1-a2' => 'A1-A2 - Beginner / Elementary',
            'b1-b2' => 'B1-B2 - Intermediate',
            'c1-c2' => 'C1-C2 - Advanced'
        ];

        $this->view('layouts/header', ['title' => 'Grammar App - ' . strtoupper($level)]);
        $this->view('layouts/aside', ['worksheets' => $worksheets, 'currentLevel' => $level, 'levelTitle' => $levelTitles[$level] ?? $level]);
        $this->view('home/level', ['worksheets' => $worksheets, 'level' => $level, 'levelTitle' => $levelTitles[$level] ?? $level]);
        $this->view('layouts/footer');
    }
}