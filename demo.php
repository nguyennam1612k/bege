<?php
require_once './commons/db.php';
require_once './commons/constants.php';
require_once './commons/helpers.php';

$sqlQuery = "SELECT * from categories";
$categories = executeQuery($sqlQuery, true);
// foreach ($categories as $c) {
//     var_dump($c);

//     // what you really want instead of var_dump is something to
//     // to create markup-- list items maybe, For example...
//     // echo '<li>'.$c->cat_name.'</li>';
// }

?>