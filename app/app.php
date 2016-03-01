<?php
	require_once __DIR__.'/../vendor/autoload.php';
	require_once __DIR__."/../src/Student.php";
	require_once __DIR__."/../src/Course.php";

	use Symfony\Component\Debug\Debug;

	$app = new Silex\Application();

	$app['debug'] = true;

    $server = 'mysql:host=localhost;dbname=university';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

	$app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__.'/../views'));

	$app->get("/", function() use ($app) {
		//home page
        return $app['twig']->render('index.html.twig', array(
			'courses' => Course::getAll(),
			'students' => Student::getAll()
		));
    });

	$app->post("/course", function() use ($app){
		//adds a specific course
		$name = $_POST['name'];
		$course_num = $_POST['number'];
		$new_course = new Course($id = null, $name, $course_num);
		$new_course->save();
		return $app['twig']->render('index.html.twig', array(
			'courses' => Course::getAll(),
			'students' => Student::getAll()
	  ));
	});

	$app->delete('/delete_all_course', function() use ($app) {
		//deletes all courses
		Course::deleteAll();
		return $app['twig']->render('index.html.twig', array(
			'courses' => Course::getAll(),
			'students' => Student::getAll()
	  ));
	});

	return $app;

?>
