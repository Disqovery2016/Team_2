<?php
require 'logininfo.php';
if(loggedin()):
   {die(header('Location:dashboard.php'));}
endif;
?>

<!DOCTYPE html>
<html >
  <head>
    <title>Scholar Shield</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<style>
* { -webkit-box-sizing:border-box; -moz-box-sizing:border-box; -ms-box-sizing:border-box; -o-box-sizing:border-box; box-sizing:border-box; }

html { width: 100%; height:100%; overflow:hidden; }

body {
       background: #248f8f;
    background: -webkit-linear-gradient(right top, #008080, #E0E0E0);
    background: -o-linear-gradient(bottom left, #008080, #E0E0E0);
    background: -moz-linear-gradient(bottom left, #008080, #E0E0E0);
    background: linear-gradient(to bottom left, #008080, #E0E0E0 );
	width: 100%;
	height:100%;
}
@media screen and (min-width: 0px) and (max-width: 299px)
{
.scholarlogotxt{font:bold 20px "Comic Sans MS", cursive, sans-serif;}
.scholarlogo {
	position: absolute;
	top: 30%;
	left: 50%;
	margin: -150px 0 0 -150px;
	width:200px;
	height:200px;
}
.login {
	position: absolute;
	top: 80%;
	left: 50%;
	margin: -150px 0 0 -150px;
	width:300px;
	height:300px;
}
}
@media screen and (min-width: 300px) and (max-width: 767px)
{
.scholarlogotxt{font:bold 30px georgia;position: absolute;top: 54%;left:24%;}
.scholarlogo {
	position: absolute;
	top: 27.5%;
	left: 50%;
	margin: -150px 0 0 -150px;
	width:300px;
	height:300px;
}
.login {
	position: absolute;
	top: 92%;
	left: 50%;
	margin: -150px 0 0 -150px;
	width:300px;
	height:300px;
}
}
@media screen and (min-width: 768px)
{
.scholarlogotxt{font:bold 30px georgia;position: absolute;top: 55%;left:42%;}
.scholarlogo {
	position: absolute;
	top: 35%;
	left: 50%;
	margin: -150px 0 0 -150px;
	width:300px;
	height:300px;
}
.login {
	position: absolute;
	top: 62%;
	left: 39.2%;
	width:300px;
	height:300px;
}
}

input {
	width: 100%;
	margin-bottom: 10px;
	background: rgba(0,0,0,0.3);
	border: none;
	outline: none;
	padding: 10px;
	font-size: 13px;
	color: #fff;
	text-shadow: 1px 1px 1px rgba(0,0,0,0.3);
	border: 1px solid rgba(0,0,0,0.3);
	border-radius: 4px;
	box-shadow: inset 0 -5px 45px rgba(100,100,100,0.2), 0 1px 1px rgba(255,255,255,0.2);
	-webkit-transition: box-shadow .5s ease;
	-moz-transition: box-shadow .5s ease;
	-o-transition: box-shadow .5s ease;
	-ms-transition: box-shadow .5s ease;
	transition: box-shadow .5s ease;
}
input:focus { box-shadow: inset 0 -5px 45px rgba(100,100,100,0.4), 0 1px 1px rgba(255,255,255,0.2); }

    </style>

  </head>

  <body>

<a href="panchtattva.php"><img src="images/logobig.png" alt="Panchtattva Logo" class="scholarlogo"></a>
    <a href="panchtattva.php" class="scholarlogotxt" style="text-decoration:none;"><span style="color:#009999;">Panch</span><span style="color:#E0E0E0;margin-left:4px;">Tattva</span></a>
    <div class="login">
       <form method="post" class="form-horizontal" role="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
 	   <input type="email" name="email" class="form-control" maxlength="45" id="email1" placeholder="Enter email" required="required">
        <input type="password" name="pwd" maxlength="25" class="form-control" autocomplete="off" placeholder="Enter password" required="required">
        <button type="submit" name="submit" class="btn btn-block btn-large" style="padding:10px;box-shadow: 3px 3px 6px grey;background-color:#00acac;border-radius: 10px;"><span style="color:white">Let me in</span></button>
    </form>
   <div id="message" style="text-align:center;margin-top:3px;"></div>
</div>

  <script src="scholarshieldjs.js"></script>

  </body>
</html>