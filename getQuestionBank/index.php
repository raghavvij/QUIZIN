<?php
	require('../config.php');
	require('QuestionModel.php');
	$jsonArray;
	function createInnerArray($row) {
		$questionObject = new QuestionModel($row);
		$questionArray = array('qid' => $questionObject->questionID,'qStr' => $questionObject->questionString);
		$option1Array = array('optid' => $questionObject->option1ID,'optStr' => $questionObject->option1String);
		$option2Array = array('optid' => $questionObject->option2ID,'optStr' => $questionObject->option2String);
		$option3Array = array('optid' => $questionObject->option3ID,'optStr' => $questionObject->option3String);
		$option4Array = array('optid' => $questionObject->option4ID,'optStr' => $questionObject->option4String);
		$optionArray = [];
		array_push($optionArray, $option1Array);
		array_push($optionArray, $option2Array);
		array_push($optionArray, $option3Array);
		array_push($optionArray, $option4Array);
		$finalArray = array('ques'=>$questionArray,'opt'=>$optionArray);
		return $finalArray;
	}
	function createQuestionBankModel($row) {
		
	}
	if ($_SERVER['REQUEST_METHOD'] == 'GET') {
		$conn = new mysqli(SERVERNAME, USERNAME, PASSWORD,SCH1);

	// Check connection
	if ($conn->connect_error) {
    	die("Connection failed: " . $conn->connect_error);
	} 
	$result1 = $conn->query(Q4);
	$qidStr = "('";
	
	if ($result1->num_rows > 0) {
    // output data of each row
		$i = 0;
    while($row = $result1->fetch_assoc()) {
    	$i = $i + 1;
    	$qidStr = $qidStr.$row['qid'];
    	if($i != 5) {
    	$qidStr = $qidStr."','";	
    	}
    }
    $qidStr = $qidStr."')";
    $result2 = $conn->query(Q5.$qidStr);
	if ($result2->num_rows > 0) {
    // output data of each row
	$jsonArray = [];
    while($row = $result2->fetch_assoc()) {
    	array_push($jsonArray,createInnerArray($row));
    }
	}
	header('Content-Type: application/json');
	echo json_encode($jsonArray);
	}
}else {
		echo var_export($_SERVER['REQUEST_METHOD']);
	}
?>