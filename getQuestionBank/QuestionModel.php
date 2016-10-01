<?php
	/**
	* 
	*/
	class QuestionModel
	{
		public $questionString;
		public $questionID;
		public $option1String;
		public $option1ID;
		public $option2String;
		public $option2ID;
		public $option3String;
		public $option3ID;
		public $option4String;
		public $option4ID;
		function __construct(array $argument)
		{
			# code...
			$this->questionString = $argument['qStr'];
			$this->questionID = $argument['qid'];
			$this->option1String = $argument['opt1'];
			$this->option1ID = $argument['opt1id'];
			$this->option2String = $argument['opt2'];
			$this->option2ID = $argument['opt2id'];
			$this->option3String = $argument['opt3'];
			$this->option3ID = $argument['opt3id'];
			$this->option4String = $argument['opt4'];
			$this->option4ID = $argument['opt4id'];
		}
	}
?>