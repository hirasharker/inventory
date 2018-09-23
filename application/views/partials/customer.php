<?php if($customer==NULL){?>
<div class="row">
        <div class="col-md-12">
            <h1 class="page-header">
                Add Customer <small>add new customer's information..</small>
            </h1>
        </div>
    </div> 
     <!-- /. ROW  -->
  <div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Insert customer's Information..
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-5">
                        <form role="form" method="post" action="<?php echo base_url();?>sales/add_customer">
                            <div class="form-group">
                                <label>Customer's Name</label>
                                <input class="form-control" placeholder = "customer's Name" name="customer_name" required>
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <textarea class="form-control" rows="2" name="address" required></textarea>
                            </div>
                            <div class="form-group">
                                <label>Phone</label>
                                <input class="form-control" placeholder = "Phone" name="phone_no" required>
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Save</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        </form>
                    </div>
                    <!-- /.col-lg-6 (nested) -->
                </div>
                <!-- /.row (nested) -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
<?php }else {?>
<div class="row">
        <div class="col-md-12">
            <h1 class="page-header">
                Edit Customer
            </h1>
        </div>
    </div> 
     <!-- /. ROW  -->
  <div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Change customer's Information..
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-5">
                        <form role="form" method="post" action="<?php echo base_url();?>sales/update_customer/<?php echo $customer->customer_id;?>">
                            <div class="form-group">
                                <label>Customer Code</label>
                                <input class="form-control" disabled value="<?php echo $customer->customer_id;?>">
                            </div>
                            <div class="form-group">
                                <label>Customer's Name</label>
                                <input class="form-control" placeholder = "customer's Name" name="customer_name" value="<?php echo $customer->customer_name;?>">
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <textarea class="form-control" rows="2" name="address"><?php echo $customer->address;?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Phone</label>
                                <input class="form-control" placeholder = "Phone" name="phone_no" value="<?php echo $customer->phone_no;?>">
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Save</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        </form>
                    </div>
                    <!-- /.col-lg-6 (nested) -->
                </div>
                <!-- /.row (nested) -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
<?php }?>