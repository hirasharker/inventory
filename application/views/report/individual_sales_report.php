<div class="row">
        <div class="col-md-12">
            <h1 class="page-header">
                Individual Sales Report <small></small>
            </h1>
        </div>
    </div> 
     <!-- /. ROW  -->
   
<div class="row">
    <div class="col-md-12">
        <!-- Advanced Tables -->
        <div class="panel panel-default">
            <div class="panel-heading">
              
            </div>
            <div class="panel-body">

                <div class="row">
                    <div class="col-lg-6">
                        <!-- <form method="post" action="<?php echo base_url()?>sales/generate_individual_sales_statement" target="_blank"> -->
                        <form method="post" action="<?php echo base_url()?>report_sales/individual_sales_pdf" target="_blank">
                            <div class="form-group">
                                <label>Sales Mode</label>
                                <select class="form-control" name="sales_mode" id="salesMode">
                                    <option value="">Select Mode</option>
                                    <!-- <option value="1">Dealer Sale</option> -->
                                    <option value="2">Dealer Sale</option>
                                    <!-- <option value="3">Quick Sale</option> -->
                                </select>
                            </div>

                            <div class="form-group" id="customer" style="display:none">
                                <label>Select Customer</label>
                                <select class="form-control select-tag" name="customer_id" id="customerId" style="width: 100% !important;">
                                    <option value="">select customer</option>
                                    <?php foreach($customer_list as $value){?>
                                    <option value="<?php echo $value->customer_id; ?>"><?php echo $value->customer_name;?></option>
                                <?php }?>
                                </select>
                            </div>

                           <!--  <div class="form-group" id="dealer" style="display:none">
                                <label>Select Dealer</label>
                                <select class="form-control select-tag" name="dealer_id" id="dealerId" style="width: 100% !important;">
                                    <option value="">select dealer</option>
                                    <?php foreach($dealer_list as $value){?>
                                    <option value="<?php echo $value->dealer_id; ?>"><?php echo $value->dealer_name;?></option>
                                <?php }?>
                                </select>
                            </div> -->



                            <!-- <div class="form-group">
                                <label>Customer Name</label>
                                <input id="customer-name" class="form-control" placeholder = "Type customer name" name="customer_name" type="text">
                            </div> -->
                            <label>Select Date</label>
                            <div class="row">
                                <div class="form-group col-lg-6 col-md-6">
                                    <div class="input-group date" data-provide="datepicker">
                                        <input type="text" class="form-control" value="<?php echo date("Y/m/d");?>" id="datepicker" name="from_date" placeholder="From" required>
                                        <div class="input-group-addon">
                                            <span class="glyphicon glyphicon-th"></span>
                                        </div>
                                    </div>
                                    <label style="color:#F00;font-size:10px;"><?php echo form_error('from_date');?></label> 
                                </div>
                                <div class="form-group col-lg-6 col-md-6">
                                    <div class="input-group date" data-provide="datepicker">
                                        <input type="text" class="form-control" value="<?php echo date("Y/m/d");?>" id="datepicker2" name="to_date" placeholder="To" required>
                                        <div class="input-group-addon">
                                            <span class="glyphicon glyphicon-th"></span>
                                        </div>
                                    </div>
                                    <label style="color:#F00;font-size:10px;"><?php echo form_error('to_date');?></label> 
                                </div>
                            </div>
                           
                            <!-- <label>purchase Date</label>
                            <div class="input-group date" data-provide="datepicker">
                                <input type="text" class="form-control"  id="datepicker" name="purchase_date" required>
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-th"></span>
                                </div>
                            </div> -->
                            <!-- <label style="color:#F00;font-size:10px;"><?php echo form_error('purchase_date');?></label> -->
                            <br/>
                            <button type="button" class="btn btn-primary" id="search">Search</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                            <button type="submit" class="btn btn-default"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Pdf</button>

                        </form>
                    </div>
                    <!-- /.col-lg-6 (nested) -->
                </div>
                <!-- /.row (nested) -->
                <br/>

                <div class="table-responsive" id="table-container">
                    
                </div>
            </div>
        </div>
        <!--End Advanced Tables -->
    </div>
</div>
    <!-- /. ROW  -->

<script>
    $( "#salesMode" ).change(function() {
      // alert( "Handler for .change() called."+this.value);
      var val = $('#salesMode option:selected').val();
      if(val == 1){
        $( "#dealer" ).show( 500 );
        $( "#customer" ).hide( 500 );
        $( "#customerId" ).val("");
      }else if (val == 2){
        $( "#customer" ).show( 500 );
        $( "#dealer" ).hide( 500 );
        $( "#dealerId" ).val("");
      }else {
        $( "#customer" ).hide( 500 );
        $( "#dealer" ).hide( 500 );
        $( "#customerId" ).val("");
        $( "#dealerId" ).val("");
      }

    });

    $(function(){
      // $("#customer-name").autocomplete({
      //   source: "<?php echo base_url();?>sales/generate_customer_name/"// path to the get_birds method
      // });
    });
</script>

<script>
        $( "#search" ).click(function() {
          // alert( "Handler for .click() called." );
            var customerId=$('#customerId option:selected').val();
            var dealerId=$('#dealerId option:selected').val();
            var fromDate=document.getElementById('datepicker').value;
            var toDate=document.getElementById('datepicker2').value;
            // alert(customerId+"/"+dealerId);
            $.ajax({
                url: '<?php echo base_url();?>sales/generate_individual_sales_statement',
                type:'POST',
                dataType: 'json',
                data: {customer_id : customerId, dealer_id : dealerId, from_date : fromDate, to_date : toDate},
                success: function(output){
                    $("#table-container").html(output);
                } // End of success function of ajax form
            }); // End of ajax call
        });
      
</script>