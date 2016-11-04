<?php
require 'logininfo.php';
if(loggedin()):
{
  die(header("Location:dashboard.php"));
}
else:
{
  if($_SERVER["REQUEST_METHOD"] == "POST"):
  {
    function test_input($data)
    {
     $data = trim($data);
     $data = stripslashes($data);
     $data = htmlentities($data);
     $data = htmlspecialchars($data);
     return $data;
    }
    if(!empty($_POST["submit"])&&isset($_POST["submit"])&&!empty($_POST["email"])&&isset($_POST["email"])&&!empty($_POST['pwd'])&&isset($_POST['pwd'])):
    {
      $password=htmlentities(htmlspecialchars($_POST['pwd']));
      $id = test_input($_POST["email"]);
      if (!filter_var($id, FILTER_VALIDATE_EMAIL))
       {die("Invalid Email");}
      else
       {
         $password_new=sha1($password);
         try
          {
            require 'connect.php';
            $query = $conn->prepare("SELECT COUNT(*) FROM `login` WHERE username = :username AND password = :password");
            $query->bindParam(':username', $id, PDO::PARAM_STR);
            $query->bindParam(':password', $password_new, PDO::PARAM_STR);
            $query->execute();
            $rows = $query->fetchColumn();
          }
          catch(PDOException $g)
          {
            echo "Error: in login user" . $g->getMessage();
          }
          $conn = null;

           if($rows==1)
            {
              $_SESSION['username']=$id;
              die("l321@");
            }
           else
            {
              die('No user found!!');
            }
        }
    }
    else:
    {
      die("All feilds are required");
    }
    endif;
  }
   else:
  {
   die(header("Location:panchtattva.php"));
  }
  endif;
}
endif;
?>

