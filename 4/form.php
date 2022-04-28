<style>
* {
   box-sizing: border-box;
}
.form1 {
   position: relative;
   max-width: 400px;
   padding: 60px 50px;
   margin: 50px auto 0;
   background-image: url(https://html5book.ru/wp-content/uploads/2017/01/photo-roses.jpg);
   background-size: cover;
}
.form1:before {
   content: "";
   position: absolute;
   top: 0;
   left: 0;
   right: 0;
   bottom: 0;
   background: linear-gradient(to right bottom, rgba(43, 44, 78, .5), rgba(104, 22, 96, .5));
}
.form {
   position: relative;
}
.form h1 {
   position: relative;
   margin-top: 0;
   color: white;
   font-family: 'Roboto', sans-serif;
   font-weight: 300;
   font-size: 26px;
   text-transform: uppercase;
}
.form h1:after {
   content: "";
   position: absolute;
   left: 0;
   bottom: -6px;
   height: 2px;
   width: 60px;
   background: #1762EE;
}
.form label {
   display: block;
   padding-left: 15px;
   font-family: 'Roboto', sans-serif;
   color: rgba(255, 255, 255, .6);
   text-transform: uppercase;
   font-size: 14px;
}
.form input {
   display: block;
   width: 100%;
   padding: 0 15px;
   margin: 10px 0 15px;
   border-width: 0;
   line-height: 40px;
   border-radius: 20px;
   color: white;
   background: rgba(255, 255, 255, .2);
   font-family: 'Roboto', sans-serif;
}
.form input[type="checkbox"] {
   position: absolute;
   opacity: 0;
}
#custom-checkbox+label {
   position: relative;
   margin: 20px 0;
   text-transform: none;
   cursor: pointer;
}
#custom-checkbox+label:before {
   content: "";
   display: inline-block;
   width: 20px;
   height: 20px;
   margin-right: 10px;
   vertical-align: text-top;
   background: white;
}
#custom-checkbox:checked+label:before {
   background: #1762EE;
}
#custom-checkbox:checked+label:after {
   content: "";
   position: absolute;
   width: 2px;
   height: 2px;
   left: 20px;
   top: 9px;
   background: white;
   box-shadow: 2px 0 0 white, 4px 0 0 white, 4px -2px 0 white, 4px -4px 0 white, 4px -6px 0 white, 4px -8px 0 white;
   transform: rotate(45deg);
}
.form input[type="submit"] {
   background: #1762EE;
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
