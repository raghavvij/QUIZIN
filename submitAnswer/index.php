<?php
require ('AnswerModel.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$score = 0;
	$max_score = 0;
	$response = json_decode($_POST['ans_array'],true);
	$finalArray = [];
	foreach ($response as $value) {
		# code...
		$max_score = $max_score + 1;
		$ansModel = new AnswerModel($value); 
		if($ansModel->isCorrectAnswer == true) {
			$score += 1;
		}
		$quesArray = array('qid'=>$ansModel->questionID,'qStr'=>$ansModel->questionString,'optSelStr'=>$ansModel->selectedOptionString);
		$ansArray = array('ansid'=>$ansModel->answerID,'ansStr'=>$ansModel->answerString,'correct'=>$ansModel->isCorrectAnswer);
		$finalObjectArray = array('ques'=>$quesArray,'ans'=>$ansArray);
		array_push($finalArray, $finalObjectArray);
	}
	$jsonArray = array('score'=>$score,'max_score'=>$max_score,'answers'=>$finalArray);
	header('Content-Type: application/json');
	echo "<br><br><br>".json_encode($jsonArray); 
}else{
	echo $_SERVER['REQUEST_METHOD'];
}
?>