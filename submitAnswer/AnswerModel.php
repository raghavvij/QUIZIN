<?php
	/**
	* 
	*/
	require('../config.php');
	class AnswerModel 
	{
		public $questionID;
		public $questionString;
		public $selectedOptionID;
		public $selectedOptionString;
		public $answerID;
		public $answerString;
		public $isCorrectAnswer;
		function isCorrectAnswer($optID,$ansID) {
			if ($optID == $ansID) {
				return true;
			}else {
				return false;
			}
		}
		function fetchOtherData(array $data) {
			$conn = new mysqli(SERVERNAME, USERNAME, PASSWORD,SCH1);
			// Check connection
			if ($conn->connect_error) {
    		die("Connection failed: " . $conn->connect_error);
			} 
			$stmt1 = $conn->prepare(Q6);
			$stmt1->bind_param("s",$data['qid']);
			if ($stmt1->execute() === true) {
				echo "<br>";
				$d1 = $data['optSelid'];
				$d2 = $data["qid"];
				$res = $stmt1->get_result();
				$row = $res->fetch_assoc();
				$sql = "SELECT $d1 from optiontable where quesid = '$d2'";
				echo $sql;
				$result = $conn->query($sql);
				$row2 = $result->fetch_assoc();
				$resultArray = array('qid'=>$row['qid'],'qStr'=>$row['qStr'],'ansID'=>$row['ansid'],'ansString'=>$row['ansString'],'optSelString'=>$row2[$data['optSelid']]);
				$stmt1->close();
				return $resultArray;
			}
			$stmt1->close();
			return [];
		}
		
		function __construct(array $argument)
		{
			# code...
			$resultArray = $this->fetchOtherData($argument);
			$this->questionID = $argument['qid'];
			$this->questionString = $resultArray['qStr'];
			$this->selectedOptionID = $argument['optSelid'];
			$this->answerID = $resultArray['ansID'];
			$this->answerString = $resultArray['ansString'];
			$this->selectedOptionString = $resultArray['optSelString'];
			$this->isCorrectAnswer = $this->isCorrectAnswer($argument['optSelid'],$resultArray['ansID']);
		}
	}
?>