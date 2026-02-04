<?php
    $cookie_name = "User";
    $cookie_value = "Daris Hodza";
    //setcookie(name, value, expire, path, domain, secure, httponly);
    setcookie($cookie_name, $cookie_value, time() + 10, "/");
    
    if(!isset($_COOKIE[$cookie_name])) {
        echo "Cookie '" . $cookie_name . "' is not set!";
    } else {
        echo "Cookie '" . $cookie_name . "' is set!<br>";
        echo "Value: " . $_COOKIE[$cookie_name];
    }
?>