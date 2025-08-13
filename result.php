<?php
declare(strict_types=1);

/**
 * PHP Web Application - Result Page
 * Displays user information after form submission
 */

// Start session to retrieve user data
session_start();

// Check if user data exists in session
if (!isset($_SESSION['user_name']) || !isset($_SESSION['favorite_color'])) {
    // Redirect to main page if no data found
    header("Location: index.php", true, 302);
    exit;
}

// Get user data from session
$userName = $_SESSION['user_name'];
$favoriteColor = $_SESSION['favorite_color'];

// Clear session data after use (optional, depends on requirements)
unset($_SESSION['user_name'], $_SESSION['favorite_color']);

// Get current server time
$currentTime = date('Y-m-d H:i:s');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Practical PHP Application - Result </title>
    <link rel="stylesheet" href="styls.css">
</head>
<body>
    <div class="container">
        <h1>The Result </h1>
        
        <!-- Display greeting with user's name -->
        <div class="greeting">
            Hello, <?php echo $userName; ?>!
        </div>
        
        <!-- Display favorite color styled in that color -->
        <div class="color-display" style="color: <?php echo $favoriteColor; ?>;">
           Your favorite color<?php echo $favoriteColor; ?>
        </div>
        
        <!-- Display current server time -->
        <div class="info-box">
            <strong> Current server time : </strong> <?php echo htmlspecialchars($currentTime, ENT_QUOTES, 'UTF-8'); ?>
        </div>
        
        <div class="back-link">
            <a href="index.php"> Back to Home Page  </a>
        </div>
    </div>
</body>
</html>

