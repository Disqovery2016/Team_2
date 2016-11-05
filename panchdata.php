<?php
require 'logininfo.php';
if(loggedin()===false):
 {die(header('Location:panchtattva.php'));}
  endif;
function test_input($data)
  {
   $data = stripslashes($data);
   $data = htmlentities($data);
   $data = htmlspecialchars($data);
   $data = ucwords(strtolower($data));
   return $data;
  };
  
function curstud($sid,$fnddt)
 {
   try
     {
    require 'connect.php';
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $curcnt = $conn->prepare("SELECT COUNT(*) FROM schools JOIN students ON schools.sid = students.schl_id JOIN rfid ON students.stid = rfid.imei WHERE schools.sid = :schoolid AND rfid.date = DATE_FORMAT(:date,'%Y-%m-%d')");
    $curcnt->bindParam(':schoolid', $sid, PDO::PARAM_STR);
    $curcnt->bindParam(':date', $fnddt, PDO::PARAM_STR);
    $curcnt->execute();
    $curcntres=$curcnt->fetchColumn();
    }
    catch(PDOException $n)
     {
    echo "Error:" . $n->getMessage();
     }
   return $curcntres;
 };
 
 function curtech($sid,$fnddt)
 {
   try
     {
    require 'connect.php';
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $curcnt = $conn->prepare("SELECT COUNT(*) FROM schools JOIN workers ON schools.sid = workers.wkschl_id JOIN rfid ON workers.wkid = rfid.imei WHERE schools.sid = :schoolid AND rfid.date = DATE_FORMAT(:date,'%Y-%m-%d')");
    $curcnt->bindParam(':schoolid', $sid, PDO::PARAM_STR);
    $curcnt->bindParam(':date', $fnddt, PDO::PARAM_STR);
    $curcnt->execute();
    $curcntres=$curcnt->fetchColumn();
    }
    catch(PDOException $n)
     {
    echo "Error:" . $n->getMessage();
     }
   return $curcntres;
 };

try
  {
    require 'connect.php';
    $user=$_SESSION['username'];
    $query = $conn->prepare("SELECT `id` from login where username = :username LIMIT 1");
    $query->bindParam(':username', $user, PDO::PARAM_STR);
    $query->execute();
    $schoolid=$query->fetchColumn();
  }
  catch(PDOException $q)
  {
    echo "Error:" . $q->getMessage();
  }
   $conn = null;
   
   if($_SERVER["REQUEST_METHOD"] == "POST"):
   {
     if(isset($_POST['date']) && !empty($_POST['date'])):
      {
        $newdat=test_input($_POST['date']);
try
 {
    require 'connect.php';
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $albus = $conn->prepare("SELECT schools.sid,schools.name,schools.prname,schools.no_of_std,schools.no_of_tech FROM schools JOIN login ON schools.gid = login.id WHERE login.id = :schoolid");
    $albus->bindParam(':schoolid', $schoolid, PDO::PARAM_STR);
    $albus->execute();
    $albusrslt=$albus->fetchAll();
 }
 catch(PDOException $n)
  {
    echo "Error:" . $n->getMessage();
  }
  $conn = null;
  $newDate = date("Y-d-m", strtotime($newdat));
    $ct = 1;
    $count = 0;
    foreach ($albusrslt as $stud)
    {
       if(curstud($stud['sid'],$newDate) > 0)
       {
         $count = $count + ( curstud($stud['sid'],$newDate) / $stud['no_of_std']);
       }
    }
     
     if(curstud($stud['sid'],$newDate) > 0)
       {
          $count = ($count / count($albusrslt))*100;
       }
    foreach ($albusrslt as $stud)
    {
                                    echo '<tr>
                                          <td>'.$ct.'</td>
                                          <td>'.$stud['name'].'</td>
                                          <td>'.$newdat.'</td>
                                          <td>'.$stud['no_of_std'].'</td>
                                          <td>'.curstud($stud['sid'],$newDate).'</td>
                                          <td>'.$stud['no_of_tech'].'</td>
                                          <td>'.curtech($stud['sid'],$newDate).'</td>';

                                         $percnt = (curstud($stud['sid'])*100) / $stud['no_of_std'];

                                          if($percnt <= 50)
                                          {
                                            echo '<td style="color:red;"><strong>Bad</strong></td>
                                               </tr>';
                                          }
                                          elseif($percnt > 50 && $percnt < 75)
                                          {
                                             echo '<td style="color:Yellow;"><strong>Good</strong></td>
                                               </tr>';
                                          }
                                          else
                                          {
                                            echo '<td style="color:green;"><strong>Excellent</strong></td>
                                               </tr>';
                                          }
                                         $ct++;
    
    }

      }
     else:
      {
      die();
      }
      endif;
   }
   else:
   {
     die();
   }
   endif;


?>