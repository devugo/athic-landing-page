<?php

    class Mailer {
        public static function send($to, $subject, $body)
        {
            $to = $to;
            $subject = $subject;
            $txt = $body;
            $headers = "From: ATHIC@devugo.com" . "\r\n";

            mail($to,$subject,$txt,$headers);
        }
    }