<style>
  .form{
    max-width: 960px;
    text-align: center;
    margin: 0 auto;
  }
  .error {
    border: 2px solid red;
  }
  .hidden{
    display: none;
  }
</style>
<body>
<?php
if (!empty($messages)) {
  print('<div id="messages">');
  // Выводим все сообщения.
  foreach ($messages as $message) {
    print($message);
  }
  print('</div>');
}
?>
  <form class="form1" action="index.php" method="POST">
	<div class="form">
    <label> ФИО </label> <br>
    <input name="field-name" <?php if ($errors_s['field-name']) {print 'class="error"';} ?> value="<?php print $values['field-name']; ?>" /> <br>
    <label> Почта </label> <br>
    <input name="email" type="email" <?php if ($errors_s['email']) {print 'class="error"';} ?> value="<?php print $values['email']; ?>"/> <br>
    <label> Год рождения </label> <br>
    <select name="year" <?php if ($errors_s['year']) {print 'class="error"';} ?>>
      <option value="Выбрать">Выбрать</option>
    <?php
        for($i=1890;$i<=2022;$i++){
          if($values['year']==$i){
            printf("<option value=%d selected>%d год</option>",$i,$i);
          }
          else{
            printf("<option value=%d>%d год</option>",$i,$i);
          }
        }
    ?>
    </select> <br>
    <!--<input name="year" type="date" /> <br>-->
    <label> Ваш пол </label> <br>
    <div <?php if ($errors_s['gr-1']) {print 'class="error"';} ?>>
      <input name="gr-1" type="radio" value="M" <?php if($values['gr-1']=="M") {print 'checked';} ?>/> Мужчина
      <input name="gr-1" type="radio" value="W" <?php if($values['gr-1']=="W") {print 'checked';} ?>/> Женщина
    </div>
    <label> Сколько у вас конечностей </label> <br>
    <div <?php if ($errors_s['gr-2']) {print 'class="error"';} ?>>
      <input name="gr-2" type="radio" value="1" <?php if($values['gr-2']=="1") {print 'checked';} ?>/> 1 
      <input name="gr-2" type="radio" value="2" <?php if($values['gr-2']=="2") {print 'checked';} ?>/> 2 
      <input name="gr-2" type="radio" value="3" <?php if($values['gr-2']=="3") {print 'checked';} ?>/> 3 
      <input name="gr-2" type="radio" value="4" <?php if($values['gr-2']=="4") {print 'checked';} ?>/> 4 
    </div>
    <label> Выберите суперспособности </label> <br>
    <select name="field-lisbox[]" size="3" multiple <?php if ($errors_s['field-listbox']) {print 'class="error"';} ?>>
      <option value="телепорт" <?php if($values['teleport']==1){print 'selected';} ?>>Телепорт</option>
      <option value="полёт" <?php if($values['fly']==1){print 'selected';} ?>>Полёт</option>
      <option value="суперскорость" <?php if($values['superspeed']==1){print 'selected';} ?>>Суперскорость</option>
      <option value="тайм-лайн" <?php if($values['time-line']==1){print 'selected';} ?>>Тайм-лайня</option>
    </select> <br>
    <label> Биография </label> <br>
    <textarea name="field-me" rows="10" cols="15"><?php print $values['field-me']; ?></textarea> <br>
    <?php 
    $cl_e='';
    $ch='';
    if($values['privacy'] or !empty($_SESSION['login'])){
      $ch='checked';
    }
    if ($errors_ar['privacy']) {
      $cl_e='class="error"';
    }
    if(empty($_SESSION['login'])){
    print('
    <div  '.$cl_e.' >
    <input name="priv" type="checkbox" '.$ch.'> Вы согласны с пользовательским соглашением <br>
    </div>');}
    ?>
    <input type="submit" value="Отправить"/>
  </form>
  <?php
  if(empty($_SESSION['login'])){
   echo'
   <div class="login">
    <p>Если у вас есть аккаунт, вы можете <a href="login.php">войти</a></p>
   </div>';
  }
  else{
    echo '
    <div class="logout">
      <a href="logout.php" name="logout">Выйти</a>
    </div>';
  } ?>
  </div>
</body>
