<?php
global $controller;
 ?>

<div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-clock-o fa-fw"></i>Managers
                            <div class="pull-right">
                                <button class="btn btn-default btn-xs reload" data-table='#table-services' data-action='get_services'><i class="fa fa-refresh fa-fw"></i></button>
                                <button class="btn btn-default btn-xs new_manager" target="#new_manager" data-toggle="modal"><i class="fa fa-plus"></i></button>
                                <div class="btn-group">
                                </div>
                            </div>
                        </div>
	
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="table-managers" class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Type</th>
                                            <th>Email</th>
                                            <th>Phone Number</th>
                                            <th>Address</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
 </div>
 <div class="modal" id="new_manager">
   <form role="form" method="post" action="" id="frmnew_manager">
    <input type="hidden" value="new_manager" name="action">
    <div class="modal-dialog">
        <div class="modal-content">
         <div class="modal-header">
            <h4>Manager Information</h4>
        </div>
        <div class="modal-body">

            <div class="form-group">
            <label>First Name</label>
                <input class="form-control" name="First_Name">
                <p class="help-block">Example block-level help text here.</p>
            </div>
            <div class="form-group">
            <label>Last Name</label>
                <input class="form-control" name="Last_Name">
                <p class="help-block">Example block-level help text here.</p>
            </div>
            <div class="form-group">
            <label>Email</label>
                <input class="form-control" name="Email">
                <p class="help-block">Example block-level help text here.</p>
            </div>
            <div class="form-group">
            <label>Address</label>
                <input class="form-control" name="Address">
                <p class="help-block">Example block-level help text here.</p>
            </div>
            <div class="form-group">
            <label>Phone Number</label>
                <input class="form-control" name="Phone_Number">
                <p class="help-block">Example block-level help text here.</p>
            </div>
            <div class="form-group">
                <label>Position</label>
                <select class="form-control" name="position_id">
                    <?php $controller->load_positions(); ?>
                </select>
            </div>

        </div>
        <div class="modal-footer">
         <button class="btn btn-default" data-dismiss="modal">Close</button>
         <button class="btn btn-success" type="submit">Save</button>
     </div>

 </div>
</div>
</form>
</div>