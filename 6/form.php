<style>
* {
   box-sizing: border-box;
}
body {
   background: #e6f4fd;
   font-family: 'Roboto', sans-serif;
}
.form {
   max-width: 350px;
   padding: 80px 30px 30px;
   margin: 50px auto 30px;
   background: white;
}
.form h1 {
   position: relative;
   z-index: 5;
   margin: 0 0 60px;
   text-align: center;
   color: #4a90e2;
   font-size: 30px;
   font-weight: normal;
}
.form h1:before {
   content: "";
   position: absolute;
   z-index: -1;
   left: 60px;
   top: -30px;
   width: 100px;
   height: 100px;
   border-radius: 50%;
   background: #fee8e4;
}
.form h1:after {
   content: "";
   position: absolute;
   z-index: -1;
   right: 50px;
   top: -40px;
   width: 0;
   height: 0;
   border-left: 55px solid transparent;
   border-right: 55px solid transparent;
   border-bottom: 90px solid #ffe3b5;
}

.form1 input[type="submit"] {
   width: 100%;
   padding: 0;
   line-height: 42px;
   background: #4a90e2;
   border-width: 0;
   color: white;
   font-size: 20px;
}
.form1 p {
   margin: 0;
   padding-top: 10px;
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
	<div class="form">
  <form class="form1" action="edit.php" method="POST">
	
    <label> ФИО </label> <br>
    <input name="field-name" <?php  ?> value="<?php print $values['field-name']; ?>" /> <br>
    <label> Почта </label> <br>
    <input name="email" type="email" <?php  ?> value="<?php print $values['email']; ?>"/> <br>
    <label> Год рождения </label> <br>
    <select name="year" <?php  ?>>
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
    <div <?php  ?>>
      <input name="gr-1" type="radio" value="M" <?php if($values['gr-1']=="M") {print 'checked';} ?>/> Мужчина
      <input name="gr-1" type="radio" value="W" <?php if($values['gr-1']=="W") {print 'checked';} ?>/> Женщина
    </div>
    <label> Сколько у вас конечностей </label> <br>
    <div <?php  ?>>
      <input name="gr-2" type="radio" value="1" <?php if($values['gr-2']=="1") {print 'checked';} ?>/> 1 
      <input name="gr-2" type="radio" value="2" <?php if($values['gr-2']=="2") {print 'checked';} ?>/> 2 
      <input name="gr-2" type="radio" value="3" <?php if($values['gr-2']=="3") {print 'checked';} ?>/> 3 
      <input name="gr-2" type="radio" value="4" <?php if($values['gr-2']=="4") {print 'checked';} ?>/> 4 
    </div>
    <label> Выберите суперспособности </label> <br>
    <select name="power[]" size="4" multiple <?php  ?>>
      <option value="телепорт" <?php if($values['teleport']==1){print 'selected';} ?>>Телепорт</option>
      <option value="полёт" <?php if($values['fly']==1){print 'selected';} ?>>Полёт</option>
      <option value="суперскорость" <?php if($values['superspeed']==1){print 'selected';} ?>>Суперскорость</option>
      <option value="тайм-лайн" <?php if($values['time-line']==1){print 'selected';} ?>>Тайм-лайня</option>
    </select> <br>
    <label> Биография </label> <br>
    <textarea name="field-me" rows="10" cols="15"><?php print $values['field-me']; ?></textarea> <br>

    <input name='dd' hidden value=<?php print($_GET['edit_id']);?>>
    <input type="submit" name='edit' value="Edit"/>
    <input type="submit" name='del' value="Delete"/>
  </form>
    <p><a href='admin.php' class="button">Назад</a></p>
  </div>
</body>
