<!-- Home Level View: Displays all worksheets for a selected CEFR level -->
<!-- Shows colorful cards with gradient backgrounds (one per worksheet) -->
<main class="col-lg-9">
    <div class="mb-4">
        <h2><?php echo htmlspecialchars($levelTitle); ?></h2>
        <p class="text-muted">Select a topic to practice</p>
    </div>

    <div class="row g-4">
        <?php foreach ($worksheets as $index => $ws): ?>
            <?php 
                // Calculate color index (cycles through 20 gradients)
                $colorIndex = ($index % 20) + 1;
                $colorClass = "ws-color-" . $colorIndex;
            ?>
            <div class="col-md-6 col-lg-4">
                <a href="<?php echo BASE_URL; ?>worksheet?id=<?php echo $ws['id']; ?>" 
                   class="card worksheet-card <?php echo $colorClass; ?> h-100 text-center text-decoration-none">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <div class="topic-badge mb-2">Topic <?php echo $ws['topic']; ?></div>
                        <h5 class="card-title"><?php echo htmlspecialchars($ws['title']); ?></h5>
                        <span class="completion-badge mt-auto" data-id="<?php echo $ws['id']; ?>"></span>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
        
        <?php if (empty($worksheets)): ?>
            <div class="col-12">
                <div class="alert alert-info">
                    No worksheets available for this level yet. Check back soon!
                </div>
            </div>
        <?php endif; ?>
    </div>
</main>