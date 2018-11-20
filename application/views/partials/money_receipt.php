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
                        <form role="form" method="post" action="<?php echo base_url();?>money_receipt/add_money_receipt">
                            

                            <div class="form-group">
                                <label>Type of Money Receipt</label>
                                <select class="form-control" name="money_receipt_type" id="moneyReceiptType">
                                    <option value="2">Select Type</option>
                                    <option value="0">Advance Against Sales Order</option>
                                    <option value="1">Payment Against Sales Invoice</option>
                                </select>
                            </div>

                            <div class="form-group sales-order-id" style="display:none;">
                                <label>Sales Order No</label>
                                <input type="text" class="form-control" id="salesOrderId" name="sales_order_id" value="<?php echo set_value('sales_order_id'); ?>">
                            </div>

                            <div class="form-group sales-id" style="display:none;">
                                <label>Invoice No</label>
                                <input type="text" class="form-control" id="salesId" name="sales_id" value="<?php echo set_value('sales_id'); ?>">
                            </div>

                            <div class="form-group">
                                <label>Payment Mode</label>
                                <select class="form-control" name="payment_mode" id="paymentMode">
                                    <option value="0">Cash</option>
                                    <option value="1">Bank Deposit</option>
                                    <option value="2">Cheque</option>
                                    <option value="3">Bank Transfer</option>
                                </select>
                            </div>

                            <div class="form-group transfer-from-bank-container" style="display:none;">
                                <label>Transfer from</label>
                                <select class="form-control select-tag" id="fromBankId" name="transfer_from_bank_id">
                                    <option value="">Select Bank</option>
                                    <?php foreach($bank_list as $b_value) {?>
                                    <option value="<?php echo $b_value->bank_id; ?>"><?php echo $b_value->bank_name; ?></option>
                                <?php } ?>
                                </select>
                            </div>

                            <div class="form-group transfer-to-bank-container" style="display:none;">
                                <label>Transfer to</label>
                                <select class="form-control select-tag" id="toBankId" name="transfer_to_bank_id">
                                    <option value="">Select Bank</option>
                                    <?php foreach($bank_list as $b_value) {?>
                                    <option value="<?php echo $b_value->bank_id; ?>"><?php echo $b_value->bank_name; ?></option>
                                <?php } ?>
                                </select>
                            </div>

                            <div class="form-group bank-transfer-id-container" style="display:none;">
                                <label>Transfer ID</label>
                                <input type="text" class="form-control" id="bankTransferId" name="bank_transfer_id" >
                            </div>

                            <div class="form-group bank-name" style="display:none;">
                                <label>Select Bank</label>
                                <select class="form-control select-tag" id="bankId" name="bank_id">
                                    <option value="">Select Bank</option>
                                    <?php foreach($bank_list as $b_value) {?>
                                    <option value="<?php echo $b_value->bank_id; ?>"><?php echo $b_value->bank_name; ?></option>
                                <?php } ?>
                                </select>
                            </div>

                            <div class="form-group bank-branch" style="display:none;">
                                <label>Branch Name</label>
                                <input type="text" class="form-control" id="bankBranch" name="branch_name" >
                            </div>

                            <div class="form-group deposit-no" style="display:none;">
                                <label>Deposit No</label>
                                <input type="text" class="form-control" id="depositNo" name="deposit_slip_no" >
                            </div>

                            <div class="form-group cheque-no" style="display:none;">
                                <label>Cheque No</label>
                                <input type="text" class="form-control" id="chequeNo" name="cheque_no" >
                            </div>

                            <label>Received Amount</label>

                            <div class="form-group input-group">
                             
                                <span class="input-group-addon">&#x9f3;</span>
                                <input type="text" class="form-control" name="received_amount" value="<?php echo set_value('received_amount'); ?>" required>
                                <span class="input-group-addon">.00</span>
                            </div>
                           
                            <br/>
                            
                           <!--  <div class="form-group">
                                <label>Date</label>
                                <input id="datepicker" class="form-control">
                            </div> -->
                            <label>Receipt Date</label>
                            <div class="input-group date" data-provide="datepicker">
                                <input type="text" class="form-control"  id="datepicker" name="money_receipt_date" value="<?php echo set_value('money_receipt_date'); ?>" required>
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

