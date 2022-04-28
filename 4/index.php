<?php
	
	header('Content-Type: text/html; charset=UTF-8');

if ($_SERVER['REQUEST_METHOD'] == 'GET'){
	$messages = array();
	if (!empty($_COOKIE['save'])) {
		// Удаляем куку, указывая время устаревания в прошлом.
		setcookie('save', '', 100000);
		// Если есть параметр save, то выводим сообщение пользователю.
		$messages[] = 'Спасибо, результаты сохранены.';
	  }
	$errors= array();
	$errors['field-name'] = !empty($_COOKIE['field-name_error']);
	$errors['field-email'] = !empty(&_COOKIE['field-email_error']);
	$errors['year'] = !empty(&_COOKIE['year_error']);
	$errors['radio-group-1'] = !empty($_COOKIE['radio-group-1_error']);
	$errors['radio-group-2'] = !empty($_COOKIE['radio-group-2_error']);
	$errors['field-me'] = !empty(&_COOKIE['field-me_error']);
	$errors['field-listbox'] = !empty(&_COOKIE['field-listbox_error']);
	$errors['check-1'] = !empty($_COOKIE['check-1_error']);

  	// TODO: аналогично все поля.
	  if ($errors['field-name']) {
		setcookie('field-name_error', '',100000);
		$messages[] = '<div class="error">Заполните имя.</div>';
	  }
	  if ($errors['field-email']) {
		setcookie('field-email_error', '',100000);
		$messages[] = '<div class="error">Заполните почту.</div>';
	  }
	  if ($errors['year']) {
		setcookie('year_error', '',100000);
		$messages[] = '<div class="error">Укажите год.</div>';
	  }
	  if ($errors['radio-group-1']) {
		setcookie('radio-group-1_error', '', 100000);
		$messages[] = '<div class="error">Выберите пол.</div>';
	  }
	  if ($errors['radio-group-2']) {
		setcookie('radio-group-2_error', '', 100000);
		$messages[] = '<div class="error">Укажите кол-во конечностей.</div>';
	  }
	  if ($errors['field-me']) {
		setcookie('field-me_error', '',100000);
		$messages[] = '<div class="error">Заполните биографию.</div>';
	  }
	  if ($errors['field-listbox']) {
		setcookie('field-listbox_error', '',100000);
		$messages[] = '<div class="error">Заполните способности.</div>';
	  }
	  if ($errors['check-1']) {
		setcookie('check-1_error', '', 100000);
		$messages[] = '<div class="error">Вы должны болеть за Red Bull Racing.</div>';
	  }
	$values = array();
	$values['field-name'] = empty($_COOKIE['field-name_value']) ? '' : $_COOKIE['field-name_value'];
	$values['field-email'] = empty($_COOKIE['field-email_value']) ? '' : $_COOKIE['field-email_value'];
	$values['year'] = empty($_COOKIE['year_value']) ? '' : $_COOKIE['year_value'];
	$values['radio-group-1'] = empty($_COOKIE['radio-group-1_value']) ? '' : $_COOKIE['radio-group-1_value'];
  	$values['radio-group-2'] = empty($_COOKIE['radio-group-2_value']) ? '' : $_COOKIE['radio-group-2_value'];
	$values['field-me'] = empty($_COOKIE['field-me_value']) ? '' : $_COOKIE['field-me_value'];

	$values['teleport'] = empty($_COOKIE['teleport_value']) ? 0 : $_COOKIE['teleport_value'];
  	$values['fly'] = empty($_COOKIE['fly_value']) ? 0 : $_COOKIE['fly_value'];
  	$values['Superspeed'] = empty($_COOKIE['Superspeed_value']) ? 0 : $_COOKIE['Superspeed_value'];
  	$values['Time-line'] = empty($_COOKIE['Time-line_value']) ? 0 : $_COOKIE['Time-line_value'];

	$values['check-1'] = empty($_COOKIE['check-1_value']) ? 0 : $_COOKIE['check-1_value'];
	include('form.php');
}
else{
	$errors = FALSE;

  if (empty($_POST['field-name'])) {
	print_r('Неверный формат имени');
    setcookie('field-name_error', '1', time() + 24 * 60 * 60);
	setcookie('field-name_value', '', 100000);
    $errors = TRUE;
  }
  else {
    setcookie('field-name_value', $_POST['field-name'], time() + 30 * 24 * 60 * 60 * 12);
	setcookie('field-name_error', '', 100000);
  }

  if (empty($_POST['field-email'])) {
	print_r('Неверный формат email');
    setcookie('field-email_error', '1', time() + 24 * 60 * 60);
	setcookie('field-email_value', '', 100000);
    $errors = TRUE;
  }
  else {
    setcookie('field-email_value', $_POST['field-email'], time() + 30 * 24 * 60 * 60 * 12);
	setcookie('field-email_error', '', 100000);
  }

  if (empty($_POST['year'])) {
    setcookie('year_error', '1', time() + 24 * 60 * 60);
	setcookie('year_value', '', 100000);
    $errors = TRUE;
  }
  else {
    setcookie('year_value', $_POST['year'], time() + 30 * 24 * 60 * 60 * 12);
	setcookie('year_error', '', 100000);
  }

  if (!isset($_POST['radio-group-1'])) {
    setcookie('radio-group-1_error', '1', time() + 24 * 60 * 60);
    setcookie('radio-group-1_value', '', 100000);
    $errors = TRUE;
  }
  else {
    setcookie('radio-group-1_value', $_POST['radio-group-1'], time() + 12 * 30 * 24 * 60 * 60);
    setcookie('radio-group-1_error','',100000);
  }

  if (!isset($_POST['radio-group-2'])) {
    setcookie('radio-group-2_error', '1', time() + 24 * 60 * 60);
    setcookie('radio-group-2_value', '', 100000);
    $errors = TRUE;
  }
  else {
    setcookie('radio-group-2_value', $_POST['radio-group-2'], time() + 12 * 30 * 24 * 60 * 60);
    setcookie('radio-group-2_error','',100000);
 }

  if (empty($_POST['field-me'])) {
	print_r('Неверный формат биографии');
    setcookie('field-me_error', '1', time() + 24 * 60 * 60);
	setcookie('field-me_value', '', 100000);
    $errors = TRUE;
  }
  else {
    setcookie('field-me_value', $_POST['field-me'], time() + 30 * 24 * 60 * 60 * 12);
	setcookie('field-me_error', '', 100000);
  }

  if (!isset($_POST['field-listbox'])) {
    setcookie('super_error', '1', time() + 24 * 60 * 60);
    setcookie('teleport_value', '', 100000);
    setcookie('fly_value', '', 100000);
    setcookie('Superspeed_value', '', 100000);
    setcookie('Time-line_value', '', 100000);
    $errors = TRUE;
  }
  else {
    $powrs=$_POST['field-listbox'];
    $apw=array(
      "teleport_value"=>0,
      "fly_value"=>0,
      "Superspeed_value"=>0,
      "Time-line_value"=>0
    );
  foreach($powrs as $pwer){
    if($pwer=='teleport'){setcookie('teleport_value', 1, time() + 12 * 30 * 24 * 60 * 60); $apw['teleport_value']=1;} 
    if($pwer=='fly'){setcookie('fly_value', 1, time() + 12*30 * 24 * 60 * 60);$apw['fly_value']=1;} 
    if($pwer=='Superspeed'){setcookie('Superspeed_value', 1, time() + 12*30 * 24 * 60 * 60);$apw['Superspeed_value']=1;} 
    if($pwer=='Time-line'){setcookie('Time-line_value', 1, time() + 12*30 * 24 * 60 * 60);$apw['Time-line_value']=1;}
    }
  foreach($apw as $c=>$val){
    if($val==0){
      setcookie($c,'',100000);
    }
  }
  if(!isset($_POST['check-1'])){
    setcookie('check-1_error','1',time()+ 24 * 60 * 60);
    setcookie('check-1_value', '', 100000);
    $errors=TRUE;
  }
  else{
    setcookie('check-1_value', TRUE,time()+ 12 * 30 * 24 * 60 * 60);
    setcookie('check-1_error','',100000);
  }
}

  if ($errors) {
    // При наличии ошибок перезагружаем страницу и завершаем работу скрипта.
    header('Location: index.php');
    exit();
  }
  else {
    // Удаляем Cookies с признаками ошибок.
    setcookie('field-name_error', '', 100000);
	setcookie('field-email_error', '', 100000);
	setcookie('year_error', '', 100000);
	setcookie('radio-group-1_error', '', 100000);
    setcookie('radio-group-2_error', '', 100000);
	setcookie('field-me_error', '', 100000);
	setcookie('field-listbox_error', '', 100000);
	setcookie('check-1_error', '', 100000);
    // TODO: тут необходимо удалить остальные Cookies.
  }


$name = $_POST['field-name'];
$email = $_POST['field-email'];
$year = $_POST['year'];
$pol = $_POST['radio-group-1'];
$limbs = intval($_POST['radio-group-2']);
$superpowers = $_POST['field-listbox'];
$bio = $_POST['field-me'];

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
	$sppe = $db->prepare("INSERT INTO powers SET superpowers=:name, contact_id=:person");
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

// Сохранение в БД.
setcookie('save', '1');

// Делаем перенаправление.
header('Location: index.php');

print_r("Данные отправлены в БД");
  }
?>
