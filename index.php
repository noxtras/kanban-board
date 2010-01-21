<?php

include_once("common/prepend.php");

$page  = $_REQUEST['page'];
$pages = array("home", "project");

if (in_array($page, $pages) == false) {
    $page = 'home';
}

include (APPPATH . "views/header.php");
include (APPPATH . "views/{$page}.php");
include (APPPATH . "views/footer.php");

