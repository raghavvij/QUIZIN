<?php
define('Q1', "INSERT INTO questiontable (qid,qStr) VALUES (?, ?)");
define('Q2', "INSERT INTO optiontable (quesid,opt1,opt2,opt3,opt4,opt1id,opt2id,opt3id,opt4id)
 VALUES (?,?,?,?,?,?,?,?,?)");
define('Q3', "INSERT INTO answertable (ansid,quesid,ansString) VALUES (?,?,?)");
define('Q4', "SELECT DISTINCT qid from questiontable ORDER BY RAND() LIMIT 5");	
define('Q5', "SELECT qid,qStr,opt1,opt2,opt3,opt4,opt1id,opt2id,opt3id,opt4id from questiontable,
	optiontable where questiontable.qid = optiontable.quesid AND questiontable.qid IN ");
define('Q6', "SELECT qid,qStr,ansid,ansString from questiontable,answertable,optiontable where
 questiontable.qid = answertable.quesid AND answertable.quesid = optiontable.quesid AND questiontable.qid = ?");
?>