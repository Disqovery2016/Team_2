<?php
 require 'logininfo.php';
  if(loggedin()===false):
 {die(header('Location:scholarshield.php'));}
  endif;

  function test_input($data)
  {
   $data = stripslashes($data);
   $data = htmlentities($data);
   $data = htmlspecialchars($data);
   $data = ucwords(strtolower($data));
   return $data;
  };
function curstud($sid)
 {
   try
     {
    require 'connect.php';
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $curcnt = $conn->prepare("SELECT COUNT(*) FROM schools JOIN students ON schools.sid = students.schl_id JOIN rfid ON students.stid = rfid.imei AND schools.sid = :schoolid WHERE schools.sid = :schoolid AND rfid.date = DATE_FORMAT(NOW(),'%Y-%m-%d')");
    $curcnt->bindParam(':schoolid', $sid, PDO::PARAM_STR);
    $curcnt->execute();
    $curcntres=$curcnt->fetchColumn();
    }
    catch(PDOException $n)
     {
    echo "Error:" . $n->getMessage();
     }
   return $curcntres;
 };
 
 function curtech($sid)
 {
   try
     {
    require 'connect.php';
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $curcnt = $conn->prepare("SELECT COUNT(*) FROM schools JOIN workers ON schools.sid = workers.wkschl_id JOIN rfid ON workers.wkid = rfid.imei WHERE schools.sid = :schoolid AND rfid.date = DATE_FORMAT(NOW(),'%Y-%m-%d')");
    $curcnt->bindParam(':schoolid', $sid, PDO::PARAM_STR);
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
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Scholar Shield</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Scholarshield">
        <meta name="author" content="HM TECH">

        <meta http-equiv="x-pjax-version" content="v173">



        <!-- build:css styles/vendor.css -->
        <!-- bower:css -->
        <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.css">
        <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.css">
        <link rel="stylesheet" href="bower_components/animate.css/animate.css">
        <link rel="stylesheet" href="bower_components/hover/css/hover.css">
        <!-- endbower -->
        <!-- endbuild -->

        <!-- build:css(.tmp) styles/main.css -->
        <link id="style-components" href="styles/loaders.css" rel="stylesheet">
        <link id="style-components" href="styles/bootstrap-theme.css" rel="stylesheet">
        <link id="style-components" href="styles/dependencies.css" rel="stylesheet">
        <link id="style-base" href="styles/stilearn.css" rel="stylesheet">
        <link id="style-responsive" href="styles/stilearn-responsive.css" rel="stylesheet">
        <link id="style-helper" href="styles/helper.css" rel="stylesheet">
        <link id="style-sample" href="styles/pages-style.css" rel="stylesheet">
        <!-- endbuild -->

        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7/html5shiv.min.js"></script>
        <![endif]-->
        <style>
        @media screen and (min-width: 0px) and (max-width: 767px)
        {
          .scholarlogo{
            font:bold 20px georgia;
          }
        }
        @media screen and (min-width: 768px)
        {
          .scholarlogo{
            font:bold 30px georgia;
          }
        }

          .routetable tr td,.routetable tr th,.studenttable tr td,.studenttable tr th,.bustable tr td,.bustable tr th{
             text-align:center;
             width:150px;
          }

          .bootstrap-timepicker-widget.dropdown-menu {
           z-index: 99999!important;
          }

          .table.stoppagetb tr td, .table.stoppagetb tr th {
           border-width: 0;
           }

            #owner{font-size:50px;font-family:georgia; animation-name: example; animation-duration:3s;
    animation-iteration-count: infinite;}
    @keyframes example {
    0%   {text-shadow:5px 4px 9px #00e673;color:#00e673;}
    50%  {text-shadow:2px 3px 5px #009999;color:#009999;}
    100% {text-shadow:5px 4px 9px #00e673;color:#00e673;}
}

   
   .notif-minimal::-webkit-scrollbar {
    width:.8em;
    }
    .notif-minimal::-webkit-scrollbar-track
    {
    -webkit-box-shadow: inset 0 0 3px rgb(19, 92, 85);
    }
   .notif-minimal::-webkit-scrollbar-thumb
    {
    background-color: #00acac;
    outline: 1px solid white;
    }

    .table-responsive::-webkit-scrollbar {
    width:.8em;
    }
    .table-responsive::-webkit-scrollbar-track
    {
    -webkit-box-shadow: inset 0 0 3px rgb(19, 92, 85);
    }
   .table-responsive::-webkit-scrollbar-thumb
    {
    background-color: #00acac;
    outline: 1px solid white;
    }

        </style>

        <script type="text/javascript" src="scripts/notifIt.js"></script>
        <link rel="stylesheet" type="text/css" href="styles/notifIt.css">

<script>
function not3(){notif({type:"info",msg:"<b>Click Or Drag Marker</b> Anywhere in the Map to Add new Stop.",position:"left",timeout:1e4})}function not4(){notif({type:"info",msg:"Select in the list where you want to <stong>Add</strong>!!!.",position:"right",timeout:1e4})}function not5(){notif({type:"error",msg:"<b>Error: </b>Field Can't be Empty And Only Characters and Spaces are allowed!!",position:"center",width:500,timeout:4e3})}function not6(){notif({type:"success",msg:"<b>Great: </b>Stoppage Has Been Updated!!",position:"center",timeout:3e3})}function not7(){notif({type:"error",msg:"<b>Error: </b>Please Save All Changes!!",position:"center",timeout:3e3})}function not8(){notif({type:"success",msg:"<b>Great: </b>Stoppage Has Been Added!!",position:"center",timeout:3e3})}function not9(){notif({type:"info",msg:"<b>Great: </b>Drag the Marker on Map to Change Stop Location!!",position:"left",timeout:4e3})}
</script>

    </head>

    <body class="animated fadeIn">
        <!-- section header -->
        <header class="header">
         <a href="dashboard.php" class="scholarlogo"><img class="brand-logo" src="images/logo.png" alt="Scholarshield Logo" ><span class="text-primary">Panch</span>Tattva</a>
            <!-- header-profile -->
            <div class="header-profile">
                <div class="profile-nav">
                    <span class="profile-username">Option</span>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu animated flipInX pull-right" role="menu">
                        <li><a href="#" data-toggle="modal" data-target="#schlprof"><i class="fa fa-user"></i> Edit Profile</a></li>
                        <li><a href="#"><i class="fa fa-envelope"></i> Inbox</a></li>
                        <li><a href="#"><i class="fa fa-tasks"></i> Tasks</a></li>
                        <li class="divider"></li>
                        <li><a href="logout.php"><i class="fa fa-sign-out"></i> Log Out</a></li>
                    </ul>
                </div>

            </div><!-- header-profile -->

            <!-- header menu -->
            <ul class="hidden-xs header-menu pull-right">

                <li>
                    <a href="#" title="Notifications" class="dropdown-toggle" data-toggle="dropdown" role="button">
                        <span class="badge badge-success animated animated-repeat flash">+</span>
                        <i class="header-menu-icon icon-only fa fa-warning"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-extend animated fadeInDown pull-right" role="menu">
                        <li class="dropdown-header">Notofications</li><!-- /dropdown-header -->
                        <li class="notif-minimal">

                   <?php
                      try
 {
    require 'connect.php';
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $albus = $conn->prepare("SELECT schools.sid,DATE_FORMAT(NOW(),'%m-%d-%Y') as date,schools.name,schools.prname,schools.no_of_std,schools.no_of_tech FROM schools JOIN login ON schools.gid = login.id WHERE login.id = :schoolid");
    $albus->bindParam(':schoolid', $schoolid, PDO::PARAM_STR);
    $albus->execute();
    $albusrslt=$albus->fetchAll();
 }
 catch(PDOException $n)
  {
    echo "Error:" . $n->getMessage();
  }
  $conn = null;
    $ct = 1;
    $count = 0;
    foreach ($albusrslt as $stud)
    {
      $count = $count + ($stud['no_of_std'] / curstud($stud['sid'])).'<br>';
    }
   $count = $count / count($albusrslt);

    $schoolcnt = 0;
   foreach ($albusrslt as $stud)
    {
      if(($stud['no_of_std'] / curstud($stud['sid'])) > $count)
      {
        echo '<a class="notif-item" href="table-basic.php" data-toggle="tooltip" data-placement="bottom" title="'.$stud['name'].' has low attendance rates">
                                <div class="notif-ico bg-warning">
                                    <i class="fa fa-user"></i>
                                </div>
                                <p class="notif-text"><span class="text-bold">'.$stud['name'].'</span> has low attendance rates</p>
                            </a>';
                            $schoolcnt++;
      }
   }
   echo '<br><br>';
?>
                        </li><!-- /dropdown-alert -->
                    </ul><!-- /dropdown-extend -->
                </li><!-- /header-menu-item -->

            </ul><!--/header-menu pull-right-->
        </header><!--/header-->


        <!-- content section -->
        <section class="section">
            <aside class="side-left">
                <ul class="sidebar">
                    <li>
                        <a href="dashboard.php">
                            <i class="sidebar-icon fa fa-home"></i>
                            <span class="sidebar-text">Dashboard</span>
                        </a>
                    </li><!--/sidebar-item-->
                    <li>
                        <a href="table-basic.php">
                            <i class="sidebar-icon fa fa-table"></i>
                            <span class="sidebar-text">Add Data</span>
                        </a>
                    </li><!--/sidebar-item-->
                    <li>
                        <a href="#">
                            <i class="sidebar-icon fa fa-table"></i>
                            <span class="sidebar-text">Device Status</span>
                        </a>
                    </li><!--/sidebar-item-->

                        </ul><!--/sidebar-child-->
                    </li><!--/sidebar-item-->
                </ul><!--/sidebar-->
            </aside><!--/side-left-->

            <div class="content">
                <div class="content-body">
                    <!-- APP CONTENT
                    ================================================== -->
                    <?php
                        if(isset($_SERVER['HTTP_X_PJAX']) && $_SERVER['HTTP_X_PJAX'] == 'true'){
                            include($content);
                        }
                        else{
                            include('index.php');
                        }
                    ?>
                </div><!--/content-body -->
            </div><!--/content -->

        </section><!--/content section -->
        <!-- section footer -->
        <a rel="to-top" href="#top"><i class="fa fa-arrow-up"></i></a>
        <footer>
            <p>&copy; 2016 PanchTattva</p>
        </footer>

        <!-- javascript
        ================================================== -->
        <!-- List of dependencies file, please check on readme.txt! (Purchase only) -->

        <!-- build:js scripts/vendor-main.js -->
        <!-- bower:js -->
        <script src="bower_components/jquery/jquery.js"></script>
        <script src="bower_components/jqueryui/ui/jquery-ui.js"></script>
        <script src="bower_components/jqueryui-touch-punch/jquery.ui.touch-punch.min.js"></script>
        <script src="bower_components/bootstrap/dist/js/bootstrap.js"></script>
        <!-- endbuild -->

        <!-- build:js scripts/vendor-usefull.js -->
        <script src="bower_components/pace/pace.min.js"></script>
        <script src="bower_components/jquery-pjax/jquery.pjax.js"></script>
        <script src="bower_components/masonry/masonry.pkgd.min.js"></script>
        <script src="bower_components/screenfull/dist/screenfull.min.js"></script>
        <script src="bower_components/countUp.js/countUp.min.js"></script>
        <script src="bower_components/skycons/skycons.js"></script>
        <script src="bower_components/jquery.lazyload/jquery.lazyload.min.js"></script>
        <script src="bower_components/wow/dist/wow.min.js"></script>
        <!-- endbuild -->

        <!-- build:js scripts/vendor-form.js -->
        <script src="bower_components/jquery.validation/jquery.validate.js"></script>
        <script src="bower_components/jquery.validation/additional-methods.js"></script>
        <script src="bower_components/autogrow-textarea/jquery.autogrowtextarea.min.js"></script>
        <script src="bower_components/typeahead.js/dist/typeahead.min.js"></script>
        <script src="bower_components/jQuery-Mask-Plugin/jquery.mask.min.js"></script>
        <script src="bower_components/jquery.tagsinput/jquery.tagsinput.min.js"></script>
        <script src="bower_components/multiselect/js/jquery.multi-select.js"></script>
        <script src="bower_components/select2/select2.js"></script>
        <script src="bower_components/jquery-selectboxit/src/javascripts/jquery.selectBoxIt.js"></script>
        <script src="bower_components/momentjs/moment.js"></script>
        <script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
        <script src="bower_components/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
        <script src="bower_components/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
        <script src="bower_components/jquery-minicolors/jquery.minicolors.min.js"></script>
        <script src="bower_components/dropzone/downloads/dropzone.min.js"></script>
        <script src="bower_components/jquery-steps/build/jquery.steps.min.js"></script>
        <!-- endbuild -->

        <!-- build:js scripts/vendor-editor.js -->
        <script src="bower_components/wysihtml5/dist/wysihtml5-0.3.0.js"></script>
        <script src="bower_components/bootstrap-wysihtml5/dist/bootstrap-wysihtml5-0.0.2.js"></script>
        <script src="bower_components/bootstrap-markdown/js/markdown.js"></script>
        <script src="bower_components/bootstrap-markdown/js/to-markdown.js"></script>
        <script src="bower_components/bootstrap-markdown/js/bootstrap-markdown.js"></script>
        <!-- endbuild -->


        <!-- build:js scripts/excanvas.js -->
        <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="bower_components/flot/excanvas.min.js"></script><![endif]-->
        <!-- endbuild -->

        <!-- build:js scripts/vendor-graph.js -->
        <script src="bower_components/raphael/raphael-min.js"></script>
        <script src="bower_components/morris.js/morris.min.js"></script>
        <script src="bower_components/flot/jquery.flot.js"></script>
        <script src="bower_components/flot/jquery.flot.resize.js"></script>
        <script src="bower_components/flot/jquery.flot.categories.js"></script>
        <script src="bower_components/flot/jquery.flot.time.js"></script>
        <script src="bower_components/flot-axislabels/jquery.flot.axislabels.js"></script>
        <script src="bower_components/sparkline/dist/jquery.sparkline.min.js"></script>
        <!-- endbuild -->

        <!-- build:js scripts/vendor-table.js -->
        <script src="bower_components/datatables/media/js/jquery.dataTables.js"></script>
        <script src="bower_components/datatables-tools/js/dataTables.tableTools.js"></script>
        <script src="bower_components/datatables-bootstrap3/bs3/assets/js/datatables.js"></script>
        <script src="bower_components/jquery.tablesorter/js/jquery.tablesorter.js"></script>
        <script src="bower_components/jquery.tablesorter/js/jquery.tablesorter.widgets.js"></script>
        <script src="bower_components/jquery.tablesorter/addons/pager/jquery.tablesorter.pager.js"></script>
        <!-- endbuild -->

        <!-- build:js scripts/vendor-util.js -->
        <script src="bower_components/holderjs/holder.js"></script>
        <!-- endbower -->
        <!-- endbuild -->


        <!-- required stilearn template js -->
        <!-- build:js scripts/main.js -->
        <script src="scripts/bootstrap-jasny/js/fileinput.js"></script>
        <script src="scripts/js-prototype.js"></script>
        <script src="scripts/slip.js"></script>
        <script src="scripts/hogan-2.0.0.js"></script>
        <script src="scripts/theme-setup.js"></script>
        <script src="scripts/chat-setup.js"></script>
        <script src="scripts/panel-setup.js"></script>
        <!-- endbuild -->

        <!-- This scripts will be reload after pjax or if popstate event is active (use with class .re-execute) -->
        <!-- build:js scripts/initializer.js -->
        <script class="re-execute" src="scripts/bootstrap-setup.js"></script>
        <script class="re-execute" src="scripts/jqueryui-setup.js"></script>
        <script class="re-execute" src="scripts/dependencies-setup.js"></script>
        <script class="re-execute" src="scripts/demo-setup.js"></script>
        <!-- endbuild -->

<script type="text/javascript">

  $(document).ready(function()
  {
    $('[data-toggle="tooltip"]').tooltip();
    $(document).on('click', '.showdrpdwn.dropdown-menu', function (e) {
        e.stopPropagation();
    });
    $("#datadt").change(function(event)
    {
      event.preventDefault();
      $('table.bustable tbody tr').hide();
      var chkdat = $("#datadt").val();
      var xmlhttp;
     if(window.XMLHttpRequest)
     {
       xmlhttp=new XMLHttpRequest();//for mordern browsers
     }
    else
     {
       xmlhttp =new ActiveXObject ('Microsoft.XMLHTTP');//for old browsers
     }
     xmlhttp.onreadystatechange = function()//checking for a state change
     {
       if(xmlhttp.readyState==4 && xmlhttp.status == 200)//weather file is empty or not
        {
          $('table.bustable tbody').html(xmlhttp.responseText);
        }
     };
     xmlhttp.open('POST','panchdata.php',true);
     xmlhttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
     xmlhttp.send('date='+chkdat);


    });
  });
</script>
</body>
</html>