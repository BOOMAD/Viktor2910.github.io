<<<<<<< HEAD
<? php
	header('Content-Type: text/html; charset=UTF-8');
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
	print_r('Применимы только методы POST');
}
$errors = FALSE;
if (empty($_POST['field-name']) || empty($_POST['field-email']) || empty($_POST['field-DoB']) || empty($_POST['field-me']) || empty($_POST['check-1']) || $_POST['check-1'] == false || !isset($_POST['field-listbox'])) {
	print_r('Необходимо заполнить!');
	exit();
}
$name = $_POST['field-name'];
$email = $_POST['field-email'];
$year = $_POST['year'];
$pol = $_POST['radio-group-1'];
$limbs = intval($_POST['radio-group-2']);
$superpowers = $_POST['field-listbox'];
$bio = $_POST['field-me'];

$reg = "/^\w+[\w\s-]*$/";
$mailreg = "/^[\w\.-]+@([\w-]+\.)+[\w-]{2,4}$/";
$bioreg = "/^\s*\w+[\w\s\.,-]*$/";
$list_sup = array('teleport', 'fly', 'Superspeed', 'Time-line');

if (!preg_match($reg, $name)) {
	print_r('Неверный формат имени');
	exit();
}
if (!preg_match($mailreg, $email)) {
	print_r('Неверный формат email');
	exit();
}
if ($pol != = 'man' && $pol != = 'woman') {
	print_r('Неверный формат пола');
	exit();
}
if ($limbs < 1) {
	print_r('Неверное кол-во конечностей');
	exit();
}
if (!preg_match($bioreg, $bio)) {
	print_r('Неверный формат биографии');
	exit();
}
foreach($superpowers as $checking) {
	if (array_search($checking, $list_sup) === false) {
		print_r('Неверный формат суперсил');
		exit();
	}
}

$user = 'u41121';
$pass = '467446357';
$db = new PDO('mysql:host=localhost;dbname=u41121', $user, $pass, array(PDO::ATTR_PERSISTENT => true));
try {
	$stmt = $db->prepare("INSERT INTO application SET name=:name, email=:email, year=:year, pol=:pol, konechnosti=:limbs, bio=:bio");
	$stmt->bindParam(':name', $name);
	$stmt->bindParam(':email', $email);
	$stmt->bindParam(':year', $year);
	$stmt->bindParam(':pol', $pol);
	$stmt->bindParam(':limbs', $limbs);
	$stmt->bindParam(':bio', $bio);
	if ($stmt->execute() == false) {
		print_r($stmt->errorCode());
		print_r($stmt->errorInfo());
		exit();
	}
	$id = $db->lastInsertId();
	$sppe = $db->prepare("INSERT INTO superp SET name=:name, id_person=:person");
	$sppe->bindParam(':person', $id);
	foreach($superpowers as $inserting) {
		$sppe->bindParam(':name', $inserting);
		if ($sppe->execute() == false) {
			print_r($sppe->errorCode());
			print_r($sppe->errorInfo());
			exit();
		}
	}
}
catch (PDOException $e) {
	print('Error : '.$e->getMessage());
	exit();
}

print_r("Данные отправлены в БД");
?>
=======
<?php
	header('Content-Type: text/html; charset=UTF-8');
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
	print_r('Применимы только методы POST');
}
$errors = FALSE;
if (empty($_POST['field-name']) || empty($_POST['field-email']) || empty($_POST['field-DoB']) || empty($_POST['field-me']) || empty($_POST['check-1']) || $_POST['check-1'] == false || !isset($_POST['field-listbox'])) {
	print_r('Необходимо заполнить!');
	exit();
}
$name = $_POST['field-name'];
$email = $_POST['field-email'];
$year = $_POST['year'];
$pol = $_POST['radio-group-1'];
$limbs = intval($_POST['radio-group-2']);
$superpowers = $_POST['field-listbox'];
$bio = $_POST['field-me'];

$reg = "/^\w+[\w\s-]*$/";
$mailreg = "/^[\w\.-]+@([\w-]+\.)+[\w-]{2,4}$/";
$bioreg = "/^\s*\w+[\w\s\.,-]*$/";
$list_sup = array('teleport', 'fly', 'Superspeed', 'Time-line');

if (!preg_match($reg, $name)) {
	print_r('Неверный формат имени');
	exit();
}
if (!preg_match($mailreg, $email)) {
	print_r('Неверный формат email');
	exit();
}
if ($pol != 'man' && $pol != 'woman') {
	print_r('Неверный формат пола');
	exit();
}
if ($limbs < 1) {
	print_r('Неверное кол-во конечностей');
	exit();
}
if (!preg_match($bioreg, $bio)) {
	print_r('Неверный формат биографии');
	exit();
}
foreach($superpowers as $checking) {
	if (array_search($checking, $list_sup) === false) {
		print_r('Неверный формат суперсил');
		exit();
	}
}

$user = 'u41121';
$pass = '467446357';
$db = new PDO('mysql:host=localhost;dbname=u41121', $user, $pass, array(PDO::ATTR_PERSISTENT => true));
try {
	$stmt = $db->prepare("INSERT INTO date_base SET name=:name, email=:email, year=:year, pol=:pol, limbs=:limbs, bio=:bio");
	$stmt->bindParam(':name', $name);
	$stmt->bindParam(':email', $email);
	$stmt->bindParam(':year', $year);
	$stmt->bindParam(':pol', $pol);
	$stmt->bindParam(':limbs', $limbs);
	$stmt->bindParam(':bio', $bio);
	if ($stmt->execute() == false) {
		print_r($stmt->errorCode());
		print_r($stmt->errorInfo());
		exit();
	}
	$id = $db->lastInsertId();
	$sppe = $db->prepare("INSERT INTO powers SET name=:name, id_person=:person");
	$sppe->bindParam(':person', $id);
	foreach($superpowers as $inserting) {
		$sppe->bindParam(':name', $inserting);
		if ($sppe->execute() == false) {
			print_r($sppe->errorCode());
			print_r($sppe->errorInfo());
			exit();
		}
	}
}
catch (PDOException $e) {
	print('Error : '.$e->getMessage());
	exit();
}

print_r("Данные отправлены в БД");
?>
>>>>>>> 341186a5d62d3d12a9dbcf4595c8cda19b0d564e
