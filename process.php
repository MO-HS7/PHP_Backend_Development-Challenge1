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

