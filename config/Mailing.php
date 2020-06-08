<?php

namespace Spac\config;
use Swift_SmtpTransport;
use Swift_Mailer;
use Swift_Message;
class Mailing
{
    
    public function __construct()
    {   
        $https['ssl']['verify_peer'] = FALSE;
        $https['ssl']['verify_peer_name'] = FALSE;
        $this->transport = (new Swift_SmtpTransport(EMAIL_HOST, EMAIL_PORT))
        ->setUsername(EMAIL_USERNAME)
        ->setPassword(EMAIL_PASSWORD);
        //->setEncryption(EMAIL_ENCRYPTION) //For Gmail
        // Create the Mailer using your created Transport
        $this->mailer = new Swift_Mailer($this->transport);
        $this->fromEmail = 'Contact@spac.fr';
        $this->fromUser = 'Site SPAC';

    }
    
    public function contact($post)
    {

        $email = $post->get('email');
        $name = $post->get('name');
        $content = $post->get('message');
        $subject = $post->get('subject');;
        $body = '<!DOCTYPE html>
                        <html>
                            <head>
                                <title>Message</title>
                            </head>
                            <body style="text-align:center">
                                '.$content.'<br/>
                               <p><strong> Message de '.$name.' </strong></p><br/> '.$email.' 
                            </body>
                        </html>';
                        
        $message = (new Swift_Message($subject))
        ->setFrom([$this->fromEmail => $this->fromUser])
         ->setTo([EMAIL_USERNAME])
        ->setBody($body, 'text/html');
       
        // Send the message
        $result = $this->mailer->send($message);
    }

    public function contactAll($post, $postname, $postmail)
    {
        $email = $postmail;
        $name = $postname;
        $content = $post->get('message');
        $subject = $post->get('subject');;
        $body = '<!DOCTYPE html>
                        <html>
                            <head>
                                <title>Message</title>
                            </head>
                            <body style="text-align:center">
                                '.$content.'<br/>
                               <p><strong> Message de '.$name.' </strong></p><br/> '.$email.' 
                            </body>
                        </html>';
                        
        $message = (new Swift_Message($subject))
        ->setFrom([$this->fromEmail => $this->fromUser])
         ->setTo([EMAIL_USERNAME])
        ->setBody($body, 'text/html');
       
        // Send the message
        $result = $this->mailer->send($message);
    }


    public function contactUser($post, $sendname, $usermail)
    {
        $name = $sendname;
        $content = $post->get('message');
        $subject = $post->get('subject');;
        $body = '<!DOCTYPE html>
                        <html>
                            <head>
                                <title>Message</title>
                            </head>
                            <body style="text-align:center">
                                '.$content.'<br/>
                               <p><strong> Message de '.$name.' </strong></p> 
                            </body>
                        </html>';
                        
        $message = (new Swift_Message($subject))
        ->setFrom([$this->fromEmail => $this->fromUser])
         ->setTo([$usermail])
        ->setBody($body, 'text/html');
       
        // Send the message
        $result = $this->mailer->send($message);
    }
}