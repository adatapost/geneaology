<?php
$cn = new PDO("mysql:host=localhost;dbname=geneology_db","root","");
$message = "";
function post($key) {
	if (isset($_POST[$key])) {
		return $_POST[$key];
	}
	return "";
}

function kvExecute($sql, $array) {
	global $cn;
	$st = $cn -> prepare($sql);
	 return $st -> execute($array);
	  print_r($st->errorInfo());
}

function kvRow($sql, $array) {
	global $cn;
	$st = $cn -> prepare($sql);
	$st -> execute($array);
	$row = $st -> fetch(PDO::FETCH_OBJ);
	return $row;
}

function kvRows($sql, $array) {
	global $cn;
	$st = $cn -> prepare($sql);
	$st -> execute($array);
	$row = $st -> fetchAll(PDO::FETCH_CLASS);
	return $row;
}

function kvSingle($sql, $array) {
	global $cn;
	$st = $cn -> prepare($sql);
	$st -> execute($array);
	$row = $st -> fetch();
	return $row[0];
}

 