<script type="text/javascript">
    $( "#moneyReceiptType" ).change(function() {
          // alert( "Handler for .change() called."+this.value);
          var val = $('#moneyReceiptType option:selected').val();
          if(val == 0){
            $( ".sales-order-id" ).show( 500 );
            $( ".sales-id" ).hide( 500 );
            $( "#salesId" ).val("");
          }else if (val == 1){
            $( ".sales-id" ).show( 500 );
            $( ".sales-order-id" ).hide( 500 );
            $( "#salesOrderId" ).val("");
          }else if(val== 2){
            $( ".sales-id" ).hide( 500 );
            $( ".sales-order-id" ).hide( 500 );
            $( "#salesId" ).val("");
            $( "#salesOrderId" ).val("");
          }
    });

    $( "#paymentMode" ).change(function() {
          // alert( "Handler for .change() called."+this.value);
          var val = $('#paymentMode option:selected').val();
          if(val == 0){                 //  CASH MODE
            $( ".bank-name" ).hide( 500 );
            $( ".bank-branch" ).hide( 500 );
            $( ".deposit-no" ).hide( 500 );
            $( ".cheque-no" ).hide( 500 );
            $( ".transfer-from-bank-container" ).hide( 500 );
            $( ".transfer-to-bank-container" ).hide( 500 );
            $( ".bank-transfer-id-container" ).hide( 500 );
            $( "#bankId" ).val("");
            $( "#bankBranch" ).val("");
            $( "#depositNo" ).val("");
            $( "#chequeNo" ).val("");
            $( "#fromBankId" ).val("");
            $( "#toBankId" ).val("");
            $( "#bankTransferId" ).val("");
          }else if (val == 1){           //  BANK DEPOSIT MODE
            $( ".bank-name" ).show( 500 );
            $( ".bank-branch" ).show( 500 );
            $( ".deposit-no" ).show( 500 );
            $( ".cheque-no" ).hide( 500 );
            $( ".transfer-from-bank-container" ).hide( 500 );
            $( ".transfer-to-bank-container" ).hide( 500 );
            $( ".bank-transfer-id-container" ).hide( 500 );
            $( "#chequeNo" ).val("");
            $( "#fromBankId" ).val("");
            $( "#toBankId" ).val("");
            $( "#bankTransferId" ).val("");
          }else if(val== 2){             //  CHEQUE MODE
            $( ".bank-name" ).show( 500 );
            $( ".bank-branch" ).show( 500 );
            $( ".cheque-no" ).show( 500 );
            $( ".deposit-no" ).hide( 500 );
            $( ".transfer-from-bank-container" ).hide( 500 );
            $( ".transfer-to-bank-container" ).hide( 500 );
            $( ".bank-transfer-id-container" ).hide( 500 );
            $( "#depositNo" ).val("");
            $( "#fromBankId" ).val("");
            $( "#toBankId" ).val("");
            $( "#bankTransferId" ).val("");
          }else if(val== 3){             //  CHEQUE MODE
            $( ".transfer-from-bank-container" ).show( 500 );
            $( ".transfer-to-bank-container" ).show( 500 );
            $( ".bank-transfer-id-container" ).show( 500 );
            $( ".bank-name" ).hide( 500 );
            $( ".bank-branch" ).hide( 500 );
            $( ".cheque-no" ).hide( 500 );
            $( ".deposit-no" ).hide( 500 );
            $( "#bankId" ).val("");
            $( "#bankBranch" ).val("");
            $( "#depositNo" ).val("");
            $( "#chequeNo" ).val("");
          }
    });
