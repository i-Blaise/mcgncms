<?php
require_once('mainlib.php');
// require_once('../../ClassLib/mainlib.php');
$mainPlug = new mainClass();

$headerID = htmlspecialchars($_GET["headerID"]);
$apiName = htmlspecialchars($_GET["apiName"]);

if(isset($headerID))
{
    $deleteResults = $mainPlug->deleteHeaderAPI($apiName, $headerID);
    echo $deleteResults;

}else{
    echo 'no';
    die();
}