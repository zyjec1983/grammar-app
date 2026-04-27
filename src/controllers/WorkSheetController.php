<?php
//***********************************************************************
// WorkSheetController Class
// Description: Controller for individual worksheet pages.
// Handles displaying exercises and processing student answers.
// Provides instant feedback with percentage scores.
//***********************************************************************

class WorkSheetController extends Controller
{
    private $model;

    // Constructor - Initialize the worksheet model
    public function __construct()
    {
        $this->model = new WorksheetModel();
    }

    // Show action - Display a worksheet and process form submissions
    public function show()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        $worksheet = $this->model->getById($id);
        
        if (!$worksheet) {
            http_response_code(404);
            echo "Worksheet not found. ID: $id";
            return;
        }

        $userAnswers = [];
        $results = null;

        // Process form submission if POST request
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_answers'])) {
            $submittedSection = isset($_POST['submitted_section']) ? $_POST['submitted_section'] : null;
            
            if ($submittedSection && in_array($submittedSection, $worksheet['sections'])) {
                $userAnswers = $this->collectAnswersForSection($worksheet, $submittedSection);
                $results = $this->evaluateSection($worksheet, $submittedSection, $userAnswers);
            }
        }

        // Level display titles
        $levelTitles = [
            'a1-a2' => 'A1-A2 - Beginner / Elementary',
            'b1-b2' => 'B1-B2 - Intermediate',
            'c1-c2' => 'C1-C2 - Advanced'
        ];

        $this->view('layouts/header', ['title' => $worksheet['title']]);
        $this->view('layouts/aside', [
            'worksheets' => $this->model->getByLevel($worksheet['level']),
            'currentLevel' => $worksheet['level'],
            'levelTitle' => $levelTitles[$worksheet['level']] ?? $worksheet['level']
        ]);
        $this->view('worksheets/worksheet', [
            'worksheet' => $worksheet,
            'userAnswers' => $userAnswers,
            'results' => $results
        ]);
        $this->view('layouts/footer');
    }

    // Collect user answers for a specific section from POST data
    private function collectAnswersForSection($worksheet, $section)
    {
        $answers = [];
        foreach ($worksheet['questions'] as $idx => $q) {
            if ($q['section'] == $section) {
                $fieldName = "q_{$section}_{$idx}";
                $answers[$section][$idx] = isset($_POST[$fieldName]) ? $_POST[$fieldName] : '';
            }
        }
        return $answers;
    }

    // Evaluate user answers and calculate score
    private function evaluateSection($worksheet, $section, $userAnswers)
    {
        $correct = 0;
        $total = 0;
        $details = [];

        foreach ($worksheet['questions'] as $idx => $q) {
            if ($q['section'] == $section) {
                $total++;
                $userAnswer = isset($userAnswers[$section][$idx]) ? trim($userAnswers[$section][$idx]) : '';
                $correctAnswer = trim($q['answer']);
                
                // Case-insensitive comparison
                $isCorrect = (strcasecmp($userAnswer, $correctAnswer) == 0);
                if ($isCorrect) {
                    $correct++;
                }
                $details[$idx] = $isCorrect;
            }
        }

        $percent = ($total > 0) ? round(($correct / $total) * 100) : 0;

        return [
            'section' => $section,
            'correct' => $correct,
            'total' => $total,
            'percent' => $percent,
            'details' => $details
        ];
    }
}