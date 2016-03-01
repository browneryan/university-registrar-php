<?php
	 class Student
	{
		private $id;
		private $name;
		private $enroll_date;

		function __construct($id = null, $name, $enroll_date)
		{
			$this->id = $id;
			$this->name = $name;
			$this->enroll_date = $enroll_date;
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

		function setEnrollDate($new_enroll_date)
        {
            $this->enroll_date = (string) $new_enroll_date;
        }

        function getEnrollDate()
        {
            return $this->enroll_date;
        }

		function save()
		{
			$GLOBALS['DB']->exec("INSERT INTO student (name, enroll_date) VALUES ('{$this->getName()}', '{$this->getEnrollDate()}');");
			$this->id = $GLOBALS['DB']->lastInsertId();
		}

		static function getAll()
		{
			$returned_students = array();
			$all_students = $GLOBALS['DB']->query("SELECT * FROM student;");
			foreach ($all_students as $student) {
				$id = $student['id'];
				$name = $student['name'];
				$enroll_date = $student['enroll_date'];
				$new_student = new Student($id, $name, $enroll_date);
				array_push($returned_students, $new_student);
			}//make sure you are pushing the object you created,'new_student' and not the object you are pulling from your database, 'student'
			return $returned_students;
		}

		static function deleteAll()
		{
			$GLOBALS['DB']->exec("DELETE FROM student;");
		}

		static function find($search_id)
		{
			$found_student = null;
			$all_students = Student::getAll();
			foreach ($all_students as $student) {
				if ($search_id == $student->getId()) {
					$found_student = $student;
				}
			}
			return $found_student;
		}

		function delete()
		{//delete one student
			$GLOBALS['DB']->exec("DELETE FROM student WHERE id = {$this->getId()};");
			$GLOBALS['DB']->exec("DELETE FROM course_student WHERE student_id = {$this->getId()};");
		}

		function updateName($new_name)
		{
			$GLOBALS['DB']->exec("UPDATE student WHERE id = {$this->getId()}:");
			$this->setName($new_name);
		}

		function addCourse($course)
		{
			$GLOBALS['DB']->exec("INSERT INTO course_student (course_id, student_id) VALUES ({$course->getId()}, {$this->getId()});");
		}

		function getCourse()
		{
			$query = $GLOBALS['DB']->query("SELECT course_id FROM course_student WHERE student_id = {$this->getId()};");
			$course_ids = $query->fetchAll(PDO::FETCH_ASSOC);

			$courses = array();
			foreach($course_ids as $id) {
				$course_id = $id['course_id'];
				$result = $GLOBALS['DB']->query("SELECT * FROM course WHERE id = {$course_id};");
				$returned_course = $result->fetchAll(PDO::FETCH_ASSOC);

				$name = $returned_course[0]['name'];
				$course_num = $returned_course[0]['course_num'];
				$id = $returned_course[0]['id'];
				$new_course = new Course($id, $name, $course_num);
				array_push($courses, $new_course);

			}
			return $courses;
		}

	}
 ?>
