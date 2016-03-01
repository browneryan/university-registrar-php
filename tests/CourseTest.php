<?php

	require_once 'src/Course.php';

	class CourseTest extends PHPUnit_Framework_TestCase
	{
		// protected function tearDown()
	    // {
        //     Student::deleteAll();
        //     Course::deleteAll();
	    // }

        function testGetName()
        {
            //Arrange
            $name = "HIST";
			$number = 100;
            $test_course = new Course($id = null, $name, $number);

            //Act
            $result = $test_course->getName();

            //Assert
            $this->assertEquals($name, $result);
        }

		function testSetName()
		{
			//Arrange
			$name = "HIST";
			$number = 100;
			$test_course = new Course($id = null, $name, $number);

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
			$number = 100;
			$test_course = new Course($id, $name, $number);

			//Act
			$result = $test_course->getId();

			//Assert
			$this->assertEquals(1, $result);
		}

		function testSetNumber()
		{
			//Arrange
			$name = "HIST";
			$number = 100;
			$test_course = new Course($id = null, $name, $number);

			//Act
			$test_course->setNumber('111');
			$result = $test_course->getNumber();

			//Assert
			$this->assertEquals('111', $result);
		}

		function testGetNumber()
		{
			//Arrange
			$name = "HIST";
			$number = 100;
			$test_course = new Course($id = null, $name, $number);

			//Act
			$result = $test_course->getNumber();

			//Assert
			$this->assertEquals(100, $result);
		}

	}

?>
