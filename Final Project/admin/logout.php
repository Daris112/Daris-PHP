<?php
// 1. Initialize the session to access existing data
session_start();

// 2. Unset all session variables to clear the user data
$_SESSION = array();

// 3. If it's desired to kill the session, also delete the session cookie.
// This is an extra step for complete security.
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// 4. Destroy the session on the server
session_destroy();

// 5. Redirect to the main user page (Root Index)
// We use ../ to move out of the 'admin' folder and into the root folder
header("Location: ../index.php");
exit();
?>