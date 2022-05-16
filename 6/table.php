<style>
  table {
font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
font-size: 14px;
border-collapse: collapse;
text-align: center;
}
th, td:first-child {
  background-color: #93291b; border: 1px solid #333333; border-radius: 3px 3px 3px 3px; box-shadow: 0 0 1px #93291b inset; color: #f5f5f5; padding: 5px;
/*background: #AFCDE7;*/
color: white;
padding: 10px 20px;
}
th, td {
border-style: solid;
border-width: 0 1px 1px 0;
border-color: white;
}
td {
background: #f5f5f5;
}
th:first-child, td:first-child {
text-align: left;
}
  .messega{
    color: #ff4411; font-family: ‘Lucida Sans’, Arial, sans-serif; font-size: 16px; line-height: 26px; text-indent: 30px; margin: 0;
  }
  .error {
    border: 2px solid red;
  }
  .hidden{
    display: none;
  }
</style>
<body>
  <div class="table1">
    <table>
      <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Year</th>
        <th>Pol</th>
        <th>Limb</th>
        <th>Superpowers</th>
        <th>Bio</th>
      </tr>
      <?php
      foreach($users as $user){
          echo '
            <tr>
              <td>'.$user['name'].'</td>
              <td>'.$user['email'].'</td>
              <td>'.$user['year'].'</td>
              <td>'.$user['pol'].'</td>
              <td>'.$user['limbs'].'</td>
              <td>';
                $user_pwrs=array(
                    "teleport"=>FALSE,
                    "fly"=>FALSE,
                    "superspeed"=>FALSE,
                    "time-line"=>FALSE
                );
                foreach($pwrs as $pwr){
                    if($pwr['contact_id']==$user['contact_id']){
                        if(($pwr['superpowers']=='телепорт')||($pwr['superpowers']=='Телепорт')||($pwr['superpowers']=='teleport')||($pwr['superpowers']=='Teleport')){
                            $user_pwrs['teleport']=TRUE;
                        }
                        if(($pwr['superpowers']=='полёт')||($pwr['superpowers']=='Полёт')||($pwr['superpowers']=='fly')||($pwr['superpowers']=='Fly')){
                            $user_pwrs['fly']=TRUE;
                        }
                        if(($pwr['superpowers']=='суперскорость')||($pwr['superpowers']=='Суперскорость')||($pwr['superpowers']=='superspeed')||($pwr['superpowers']=='Superspeed')){
                            $user_pwrs['superspeed']=TRUE;
                        }
                        if(($pwr['superpowers']=='тайм-лайн')||($pwr['superpowers']=='Тайм-лайн')||($pwr['superpowers']=='time-line')||($pwr['superpowers']=='Time-line')){
                            $user_pwrs['time-line']=TRUE;
                        }
                    }
                }
                if($user_pwrs['teleport']){echo 'телепорт<br>';}
                if($user_pwrs['fly']){echo 'полёт<br>';}
                if($user_pwrs['superspeed']){echo 'суперскорость<br>';}
                if($user_pwrs['time-line']){echo 'тайм-лайн<br>';}
              echo '</td>
              <td>'.$user['bio'].'</td>
              <td>
                <form method="get" action="edit.php">
                  <input name=edit_id value='.$user['contact_id'].' hidden>
                  <input type="submit" value=Edit>
                </form>
              </td>
            </tr>';
       }
      ?>
    </table>
    <div class="messega">
    <?php
    printf('Кол-во пользователей с сверхспособностью "телепорт": %d <br>',$pwrs_count[0]);
    printf('Кол-во пользователей с сверхспособностью "полёт": %d <br>',$pwrs_count[1]);
    printf('Кол-во пользователей с сверхспособностью "суперскорость": %d <br>',$pwrs_count[2]);
    printf('Кол-во пользователей с сверхспособностью "тайм-лайн": %d <br>',$pwrs_count[3]);
    ?>
    </div>
  </div>
</body>
