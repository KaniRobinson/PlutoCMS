<?php
  $Configuration = [
    'errors' => E_ALL,
    'ini' => [
      'display_errors' => 1,
      'session.cookie_domain' => '.kanirobinson.co.uk',
    ],
    'session' => [
      'lifetime' => 0,
      'path' => '/',
      'domain' => '.kanirobinson.co.uk',
      'secure' => false,
      'httponly' => false,
      'options' => [
        'cookie_lifetime' => 86400,
      ],
    ],
    'application' => [
      'Template' => 'Pluto\Application\Template\Template',
      'Param' => 'Pluto\Application\Template\Param',
      'Pluto\Application\Cache\Cache',
      'Pluto\Application\Controller\Controller',
    ],
  ];
