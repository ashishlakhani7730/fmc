<?php

function send_email($to,$subject,$message) 
{
    $ci = & get_instance();
    $ci->load->database();

    $query = $ci->db->query("SELECT * FROM email_smtp_configuration WHERE id = 1 ");
    
    if ($query->num_rows() > 0) {
    	$row =  $query->row_array();

    	$smtp_host = $row['smtp_host'];
	    $smtp_port = $row['smtp_port'];
	    $smtp_secure =  $row['smtp_secure'];
	    $smtp_username = $row['smtp_username'];
	    $smtp_password = $row['smtp_password'];
    }else{
    	$smtp_host = "smtp.yandex.com";
    	$smtp_port = "465";
    	$smtp_secure = "ssl";
    	$smtp_username = "notification@fmc.net.sa";
    	$smtp_password = "Qwer1234";
    }

    // Load PHPMailer library
    $ci->load->library('phpmailer_lib');

    // PHPMailer object            
	$mail = $ci->phpmailer_lib->load();
	$mail->IsSMTP(); // enable SMTP
	//$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
	$mail->SMTPAuth = true; // authentication enabled
	$mail->SMTPSecure = $smtp_secure; // secure transfer enabled REQUIRED for Gmail
	$mail->CharSet = 'UTF-8';
	$mail->Host = $smtp_host;
	$mail->Port = $smtp_port; // or 587
	$mail->IsHTML(true);
	$mail->Username = $smtp_username;
	$mail->Password = $smtp_password;
	$mail->SetFrom($smtp_username);
	$mail->Subject = $subject;
	$mail->Body = $message;

	$mail->AddAddress($to);
	
	//Send Email
	$mail->Send(); 
	return true;
}

?>