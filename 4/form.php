<style>
* {
   box-sizing: border-box;
}
body {
   background: #e6f4fd;
   font-family: 'Roboto', sans-serif;
}
.form1 {
   max-width: 350px;
   padding: 80px 30px 30px;
   margin: 50px auto 30px;
   background: white;
}
.form1 h1 {
   position: relative;
   z-index: 5;
   margin: 0 0 60px;
   text-align: center;
   color: #4a90e2;
   font-size: 30px;
   font-weight: normal;
}
.form1 h1:before {
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
.form1 h1:after {
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
.form {
   position: relative;
   margin-bottom: 40px;
}
.form input {
   display: block;
   width: 100%;
   padding: 0 10px;
   line-height: 40px;
   font-family: 'Roboto', sans-serif;
   background: none;
   border-width: 0;
   border-bottom: 2px solid #4a90e2;
   transition: all 0.2s ease;
}
.form label {
   position: absolute;
   left: 13px;
   color: #9d959d;
   font-size: 20px;
   font-weight: 300;
   transform: translateY(-35px);
   transition: all 0.2s ease;
}
.form input:focus {
   outline: 0;
   border-color: #F77A52;
}
.form input:focus+label, .form-row input:valid+label {
   transform: translateY(-60px);
   margin-left: -14px;
   font-size: 14px;
   font-weight: 400;
   outline: 0;
   border-color: #F77A52;
   color: #F77A52;
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

   
	   
    <h1>Форма контракта</h1>
	<form class="form1" action="index.php" method="POST">
	<div class="form">
    
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
   
   </div>
 </form>
</body>
