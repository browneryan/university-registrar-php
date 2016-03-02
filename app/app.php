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

	//===============COURSE=================//
	$app->get("/", function() use ($app) {
		//home page
        return $app['twig']->render('index.html.twig', array(
			'courses' => Course::getAll(),
			'students' => Student::getAll()
		));
    });

	$app->get('/course/{id}', function($id) use ($app) {
		//inspect a single course
		$course = Course::find($id);
		return $app['twig']->render('course.html.twig', array(
			'course' => $course,
			'students' => $course->getStudents(),
			'all_students' => Student::getAll()
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

	//===============STUDENT=================//

	$app->post('/student', function() use ($app) {
		//adds a specific student
		$name = $_POST['name'];
		$enroll_date = $_POST['enroll_date'];
		$new_student = new Student($id = null, $name, $enroll_date);
		$new_student->save();
		return $app['twig']->render('index.html.twig', array(
			'courses' => Course::getAll(),
			'students' => Student::getAll()
		));
	});

	$app->post('/add_student', function() use ($app) {
		$course = Course::find($_POST['course_id']);
		$student = Student::find($_POST['student_id']);
		$course->addStudent($student);
		return $app['twig']->render('course.html.twig', array(
			'course' => $course,
			'students' => $course->getStudents(),
			'all_students' => Student::getAll()
		));
	});

	$app->post("/add_tasks", function() use ($app) {
	$category = Category::find($_POST['category_id']);
	$task = Task::find($_POST['task_id']);
	$category->addTask($task);
	return $app['twig']->render('category.html.twig', array('category' => $category,
	'categories' => Category::getAll(),
	'tasks' => $category->getTasks(),
	'all_tasks' => Task::getAll()));
});

	$app->delete('/delete_all_student', function() use ($app) {
		//deletes all courses
		Student::deleteAll();
		return $app['twig']->render('index.html.twig', array(
			'courses' => Course::getAll(),
			'students' => Student::getAll()
	  ));
	});

	return $app;

?>
