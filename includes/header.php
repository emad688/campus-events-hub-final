<?php
if (!isset($pageTitle)) {
    $pageTitle = 'Campus Events Hub';
}
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($pageTitle); ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header class="site-header">
    <div class="container header-inner">
        <div>
            <h1 class="site-title">Campus Events Hub</h1>
            <p class="site-tagline">Discover, join, and enjoy campus activities</p>
        </div>

        <nav class="main-nav" aria-label="Main navigation">
            <a class="<?php echo $currentPage === 'index.php' ? 'active' : ''; ?>" href="index.php">Home</a>
            <a class="<?php echo $currentPage === 'events.php' || $currentPage === 'event.php' ? 'active' : ''; ?>" href="events.php">Events</a>
            <a class="<?php echo $currentPage === 'register.php' ? 'active' : ''; ?>" href="register.php">Register</a>
            <a class="<?php echo $currentPage === 'registrations.php' ? 'active' : ''; ?>" href="registrations.php">Registrations</a>
            <a class="<?php echo $currentPage === 'about.php' ? 'active' : ''; ?>" href="about.php">About / Contact</a>
        </nav>
    </div>
</header>

<main class="container page-content">
