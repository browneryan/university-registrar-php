<?php
	 class Course
	{
		private $id;
		private $name;
		private $course_num;

		function __construct($id = null, $name, $course_num)
        {
			$this->id = $id;
            $this->name = $name;
            $this->course_num = $course_num;
        }

		function setName($new_name)
        {
            $this->name = (string) $new_name;
        }

        function getName()
        {
            return $this->name;
        }

		function getId()
        {
            return $this->id;
        }

		function setCourseNum($new_course_num)
        {
            $this->course_num = (string) $new_course_num;
        }

        function getCourseNum()
        {
            return $this->course_num;
        }

		function save()
		{
			$GLOBALS['DB']->exec("INSERT INTO course (name, course_num) VALUES ('{$this->getName()}', '{$this->getCourseNum()}');");
			$this->id = $GLOBALS['DB']->lastInsertId();
		}

		static function getAll()
		{
			$returned_courses = array();
			$all_courses = $GLOBALS['DB']->query("SELECT * FROM course;");
			foreach ($all_courses as $course) {
				$id = $course['id'];
				$name = $course['name'];
				$course_num = $course['course_num'];
				$new_course = new Course($id, $name, $course_num);
				array_push($returned_courses, $new_course);
			}//make sure you are pushing the object you created,'new_course' and not the object you are pulling from your database, 'course'
			return $returned_courses;
		}

		static function deleteAll()
		{
			$GLOBALS['DB']->exec("DELETE FROM course;");
		}

		function updateName($new_name)
		{
			$GLOBALS['DB']->exec("UPDATE course SET name = '{$new_name}' WHERE id = {$this->getId()};");
			$this->setName($new_name);
		}

		static function find($search_id)
		{
			$found_course = null;
			$all_courses = Course::getAll();
			foreach($all_courses as $course) {
				if ($search_id == $course->getId()){
					$found_course = $course;
				}
			}	return $found_course;
		}

		function delete()
		{//delete one course
			//will update later to delete all students in that course
			$GLOBALS['DB']->exec("DELETE FROM course WHERE id = {$this->getId()};");
			$GLOBALS['DB']->exec("DELETE FROM course_student WHERE course_id = {$this->getId()};");
		}

		function addStudent($student)
		{
			$GLOBALS['DB']->exec("INSERT INTO course_student (course_id, student_id) VALUES ({$this->getId()}, {$student->getId()});");
		}

		function getStudents()
		{
			$query = $GLOBALS['DB']->query("SELECT student_id FROM course_student WHERE course_id = {$this->getId()};");
			$student_ids = $query->fetchAll(PDO::FETCH_ASSOC);

			$students = array();
			foreach($student_ids as $id) {
				$student_id = $id['student_id'];
				$result = $GLOBALS['DB']->query("SELECT * FROM student WHERE id = {$student_id};");
				$returned_student = $result->fetchAll(PDO::FETCH_ASSOC);

				$id = $returned_student[0]['id'];
				$name = $returned_student[0]['name'];
				$enroll_date = $returned_student[0]['enroll_date'];
				$new_student = new Student($id, $name, $enroll_date);
				array_push($students, $new_student);
			}
			return $students;
		}

	}
 ?>
