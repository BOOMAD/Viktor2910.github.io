<style>
  .form{
    max-width: 960px;
    text-align: center;
    margin: 0 auto;
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

      <label>
        Имя:<br />
        <input type="text" name="field-name" <?php if ($errors['field-name']) {print 'class="error"';} ?>
          value="<?php print $values['field-name']; ?>" />
      </label><br />

      <label>
        Еmail:<br />
        <input name="field-email" type="email"
          value="<?php print $values['field-email']; ?>"
	<?php if ($errors['field-email']) {print 'class="error"';} ?>
	/>
      </label><br />

      <label>
        Год рождения:<br />
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
      </label><br />
	  
	  Пол:<br />
     <div <?php if ($errors['radio-group-1']) {print 'class="error"';} ?>>
      <label> <input type="radio" name="radio-group-1" value="man" 
	<?php if($values['radio-group-1']=="man") {print 'checked';} ?> />
        Мужской </label>
      <label><input type="radio" name="radio-group-1" value="woman" 
	<?php if($values['radio-group-1']=="woman") {print 'checked';} ?> />
        Женский</label><br />
     </div>
		
	  Количество конечностей:<br />
     <div <?php if ($errors['radio-group-2']) {print 'class="error"';} ?>>
      <label><input type="radio" name="radio-group-2" value="1" 
	<?php if($values['radio-group-2']=="1") {print 'checked';} ?> />
        1</label>
      <label><input type="radio"name="radio-group-2" value="2" 
	<?php if($values['radio-group-2']=="2") {print 'checked';} ?> />
        2</label>
      <label><input type="radio" name="radio-group-2" value="3" 
	<?php if($values['radio-group-2']=="3") {print 'checked';} ?> />
        3</label>
      <label><input type="radio" name="radio-group-2" value="4" 
	<?php if($values['radio-group-2']=="4") {print 'checked';} ?> />
        4</label><br />
      </div>
		
	  <label>
        Сверхспособности:
        <br />
        <select name="field-listbox[]" multiple="multiple"
	  <?php if ($errors['field-listbox']) {print 'class="error"';} ?> >
          <option value="teleport" <?php if($values['teleport']==1){print 'selected';} ?> > Телепорт</option>
          <option value="fly" <?php if ($values['fly']==1){print 'selected';} ?> > Полёт</option>
          <option value="Superspeed" <?php if ($values['Superspeed']==1){print 'selected';} ?> > Суперскорость</option>
	        <option value="Time-line" <?php if ($values['Time-line']==1){print 'selected';} ?> > Тайм-лайн</option>
        </select>
      </label><br />
	  
      <label>
        Биография:<br />
        <textarea name="field-me"> <?php print $values['field-me']; ?> </textarea>
      </label><br />

      Чекбокс:<br />
      <div <?php if ($errors['check-1']) {print 'class="error"';} ?> >
      <label><input type="check-1" name="check-1"
	<?php if($values['check-1']==TRUE){print 'checked';} ?> />
        **********</label><br />
      </div>
	    
      <input type="submit" value="Отправить" />
    </form>
   </div>
</body>
