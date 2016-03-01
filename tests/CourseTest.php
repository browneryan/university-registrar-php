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

	class CourseTest extends PHPUnit_Framework_TestCase
	{
		protected function tearDown()
	    {
			Student::deleteAll();
			Course::deleteAll();
	    }

        function testGetName()
        {
            //Arrange
            $name = "HIST";
			$course_num = 100;
            $test_course = new Course($id = null, $name, $course_num);

            //Act
            $result = $test_course->getName();

            //Assert
            $this->assertEquals($name, $result);
        }

		function testSetName()
		{
			//Arrange
			$name = "HIST";
			$course_num = 100;
			$test_course = new Course($id = null, $name, $course_num);

			//Act
			$test_course->setName('BIO');
			$result = $test_course->getName();

			//Assert
			$this->assertEquals('BIO', $result);
		}

		function testGetId()
		{
			//Arrange
			$id = 1;
			$name = "HIST";
			$course_num = 100;
			$test_course = new Course($id, $name, $course_num);

			//Act
			$result = $test_course->getId();

			//Assert
			$this->assertEquals(1, $result);
		}

		function testSetNumber()
		{
			//Arrange
			$name = "HIST";
			$course_num = 100;
			$test_course = new Course($id = null, $name, $course_num);

			//Act
			$test_course->setCourseNum('111');
			$result = $test_course->getCourseNum();

			//Assert
			$this->assertEquals('111', $result);
		}

		function testGetNumber()
		{
			//Arrange
			$name = "HIST";
			$course_num = 100;
			$test_course = new Course($id = null, $name, $course_num);

			//Act
			$result = $test_course->getCourseNum();

			//Assert
			$this->assertEquals(100, $result);
		}

		function testSave()
		{
			//Arrange
			$id = null;
			$name = "HIST";
			$course_num = 100;
			$test_course = new Course($id, $name, $course_num);
			$test_course->save();

			//Act
			$result = Course::getAll();

			//Assert
			$this->assertEquals([$test_course], $result);
		}

		function testGetAll()
		{
			//Arrange
			$id = null;
			$name = "HIST";
			$course_num = 100;
			$test_course = new Course($id, $name, $course_num);
			$test_course->save();

			$name2 = "BIO";
			$course_num2 = 452;
			$test_course2 = new Course($id, $name2, $course_num2);
			$test_course2->save();

			//Act
			$result = Course::getAll();
			//Assert
			$this->assertEquals([$test_course, $test_course2], $result);

		}

		function testDeleteAll()
		{
			//Arrange
			$id = null;
			$name = "HIST";
			$course_num = 100;
			$test_course = new Course($id, $name, $course_num);
			$test_course->save();

			$name2 = "BIO";
			$course_num2 = 452;
			$test_course2 = new Course($id, $name2, $course_num2);
			$test_course2->save();

			//Act
			Course::deleteAll();
			$result = Course::getAll();

			//Assert
			$this->assertEquals([], $result);
		}

		function testUpdateName()
		{
			//Arrange
			$id = null;
			$name = "HIST";
			$course_num = 100;
			$test_course = new Course($id, $name, $course_num);
			$test_course->save();

			//Act
			$test_course->updateName('ENG');

			//Assert
			$this->assertEquals('ENG', $test_course->getName());
		}

		function testFind()
		{
			//Arrange
			$id = null;
			$name = "HIST";
			$course_num = 100;
			$test_course = new Course($id, $name, $course_num);
			$test_course->save();

			//Act
			$result = Course::find($test_course->getId());

			//Arrange
			$this->assertEquals($test_course, $result);
		}

		function testDelete()
		{//delete one course

			//Arrange
			$id = null;
			$name = "HIST";
			$course_num = 100;
			$test_course = new Course($id, $name, $course_num);
			$test_course->save();

			$name2 = "BIO";
			$course_num2 = 452;
			$test_course2 = new Course($id, $name2, $course_num2);
			$test_course2->save();

			//Act
			$test_course->delete();
			$result = Course::getAll();

			//Assert
			$this->assertEquals([$test_course2], $result);

		}


		/////workspace


	}

?>
