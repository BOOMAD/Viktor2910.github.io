<style>
  .form1{
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
                    if($pwr['id']==$user['id']){
                        if($pwr['power']=='телепорт'){
                            $user_pwrs['teleport']=TRUE;
                        }
                        if($pwr['power']=='полёт'){
                            $user_pwrs['fly']=TRUE;
                        }
                        if($pwr['power']=='суперскорость'){
                            $user_pwrs['superspeed']=TRUE;
                        }
                        if($pwr['power']=='тайм-лайн'){
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
                  <input name=edit_id value='.$user['id'].' hidden>
                  <input type="submit" value=Edit>
                </form>
              </td>
            </tr>';
       }
      ?>
    </table>
    <?php
    printf('Кол-во пользователей с сверхспособностью "телепорт": %d <br>',$pwrs_count[0]);
    printf('Кол-во пользователей с сверхспособностью "полёт": %d <br>',$pwrs_count[1]);
    printf('Кол-во пользователей с сверхспособностью "суперскорость": %d <br>',$pwrs_count[2]);
    printf('Кол-во пользователей с сверхспособностью "тайм-лайн": %d <br>',$pwrs_count[3]);
    ?>
  </div>
</body>