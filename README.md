The following is a digest of the repository "PHP_Backend_Development–Challenge1".
This digest is designed to be easily parsed by Large Language Models.

--- SUMMARY ---
Repository: PHP_Backend_Development–Challenge1
Files Analyzed: 6
Total Text Size: 9.78 KB
Estimated Tokens (text only): ~2,450

--- DIRECTORY STRUCTURE ---
PHP_Backend_Development–Challenge1/
├── get_page.php
├── index.php
├── process.php
├── README.md
├── result.php
└── styls.css


--- FILE CONTENTS ---
============================================================
FILE: get_page.php
============================================================
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


============================================================
FILE: index.php
============================================================
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
            <a href="get_page.php?name=Mohannad">GET Page</a>
        </div>
    </div>
</body>
</html>


============================================================
FILE: process.php
============================================================
<?php
declare(strict_types=1);

/**
 * PHP Web Application - Form Processing Page
 * Processes POST data and redirects to result page
 */

// Check if form was submitted via POST method
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    // Redirect to main page if accessed directly
    header("Location: index.php", true, 302);
    exit;
}

// Sanitize and validate input data
$userName = trim($_POST['user_name'] ?? 'Nothing to show');
$favoriteColor = trim($_POST['favorite_color'] ?? 'Nothing to show');

// Validate required fields
if (empty($userName) || empty($favoriteColor)) {
    // Redirect back to form with error (in real application, you'd use sessions for error messages)
    header("Location: index.php", true, 302);
    exit;
}

// Store data in session for result page
session_start();
$_SESSION['user_name'] = htmlspecialchars($userName, ENT_QUOTES, 'UTF-8');
$_SESSION['favorite_color'] = htmlspecialchars($favoriteColor, ENT_QUOTES, 'UTF-8');

/*
Using a redirect after POST is preferred because:
It prevents the form from being resubmitted when the page is refreshed (POST-Redirect-GET pattern).
Using the 303 status code is appropriate here because it tells the browser to change the method to GET.
*/
header("Location: result.php", true, 303);
exit;



============================================================
FILE: result.php
============================================================
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



============================================================
FILE: styls.css
============================================================
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #333;
            text-align: center;
        }
        .time-display {
            background-color: #e8f4fd;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
            text-align: center;
            font-size: 18px;
            color: #2c5aa0;
        }
        .form-group {
            margin: 15px 0;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }
        input[type="text"], select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        button {
            background-color: #2c5aa0;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }
        button:hover {
            background-color: #2c5aa0;
        }
        .links {
            margin-top: 20px;
            text-align: center;
        }
        .links a {
            color: #2c5aa0;
            text-decoration: none;
            margin: 0 10px;
        }
        .links a:hover {
            text-decoration: underline;
        }

         .greeting {
            background-color: #422945;
            padding: 20px;
            border-radius: 5px;
            margin: 20px 0;
            text-align: center;
            font-size: 24px;
            color: #dfcee5;
            border: 1px solid #422945;
        }
        .color-display {
            padding: 20px;
            border-radius: 5px;
            margin: 20px 0;
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            border: 2px solid #ddd;
        }
        .info-box {
            background-color: #e8f4fd;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
            color: #2c5aa0;
        }
        .back-link {
            text-align: center;
            margin-top: 30px;
        }
        .back-link a {
            background-color: #2c5aa0;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
        }
        .back-link a:hover {
            background-color: #2c5aa0;
        }
        .back-link {
            text-align: center;
            margin-top: 30px;
        }
        .back-link a {
            background-color: #712987;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
        }
        .back-link a:hover {
            background-color: #712987;
        }