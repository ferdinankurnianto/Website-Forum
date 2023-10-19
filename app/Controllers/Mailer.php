<?php

namespace App\Controllers;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Mailer extends BaseController
{
    public $to;
	public $subject;
	public $message;
	public $addCc;
	public $username='Ferdinan';
	public $email='ferdinan.412019007@civitas.ukrida.ac.id';
	public $password='ukrida_36A';
	
	public function send(){
		$mail = new PHPMailer(true);
		try {
			$mail->isSMTP();
			$mail->Host = 'smtp.googlemail.com';
			$mail->SMTPAuth = true;
			$mail->Username = $this->email;
			$mail->Password = $this->password;
			$mail->SMTPSecure = 'ssl';
			$mail->Port = 465;
			$mail->setFrom($this->email, '');
			$mail->addReplyTo($this->email, $this->username);
			$mail->isHTML(true);
			$mail->Subject = $this->subject;
			$mail->Body = $this->message;
			
			if (!empty($this->to) && is_array($this->to)) {
				foreach ($this->to as $recipient) {
					$mail->addAddress($recipient['email'], $recipient['name']);
				}
			} else $mail->addAddress($this->to);
			
			if (!empty($this->addCc) && is_array($this->addCc)) {
				foreach ($this->addCc as $recipient) {
					$mail->addCc($recipient['email'], $recipient['name']);
				}
			} elseif(!empty($this->addCc)) $mail->addCc($this->addCc);
			
			$mail->send();
			return true;
		} catch (Exception $e) {
			$this->ErrorInfo=$e;
			return false;
		}
	}
}
?>