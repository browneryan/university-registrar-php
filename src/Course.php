<?php
	 class Course
	{
		private $id;
		private $name;
		private $number;

		function __construct($id = null, $name, $number)
        {
			$this->id = $id;
            $this->name = $name;
            $this->number = $number;
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

		function setNumber($new_number)
        {
            $this->number = (string) $new_number;
        }

        function getNumber()
        {
            return $this->number;
        }


	}
 ?>
