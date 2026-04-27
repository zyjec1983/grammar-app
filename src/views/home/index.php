<!-- Home Index View: Landing page displaying 3 level cards -->
<!-- Cards show A1-A2 (Beginner), B1-B2 (Intermediate), C1-C2 (Advanced) -->
<main class="col-lg-12">
    <div class="text-center mb-4">
        <h1 class="fw-bold">Grammar App</h1>
        <p class="text-muted">Choose your level to get started</p>
    </div>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4 mb-5">

        <!-- Level A1-A2 Card (Red gradient - Beginner/Elementary) -->
        <div class="col">
            <div class="card tool-card card-grammar-a1 h-100">
                <a href="<?php echo BASE_URL; ?>level?level=a1-a2" class="stretched-link"></a>
                <div class="card-body">
                    <i class="fas fa-star-of-life"></i>
                    <h5>Grammar A1-A2</h5>
                    <p>Beginner to Elementary. Verb to be, present simple, past simple, etc.</p>
                </div>
            </div>
        </div>

        <!-- Level B1-B2 Card (Blue gradient - Intermediate) -->
        <div class="col">
            <div class="card tool-card card-grammar-b1 h-100">
                <a href="<?php echo BASE_URL; ?>level?level=b1-b2" class="stretched-link"></a>
                <div class="card-body">
                    <i class="fas fa-chart-line"></i>
                    <h5>Grammar B1-B2</h5>
                    <p>Intermediate. Present perfect, conditionals, passive voice, reported speech.</p>
                </div>
            </div>
        </div>

        <!-- Level C1-C2 Card (Green gradient - Advanced) -->
        <div class="col">
            <div class="card tool-card card-grammar-c1 h-100">
                <a href="<?php echo BASE_URL; ?>level?level=c1-c2" class="stretched-link"></a>
                <div class="card-body">
                    <i class="fas fa-crown"></i>
                    <h5>Grammar C1-C2</h5>
                    <p>Advanced. Inversion, subjunctive, perfect modals, participle clauses.</p>
                </div>
            </div>
        </div>

    </div>
</main>