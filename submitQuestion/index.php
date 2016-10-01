<?php
	require('../config.php');
	function insertIntoTable(array $argumentArray,$tableName,$conn) {
		switch ($tableName) {
			case TBL1:
				# code...
				$stmt1 = $conn->prepare(Q1);
				$stmt1->bind_param("ss", $argumentArray['qid'], $argumentArray['qStr']);
				if ($stmt1->execute() === true) {
					echo "question added successfully";
				}
				$stmt1->close();
				break;
			case TBL2:
				# code...
				$stmt2 = $conn->prepare(Q2);
				$stmt2->bind_param("sssssssss", $argumentArray['qid'], $argumentArray['opt1'],$argumentArray['opt2'],$argumentArray['opt3'],$argumentArray['opt4'],$opt1id,$opt2id,$opt3id,$opt4id);
				$opt1id = "opt1";
				$opt2id = "opt2";
				$opt3id = "opt3";
				$opt4id = "opt4";
				if ($stmt2->execute() === true) {
					echo " options added successfully";
				}
				$stmt2->close();
				break;
			case TBL3:
				# code...
				$stmt3 = $conn->prepare(Q3);
				$stmt3->bind_param("sss", $argumentArray['ansid'], $argumentArray['qid'],$argumentArray['ansStr']);
				if ($stmt3->execute() === true) {
					echo " answer added successfully";
				}
				$stmt3->close();
				break;
			
			default:
				# code...
				break;
		}
	}
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
	// Create connection
	$conn = new mysqli(SERVERNAME, USERNAME, PASSWORD,SCH1);

	// Check connection
	if ($conn->connect_error) {
    	die("Connection failed: " . $conn->connect_error);
	} 
	echo "Connected successfully";
	$question = $_POST['question'];
	$opt1 = $_POST['opt1'];
	$opt2 = $_POST['opt2'];
	$opt3 = $_POST['opt3'];
	$opt4 = $_POST['opt4'];
	$answer = $_POST['ans'];
	$answerid = $_POST['ansid'];
	$questionid = "QZ".sha1(uniqid(time(), true));
	$questionTableArray = array('qid' =>  $questionid ,'qStr' => $question);
	$optionTableArray =  array('qid' => $questionid, 'opt1' => $opt1, 'opt2' => $opt2, 'opt3' => $opt3, 'opt4' => $opt4 );
	$answerTableArray = array('ansid' => $answerid, 'qid' => $questionid, 'ansStr' => $answer);
	insertIntoTable($questionTableArray,TBL1,$conn);
	insertIntoTable($optionTableArray,TBL2,$conn);
	insertIntoTable($answerTableArray,TBL3,$conn);
	}
	else
	{
    	Utility::fetchHTTPCodeText(400);
	}
?>