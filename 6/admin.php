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
  <style>
  .animation{
    text-aligh: centre;
margin-top 15px;
font-family: Arial;
font-size:80px;
text-transform: uppercase;
color: rgba(255,255,255,0.2);
background: url(https://yandex.ru/images/search?pos=1&img_url=https%3A%2F%2Fget.pxhere.com%2Fphoto%2Fwarm-orange-red-flame-fire-romantic-cozy-fireplace-glow-darkness-campfire-heat-energy-burn-performance-art-blaze-firelight-fiery-embers-wood-fire-flame-log-fire-heiss-wood-for-the-fireplace-open-fire-computer-wallpaper-1376000.jpg&text=пламя&lr=35&rpt=simage&source=serp);
repeat-x;
-webkit-background-clip: text;
background-size: contain;
animation: fire 13s linear infinite;
  }
                @keyframes fire{
0%{
background-position: left 0 top 0;
}
50%{
background-position: left 150px top -25px;
}
100%{
background-position: left 300px top 0;
}
}
  </style>
  
  <div class ="animation">
  print('Вы успешно авторизовались и видите защищенные паролем данные.');
  </div>
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
