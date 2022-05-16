<?php
if($_SERVER['REQUEST_METHOD']=='GET'){
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
    print('<h1>401 Требуется авторизация </h1>');
    exit();
  }

  if(!empty($_COOKIE['del'])){
    echo 'Пользователь '.$_COOKIE['del_user'].' удалён <br>';
    setcookie('del','');
    setcookie('del_user','');
  }
  <h1 class="animation">Вы успешно авторизовались и видите защищенные паролем данные</h1>
  /*print('Вы успешно авторизовались и видите защищенные паролем данные.');*/
  $users=array();
  $pwrs=array();
  $pwr_def=array('телепорт','полёт','суперскорость','тайм-лайн');
  $pwrs_count=array();

  try{
    $get=$db->prepare("select * from date_base");
    $get->execute();
    $inf=$get->fetchALL();
    $get2=$db->prepare("select contact_id,superpowers from powers");
    $get2->execute();
    $inf2=$get2->fetchALL();
    $count=$db->prepare("select count(*) from powers where superpowers=?");
    foreach($pwr_def as $pw){
      $i=0;
      $count->execute(array($pw));
      $pwrs_count[]=$count->fetchAll()[$i][0];
      $i++;
    }
  }
  catch(PDOException $e){
    print('Error: '.$e->getMessage());
    exit();
  }
  $users=$inf;
  $pwrs=$inf2;
  include('table.php');
}

else{
  
}
?>
