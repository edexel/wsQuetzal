<?php
// rutas sobre el modulo de Acceso
$router->post('/auth/login','Auth\LoginController');
$router->post('/auth/loginclient','Auth\LoginClientController');
$router->post('/auth/forgot','Auth\ForgotController');
$router->post('/auth/change','Auth\ChangeController');
// $router->post('/auth/GetNewCodePlatform','Auth\GetNewCodePlatformController');
$router->post('/auth/verifycodeplatform','Auth\VerifyCodePlatformController');