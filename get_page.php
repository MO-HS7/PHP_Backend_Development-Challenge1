<?php
declare(strict_types=1);

/**
 * PHP Web Application - GET Parameter Page
 * Demonstrates GET parameter handling
 */

/*
Using GET here is appropriate because:
The requested data is simple (just a name) and not sensitive.
*/

// Get name parameter from URL, default to 'Guest' if not provided
$name = $_GET['name'] ?? 'Guest';

// Sanitize the name for security (prevent XSS)
$name = htmlspecialchars(trim($name), ENT_QUOTES, 'UTF-8');

// If name is empty after trimming, use 'Guest'
if (empty($name)) {
    $name = 'Guest';
}

// Get current server time
$currentTime = date('Y-m-d H:i:s');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GET Page - Practical PHP Application</title>
    <link rel="stylesheet" href="styls.css">
</head>
<body>
    <div class="container">
        <h1>GET Parameter</h1>
        
        <!-- Display greeting based on GET parameter -->
        <div class="greeting">
            <?php if ($name === 'Guest'): ?>
                Hello, Guest!
            <?php else: ?>
                Hello, <?php echo $name; ?>!
            <?php endif; ?>
        </div>
        
        <!-- Display current server time -->
        <div class="info-box">
            <strong>Current Server Time:</strong> 
            <?php echo htmlspecialchars($currentTime, ENT_QUOTES, 'UTF-8'); ?>
        </div>
        
        <div class="back-link">
            <a href="index.php">Back to Home</a>
        </div>
    </div>
</body>
</html>
