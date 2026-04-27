<!-- Worksheet View: Displays individual worksheet with tabs for each section -->
<!-- Shows section instructions, form with questions in grid layout, submit button calculates score -->
<main class="col-lg-9">
    <h2><?php echo htmlspecialchars($worksheet['title']); ?></h2>

    <!-- Tabs Navigation (Section A, B, C, etc.) -->
    <ul class="nav nav-tabs" id="worksheetTabs" role="tablist">
        <?php foreach ($worksheet['sections'] as $index => $section): ?>
            <li class="nav-item" role="presentation">
                <button class="nav-link <?php echo $index === 0 ? 'active' : ''; ?>"
                    id="tab-<?php echo $section; ?>"
                    data-bs-toggle="tab"
                    data-bs-target="#section-<?php echo $section; ?>"
                    type="button" role="tab">
                    Section <?php echo strtoupper($section); ?>
                </button>
            </li>
        <?php endforeach; ?>
    </ul>

    <!-- Tab Content Panes (one per section) -->
    <div class="tab-content mt-3">
        <?php foreach ($worksheet['sections'] as $index => $section): ?>
            <div class="tab-pane <?php echo $index === 0 ? 'active' : ''; ?>"
                id="section-<?php echo $section; ?>" role="tabpanel">

                <?php if (isset($worksheet['section_instructions'][$section])): ?>
                    <div class="alert alert-secondary mb-3">
                        <?php echo htmlspecialchars($worksheet['section_instructions'][$section]); ?>
                    </div>
                <?php endif; ?>

                <!-- Passage display for reading comprehension sections -->
                <?php if (isset($worksheet['section_passages'][$section])): ?>
                    <div class="card mb-4">
                        <div class="card-body passage-card">
                            <p class="mb-0" style="white-space: pre-line;"><?php echo htmlspecialchars($worksheet['section_passages'][$section]); ?></p>
                        </div>
                    </div>
                <?php endif; ?>

                <form method="post" action="<?php echo BASE_URL; ?>worksheet?id=<?php echo $worksheet['id']; ?>" class="section-form">
                    <input type="hidden" name="submitted_section" value="<?php echo $section; ?>">

                    <div class="row">
                    <?php
                    // Filter questions for this section
                    $sectionQuestions = array_filter($worksheet['questions'], function ($q) use ($section) {
                        return $q['section'] == $section;
                    });
                    foreach ($sectionQuestions as $idx => $q):
                        $fieldName = "q_{$section}_{$idx}";
                        $userVal = isset($userAnswers[$section][$idx]) ? htmlspecialchars($userAnswers[$section][$idx]) : '';
                        
                        // Check if this is a "text" type question (inline text with inputs)
                        if (isset($q['type']) && $q['type'] === 'text'): 
                            // Parse the text and insert input fields at ___ positions
                            $parts = preg_split('/(___)+/', $q['text'], -1, PREG_SPLIT_NO_EMPTY);
                            ?>
                            <div class="col-12 mb-3">
                                <div class="text-question">
                                    <?php foreach ($parts as $i => $part): ?>
                                        <span><?php echo htmlspecialchars($part); ?></span>
                                        <input type="text" 
                                               name="<?php echo $fieldName; ?>_<?php echo $i; ?>" 
                                               value="<?php echo isset($userAnswers[$section][$idx][$i]) ? htmlspecialchars($userAnswers[$section][$idx][$i]) : ''; ?>" 
                                               class="form-control d-inline-block" 
                                               style="width: 100px; display: inline-block;"
                                               placeholder="___">
                                    <?php endforeach; ?>
                                    <?php if ($results && isset($results['details'][$idx])): ?>
                                        <span class="text-<?php echo $results['details'][$idx] ? 'success' : 'danger'; ?> ms-2">
                                            <?php echo $results['details'][$idx] ? '✓' : '✗'; ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php 
                        else:
                            // Normal question display
                            ?>
                            <div class="col-md-4 col-sm-6 mb-3">
                                <label class="form-label fw-medium d-block"><?php echo htmlspecialchars($q['text']); ?></label>
                                <?php if ($q['type'] === 'fill'): ?>
                                    <input type="text" name="<?php echo $fieldName; ?>" value="<?php echo $userVal; ?>" class="form-control" placeholder="answer">
                                <?php elseif ($q['type'] === 'choice' && isset($q['options'])): ?>
                                    <?php if (isset($q['display']) && $q['display'] === 'radio'): ?>
                                        <!-- Radio button display for True/False questions -->
                                        <div class="d-flex gap-3">
                                            <?php foreach ($q['options'] as $opt): ?>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="<?php echo $fieldName; ?>" 
                                                           id="<?php echo $fieldName . '_' . $opt; ?>" 
                                                           value="<?php echo htmlspecialchars($opt); ?>"
                                                           <?php echo $userVal === $opt ? 'checked' : ''; ?>>
                                                    <label class="form-check-label" for="<?php echo $fieldName . '_' . $opt; ?>">
                                                        <?php echo ucfirst(htmlspecialchars($opt)); ?>
                                                    </label>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php else: ?>
                                        <!-- Dropdown select display -->
                                        <select name="<?php echo $fieldName; ?>" class="form-select">
                                            <option value="">-- Select --</option>
                                            <?php foreach ($q['options'] as $opt): ?>
                                                <option value="<?php echo htmlspecialchars($opt); ?>" <?php echo $userVal === $opt ? 'selected' : ''; ?>>
                                                    <?php echo htmlspecialchars($opt); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <?php if ($results && isset($results['details'][$idx])): ?>
                                    <span class="text-<?php echo $results['details'][$idx] ? 'success' : 'danger'; ?> ms-2">
                                        <?php echo $results['details'][$idx] ? '✓' : '✗'; ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                            <?php 
                        endif;
                    endforeach; ?>
                    </div>
                    <button type="submit" name="submit_answers" class="btn btn-primary">Check Section <?php echo strtoupper($section); ?></button>
                </form>

                <?php if ($results && $results['section'] === $section): ?>
                    <div class="alert alert-info mt-3 score-alert">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <strong>Score:</strong> 
                                <span class="score-percent"><?php echo $results['percent']; ?>%</span>
                                <span class="score-detail">(<?php echo $results['correct']; ?>/<?php echo $results['total']; ?>)</span>
                            </div>
                            <div class="score-badge">
                                <?php if ($results['percent'] >= 80): ?>
                                    <span class="badge bg-success">Great!</span>
                                <?php elseif ($results['percent'] >= 60): ?>
                                    <span class="badge bg-warning text-dark">Good</span>
                                <?php else: ?>
                                    <span class="badge bg-danger">Keep Practice</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</main>