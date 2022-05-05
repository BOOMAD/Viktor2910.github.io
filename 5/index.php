<?php

session_start();
header('Content-Type: text/html; charset=UTF-8');
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  $messages = array();
  if (!empty($_COOKIE['save'])) {
    setcookie('save', '', 100000);
    setcookie('login', '', 100000);
    setcookie('pass_in', '', 100000);
    $messages[] = 'Спасибо, результаты сохранены.';
    if (!empty($_COOKIE['pass_in'])) {
      $messages[] = sprintf('Вы можете <a href="login.php">войти</a> с логином <strong>%s</strong>
        и паролем <strong>%s</strong> для изменения данных.',
        strip_tags($_COOKIE['login']),
        strip_tags($_COOKIE['pass_in']));
    }
    setcookie('field-name_value', '', 100000);
    setcookie('email_value', '', 100000);
    setcookie('year_value', '', 100000);
    setcookie('gr-1_value', '', 100000);
    setcookie('gr-2_value', '', 100000);
    setcookie('field-me_value', '', 100000);
    setcookie('teleport_value', '', 100000);
    setcookie('fly_value', '', 100000);
    setcookie('superspeed_value', '', 100000);
    setcookie('time-line_value', '', 100000);
    setcookie('privacy_value', '', 100000);
  }

  $errors_s = array();
  $error=FALSE;
  $errors_s['field-name'] = !empty($_COOKIE['field-name_error']);
  $errors_s['email'] = !empty($_COOKIE['email_error']);
  $errors_s['year'] = !empty($_COOKIE['year_error']);
  $errors_s['gr-1'] = !empty($_COOKIE['gr-1_error']);
  $errors_s['gr-2'] = !empty($_COOKIE['gr-2_error']);
  $errors_s['field-listbox'] = !empty($_COOKIE['field-listbox_error']);
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
  if ($errors_s['field-listbox']) {
    setcookie('field-listbox_error', '', 100000);
    $messages[] = '<div class="error">Выберите хотя бы одну суперспособность.</div>';
    $error=TRUE;
  }
  if ($errors_s['privacy']) {
    setcookie('privacy_error', '', 100000);
    $messages[] = '<div class="error">Необходимо согласиться с политикой конфиденциальности.</div>';
    $error=TRUE;
  }
  $values = array();
  $values['field-name'] = empty($_COOKIE['field-name_value']) ? '' : strip_tags($_COOKIE['field-name_value']);
  $values['email'] = empty($_COOKIE['email_value']) ? '' : strip_tags($_COOKIE['email_value']);
  $values['year'] = empty($_COOKIE['year_value']) ? 0 : $_COOKIE['year_value'];
  $values['gr-1'] = empty($_COOKIE['gr-1_value']) ? '' : $_COOKIE['gr-1_value'];
  $values['gr-2'] = empty($_COOKIE['gr-2_value']) ? '' : $_COOKIE['gr-2_value'];
  $values['teleport'] = empty($_COOKIE['teleport_value']) ? 0 : $_COOKIE['teleport_value'];
  $values['fly'] = empty($_COOKIE['fly_value']) ? 0 : $_COOKIE['fly_value'];
  $values['superspeed'] = empty($_COOKIE['superspeed_value']) ? 0 : $_COOKIE['superspeed_value'];
  $values['time-line'] = empty($_COOKIE['time-line_value']) ? 0 : $_COOKIE['time-line_value'];
  $values['field-me'] = empty($_COOKIE['filed-me_value']) ? '' : strip_tags($_COOKIE['field-me_value']);
  $values['privacy'] = empty($_COOKIE['privacy_value']) ? FALSE : $_COOKIE['privacy_value'];
  if (!$error and !empty($_COOKIE[session_name()]) and !empty($_SESSION['login'])) {
    require('connect.php');
    try{
      $get=$db->prepare("select * from date_base where contact_id=?");
      $get->bindParam(1,$_SESSION['uid']);
      $get->execute();
      $inf=$get->fetchALL();
 
      $values['field-name']=$inf[0]['name'];
      $values['email']=$inf[0]['email'];
      $values['year']=$inf[0]['year'];
      $values['gr-1']=$inf[0]['pol'];
      $values['gr-2']=$inf[0]['limbs'];
      $values['field-me']=$inf[0]['bio'];

      $get2=$db->prepare("select superpowers from powers where contact_id=?");
      $get2->bindParam(1,$_SESSION['uid']);
      $get2->execute();
      $inf2=$get2->fetchALL();
      for($i=0;$i<count($inf2);$i++){
        if($inf2[$i]['superpowers']=='телепорт'){
          $values['teleport']=1;
        }
        if($inf2[$i]['superpowers']=='полёт'){
          $values['fly']=1;
        }
        if($inf2[$i]['superpowers']=='суперскорость'){
          $values['superspeed']=1;
        }
        if($inf2[$i]['superpowers']=='тайм-лайн'){
          $values['time-line']=1;
        }
      }
    }
    catch(PDOException $e){
      print('Error: '.$e->getMessage());
      exit();
    }
    printf('Вход с логином %s, uid %d', $_SESSION['login'], $_SESSION['uid']);
  }
  include('form.php');
}
else {
  $field_name=$_POST['field-name'];
  $email=$_POST['email'];
  $year=$_POST['year'];
  $gr_1=$_POST['gr-1'];
  $gr_2=$_POST['gr-2'];
  $field_listbox=$_POST['field-listbox'];
  $field_me=$_POST['field-me'];
  if(empty($_SESSION['login'])){
    $priv=$_POST['priv'];
  }
  $errors = FALSE;
  if (empty($field_name)) {
    setcookie('field-name_error', '1', time() + 24*60 * 60);
    setcookie('field-name_value', '', 100000);
    $errors = TRUE;
  }
  else {
    setcookie('field-name_value', $field_name, time() + 60 * 60);
    setcookie('field-name_error','',100000);
  }
  //проверка почты
  if (empty($email) or !filter_var($email,FILTER_VALIDATE_EMAIL)) {
    setcookie('email_error', '1', time() + 24*60 * 60);
    setcookie('email_value', '', 100000);
    $errors = TRUE;
  }
  else {
    setcookie('mail_value', $email, time() + 60 * 60);
    setcookie('mail_error','',100000);
  }
  //проверка года
  if ($year=='Выбрать') {
    setcookie('year_error', '1', time() + 24 * 60 * 60);
    setcookie('year_value', '', 100000);
    $errors = TRUE;
  }
  else {
    setcookie('year_value', intval($year), time() + 60 * 60);
    setcookie('year_error','',100000);
  }
  //проверка пола
  if (!isset($gr_1)) {
    setcookie('gr-1_error', '1', time() + 24 * 60 * 60);
    setcookie('gr-1_value', '', 100000);
    $errors = TRUE;
  }
  else {
    setcookie('gr-1_value', $gr_1, time() + 60 * 60);
    setcookie('gr-1_error','',100000);
  }
  //проверка конечностей
  if (!isset($gr_2)) {
    setcookie('gr-2_error', '1', time() + 24 * 60 * 60);
    setcookie('gr-2_value', '', 100000);
    $errors = TRUE;
  }
  else {
    setcookie('gr-2_value', $gr_2, time() + 60 * 60);
    setcookie('gr-2_error','',100000);
  }
  //проверка суперспособностей
  if (!isset($field_listbox)) {
    setcookie('field-listbox_error', '1', time() + 24 * 60 * 60);
    setcookie('teleport_value', '', 100000);
    setcookie('fly_value', '', 100000);
    setcookie('superspeed_value', '', 100000);
    setcookie('time-line_value', '', 100000);
    $errors = TRUE;
  }
  else {
    $a=array(
      "teleport_value"=>0,
      "fly_value"=>0,
      "superspeed_value"=>0,
      "time-line_value"=>0
    );
    foreach($field_listbox as $pwr){
      if($pwr=='телепорт'){setcookie('teleport_value', 1, time() + 60 * 60); $a['teleport_value']=1;} 
      if($pwr=='полёты'){setcookie('fly_value', 1, time() + 60 * 60);$a['fly_value']=1;} 
      if($pwr=='суперскорость'){setcookie('superspeed_value', 1, time() + 60 * 60);$a['superspeed_value']=1;}
      if($pwr=='тайм-лайн'){setcookie('time-line_value', 1, time() + 60 * 60);$a['time-line_value']=1;} 
    }
    foreach($a as $c=>$val){
      if($val==0){
        setcookie($c,'',100000);
      }
    }
  }
  
  //запись куки для биографии
  setcookie('bio_value',$field_me,time()+ 60*60);
  
  //проверка согласия с политикой конфиденциальности
  if(empty($_SESSION['login'])){
    if(!isset($priv)){
      setcookie('privacy_error','1',time()+ 24*60*60);
      setcookie('privacy_value', '', 100000);
      $errors=TRUE;
    }
    else{
      setcookie('privacy_value',TRUE,time()+ 60*60);
      setcookie('privacy_error','',100000);
    }
  }
  if ($errors) {
    setcookie('save','',100000);
    header('Location: login.php');
  }
  else {
    setcookie('field-name_error', '', 100000);
    setcookie('email_error', '', 100000);
    setcookie('year_error', '', 100000);
    setcookie('gr-1_error', '', 100000);
    setcookie('gr-2_error', '', 100000);
    setcookie('field-listbox_error', '', 100000);
    setcookie('field-me_error', '', 100000);
    setcookie('privacy_error', '', 100000);
  }
  
  require('connect.php');
  if (!empty($_COOKIE[session_name()]) && !empty($_SESSION['login']) and !$errors) {
    $id=$_SESSION['uid'];
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
    $upd1=$db->prepare("insert into powers set superpowers=:power,contact_id=:id");
    $upd1->bindParam(':id',$id);
    foreach($field_listbox as $pwr){
      $upd1->bindParam(':power',$pwr);
      $upd1->execute();
    }
  }
  else {
    if(!$errors){
      $login = 'u'.substr(uniqid(),-5);
      $pass_in = substr(md5(uniqid()),0,10);
      $pass_hash=password_hash($pass_in,PASSWORD_DEFAULT);
      setcookie('login', $login);
      setcookie('pass_in', $pass_in);

      try {
        $stmt = $db->prepare("INSERT INTO date_base SET name=:name,email=:email,year=:year,pol=:pol,limbs=:limbs,bio=:bio");
        $stmt->bindParam(':name',$_POST['field-name']);
        $stmt->bindParam(':email',$_POST['email']);
        $stmt->bindParam(':year',$_POST['year']);
        $stmt->bindParam(':pol',$_POST['gr-1']);
        $stmt->bindParam(':limbs',$_POST['gr-2']);
        $stmt->bindParam(':bio',$_POST['field-me']);
        $stmt -> execute();

        $id=$db->lastInsertId();

        $usr=$db->prepare("insert into username set id=?,login=?,pass=?");
        $usr->bindParam(1,$id);
        $usr->bindParam(2,$login);
        $usr->bindParam(3,$pass_hash);
        $usr->execute();

        $pwr=$db->prepare("INSERT INTO powers SET superpowers=:power,contact_id=:id");
        $pwr->bindParam(':id',$id);
        foreach($field_listbox as $power){
          $pwr->bindParam(':power',$power); 
          $pwr->execute();  
        }
      }
      catch(PDOException $e){
        print('Error : ' . $e->getMessage());
        exit();
      }
    }
  }
  if(!$errors){
    setcookie('save', '1');
  }
  header('Location: ./');
}
