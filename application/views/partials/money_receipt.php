<?php if($money_receipt==NULL){?>
<div class="row">
        <div class="col-md-12">
            <h1 class="page-header">
                Add Money Receipt <small>add new money receipt entry</small>
            </h1>
        </div>
    </div> 
     <!-- /. ROW  -->
  <div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Insert money receipt Information..
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-5">
                        <form role="form" method="post" action="<?php echo base_url();?>sales/add_money_receipt">
                            <label>Invoice No</label>

                            <div class="form-group input-group">
                             
                                <span class="input-group-addon">&#x9f3;</span>
                                <input type="text" class="form-control" id="sales_id" name="sales_id" value="<?php echo set_value('sales_id'); ?>">
                                <span class="input-group-addon">.00</span>
                            </div>

                            <label>Received Amount</label>

                            <div class="form-group input-group">
                             
                                <span class="input-group-addon">&#x9f3;</span>
                                <input type="text" class="form-control" name="received_amount" value="<?php echo set_value('received_amount'); ?>">
                                <span class="input-group-addon">.00</span>
                            </div>
                           
                            <br/>
                            
                           <!--  <div class="form-group">
                                <label>Date</label>
                                <input id="datepicker" class="form-control">
                            </div> -->
                            <label>Receipt Date</label>
                            <div class="input-group date" data-provide="datepicker">
                                <input type="text" class="form-control"  id="datepicker" name="money_receipt_date" value="<?php echo set_value('money_receipt_date'); ?>">
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-th"></span>
                                </div>
                            </div>
                            <label style="color:#F00;font-size:10px;"><?php echo form_error('money_receipt_date');?></label>
                            <br/>
                            </br>
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
<?php }else{?>
<div class="row">
    <div class="col-md-12">
        <h1 class="page-header">
            Edit Money Receipt
        </h1>
    </div>
</div> 
     <!-- /. ROW  -->
  <div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Change money receipt Information..
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-5">
                        <form role="form" method="post" action="<?php echo base_url();?>sales/update_money_receipt/<?php echo $money_receipt->money_receipt_id?>">
                            <label>Invoice No</label>

                            <div class="form-group input-group">
                             
                                <span class="input-group-addon">&#x9f3;</span>
                                <input type="text" class="form-control" id="sales_id" name="sales_id" value="<?php echo $money_receipt->sales_id; ?>">
                                <span class="input-group-addon">.00</span>
                            </div>
                            

                            <label>Received Amount</label>

                            <div class="form-group input-group">
                             
                                <span class="input-group-addon">&#x9f3;</span>
                                <input type="text" class="form-control" name="received_amount" value="<?php echo $money_receipt->received_amount;?>">
                                <span class="input-group-addon">.00</span>
                            </div>
                           
                            <br/>
                            
                           <!--  <div class="form-group">
                                <label>Date</label>
                                <input id="datepicker" class="form-control">
                            </div> -->
                            <label>Receipt Date</label>
                            <div class="input-group date" data-provide="datepicker">
                                <input type="text" class="form-control"  id="datepicker" name="money_receipt_date" value="<?php echo $money_receipt->money_receipt_date;?>">
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-th"></span>
                                </div>
                            </div>
                            <label style="color:#F00;font-size:10px;"><?php echo form_error('money_receipt_date');?></label>
                            <br/>
                            </br>
                            <button type="update" class="btn btn-primary">Save</button>
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
<script>
    $(function(){
      $("#sales_id").autocomplete({
        source: "<?php echo base_url();?>sales/generate_sales_id/"// path to the get_birds method
      });
    });
</script>