<style>
  @font-face {
    font-family: 'handwriting';
    src: url('fonts/journal-webfont.woff2') format('woff2'),
         url('fonts/journal-webfont.woff') format('woff');
    font-weight: normal;
    font-style: normal;
}

@font-face {
    font-family: 'typewriter';
    src: url('fonts/veteran_typewriter-webfont.woff2') format('woff2'),
         url('fonts/veteran_typewriter-webfont.woff') format('woff');
    font-weight: normal;
    font-style: normal;
}
* {box-sizing: border-box;}
.form1 {
  max-width: 350px;
  margin: 50px auto 0;
  padding: 20px;
  background: #E4E3DF;
  font-family: 'Oswald', sans-serif;
}
.stripes-block {
  position: relative;
  padding: 15px;
  margin-bottom: 20px;
  background: repeating-linear-gradient(-45deg, #E4E3DF, #E4E3DF 5px, #909090 6px, #909090 8px);
  border-bottom: 2px solid #909090;
}
.stripes-block:before {
  content: "";
  position: absolute;
  left: 50%;
  top: 8px;
  margin-left: -6px;
  width: 14px;
  height: 14px;
  border-radius: 50%;
  background: #fffffe;
  box-shadow: 0 0 0 1px #090606, 0 0 0 12px #9c8778;
}
.form {
  position: relative;
  padding: 10px;
  border-bottom: 2px solid #909090;
}
.form label {
  display: block;
}
.form input {
  display: block;
  width: 100%;
  padding: 0;
  line-height: 30px;
  border-width: 0;
  background: #E4E3DF;
}
.form textarea {
  width: 100%;
  margin-bottom:40px;
  padding: 0;
  outline: 0;
  line-height: 40px;
  background: transparent url(https://html5book.ru/wp-content/uploads/2016/12/bg-form.png) bottom left repeat-x;
  background-size: 8px 40px;
  letter-spacing: 0.2em;
  background-attachment: local;
  background-repeat: repeat;
  border-width: 0;
  resize: none;
}
.form-icon {
  position: relative;
  border-bottom: 2px solid #909090;
}
.form-icon .fa {
  position: absolute;
  left: 0;
  top: 0;
  width: 40px;
  height: 40px;
  line-height: 40px;
  text-align: center;
  background: #909090;
  color: #E4E3DF;
  border-bottom: 2px solid;
}
.form-icon input {
  display: block;
  width: 100%;
  padding: 0 10px 0 50px;
  line-height: 40px;
  box-sizing: border-box;
  border-width: 0;
  background: #E4E3DF;
}
.form-icon .fa-paper-plane-o {
  border-bottom-color: #909090;
  cursor: pointer;
}
.form-icon input[type="submit"] {
  cursor: pointer;
}
.error {
    border: 2px solid red;
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
	   
    <h1>Форма контракта</h1>

    <form class="form1" action="index.php" method="POST">
    <div class="stripes-block"></div>
      <label>Имя:</label><br />
      <input type="text" name="field-name" placeholder="Name" <?php if ($errors['field-name']) {print 'class="error"';} ?>
	     value="<?php print $values['field-name']; ?>" />
      <br />
      <label> Еmail:</label><br />
        <input name="field-email" type="email" <?php if ($errors['field-email']) {print 'class="error"';} ?> value="<?php print $values['field-email']; ?>"/><br />
      <label>
        Год рождения:</label><br />
        <select name="year" <?php if ($errors['year']) {print 'class="error"';} ?>> 
	  <option value="Год">Год рождения</option>
           <?php
             for($i=1890;$i<=2022;$i++){
             if($values['year']==$i){
             printf("<option value=%d selected>%d </option>",$i,$i);
              }
             else{
             printf("<option value=%d>%d </option>",$i,$i);
            }
          }
          ?>
         </select>
      <br />
      <label>  Пол: </label><br />
     <div <?php if ($errors['radio-group-1']) {print 'class="error"';} ?>>
       <input type="radio" name="radio-group-1" value="man" <?php if($values['radio-group-1']=="man") {print 'checked';} ?> />
        Мужской 
      <input type="radio" name="radio-group-1" value="woman" <?php if($values['radio-group-1']=="woman") {print 'checked';} ?> />
        Женский<br />
     </div>
		

	<label>  Количество конечностей:</label><br />
     <div <?php if ($errors['radio-group-2']) {print 'class="error"';} ?>>
      <input type="radio" name="radio-group-2" value="1" <?php if($values['radio-group-2']=="1") {print 'checked';} ?> />
        1
      <input type="radio"name="radio-group-2" value="2" <?php if($values['radio-group-2']=="2") {print 'checked';} ?> />
        2
      <input type="radio" name="radio-group-2" value="3" <?php if($values['radio-group-2']=="3") {print 'checked';} ?> />
        3
      <input type="radio" name="radio-group-2" value="4" <?php if($values['radio-group-2']=="4") {print 'checked';} ?> />
        4<br />
      </div>
		

	  <label> Сверхспособности:</label> <br />
        <select name="field-listbox[]" size="4" multiple="multiple"
	  <?php if ($errors['field-listbox']) {print 'class="error"';} ?> >
          <option value="teleport" <?php if($values['teleport']==1){print 'selected';} ?> > Телепорт</option>
          <option value="fly" <?php if ($values['fly']==1){print 'selected';} ?> > Полёт</option>
          <option value="Superspeed" <?php if ($values['Superspeed']==1){print 'selected';} ?> > Суперскорость</option>
	        <option value="Time-line" <?php if ($values['Time-line']==1){print 'selected';} ?> > Тайм-лайн</option>
        </select>
      <br />
          
      <label>
        Биография:</label><br />
        <textarea name="field-me"> <?php print $values['field-me']; ?> </textarea>
      <br />

      <div <?php if ($errors['check-1']) {print 'class="error"';} ?> >
      <input type="checkbox" name="check-1" <?php if($values['check-1']==TRUE){print 'checked';} ?> />
        **********<br />
      </div>
	    
      <input type="submit" value="Отправить" />
    </form>
   </div>
</body>
