<!-- Aside Layout View (Sidebar): Left sidebar with worksheet navigation -->
<!-- Desktop: Collapsible accordion menu -->
<!-- Mobile: Offcanvas sidebar (slides in from left) -->
<nav class="col-lg-3 d-none d-lg-block sidebar">
    <div class="position-sticky pt-3">
        <h6 class="sidebar-heading"><?php echo htmlspecialchars($levelTitle ?? 'Worksheets'); ?></h6>
        <div class="accordion" id="levelAccordion">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseWorksheets">
                        Topics
                    </button>
                </h2>
                <div id="collapseWorksheets" class="accordion-collapse collapse show" data-bs-parent="#levelAccordion">
                    <div class="accordion-body p-0">
                        <ul class="nav flex-column">
                            <?php foreach ($worksheets as $ws): ?>
                                <li class="nav-item">
                                    <a class="nav-link <?php echo (isset($_GET['id']) && $_GET['id'] == $ws['id']) ? 'active fw-bold' : ''; ?>"
                                        href="<?php echo BASE_URL; ?>worksheet?id=<?php echo $ws['id']; ?>">
                                        <span class="topic-number"><?php echo $ws['topic']; ?>.</span>
                                        <?php echo htmlspecialchars($ws['title']); ?>
                                        <span class="completion-badge" data-id="<?php echo $ws['id']; ?>"></span>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- Offcanvas Sidebar for Mobile: Slides in from the left -->
<div class="offcanvas offcanvas-start d-lg-none" tabindex="-1" id="sidebarOffcanvas" aria-labelledby="sidebarOffcanvasLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="sidebarOffcanvasLabel">Worksheets</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <h6><?php echo htmlspecialchars($levelTitle ?? 'Worksheets'); ?></h6>
        <ul class="nav flex-column">
            <?php foreach ($worksheets as $ws): ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo (isset($_GET['id']) && $_GET['id'] == $ws['id']) ? 'active fw-bold' : ''; ?>"
                        href="<?php echo BASE_URL; ?>worksheet?id=<?php echo $ws['id']; ?>">
                        <span class="topic-number"><?php echo $ws['topic']; ?>.</span>
                        <?php echo htmlspecialchars($ws['title']); ?>
                        <span class="completion-badge" data-id="<?php echo $ws['id']; ?>"></span>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>