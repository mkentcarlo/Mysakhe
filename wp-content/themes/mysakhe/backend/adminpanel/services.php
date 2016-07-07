<?php global $controller;
$service_types = $controller->get_service_types();

?>
<!-- <div class="alert alert-success alert-dismissable">
    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
    Lorem ipsum dolor sit amet, consectetur adipisicing elit. <a class="alert-link" href="#">Alert Link</a>.
</div> -->
<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-clock-o fa-fw"></i>Serives
        <div class="pull-right">
            <button class="btn btn-default btn-xs reload" data-table='#table-services' data-action='get_services'><i class="fa fa-refresh fa-fw"></i></button>
            <button class="btn btn-default btn-xs new_service" data-toggle="modal" data-target="#new_service"><i class="fa fa-plus"></i></button>
            <div class="btn-group">
               <!--  <button data-toggle="dropdown" class="btn btn-default btn-xs dropdown-toggle" type="button">
                    Actions
                    <span class="caret"></span>
                </button>
                <ul role="menu" class="dropdown-menu pull-right">
                    <li><a href="#new_service" >Add New</a>
                    </li>
                    <li><a href="" class="reload" >Refresh</a>
                    </li>
                </ul> -->
            </div>
        </div>
    </div>

    <div class="panel-body">
        <div class="table-responsive">
            <table id="table-services" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Service</th>
                        <th>Type</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal" id="new_service">
   <form role="form" method="post" action="" id="frmnew_service">
    <input type="hidden" value="new_service" name="action">
    <input type="hidden" name="Service_id">
    <div class="modal-dialog">
        <div class="modal-content">
         <div class="modal-header">
            <h4>Service Information</h4>
        </div>
        <div class="modal-body">

            <div class="form-group">
                <label>Service Name</label>
                <input class="form-control" name="Service_Name">
                <p class="help-block">Example block-level help text here.</p>
            </div>
            <div class="form-group">
                <label>Type</label>
                <select class="form-control" name="Service_type_id">
                    <?php $controller->load_select(json_decode($service_types)); ?>
                </select>
            </div>
            <div class="form-group">
                <label>Price</label>
                <input placeholder="Enter text" class="form-control" name="Price">
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