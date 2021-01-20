
<?php
// include language configuration file based on selected language
$lang = "bi";
if (isset($_GET['lang'])) {
    $lang = $_GET['lang'];
}
require_once ("Languages/lang." . $lang . ".php");
?> 
