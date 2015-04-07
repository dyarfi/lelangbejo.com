<?php
//Send data email
function send_mail($data)
{
    // To send HTML mail, the Content-type header must be set
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    // Additional headers
    $headers .= 'From: Lelang Bejo <info@lelangbejo.com>' . "\r\n";

    if(@mail($data['to'],$data['subject'],$data['message'],$headers)){
        return true;
    }else{
        return false;
    }
}

//Waktu UTC
date_default_timezone_set('UTC');

/*
**Setting database conection
*/
$host = 'localhost';
$user = 'lelangbejo';
$pass = 'load2014!!';
$dbname = 'lelangbejo';

$dbLink = mysql_connect($host, $user, $pass);
if (!$dbLink) {
    die('Could not connect: ' . mysql_error());
}
if ( !mysql_select_db($dbname,$dbLink) ) {
    die('Unable to select database '.$dbname);
}
?>