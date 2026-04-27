<?php
//***********************************************************************
// WorksheetModel Class
// Description: Model for managing worksheet data.
// Loads worksheet data from JSON files in the data/worksheets folder.
// Handles UTF-8 BOM removal from JSON files for proper parsing.
//***********************************************************************

class WorksheetModel
{
    private $dataDir;

    // Constructor - Set the data directory path
    public function __construct()
    {
        $this->dataDir = DATA_PATH . '/worksheets';
    }

    // Get all worksheets from all JSON files
    public function getAll()
    {
        $files = glob($this->dataDir . '/*.json');
        $worksheets = [];
        foreach ($files as $file) {
            $content = file_get_contents($file);
            
            // Remove UTF-8 BOM if present (common issue with JSON files)
            $bom = "\xEF\xBB\xBF";
            if (substr($content, 0, 3) === $bom) {
                $content = substr($content, 3);
            }
            
            $ws = json_decode($content, true);
            if ($ws) {
                $worksheets[] = $ws;
            }
        }
        usort($worksheets, function($a, $b) {
            return strnatcmp($a['id'], $b['id']);
        });
        return $worksheets;
    }

    // Get worksheets filtered by CEFR level
    public function getByLevel($level)
    {
        $all = $this->getAll();
        $result = [];
        foreach ($all as $ws) {
            if ($ws['level'] === $level) {
                $result[] = $ws;
            }
        }
        return $result;
    }

    // Get a single worksheet by ID
    public function getById($id)
    {
        $file = DATA_PATH . '/worksheets/' . $id . '.json';
        
        if (file_exists($file)) {
            $content = file_get_contents($file);
            
            // Remove UTF-8 BOM if present
            $bom = "\xEF\xBB\xBF";
            if (substr($content, 0, 3) === $bom) {
                $content = substr($content, 3);
            }
            
            return json_decode($content, true);
        }
        
        return null;
    }
}