<?php

	/**
	* @backupGlobals disabled
	* @backupStaticAttributes disabled
	*/

	require_once 'src/Student.php';
	require_once 'src/Course.php';

	$server = 'mysql:host=localhost;dbname=university_test';
	$username = 'root';
	$password = 'root';
	$DB = new PDO($server, $username, $password);


	class StudentTest extends PHPUnit_Framework_TestCase
	{
		protected function tearDown()
		{
			Student::deleteAll();
			Course::deleteAll();
		}

		function testGetName()
		{
			//Arrange
			$name = "Goofus";
			$enroll_date = '2000-12-30';
			$id = null;
			$test_student = new Student($id, $name, $enroll_date);

			//Act
			$result = $test_student->getName();

			//Assert
			$this->assertEquals($name, $result);
		}

		function testSetName()
		{
			//Arrange
			$name = "Goofus";
			$enroll_date = '2000-12-30';
			$id = null;
			$test_student = new Student($id, $name, $enroll_date);

			//Act
			$test_student->setName('Gallant');
			$result = $test_student->getName();

			//Assert
			$this->assertEquals('Gallant', $result);

		}

		function testGetId()
		{
			//Arrange
			$name = "Goofus";
			$enroll_date = '2000-12-30';
			$id = 1;
			$test_student = new Student($id, $name, $enroll_date);

			//Act
			$result = $test_student->getId();

			//Assert
			$this->assertEquals(1, $result);
		}

		function setEnrollDate()
		{
			//Arrange
			$name = "Goofus";
			$enroll_date = '2000-12-30';
			$id = null;
			$test_student = new Student($id, $name, $enroll_date);

			//Act
			$test_student->setEnrollDate('2020-12-30');
			$result = $test_student->getEnrollDate();

			//Assert
			$this->assertEquals('2020-12-30', $result);
		}

		function testSave()
		{
			//Arrange
			$name = "Goofus";
			$enroll_date = '2000-12-30';
			$id = null;
			$test_student = new Student($id, $name, $enroll_date);
			$test_student->save();

			//Act
			$result = Student::getAll();

			//Assert
			$this->assertEquals([$test_student], $result);
		}

		function testFind()
		{
			//Arrange
			$name = "Goofus";
			$enroll_date = '2000-12-30';
			$id = null;
			$test_student = new Student($id, $name, $enroll_date);
			$test_student->save();

			//Act
			$result = Student::find($test_student->getId());

			//Result
			$this->assertEquals($test_student, $result);
		}

		function testDeleteAll()
		{
			//Arrange
			$name = "Goofus";
			$enroll_date = '2000-12-30';
			$id = null;
			$test_student = new Student($id, $name, $enroll_date);
			$test_student->save();

			$name2 = "Jabroni";
			$enroll_date2 = '2012-10-18';
			$id2 = null;
			$test_student2 = new Student($id2, $name2, $enroll_date2);
			$test_student2->save();

			//Act
			Student::deleteAll();
			$result = Student::getAll();

			//Arrange
			$this->assertEquals([], $result);
		}

		function testGetAll()
		{
			//Arrange
			$name = "Goofus";
			$enroll_date = '2000-12-30';
			$id = null;
			$test_student = new Student($id, $name, $enroll_date);
			$test_student->save();

			$name2 = "Jabroni";
			$enroll_date2 = '2012-10-18';
			$id2 = null;
			$test_student2 = new Student($id2, $name2, $enroll_date2);
			$test_student2->save();

			//Act
			$result = Student::getAll();

			//Arrange
			$this->assertEquals([$test_student, $test_student2], $result);
		}

		function testDelete()
		{//delete one student

			//Arrange
			$name = "Goofus";
			$enroll_date = '2000-12-30';
			$id = null;
			$test_student = new Student($id, $name, $enroll_date);
			$test_student->save();

			$name2 = "Jabroni";
			$enroll_date2 = '2012-10-18';
			$id2 = null;
			$test_student2 = new Student($id2, $name2, $enroll_date2);
			$test_student2->save();

			//Act
			$test_student->delete();
			$result = Student::getAll();

			//Result
			$this->assertEquals([$test_student2], $result);
		}

		function testUpdateName()
		{
			//Arrange
			$name = "Goofus";
			$enroll_date = '2000-12-30';
			$id = null;
			$test_student = new Student($id, $name, $enroll_date);
			$test_student->save();

			//Act
			$test_student->updateName('Goofball');

			//Assert
			$this->assertEquals('Goofball', $test_student->getName());
		}

		function testaddCourse()
		{
			//Arrange
			$id = 1;
			$course_name = "HIST";
			$course_num = 100;
			$test_course = new Course($id, $course_name, $course_num);
			$test_course->save();

			$name = "Goofus";
			$enroll_date = '2000-12-30';
			$id2 = 2;
			$test_student = new Student($id2, $name, $enroll_date);
			$test_student->save();

			//Act
			$test_student->addCourse($test_course);

			//Assert
			$this->assertEquals($test_student->getCourse(), [$test_course]);
		}

		function testGetCourse()
		{
			//Arrange
			$id = 1;
			$course_name = "HIST";
			$course_num = 100;
			$test_course = new Course($id, $course_name, $course_num);
			$test_course->save();

			$id2 = 2;
			$course_name2 = "ENG";
			$course_num2 = 110;
			$test_course2 = new Course($id2, $course_name2, $course_num2);
			$test_course2->save();

			$name = "Goofus";
			$enroll_date = '2000-12-30';
			$id3 = 1;
			$test_student = new Student($id3, $name, $enroll_date);
			$test_student->save();

			//Act
			$test_student->addCourse($test_course);
			$test_student->addCourse($test_course2);

			//Assert
			$this->assertEquals($test_student->getCourse(), [$test_course, $test_course2]);
		}

	}


?>
