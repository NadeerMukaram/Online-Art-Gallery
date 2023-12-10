<?php
session_start();
if(isset($_SESSION['username'])){
    $text = $_POST['text'];

    // Set the time zone to Asia/Manila
    date_default_timezone_set('Asia/Manila');

    $cb = fopen("log.html", 'a');
    $message = "<div class='msgln'>(".date("Y-m-d g:i A").") <b>".$_SESSION['username']."</b>: ".stripslashes(htmlspecialchars($text))."<br></div>";
    fwrite($cb, $message);
    fclose($cb);
}
?>