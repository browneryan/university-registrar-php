<?php

	/**
	* @backupGlobals disabled
	* @backupStaticAttributes disabled
	*/

	$server = 'mysql:host=localhost;dbname=university_test';
	$username = 'root';
	$password = 'root';
	$DB = new PDO($server, $username, $password);

	require_once 'src/Student.php';

	class StudentTest extends PHPUnit_Framework_TestCase
	{
		protected function tearDown()
		{
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
	}


?>
