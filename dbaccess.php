<?php
define('DB_NAME', 'your db name');

/** MySQL database username */
define('DB_USER', 'username');

/** MySQL database password */
define('DB_PASSWORD', 'password');

/** MySQL hostname */
define('DB_HOST', 'your host url');

/** API KEY **/
define('API_KEY', 'Google api key');

//Create Connection
$myconnection=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

if ($myconnection->connect_error)
{

	die("Failed!");
}
?>