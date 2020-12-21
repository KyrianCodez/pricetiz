<?php

$toEmail = "info@cenedex.com";
$subject = $_POST["contact_name"]." ".$_POST["contact_company"];
$mailHeaders = "From: " . $_POST["contact_email"] . "<". $_POST["contact_email"] .">\r\n";

if( mail( $toEmail, $subject, $_POST["contact_message"], $mailHeaders ) ) {
    print "<p class='success'>Your message was successful.</p>";
} else {
    print "<p class='Error'>Problem in Sending Mail.</p>";
}

?>