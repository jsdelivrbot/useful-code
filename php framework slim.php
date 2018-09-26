https://www.slimframework.com/docs/v2/start/get-started.html

<!-- composer -->
composer require slim/slim:~2.0

<!-- .htaccess -->
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^ index.php [QSA,L]

<!-- index.php -->
<?php
require 'vendor/autoload.php';

$config = [
	'templates.path' => 'views'
];

$app = new \Slim\Slim($config);

$app->get('/', function () use ($app) {
    $app->render('home.php');
});

$app->get('/hello/:id', function ($id) use ($app) {

    $req = $app->request;

    $host = $req->getHost();
    $root = $req->getRootUri();

    $baseurl = (isset($_SERVER['HTTPS']) ? "https://" : "http://") . $host . $root;

    $app->view()->appendData(array('baseurl' => $baseurl));

    /*
    <link rel="stylesheet" href="<?= $baseurl ?>/stylesheets/style.css">
    */

    $app->render('html.php', [
    	'id' => $id
    ]);

});

$app->run();