<?php global $controller;
$employees = $controller->get_employees(); ?>
<!-- <div class="alert alert-success alert-dismissable">
    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
    Lorem ipsum dolor sit amet, consectetur adipisicing elit. <a class="alert-link" href="#">Alert Link</a>.
</div> -->
<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-clock-o fa-fw"></i>Orders
        <div class="pull-right">
              <div class="btn-group">
                                    <button data-toggle="dropdown" class="btn btn-default btn-xs dropdown-toggle" type="button">
                                        Pending Orders
                                        <span class="caret"></span>
                                    </button>
                                    <ul role="menu" class="dropdown-menu pull-right">
                                        <li><a href="#new_manager" data-toggle="modal">Completed</a>
                                        <li><a href="#new_manager" data-toggle="modal">On Going</a>
                                        </li>
                                    </ul>
                                </div>
            <button class="btn btn-default btn-xs reload" data-table='#table-services' data-action='get_services'><i class="fa fa-refresh fa-fw"></i></button>
            <button class="btn btn-default btn-xs new_service" data-toggle="modal" data-target="#new_service"><i class="fa fa-plus"></i></button>
            <div class="btn-group">
            </div>
        </div>
    </div>

    <div class="panel-body">
        <div class="table-responsive">
            <table id="table-orders" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Service</th>
                        <th>Recipient</th>
                        <th>Phone Number</th>
                        <th>Email</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal" id="assign_employee">
   <form role="form" method="post" action="" id="frmnew_service">
    <input type="hidden" value="new_service" name="action">
    <input type="hidden" name="Service_id">
    <div class="modal-dialog">
        <div class="modal-content">
         <div class="modal-header">
            <h4><i class="fa fa-user"></i>&nbsp;&nbsp;Assign Employee</h4>
        </div>
        <div class="modal-body">
            
            <div class="well">
                 <div class="row">
                     <div class="form-group col-xs-12">
                        <label>Serviceasdasd</label>
                        <input placeholder="Enter text" class="form-control" name="Service" disabled>
                     </div>
                 </div>
                <div class="row">
                    <div class="form-group col-xs-6 clearfix">
                        <label>Service Start</label>
                        <input placeholder="Enter text" class="form-control" name="service_start" disabled>
                    </div>
                        <div class="form-group col-xs-6 clearfix">
                        <label>Service End</label>
                        <input placeholder="Enter text" class="form-control" name="service_end" disabled>
                    </div>
                </div>
            </div>
            

            <div class="form-group">
                <label>Select Employee</label>
                <select name="Employee_id" id="emp" class="js-example-basic-single form-control" style="width: 100%">
                   <?php
                        foreach ($employees as $key => $value) {
                           echo "<option value='$value[Employee_id]'>$value[First_Name] $value[Last_Name]</option>";
                        }
                   ?>
                </select>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input placeholder="Enter text" class="form-control" name="Email" disabled>
            </div>
            <div class="form-group">
                <label>Phone Number</label>
                <input placeholder="Enter text" class="form-control" name="Phone_Number" disabled>
            </div>

        </div>
        <div class="modal-footer">
         <button class="btn btn-default" data-dismiss="modal">Close</button>
         <button class="btn btn-success" name="add_new_service" type="submit">Save</button>
     </div>

 </div>
</div>
</form>
</div>