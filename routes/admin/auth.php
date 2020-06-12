<?php
// rutas sobre el modulo de Acceso
$router->post('/auth/login','Auth\LoginController');
$router->post('/auth/loginClient','Auth\LoginClientController');
// $router->post('/auth/GetNewCodePlatform','Auth\GetNewCodePlatformController');
$router->post('/auth/VerifyCodePlatform','Auth\VerifyCodePlatformController');