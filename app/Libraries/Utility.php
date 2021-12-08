<?php

namespace App\Libraries;

class Utility
{
    public function generateRand($len)
    {
        helper('text');
        return random_string('alnum', $len);
    }

    public function sendCode($msg, $to, $cc)
    {
        $email = \Config\Services::email();
        $config['newline'] = "\r\n";
        $config['mailtype'] = 'html';
        $data['msg'] = $msg;
        $email->setFrom('childrenchurch@rccggwc.org', 'RCCG GWC Children Church');
        $email->setTo($to);
        if ($cc != "") {
            $email->setCC($cc);
        }

        $email->setSubject('RCCG GWC Children Church registration');
        $email->setMessage($msg);
        $result = $email->send();
        if ($result) {
            echo $result;
        } else {
            echo $email->printDebugger();
        }
        return $result;
    }
}
