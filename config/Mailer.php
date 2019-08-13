<?php

use Rain\Tpl;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mailer
{

    const FROM_NAME = "AllBlacks Store";
    const USERNAME = "allblacksstore@gmail.com";
    const PASSWORD = "<?password?>";

    private $mail;

    public function __construct($subject, $tplName, $data = array())
    {

        $config = array(
            "tpl_dir"       => $_SERVER["DOCUMENT_ROOT"] . "/allblacks-ecommerce/resources/views/email/",
            "cache_dir"     => $_SERVER["DOCUMENT_ROOT"] . "/allblacks-ecommerce/resources/views-cache/",
            "debug"         => false
        );
        Tpl::configure($config);

        $tpl = new Tpl;

        foreach ($data as $key => $value) {
            $tpl->assign($key, $value);
        }

        $html = $tpl->draw($tplName, true);

        $this->mail = new PHPMailer(true);
        $this->mail->isSMTP();
        $this->mail->Host = 'smtp.gmail.com';
        $this->mail->SMTPAuth = true;
        $this->mail->SMTPSecure = 'tls';
        $this->mail->SMTPKeepAlive = true;
        $this->mail->Port = 587;
        $this->mail->Username = Mailer::USERNAME;
        $this->mail->Password = Mailer::PASSWORD;
        $this->mail->setFrom(Mailer::USERNAME, Mailer::FROM_NAME);
        $this->mail->Subject = utf8_decode($subject);
        $this->mail->msgHTML($html);
    }

    public function send(array $toRecipients)
    {
        foreach ($toRecipients as $toRecipient) {
            try {
                $this->mail->addAddress($toRecipient['email'], $toRecipient['name']);
            } catch (Exception $e) {
                continue;
            }

            try {
                $this->mail->send();
            } catch (Exception $e) {
                $this->mail->smtp->reset();
            }
            $this->mail->clearAddresses();
            $this->mail->clearAttachments();
        }
    }
}
