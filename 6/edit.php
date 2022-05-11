<?php
//echo '<pre>';
//print_r($_SERVER);
//echo '</pre>';
//echo '<pre>';
//print_r($_GET);
//echo '</pre>';
require('connect.php');
$pass_hash=array();
try{
  $get=$db->prepare("select password from administration where username=?");
  $get->execute(array('admin'));
  $pass_hash=$get->fetchAll()[0][0];
}
catch(PDOException $e){
  print('Error: '.$e->getMessage());
}
if (empty($_SERVER['PHP_AUTH_USER']) ||
      empty($_SERVER['PHP_AUTH_PW']) ||
      $_SERVER['PHP_AUTH_USER'] != 'admin' ||
      md5($_SERVER['PHP_AUTH_PW']) != $pass_hash) {
    header('HTTP/1.1 401 Unanthorized');
    header('WWW-Authenticate: Basic realm="My site"');
    print('<h1>401 Требуется авторизация</h1>');
    exit();
}
if(empty($_GET['edit_id'])){
  header('Location: admin.php');
}
header('Content-Type: text/html; charset=UTF-8');
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  $messages = array();
  if (!empty($_COOKIE['save'])) {
    setcookie('save', '', 100000);
    $messages[] = 'Спасибо, результаты сохранены.';
    setcookie('field-name_value', '', 100000);
    setcookie('email_value', '', 100000);
    setcookie('year_value', '', 100000);
    setcookie('gr-1_value', '', 100000);
    setcookie('gr-2_value', '', 100000);
    setcookie('field-me_value', '', 100000);
    setcookie('teleport_value', '', 100000);
    setcookie('flyt_value', '', 100000);
    setcookie('superspeed_value', '', 100000);
    setcookie('time-line_value', '', 100000);
    setcookie('privacy_value', '', 100000);
  }
  //Ошибки
  
  $errors_s = array();
  $error=FALSE;
  
  $errors_s['field-name'] = !empty($_COOKIE['field-name_error']);
  $errors_s['email'] = !empty($_COOKIE['email_error']);
  $errors_s['year'] = !empty($_COOKIE['year_error']);
  $errors_s['gr-1'] = !empty($_COOKIE['gr-1_error']);
  $errors_s['gr-2'] = !empty($_COOKIE['gr-2_error']);
  $errors_s['powers'] = !empty($_COOKIE['powers_error']);
  $errors_s['privacy'] = !empty($_COOKIE['privacy_error']);
  if (!empty($errors_s['field-name'])) {
    setcookie('field-name_error', '', 100000);
    $messages[] = '<div class="error">Заполните имя.</div>';
    $error=TRUE;
  }
  if ($errors_s['email']) {
    setcookie('email_error', '', 100000);
    $messages[] = '<div class="error">Заполните или исправьте почту.</div>';
    $error=TRUE;
  }
  if ($errors_s['year']) {
    setcookie('year_error', '', 100000);
    $messages[] = '<div class="error">Выберите год рождения.</div>';
    $error=TRUE;
  }
  if ($errors_s['gr-1']) {
    setcookie('gr-1_error', '', 100000);
    $messages[] = '<div class="error">Выберите пол.</div>';
    $error=TRUE;
  }
  if ($errors_s['gr-2']) {
    setcookie('gr-2_error', '', 100000);
    $messages[] = '<div class="error">Выберите сколько у вас конечностей.</div>';
    $error=TRUE;
  }
  if ($errors_s['powers']) {
    setcookie('powers_error', '', 100000);
    $messages[] = '<div class="error">Выберите хотя бы одну суперспособность.</div>';
    $error=TRUE;
  }
  $values = array();
  $values['teleport']=0;
  $values['fly']=0;
  $values['superspeed']=0;
  $values['time-line']=0;
  //print_r(empty($_SESSION['login']).' '.$_COOKIE[session_name()].' '.empty($_SESSION['uid']));
  include('connect.php');
  try{
      $id=$_GET['edit_id'];
      $get=$db->prepare("select * from date_base where contact_id=?");
      $get->bindParam(1,$id);
      $get->execute();
      $inf=$get->fetchALL();
      $values['field-name']=$inf[0]['name'];
      $values['email']=$inf[0]['email'];
      $values['year']=$inf[0]['year'];
      $values['gr-1']=$inf[0]['pol'];
      $values['gr-2']=$inf[0]['limbs'];
      $values['field-me']=$inf[0]['bio'];
      $get2=$db->prepare("select superpowers from powers where contact_id=?");
      $get2->bindParam(1,$id);
      $get2->execute();
      $inf2=$get2->fetchALL();
      for($i=0;$i<count($inf2);$i++){
        if(($inf2[$i]['superpowers']=='телепорт')||($inf2[$i]['superpowers']=='teleport')){
          $values['teleport']=1;
        }
        if(($inf2[$i]['superpowers']=='полёт')||($inf2[$i]['superpowers']=='fly')){
          $values['fly']=1;
        }
        if(($inf2[$i]['superpowers']=='суперскорость')||($inf2[$i]['superpowers']=='superspeed')){
          $values['superspeed']=1;
        }
        if(($inf2[$i]['superpowers']=='тайм-лайн')||($inf2[$i]['superpowers']=='time-line')){
            $values['time-line']=1;
          }
      }
  }
  catch(PDOException $e){
      print('Error: '.$e->getMessage());
      exit();
  }
  include('form.php');
}
else {
  if(!empty($_POST['edit'])){
    $id=$_POST['dd'];
    $field_name=$_POST['field-name'];
    $email=$_POST['email'];
    $year=$_POST['year'];
    $gr_1=$_POST['gr-1'];
    $gr_2=$_POST['gr-2'];
    $pwrs=$_POST['power'];
    $field_me=$_POST['field-me'];
    $errors = FALSE;
    if (empty($field_name)) {
        setcookie('field-name_error', '1', time() + 24*60 * 60);
        setcookie('field-name_value', '', 100000);
        $errors = TRUE;
    }
    //проверка почты
    if (empty($email) or !filter_var($email,FILTER_VALIDATE_EMAIL)) {
        setcookie('email_error', '1', time() + 24*60 * 60);
        setcookie('email_value', '', 100000);
        $errors = TRUE;
    }
    //проверка года
    if ($year=='Выбрать') {
        setcookie('year_error', '1', time() + 24 * 60 * 60);
        setcookie('year_value', '', 100000);
        $errors = TRUE;
    }
    //проверка пола
    if (!isset($gr_1)) {
        setcookie('gr-1_error', '1', time() + 24 * 60 * 60);
        setcookie('gr-2_value', '', 100000);
        $errors = TRUE;
    }
    //проверка конечностей
    if (!isset($gr_2)) {
        setcookie('gr-2_error', '1', time() + 24 * 60 * 60);
        setcookie('gr-2_value', '', 100000);
        $errors = TRUE;
    }
    //проверка суперспособностей
    if (!isset($pwrs)) {
        setcookie('powers_error', '1', time() + 24 * 60 * 60);
        $errors = TRUE;
    }
    if ($errors) {
        setcookie('save','',100000);
        header('Location: edit.php?edit_id='.$id);
    }
    else {
        setcookie('field-name_error', '', 100000);
        setcookie('email_error', '', 100000);
        setcookie('year_error', '', 100000);
        setcookie('gr-1_error', '', 100000);
        setcookie('gr-2_error', '', 100000);
        setcookie('powers_error', '', 100000);
        setcookie('field-me_error', '', 100000);
        setcookie('privacy_error', '', 100000);
    }
    include('connect.php');
    if(!$errors){
        $upd=$db->prepare("update date_base set name=:name,email=:email,year=:year,pol=:pol,limbs=:limbs,bio=:bio where contact_id=:id");
        $cols=array(
        ':name'=>$field_name,
        ':email'=>$email,
        ':year'=>$year,
        ':pol'=>$gr_1,
        ':limbs'=>$gr_2,
        ':bio'=>$field_me
        );
        foreach($cols as $k=>&$v){
        $upd->bindParam($k,$v);
        }
        $upd->bindParam(':id',$id);
        $upd->execute();
        $del=$db->prepare("delete from powers where contact_id=?");
        $del->execute(array($id));
        $upd1=$db->prepare("insert into powers set superpowers=:power,contect_id=:id");
        $upd1->bindParam(':id',$id);
        foreach($pwrs as $pwr){
        $upd1->bindParam(':power',$pwr);
        $upd1->execute();
        }
    }
    
    if(!$errors){
      setcookie('save', '1');
    }
    header('Location: edit.php?edit_id='.$id);
  }
  else {
    $id=$_POST['dd'];
    include('connect.php');
    try {
      $del=$db->prepare("delete from powers where contact_id=?");
      $del->execute(array($id));
      $stmt = $db->prepare("delete from date_base where contact_id=?");
      $stmt -> execute(array($id));
    }
    catch(PDOException $e){
      print('Error : ' . $e->getMessage());
    exit();
    }
    setcookie('del','1');
    setcookie('del_user',$id);
    header('Location: admin.php');
  }

}
