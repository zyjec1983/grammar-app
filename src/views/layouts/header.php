<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($title ?? 'Grammar App'); ?></title>
    <!-- CSS Files - Theme (Litera light or Slate dark) + Font Awesome + Custom Styles -->
    <link id="theme-stylesheet" rel="stylesheet" href="<?php echo ASSETS_URL; ?>/css/litera.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="<?php echo ASSETS_URL; ?>/css/custom.css" rel="stylesheet">    
</head>
<body>

<nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
    <div class="container-fluid">
        <!-- Mobile menu button (hamburger) - shows offcanvas sidebar on mobile -->
        <button class="btn btn-outline-light d-lg-none me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarOffcanvas">
            ☰
        </button>
        <a class="navbar-brand" href="<?php echo BASE_URL; ?>">Grammar App</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <!-- Navigation links to each CEFR level -->
                <li class="nav-item"><a class="nav-link" href="<?php echo BASE_URL; ?>level?level=a1-a2">A1-A2</a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo BASE_URL; ?>level?level=b1-b2">B1-B2</a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo BASE_URL; ?>level?level=c1-c2">C1-C2</a></li>
            </ul>
            <!-- Theme toggle button (light/dark mode) -->
            <button class="btn btn-outline-light" onclick="toggleTheme()">🌓 Theme</button>
        </div>
    </div>
</nav>

<div class="container-fluid mt-3">
    <div class="row">