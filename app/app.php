<?php
	require_once __DIR__.'/../vendor/autoload.php';
	require_once __DIR__."/../src/Student.php";
	require_once __DIR__."/../src/Course.php";

	use Symfony\Component\Debug\Debug;

	$app = new Silex\Application();

	$app['debug'] = true;

    $server = 'mysql:host=localhost;dbname=to_do';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

	$app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__.'/../views'));

	$app->get('/', function(){return 'Hello, World!';});

	return $app;

?>
