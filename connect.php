<?php
ob_start();
try {
    $conn = new PDO("mysql:host=localhost;dbname=noithat;charset=utf8", "root", "");
} catch (PDOException $e) {
    echo $e->getMessage();
}
function selectAll($sql)
{
    $result = $GLOBALS['conn']->query($sql);
    return $result;
}
function exSQL($sql)
{
    $result =  $GLOBALS['conn']->prepare($sql);
    return $result->execute();
}
function rowCount($sql){
    $result =  $GLOBALS['conn']->query($sql);
    return $result->rowCount();
}
date_default_timezone_set('Asia/Ho_Chi_Minh');
$timestamp = time();
$today = date('d-m-Y H:i:s', $timestamp);
// //////////////
define('PAYPAL_ID','Insert_PayPal_Business_Email'); 
define('PAYPAL_SANDBOX',TRUE);
 
define('PAYPAL_RETURN_URL','http://www.example.com/success.php'); 
define('PAYPAL_CANCEL_URL','http://www.example.com/cancel.php'); 
define('PAYPAL_NOTIFY_URL','http://www.example.com/ipn.php'); 
define('PAYPAL_CURRENCY','USD'); 
define('PAYPAL_URL',(PAYPAL_SANDBOX==true)?"https://www.sandbox.paypal.com/cgi-bin/webscr":"https://www.paypal.com/cgi-bin/webscr");
?>