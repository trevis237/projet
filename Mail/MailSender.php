<?php

//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
date_default_timezone_set('Etc/UTC');
require_once 'vendor/autoload.php';

class MailSender {
    private $_mailer;
    private $_result = '';
    private $_state = false;
    private $_recipient;
    private $_subject;
    private $_message;
    private $_BCC;
    private $_gmail = true;

    public function __construct() {
        $this->_mailer = new PHPMailer\PHPMailer\PHPMailer; 

        
        $this->_mailer->IsSMTP();
        $this->_mailer->SMTPAuth = true;
        if ($this->_gmail) {
            $this->_mailer->Host = 'smtp.gmail.com';
            $this->_mailer->Port = 587;
            $this->_mailer->SMTPSecure = 'tls';
        } else {
            $this->_mailer->Host = 'localhost:3307';
        }

        $this->_mailer->SMTPDebug = 0;
        $this->_mailer->Username = 'trevissonna047@gmail.com';  // Remplacez par votre adresse email
        $this->_mailer->Password = 'mvdc yfvk hxim lmax';  // Remplacez par votre mot de passe d'application
    
        $this->_mailer->addReplyTo("trevisscott47@gmail.com", "trevis");
        $this->_mailer->From = 'trevisscott47@gmail.com';
        $this->_mailer->FromName = 'trevis';
    }

    public function sendMail() {
        $this->_mailer->addAddress($this->_recipient);
        if (!empty($this->_BCC)) {
            $this->_mailer->addBCC($this->_BCC);
        }

        $this->_mailer->isHTML(true);
        $this->_mailer->Subject = $this->_subject;

        $body = "<html><body>";
        $body .= "<table width='100%' bgcolor='#e0e0e0' cellpadding='0' cellspacing='0' border='0'>";
        $body .= "<tr><td>";
        $body .= "<table align='center' width='100%' border='0' cellpadding='0' cellspacing='0' style='max-width:650px; background-color:#fff; font-family:Verdana, Geneva, sans-serif;'>";
        $body .= "<thead>
                    <tr height='80'>
                        <th colspan='4' style='background-color:#f5f5f5; border-bottom:solid 1px #bdbdbd; font-family:Verdana, Geneva, sans-serif; color:#333; font-size:34px;'>App Test</th>
                    </tr>
                    </thead>";
        $body .= "<tbody>
                    <tr align='center' height='50' style='font-family:Verdana, Geneva, sans-serif;background-color:#00a2d1;'>
                    <td colspan='4' align='center' style='background-color:#f5f5f5; border-top:dashed #00a2d1 2px; font-size:24px; '>Merci de nous avoir contacté</td>
                    </tr>
                    </tbody>";

        $body .= "</table>";
        $body .= "</td></tr>";
        $body .= "</table>";
        $body .= "</body></html>";

        $this->_mailer->AltBody = $this->_message;
        $this->_mailer->MsgHTML($body);
        if(!$this->_mailer->send()) {
            $this->_result = 'Erreur du mail: ' . $this->_mailer->ErrorInfo;
            $this->_state = false;
            return false;
        } else {
            $this->_result = 'Message envoyé avec succès!';
            $this->_state = true;
            return true;
        }
    }

    public function getresult() {
        return $this->_result;
    }

    public function setrecipient($value) {
        $this->_recipient = $value;
    }

    public function setsubject($value) {
        $this->_subject = $value;
    }

    public function setMessage($value) {
        $this->_message = $value;
    }

    public function setBCC($value) {
        $this->_BCC = $value;
    }

    public function setstate($state) {
        $this->_state = $state;
    }

    public function getstate() {
        return $this->_state;
    }
}