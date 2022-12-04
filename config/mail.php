<?php

return [

    'driver' => 'smtp',
    'host' => env('MAIL_HOST', 'smtp.gmail.com'),
    'port' => env('MAIL_PORT', '587'),
    'from' => ['address' => 'lucho.uns.iaweb@gmail.com', 'name' => 'luchoiaweb'],
    'encryption' => env('MAIL_ENCRYPTION','tls'),
    'username' => env('MAIL_USERNAME', 'lucho.uns.iaweb@gmail.com'),
    'password' => env('MAIL_PASSWORD', 'ieaogzqrujuwmshv'),
    'sendmail' => '/usr/sbin/sendmail -bs',
    
    'pretend' => false,
    
    ];
