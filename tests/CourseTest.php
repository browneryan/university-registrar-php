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
	}

?>
