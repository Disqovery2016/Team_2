<?php

if(!isset($_SERVER['HTTP_X_PJAX'])){

    $content = basename($_SERVER['SCRIPT_NAME']);

    $_SERVER['HTTP_X_PJAX'] = true;
    require 'stilearn.base.template.php';
    require 'uploadcore.php';
    require 'stoppagemap.php';
    require 'showpopover.php';
    die();
}
?>


                    <!-- STATIC TABLE
                    ================================================== -->
                    <!-- TABLE -->
                    <div class="page-header">
                    </div>

                    <div class="row">
                        <div class="col-sm-12">

                           <ul class="nav nav-tabs">
                             <li class="active"><a data-toggle="tab" href="#stud">Students Data</a></li>
                             <li><a data-toggle="tab" href="#vech">Teachers Data</a></li>
                             <li><a data-toggle="tab" href="#mang">Schools Extra Data Table</a></li>
                             <li><a data-toggle="tab" href="#regn">Device Details</a></li>
                           </ul>
                           <div class="tab-content">
                            <div id="stud" class="tab-pane fade in active">

                            <form role="form" style="width:150px;position:absolute;top:0%;right:1%;">
                                <div class="form-group">
                                   <span class="input-group input-group-in">
                                            <input type="text" class="form-control dropdown-toggle bussrch" data-toggle="dropdown" placeholder="Student">
                                            <span class="input-group-btn">
                                                <button class="btn btn-primary" type="button"><i class="fa fa-search"></i></button>
                                            </span>
                                            <ul class="showbusdrpdwn dropdown-menu">
                                             <li style="text-align:center;"><i class="loadbussrh"></i></li>
                                             <li class="srchbusrslts"></li>
                                            </ul>
                                        </span><!-- /input-group-in -->
                                </div><!-- /form-group -->
                              </form>

                        <button type="button" id="showalfltrbus" class="btn btn-sm btn-primary" style="margin-top:5px;display:none;"> <span class="glyphicon glyphicon-arrow-left"></span> Back</button>


                             <span style="float:right;margin-top:5px;">
                             <a href="downloadbustemplate.php" type="button" class="drbsdl btn btn-warning btn-md">
                               <span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span> Download Template</a>
                            <a href="downloadbussheet.php" type="button" class="drbsdl btn btn-inverse btn-md">
                               <span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span> Download Details</a>
                           </span>
                            <progress id="prog" max="100" value="0" style="display:none;margin-left:0%;margin-top:8px;"></progress>
                            <span id="percent"></span>
                            <span style="float:right;margin-top:5px;margin-right:3px;">
                            <form id="upload" action="<?php echo htmlspecialchars('bulkbusupload.php') ?>" method="post" enctype="multipart/form-data" role="form">
                            <span class="form-group">
                              <div class="fileinput fileinput-new" data-provides="fileinput">
                                <span class="btn btn-icon btn-icon-right btn-primary btn-file">
                                  <i class="fa fa-upload"></i>
                                    <span class="fileinput-new">Select Excel file</span>
                                     <span class="fileinput-exists">Change</span>
                                      <input type="file" name="fileToUpload" id="fileToUpload">
                                     </span>
                                  <span class="fileinput-filename"></span>
                                <button class="close fileinput-exists" data-dismiss="fileinput" style="float: none">&times;</button>
                             </div><!-- /fileinput -->
                            </span><!-- /form-group -->

                                <button type="submit" name="filesubmit" id="upldbtn" class="btn btn-info btn-md">
                                  <i id="loadfile"></i> <span class="glyphicon glyphicon-upload" aria-hidden="true"></span> Upload
                                </button>
                              </form>

                           </span>

                            <br><br>

                            <div class="alert alert-danger fade in emptywarn" style="margin-top:5px;display:none">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Oops!</strong><span id="shwoter">Are you missing any field.</span>
                           </div>

                           <div class="alert alert-success fade in scalrt" style="margin-top:5px;display:none">
                             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                              <strong>Great!</strong>All Changes Are Saved.
                            </div>
                            
                            <div class="alert alert-danger fade in upemptywarn" style="margin-top:5px;display:none">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Oops!</strong><span id="warntxt"></span>
                           </div>

                           <div class="alert alert-success fade in upscalrt" style="margin-top:5px;display:none">
                             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                              <strong>Great!</strong><span id="suctxt"></span>
                            </div>

                            <!-- Table-->
                           <div class="table-responsive">

                                <table class="table table-bordered bustable">
                                    <thead>
                                        <tr>
                                            <th>Id Number</th>
                                            <th>Name</th>
                                            <th>Class</th>
                                            <th>School Name</th>
                                            <th>Edit/Clear</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table><!-- /table -->
                         </div>
                        </div><!-- /end - Students tab-->

                        <div id="vech" class="tab-pane fade">

                             <form role="form" style="width:150px;position:absolute;top:0%;right:7.2%;">
                                <div class="form-group">
                                   <span class="input-group input-group-in">
                                           <input type="text" class="form-control dropdown-toggle routesrch" data-toggle="dropdown" placeholder="Search">
                                            <span class="input-group-btn">
                                                <button class="btn btn-primary" type="button"><i class="fa fa-search"></i></button>
                                            </span>
                                            <ul class="showrotdrpdwn dropdown-menu">
                                             <li style="text-align:center;"><i class="loadrotsrh"></i></li>
                                             <li class="srchrotrslts"></li>
                                            </ul>
                                        </span><!-- /input-group-in -->
                                </div><!-- /form-group -->
                              </form>
                              <div style="position:absolute;top:0%;right:1%;">
                               <button type="button" class="btn btn-md btn-success" data-toggle="modal" data-target="#adroute"> <span class="glyphicon glyphicon-plus"></span> Add</button>
                              </div>
                        <button type="button" id="showalfltrrot" class="btn btn-sm btn-primary" style="margin-top:5px;margin-bottom:5px;display:none;"> <span class="glyphicon glyphicon-arrow-left"></span> Back</button>

                        <br>
                        <div class="alert alert-danger fade in rtwarn" style="margin-top:5px;display:none">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Oops!</strong><span id="rtwarntxt"></span>
                           </div>

                           <div class="alert alert-success fade in rtscalrt" style="margin-top:5px;display:none">
                             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                              <strong>Great!</strong><span id="rtsuctxt"></span>
                            </div>

                        <div class="table-responsive">

                                <table class="table table-bordered routetable">
                                    <thead>
                                        <tr>
                                           <th>Id Number</th>
                                            <th>Teacher Name</th>
                                            <th>School Name</th>
                                            <th>Specialised Subject</th>
                                            <th>Edit/Clear</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                     </tbody>
                                    </table><!-- /table -->
                         </div>
                         <br>

