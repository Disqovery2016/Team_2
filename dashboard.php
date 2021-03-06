<?php

if(!isset($_SERVER['HTTP_X_PJAX'])){

    $content = basename($_SERVER['SCRIPT_NAME']);

    $_SERVER['HTTP_X_PJAX'] = true;
    require 'stilearn.base.template.php';
    die();
}

?>
                    <!-- DASHBOARD
                    ================================================== -->
                    <!-- Dashboard  -->
                    <div class="row margin-top">

                            <div id="system-stats" class="tab-pane fade active in">
                               <div class="col-md-4">
                                    <a href="#" style="text-decoration: none;"><div id="overall-diskspace" data-toggle="tooltip" data-placement="top" title="All Schools!" class="panel panel-animated panel-primary bg-primary">
                                        <div style="height:120%;" class="panel-body">
                                           <br><p class="text-ellipsis text-center" style="font-size:20px;"><?php echo 'Total Schools: '.count($albusrslt); ?></p>
                                        </div><!--/panel-body-->
                                    </div></a><!--/panel overal-diskspace-->
                                </div><!--/cols-->

                                <div class="col-md-4">
                                     <a href="#" style="text-decoration: none;"><div id="overall-diskspace" data-toggle="tooltip" data-placement="top" title="Good attandance Schools!" class="panel panel-animated panel-success bg-success">
                                        <div style="height:120%;" class="panel-body">
                                           <br><p class="text-ellipsis text-center" style="font-size:20px;"><?php echo 'High Attandance Schools: '.$grtcount; ?></p>
                                        </div><!--/panel-body-->
                                    </div></a><!--/panel overal-diskspace-->
                                </div><!--/cols-->

                                <div class="col-md-4">
                                     <a href="#" style="text-decoration: none;"><div id="overall-phisicmem" data-toggle="tooltip" data-placement="top" title="Bad attandance Schools!" class="panel panel-animated panel-danger bg-danger">
                                        <div style="height:120%;" class="panel-body">
                                          <br><p class="text-ellipsis text-center" style="font-size:20px"><?php echo 'Low Attandance Schools: '.$leescount; ?></p>
                                        </div><!--/panel-body-->
                                    </div></a><!--/panel overal-phisicmem-->
                                </div><!--/cols-->
                            </div><!--/#system-stats-->



                    </div><!--/row-->

                    <div class="row">
                        <div class="col-sm-12">

                          
                           <!-- Table-->
                           <div class="table-responsive">

                                <table class="table table-bordered bustable">
                                    <thead>
                                        <tr>
                                            <th>Sr.No</th>
                                            <th>School Name</th>
                                            <th>
                                            <span class="form-group">
                                           <span class="input-group input-group-in date" data-input="datepicker" data-format="dd/mm/yyyy">
                                           <input class="form-control" type="text" placeholder="Select Date" id="datadt" style="color:blue;">
                                             <span class="input-group-addon text-silver"><i class="fa fa-calendar"></i></span>
                                            </span><!-- /input-group-in -->
                                            </span><!--/form-group-->
                                            </th>
                                            <th>Total Students</th>
                                            <th>Present Students</th>
                                            <th>Total Teachers</th>
                                            <th>Present Teachers</th>
                                            <th><?php echo 'Status <br> avg ('.round($count).' %)'; ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>

<?php
    foreach ($albusrslt as $stud)
    {
                                    echo '<tr>
                                          <td>'.$ct.'</td>
                                          <td>'.$stud['name'].'</td>
                                          <td>'.$stud['date'].'</td>
                                          <td>'.$stud['no_of_std'].'</td>
                                          <td>'.curstud($stud['sid']).'</td>
                                          <td>'.$stud['no_of_tech'].'</td>
                                          <td>'.curtech($stud['sid']).'</td>';

                                          $percnt = ((curstud($stud['sid']) / $stud['no_of_std']))*100;

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
?>

                                    </tbody>
                                </table><!-- /table -->
                         </div>

                            

                        </div><!--/cols-->

 <div class="modal fade" data-sound="off" id="myMapModal" tabindex="-1" role="dialog" aria-labelledby="modalAnimatedLabel" aria-hidden="true">
   <div class="modal-dialog animated bounceIn" style="width:85%;">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="resetpath close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Completed Path</h4>
        </div>
        <div class="modal-body">
           <div id="busmap" style="height:400px;"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="resetpath btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div><!-- end--Modal content-->

    </div>
  </div>

</div><!--/row-->