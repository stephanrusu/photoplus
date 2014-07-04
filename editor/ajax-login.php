<?php

/**
 * A simple PHP Login Script / ADVANCED VERSION
 * For more versions (one-file, minimal, framework-like) visit http://www.php-login.net
 *
 * @author Panique
 * @link http://www.php-login.net
 * @link https://github.com/panique/php-login-advanced/
 * @license http://opensource.org/licenses/MIT MIT License
 */

// check for minimum PHP version
if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit('Sorry, this script does not run on a PHP version smaller than 5.3.7 !');
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    // if you are using PHP 5.3 or PHP 5.4 you have to include the password_api_compatibility_library.php
    // (this library adds the PHP 5.5 password hashing functions to older versions of PHP)
    require_once('../login/libraries/password_compatibility_library.php');
}
// include the config
require_once('../login/config/config.php');

// include the to-be-used language, english by default. feel free to translate your project and include something else
require_once('../login/translations/en.php');

// include the PHPMailer library
require_once('../login/libraries/PHPMailer.php');

// load the login class
require_once('../login/classes/Login.php');

//load the register class
require_once('../login/classes/Registration.php');

// create a login object. when this object is created, it will do all login/logout stuff automatically
// so this single line handles the entire login process.
if (isset($_POST['ajax'])) {
    if (isset($_POST['login'])) {
        $login = new Login();
        echo $_SESSION['user_id'];
    } elseif (isset($_POST['register'])) {
        $register = new Registration();
        echo $_SESSION['user_id'];
    }
}
?>