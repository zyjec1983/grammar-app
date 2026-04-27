//***********************************************************************
// Worksheet JavaScript
// Description: Handles worksheet progress tracking.
// Saves completion status to localStorage when score >= 80%
// Updates completion badges across the app
//***********************************************************************

(function() {
    var PROGRESS_KEY = 'grammar_progress';

    // Get progress data from localStorage
    function getProgress() {
        var stored = localStorage.getItem(PROGRESS_KEY);
        return stored ? JSON.parse(stored) : {};
    }

    // Save progress to localStorage
    function saveProgress(worksheetId, completed) {
        var progress = getProgress();
        progress[worksheetId] = completed;
        localStorage.setItem(PROGRESS_KEY, JSON.stringify(progress));
    }

    // Check if worksheet is completed
    function isCompleted(worksheetId) {
        var progress = getProgress();
        return progress[worksheetId] === true;
    }

    // Update completion badges in the DOM
    function refreshBadges() {
        var badges = document.querySelectorAll('.completion-badge');
        badges.forEach(function(badge) {
            var wsId = badge.getAttribute('data-id');
            if (isCompleted(wsId)) {
                badge.innerHTML = ' ✓';
                badge.classList.add('text-success', 'fw-bold');
            }
        });
    }

    // After form submission, if score >= 80%, mark as completed
    var urlParams = new URLSearchParams(window.location.search);
    var worksheetId = urlParams.get('id');
    if (worksheetId && document.querySelector('.alert-info')) {
        var scoreText = document.querySelector('.alert-info strong').innerText;
        if (scoreText) {
            var percent = parseInt(scoreText);
            if (!isNaN(percent) && percent >= 80) {
                saveProgress(worksheetId, true);
                console.log('Worksheet ' + worksheetId + ' completed!');
            }
        }
    }

    // Expose functions globally for other scripts to use
    window.GrammarProgress = {
        isCompleted: isCompleted,
        saveProgress: saveProgress,
        getProgress: getProgress
    };

    // Initialize badges on page load
    refreshBadges();
})();