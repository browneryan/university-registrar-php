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
	}
 ?>
