<?php
declare(strict_types=1);

/**
 * PHP Web Application - Main Page
 * Displays server time and form for user input
 */

// Display current server time
$currentTime = date('Y-m-d H:i:s');
// date_default_timezone_set('Asia/Sana'); // Set timezone to Asia/Sana for consistency

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practical PHP Application</title>
    <link rel="stylesheet" href="styls.css">
</head>
<body>
    <div class="container">
        <h1>Practical PHP Application</h1>
        
        <!-- Display current server time -->
        <div class="time-display">
            <strong>Current server time:</strong> 
            <?php echo htmlspecialchars($currentTime, ENT_QUOTES, 'UTF-8'); ?>
        </div>

        <!-- 
            Using POST here is preferred because:
            - The data is not shown in the URL, which improves privacy and security.
            - POST allows sending more data compared to GET.
        -->
        <form method="POST" action="process.php">
            <div class="form-group">
                <label for="user_name">User Name:</label>
                <input type="text" id="user_name" name="user_name" required>
            </div>
            
            <div class="form-group">
                <label for="favorite_color">Favorite Color:</label>
                <select id="favorite_color" name="favorite_color" required>
                    <option value="">Choose a color:</option>
                    <option value="red">Red</option>
                    <option value="blue">Blue</option>
                    <option value="purple">Purple</option>
                    <option value="black">Black</option>
                </select>
            </div>
            
            <button type="submit">Submit</button>
        </form>

        <div class="links">
            <a href="get_page.php">GET Page</a> --
            <a href="get_page.php?name=Mohannad">With GET Page Name</a>
        </div>
    </div>
</body>
</html>
