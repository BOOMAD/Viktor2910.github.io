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

body {
  font  : 21px sans-serif;

  padding : 2em;
  margin  : 0;

  background : #222;
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

    <form action="index.php" method="POST">
    
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
