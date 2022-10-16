<?php

require __DIR__ . '/lib_ext/autoload.php';

use Notification\Email;

$mailer = new Email();

$mailer->sendMail(
    'teste de e-mail',
    "<p>Teste de e-mail</p>",
    'thiagomiranda.tms@gmail.com',
    'Thaigo Teste',
    'thiagomiranda.tms@gmail.com',
    'Thiago Teste'
);

var_dump($mailer);