</script>
<?php }else{?>
<div class="row">
        <div class="col-md-12">
            <h1 class="page-header">
                Edit Money Receipt <small>edit money receipt</small>
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
                        <form role="form" method="post" action="<?php echo base_url();?>money_receipt/update_money_receipt">
                            <input type="hidden" name="money_receipt_id" value="<?php echo $money_receipt->money_receipt_id;?>">

                            <div class="form-group">
                                <label>Type of Money Receipt</label>
                                <select class="form-control" name="money_receipt_type" id="moneyReceiptType">
                                    <option value="2">Select Type</option>
                                    <option value="0" <?php if($money_receipt->money_receipt_type == 0){echo "selected";}?>>Advance Against Sales Order</option>
                                    <option value="1" <?php if($money_receipt->money_receipt_type == 1){echo "selected";}?>>Payment Against Sales Invoice</option>
                                </select>
                            </div>
                            
                            <div class="form-group sales-order-id" style="display:none;">
                                <label>Sales Order No</label>
                                <input type="text" class="form-control" id="salesOrderId" name="sales_order_id" value="<?php echo $money_receipt->sales_order_id; ?>">
                            </div>

                            <div class="form-group sales-id" style="display:none;">
                                <label>Invoice No</label>
                                <input type="text" class="form-control" id="salesId" name="sales_id" value="<?php echo $money_receipt->sales_id; ?>">
                            </div>

                            <div class="form-group">
                                <label>Payment Mode</label>
                                <select class="form-control" name="payment_mode" id="paymentMode">
                                    <option value="0" <?php if($money_receipt->payment_mode == 0){echo "selected";}?>>Cash</option>
                                    <option value="1" <?php if($money_receipt->payment_mode == 1){echo "selected";}?>>Bank Deposit</option>
                                    <option value="2" <?php if($money_receipt->payment_mode == 2){echo "selected";}?>>Cheque</option>
                                </select>
                            </div>

                            <div class="form-group bank-name" style="display:none;">
                                <label>Select Bank</label>
                                <select class="form-control" id="bankId" name="bank_id">
                                    <option value="">Select Bank</option>
                                    <?php foreach($bank_list as $b_value) {?>
                                    <option value="<?php echo $b_value->bank_id; ?>" <?php if($money_receipt->bank_id == $b_value->bank_id){echo "selected";}?>><?php echo $b_value->bank_name; ?></option>
                                <?php } ?>
                                </select>
                            </div>

                            <div class="form-group bank-branch" style="display:none;">
                                <label>Branch Name</label>
                                <input type="text" class="form-control" id="bankBranch" name="branch_name" value="<?php echo $money_receipt->branch_name ?>">
                            </div>

                            <div class="form-group deposit-no" style="display:none;">
                                <label>Deposit No</label>
                                <input type="text" class="form-control" id="depositNo" name="deposit_slip_no" value="<?php echo $money_receipt->deposit_slip_no; ?>">
                            </div>

                            <div class="form-group cheque-no" style="display:none;">
                                <label>Cheque No</label>
                                <input type="text" class="form-control" id="chequeNo" name="cheque_no" value="<?php echo $money_receipt->cheque_no; ?>">
                            </div>

                            <label>Received Amount</label>

                            <div class="form-group input-group">
                             
                                <span class="input-group-addon">&#x9f3;</span>
                                <input type="text" class="form-control" name="received_amount" value="<?php echo $money_receipt->received_amount; ?>" required>
                                <span class="input-group-addon">.00</span>
                            </div>
                           
                            <br/>
                            
                           <!--  <div class="form-group">
                                <label>Date</label>
                                <input id="datepicker" class="form-control">
                            </div> -->
                            <label>Receipt Date</label>
                            <div class="input-group date" data-provide="datepicker">
                                <input type="text" class="form-control"  id="datepicker" name="money_receipt_date" value="<?php echo $money_receipt->money_receipt_date; ?>" required>
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-th"></span>
                                </div>
                            </div>
                            <label style="color:#F00;font-size:10px;"><?php echo form_error('money_receipt_date');?></label>
                            <br/>
                            </br>
                            <button type="submit" class="btn btn-primary">Update</button>
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

<script type="text/javascript">
    <?php if($money_receipt->money_receipt_type == 0){?>
        $( ".sales-order-id" ).show( 500 );
        $( ".sales-id" ).hide( 500 );
        $( "#salesId" ).val("");
    <?php }?>

    <?php if($money_receipt->money_receipt_type == 1){?>
        $( ".sales-id" ).show( 500 );
        $( ".sales-order-id" ).hide( 500 );
        $( "#salesOrderId" ).val("");
    <?php }?>

    $( "#moneyReceiptType" ).change(function() {
          // alert( "Handler for .change() called."+this.value);
          var val = $('#moneyReceiptType option:selected').val();
          if(val == 0){
            $( ".sales-order-id" ).show( 500 );
            $( ".sales-id" ).hide( 500 );
            $( "#salesId" ).val("");
          }else if (val == 1){
            $( ".sales-id" ).show( 500 );
            $( ".sales-order-id" ).hide( 500 );
            $( "#salesOrderId" ).val("");
          }else if(val== 2){
            $( ".sales-id" ).hide( 500 );
            $( ".sales-order-id" ).hide( 500 );
            $( "#salesId" ).val("");
            $( "#salesOrderId" ).val("");
          }
    });

    <?php if($money_receipt->payment_mode == 0){?>
        $( ".bank-name" ).hide( 500 );
        $( ".bank-branch" ).hide( 500 );
        $( ".deposit-no" ).hide( 500 );
        $( ".cheque-no" ).hide( 500 );
        $( "#bankId" ).val("");
        $( "#bankBranch" ).val("");
        $( "#depositNo" ).val("");
        $( "#chequeNo" ).val("");
    <?php }?>

    <?php if($money_receipt->payment_mode == 1){?>
        $( ".bank-name" ).show( 500 );
        $( ".bank-branch" ).show( 500 );
        $( ".deposit-no" ).show( 500 );
        $( ".cheque-no" ).hide( 500 );
        $( "#chequeNo" ).val("");
    <?php }?>

    <?php if($money_receipt->payment_mode == 2){?>
        $( ".bank-name" ).show( 500 );
        $( ".bank-branch" ).show( 500 );
        $( ".cheque-no" ).show( 500 );
        $( ".deposit-no" ).hide( 500 );
        $( "#depositNo" ).val("");
    <?php }?>

    $( "#paymentMode" ).change(function() {
          // alert( "Handler for .change() called."+this.value);
          var val = $('#paymentMode option:selected').val();
          if(val == 0){                 //  CASH MODE
            $( ".bank-name" ).hide( 500 );
            $( ".bank-branch" ).hide( 500 );
            $( ".deposit-no" ).hide( 500 );
            $( ".cheque-no" ).hide( 500 );
            $( "#bankId" ).val("");
            $( "#bankBranch" ).val("");
            $( "#depositNo" ).val("");
            $( "#chequeNo" ).val("");
          }else if (val == 1){           //  BANK DEPOSIT MODE
            $( ".bank-name" ).show( 500 );
            $( ".bank-branch" ).show( 500 );
            $( ".deposit-no" ).show( 500 );
            $( ".cheque-no" ).hide( 500 );
            $( "#chequeNo" ).val("");
          }else if(val== 2){             //  CHEQUE MODE
            $( ".bank-name" ).show( 500 );
            $( ".bank-branch" ).show( 500 );
            $( ".cheque-no" ).show( 500 );
            $( ".deposit-no" ).hide( 500 );
            $( "#depositNo" ).val("");
          }
    });
</script>
<?php }?>
<script>
    $(function(){
      $("#salesId").autocomplete({
        source: "<?php echo base_url();?>sales/generate_sales_id/"// path to the get_birds method
      });

      $("#salesOrderId").autocomplete({
        source: "<?php echo base_url();?>sales_order/generate_sales_order_id/"// path to the get_birds method
      });

    });
</script>