<div class="modal fade" data-sound="off" id="myMapModal" tabindex="-1" role="dialog" aria-labelledby="modalLargeLabel" aria-hidden="true">
<div class="modal-dialog modal-lg" style="width:95%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="resetpath close" aria-hidden="true">&times;</button>
                <h1 class="modal-title" style="font:bold 18px serif"><span id="routename"></span><span style="float:right;margin-right:2%;">View/Edit Stoppage</span></h1>
            </div>
            <div class="modal-body">
                <div class="container-fluid">

                   <div class="row">
                    <div class="col-sm-3" style="margin-top:-15px;">
                      <div class="table-responsive" style="max-height:400px;overflow-y:auto;">
                                <form role="form">
                                <table class="table stoppagetb">
                                    <thead>
                                        <tr style="background-color:#00acac;color:black;font:bold 15px Georgia;">
                                            <th></th>
                                            <th><span style="margin-left:14%;">Stoppage</span></th>
                                        </tr>
                                    </thead>
                                     <tbody id="freqstop">
                                     </tbody>
                                    </table><!-- /table -->
                                    </form>
                         </div><br>
                        <button id="newstpbtn" type="button" class="btn btn-info btn-lg" style="margin-left:28%">Insert Stoppage</button>
                    </div>
                    <div class="col-sm-9">
                      <div style="margin-top:-15px;float:right;display:none" id="selrotesmap">
                        <form class="form-inline" role="form">
                          <div class="row">

                         <div class="col-sm-4">
                          <div class="form-group">
                            <span class="input-group input-group-in">
                               <input type="text" class="form-control dropdown-toggle" id="searchTextField" data-toggle="dropdown" placeholder="Search Stoppage On Map">
                                 <span class="input-group-btn">
                                   <button class="btn btn-primary" type="button"><i class="fa fa-search"></i></button>
                                 </span>
                            </span><!-- /input-group-in -->
                          </div><!-- /form-group -->
                          </div>

                          <div class="col-sm-8">
                          <div  style="float:right">
                          <div class="form-group">
                           <label for="selrt" style="color:green;font:bold 15px georgia;">Select From Routes </label>
                            <select class="form-control" id="selrt">
                            </select>
                            </div>
                            <div class="form-group">
                            <select class="form-control" id="selstop">
                            </select>
                           </div>
                           </div>
                          </div>

                          </div>
                          </form>
                       </div>
                      <div id="map-canvas" style="width:100%;height:425px;"></div>
                    </div>
                   </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="resetpath btn btn-default">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

                        <div class="modal fade" data-sound="off" id="adroute" tabindex="-1" role="dialog" aria-labelledby="modalLargeLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" style="width:40%;">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="modalLargeLabel">Add New route</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form role="form" class="form-horizontal form-bordered">

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="nwrotnm" style="color:black;font-weight: 600;">Route Name</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" id="nwrotnm" placeholder="Route Name" />
                                    </div>
                                </div><!-- /form-group -->

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="newselbus" style="color:black;font-weight: 600">Select Bus</label>
                                    <div class="col-sm-5">
                                         <select class="form-control" name="newselbus">

                                         </select>
                                    </div><!--/cols-->
                                </div><!--/form-group-->


                                <div class="form-group">
                                    <label class="col-sm-3 control-label" style="color:black;font-weight:600">Start Time</label>
                                    <div class="col-sm-5">
                                        <input type="text" id="nwsttim" data-input="timepicker" data-template="dropdown" class="form-control" placeholder="Start Time"/>
                                    </div><!--/cols-->
                                </div><!--/form-group-->

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" style="color:black;font-weight:600">Stop Time</label>
                                    <div class="col-sm-5">
                                        <input type="text" id="nwstptim" data-input="timepicker" data-template="dropdown" class="form-control" placeholder="Stop Time"/>
                                    </div><!--/cols-->
                                </div><!--/form-group-->
                            </form><!--/form-->
                                        </div>
                                        <div class="modal-footer">
                                            <span id="adrespn"></span>&nbsp&nbsp
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" id="savnewrt">Save changes</button>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->

                        </div><!-- /vechicles -->

                        <div id="mang" class="tab-pane fade">
                              <form role="form" style="width:150px;position:absolute;top:0%;right:7.2%;">
                                <div class="form-group">
                                   <span class="input-group input-group-in">
                                            <input type="text" class="form-control dropdown-toggle childsrch" data-toggle="dropdown"  placeholder="Students">
                                            <span class="input-group-btn">
                                                <button class="btn btn-primary" type="button"><i class="fa fa-search"></i></button>
                                            </span>
                                             <ul class="showdrpdwn dropdown-menu">
                                             <li style="text-align:center;"><i class="loadsrh"></i></li>
                                            <li class="srchrslts"></li>
                                              </ul>
                                        </span><!-- /input-group-in -->
                                </div><!-- /form-group -->
                              </form>
                              <div style="position:absolute;top:0%;right:1%;">
                               <button type="button" id="addnewstud" class="btn btn-md btn-success" data-toggle="modal" data-target="#addstudent"> <span class="glyphicon glyphicon-plus"></span> Add</button>
                              </div>

                              <button type="button" id="showalfltrstud" class="btn btn-sm btn-primary" style="margin-top:5px;display:none"> <span class="glyphicon glyphicon-arrow-left"></span> Back</button>


                             <span style="float:right;margin-top:5px;">
                             <a href="updatesheet.php" type="button" class="btn btn-warning btn-md">
                               <span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span> Download Template</a>
                            <a href="downloadstuddet.php" type="button" class="btn btn-inverse btn-md">
                               <span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span> Download Details</a>
                           </span>
                            <progress id="progstud" max="100" value="0" style="display:none;margin-left:0%;margin-top:8px;"></progress>
                            <span id="percentstud"></span>
                            <span style="float:right;margin-top:5px;margin-right:3px;">
                            <form id="uploadstud" action="<?php echo htmlspecialchars('bulkstudupload.php') ?>" method="post" enctype="multipart/form-data" role="form">
                            <span class="form-group">
                              <div class="fileinput fileinput-new" data-provides="fileinput">
                                <span class="btn btn-icon btn-icon-right btn-primary btn-file">
                                  <i class="fa fa-upload"></i>
                                    <span class="fileinput-new">Select Excel file</span>
                                     <span class="fileinput-exists">Change</span>
                                      <input type="file" name="studfileToUpload" id="fileToUpload">
                                     </span>
                                  <span class="fileinput-filename"></span>
                                <button class="close fileinput-exists" data-dismiss="fileinput" style="float: none">&times;</button>
                             </div><!-- /fileinput -->
                            </span><!-- /form-group -->

                                <button type="submit" name="studfilesubmit" id="studupldbtn" class="btn btn-info btn-md">
                                  <i id="studloadfile"></i> <span class="glyphicon glyphicon-upload" aria-hidden="true"></span> Upload
                                </button>
                              </form>

                           </span>

                            <br><br>

                            <div class="alert alert-danger fade in studemptywarn" style="margin-top:5px;display:none">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Oops!</strong><span id="studshwoter">Are you missing any field.</span>
                           </div>

                            <div class="alert alert-success fade in studscalrt" style="margin-top:5px;display:none">
                             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                              <strong>Great!</strong><span id="studsuctxt"></span>
                            </div>
                            <!-- Table-->
                           <div class="table-responsive">

                                <table class="table table-bordered studenttable">
                                    <thead>
                                        <tr>
                                            <th>School Name</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table><!-- /table -->
                                 <i id="loadnxtchild" style="margin-left:50%;"></i>
                         </div>
                         <div class="modal fade" id="addstudent" data-sound="off" tabindex="-1" role="dialog" aria-labelledby="modalLargeLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="modalLargeLabel">Add a new Student</h4>
                                        </div>
                                        <div class="modal-body">
                                         <form role="form" class="form-horizontal form-bordered">

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="nwrstudchnm" style="color:black;font-weight: 600;">Child Name</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" id="nwrstudchnm" placeholder="Child Name" />
                                    </div>
                                </div><!-- /form-group -->
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="nwstudclsnm" style="color:black;font-weight: 600;">Class</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" id="nwstudclsnm" placeholder="Class Name" />
                                    </div>
                                </div><!-- /form-group -->
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="nwstudsecnm" style="color:black;font-weight: 600;">Section</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" id="nwstudsecnm" placeholder="Section Name" />
                                    </div>
                                </div><!-- /form-group -->
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="nwstudprnm" style="color:black;font-weight: 600;">Parent Name</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" id="nwstudprnm" placeholder="Parent Name" />
                                    </div>
                                </div><!-- /form-group -->

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="nwstudprphn" style="color:black;font-weight: 600;">Parent Phone</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" id="nwstudprphn" placeholder="Parent Phone" />
                                    </div>
                                </div><!-- /form-group -->

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="newselpcrot" style="color:black;font-weight: 600">Pickup Route</label>
                                    <div class="col-sm-5">
                                         <select class="form-control newselpcrot">

                                         </select>
                                    </div><!--/cols-->
                                </div><!--/form-group-->

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="newseldrrot" style="color:black;font-weight: 600">Drop Route</label>
                                    <div class="col-sm-5">
                                         <select class="form-control newseldrrot">

                                         </select>
                                    </div><!--/cols-->
                                </div><!--/form-group-->

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="newselpcstp" style="color:black;font-weight: 600">Pickup Stoppage</label>
                                    <div class="col-sm-5">
                                         <select class="form-control newselpcstp">

                                         </select>
                                    </div><!--/cols-->
                                </div><!--/form-group-->

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="newseldrstp" style="color:black;font-weight: 600">Drop Stoppage</label>
                                    <div class="col-sm-5">
                                         <select class="form-control newseldrstp">

                                         </select>
                                    </div><!--/cols-->
                                </div><!--/form-group-->

                            </form><!--/form-->
                                        </div>
                                        <div class="modal-footer">
                                            <span id="adchdres"></span>&nbsp&nbsp
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="button" id="savnwstud" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->
                        </div><!-- /managers -->
                        <div id="regn" class="tab-pane fade">

                              <div style="position:absolute;top:0%;right:1%;">
                               <button type="button" id="addnewcnt" class="btn btn-md btn-success" data-toggle="modal" data-target="#addcont"> <span class="glyphicon glyphicon-plus"></span> Add</button>
                              </div>

                             <span style="float:right;margin-top:5px;">
                             <a href="updatesheet.php" type="button" class="btn btn-warning btn-md">
                               <span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span> Download Template</a>
                            <a href="downloadstuddet.php" type="button" class="btn btn-inverse btn-md">
                               <span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span> Download Details</a>
                           </span>
                            <progress id="progstud" max="100" value="0" style="display:none;margin-left:0%;margin-top:8px;"></progress>
                            <span id="percentstud"></span>
                            <span style="float:right;margin-top:5px;margin-right:3px;">
                            <form id="uploadstud" action="<?php echo htmlspecialchars('bulkstudupload.php') ?>" method="post" enctype="multipart/form-data" role="form">
                            <span class="form-group">
                              <div class="fileinput fileinput-new" data-provides="fileinput">
                                <span class="btn btn-icon btn-icon-right btn-primary btn-file">
                                  <i class="fa fa-upload"></i>
                                    <span class="fileinput-new">Select Excel file</span>
                                     <span class="fileinput-exists">Change</span>
                                      <input type="file" name="studfileToUpload" id="fileToUpload">
                                     </span>
                                  <span class="fileinput-filename"></span>
                                <button class="close fileinput-exists" data-dismiss="fileinput" style="float: none">&times;</button>
                             </div><!-- /fileinput -->
                            </span><!-- /form-group -->

                                <button type="submit" name="studfilesubmit" id="studupldbtn" class="btn btn-info btn-md">
                                  <i id="studloadfile"></i> <span class="glyphicon glyphicon-upload" aria-hidden="true"></span> Upload
                                </button>
                              </form>

                           </span>

                            <br><br><br>
                             <h1 style="text-align:center;"><span id="owner">Registration Numbers</span></h1>

                            <form role="form" style="width:50%;margin-left:25%;margin-top:3%;">

                                            <input type="text" class="form-control dropdown-toggle contsrch" data-toggle="dropdown"  placeholder="Search..." style="border:2px solid lightgrey;padding-top:20px;padding-bottom:20px;font-size:15px;background-image: url('search.png'); background-position: 98% 50%;background-repeat: no-repeat;">
                                             <ul class="showdrpdwn dropdown-menu" style="margin-left:25.5%;max-height:300px;overflow:auto;">
                                              <li style="text-align:center;"><i class="loadcntsrh"></i></li>
                                              <li class="srchcntrslts" style="padding-top:5px;padding-bottom:5px;"></li>
                                             </ul>

                              </form>
                        </div><!-- /contact nos -->

                        <div class="modal fade" id="addcont" data-sound="off" tabindex="-1" role="dialog" aria-labelledby="modalLargeLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="modalLargeLabel">Register Numbers</h4>
                                        </div>
                                        <div class="modal-body">
                                         <form role="form" class="form-horizontal form-bordered">
                                         <div class="row">

                                          <div class="col-sm-4">
                                           <div class="form-group">
                                            <input type="text" class="form-control contregstr0" placeholder="Registration Number" />
                                          </div><!-- /form-group -->
                                          </div><!-- /column -->

                                          <div class="col-sm-4">
                                           <div class="form-group">
                                            <input type="text" class="form-control contregstr1" placeholder="Registration Number" />
                                          </div><!-- /form-group -->
                                          </div><!-- /column -->
                                          
                                          <div class="col-sm-4">
                                           <div class="form-group">
                                            <input type="text" class="form-control contregstr2" placeholder="Registration Number" />
                                          </div><!-- /form-group -->
                                          </div><!-- /column -->
                                          
                                          <div class="col-sm-4">
                                           <div class="form-group">
                                            <input type="text" class="form-control contregstr3" placeholder="Registration Number" />
                                          </div><!-- /form-group -->
                                          </div><!-- /column -->

                                          <div class="col-sm-4">
                                           <div class="form-group">
                                            <input type="text" class="form-control contregstr4" placeholder="Registration Number" />
                                          </div><!-- /form-group -->
                                          </div><!-- /column -->
                                          
                                          <div class="col-sm-4">
                                           <div class="form-group">
                                            <input type="text" class="form-control contregstr5" placeholder="Registration Number" />
                                          </div><!-- /form-group -->
                                          </div><!-- /column -->
                                          
                                          <div class="col-sm-4">
                                           <div class="form-group">
                                            <input type="text" class="form-control contregstr6" placeholder="Registration Number" />
                                          </div><!-- /form-group -->
                                          </div><!-- /column -->

                                          <div class="col-sm-4">
                                           <div class="form-group">
                                            <input type="text" class="form-control contregstr7" placeholder="Registration Number" />
                                          </div><!-- /form-group -->
                                          </div><!-- /column -->
                                          
                                          <div class="col-sm-4">
                                           <div class="form-group">
                                            <input type="text" class="form-control contregstr8" placeholder="Registration Number" />
                                          </div><!-- /form-group -->
                                          </div><!-- /column -->
                                          
                                          <div class="col-sm-4">
                                           <div class="form-group">
                                            <input type="text" class="form-control contregstr9" placeholder="Registration Number" />
                                          </div><!-- /form-group -->
                                          </div><!-- /column -->
                                          
                                          <div class="col-sm-4">
                                           <div class="form-group">
                                            <input type="text" class="form-control contregstr10" placeholder="Registration Number" />
                                          </div><!-- /form-group -->
                                          </div><!-- /column -->
                                          
                                          <div class="col-sm-4">
                                           <div class="form-group">
                                            <input type="text" class="form-control contregstr11" placeholder="Registration Number" />
                                          </div><!-- /form-group -->
                                          </div><!-- /column -->
                                          
                                          <div class="col-sm-4">
                                           <div class="form-group">
                                            <input type="text" class="form-control contregstr12" placeholder="Registration Number" />
                                          </div><!-- /form-group -->
                                          </div><!-- /column -->
                                          
                                          <div class="col-sm-4">
                                           <div class="form-group">
                                            <input type="text" class="form-control contregstr13" placeholder="Registration Number" />
                                          </div><!-- /form-group -->
                                          </div><!-- /column -->
                                          
                                          <div class="col-sm-4">
                                           <div class="form-group">
                                            <input type="text" class="form-control contregstr14" placeholder="Registration Number" />
                                          </div><!-- /form-group -->
                                          </div><!-- /column -->

                                     </row><!--/row-->
                            </form><!--/form-->
                                        </div>
                                        <div class="modal-footer">
                                            <span id="cntmsg"></span>&nbsp&nbsp
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="button" id="savnwcnct" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->

                       </div> <!-- /end - tabcontent -->
                      </div>
                     </div>



