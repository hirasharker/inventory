<?php if($sales==NULL){?>
<div class="row">
        <div class="col-md-12">
            <h1 class="page-header">
                Add Sales <small>add new sales entry..</small>
            </h1>
        </div>
    </div> 
     <!-- /. ROW  -->
  <div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Insert Sales Information...
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-9">
                       <?php echo form_open('sales/add_sales');?>
                       <!-- <form role="form" method="get" action="#"> -->

                            <div class="form-group">
                                <label>Sales Mode</label>
                                <select class="form-control" name="sales_mode" id="salesMode">
                                    <option value="">Select Mode</option>
                                    <option value="1">Dealer Sale</option>
                                    <option value="2">Regular Customer</option>
                                    <option value="3">Quick Sale</option>
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

                            <div class="form-group" id="dealer" style="display:none">
                                <label>Select Dealer</label>
                                <select class="form-control select-tag" name="dealer_id" id="dealerId" style="width: 100% !important;">
                                    <option value="">select dealer</option>
                                    <?php foreach($dealer_list as $value){?>
                                    <option value="<?php echo $value->dealer_id; ?>"><?php echo $value->dealer_name;?></option>
                                <?php }?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Select Warehouse</label>
                                <select class="form-control" name="warehouse_id" id="warehouseId">
                                    <option value="">Select Warehouse</option>
                                    <?php foreach($warehouse_list as $value){?>
                                    <option value="<?php echo $value->warehouse_id; ?>"><?php echo $value->warehouse_name;?></option>
                                <?php }?>
                                </select>
                            </div>


                            <div class="form-group">
                                <label>Select Item</label>
                                <select class="form-control select-tag" id="item" name="item_id">
                                    <option value="0">select</option>
                               <!--  <?php foreach($item_list as $value){?>
                                    <option value="<?php echo $value->item_id; ?>" quantity="<?php echo $value->quantity;?>"><?php echo $value->item_name;?></option>
                                <?php }?> -->
                                </select>
                            </div>
                            <?php if($error_content!=NULL){?>
                            <?php for($i=0; $i<$error_content; $i++){?>
                            <label style="color:#F00;font-size:10px;"><?php echo form_error('quantity['.$i.']');?> </label>
                            <?php }}?>
                            <div class="col-lg-12" id="create">
                                <div id="quantity-error">
                                </div>
                                <input type="hidden" id="count" value="0" name="count">
                            </div>

                            

                            <div class="form-group">
                                <label>Discount (%)</label>
                                <input class="form-control" placeholder = "Discount" name="sales_discount" type="number" step=".01" min="0" max="100">
                            </div>
                            <label>Sales Date</label>
                            <div class="input-group date" data-provide="datepicker">
                                <input type="text" class="form-control"  id="datepicker" name="sales_date" required >
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-th"></span>
                                </div>
                            </div>
                            <label style="color:#F00;font-size:10px;"><?php echo form_error('sales_date');?></label>
                            <br/>
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


<script>
        $( "#item" ).change(function() {
          // alert( "Handler for .change() called."+this.value);
          // var itemName = $('#item option:selected').text();
          var element = $(this).find('option:selected'); 
          var itemName = element.attr("itemName");

          var itemPrice = $(this).find('option:selected').attr('itemPrice');
          var quantity = $(this).find('option:selected').attr('quantity');
          count = document.getElementById('count').value;
          if(count == 0){
            var itemHeader  = '<div class="col-lg-12" style="margin-bottom: 10px;border-bottom: 2px solid #09192a;" id="itemHeader">'
            +'<div class="col-lg-4"><label class="lblItem">Name</label></div>'
            +'<div class="col-lg-2"><label class="lblItem">Price</label></div>'
            +'<div class="col-lg-2"><label class="lblItem"></label></div>'
            +'<div class="col-lg-2"><label class="lblItem">QTY</label></div>'
            +'<div class="col-lg-1"><label class="lblItem">Stock</label></div>'
            +'</div>';
            
            $('#create').append(itemHeader);
          }
          var val = $('#item option:selected').val();
              if(val!=0){
                $.ajax({
                      url: '<?php echo base_url();?>sales/ajax_count_item',
                      type:'POST',
                      dataType: 'json',
                      data: {count : count},
                      success: function(error_message){
                              $('#quantity-error').html(error_message);
                          } // End of success function of ajax form
                }); // End of ajax call
                
                // alert(quantity);

                count++;
                var code = '<div class="col-lg-12" style="margin-bottom: 10px"><div class="col-lg-4"><label class="lblItem">'
                +itemName+'</label><input class="form-control item-id" type="hidden" name="item_id[]" value="'+this.value+'">'
                +'<input class="form-control" type="hidden" name="item_name[]" value="'+itemName+'">'
                +'</div><div class="col-lg-2">'
                +'<input class="form-control item-price" placeholder = "Price" name="sales_price[]" value="'+itemPrice+'" required type="hidden" >'
                +'<label>MRP '+itemPrice+'/-</label></div>'
                +'<div class="col-lg-2">'
                +'<input class="form-control" placeholder = "Discount" name="discount[]" required value="0" type="hidden"></div><div class="col-lg-2">'
                +'<input class="form-control" placeholder = "QTY" name="quantity[]" required></div><div class="col-lg-1"><label>('+quantity+')</label></div>'
                +'<a href="" class="col-lg-1 remove"><i class="fa fa-times fa-lg text-danger" aria-hidden="true"></i></a></div>';

                if(this.value != 0){
                     $('#create').append(code);
                        document.getElementById('count').value = count;
                }

                $("#item option[value='"+this.value+"']").remove();
            }
          
        });


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



         $( "#warehouseId" ).change(function() {
          // alert( "Handler for .change() called.");

          var warehouseId = $('#warehouseId option:selected').val();
          
          if($('#item').val()!="NULL"){
              $('#item').empty();
          }

          $('#create').empty();

          $('#create').append('<div id="quantity-error"></div><input type="hidden" id="count" value="0" name="count">');

          $.ajax({
              type: "POST",
              url: "<?php echo base_url()?>sales/get_item_by_warehouse_id/",
              data: { 'warehouseId': warehouseId  },
              success: function(data){
                  // Parse the returned json data
                  var opts = $.parseJSON(data);
                  // Use jQuery's each to iterate over the opts value
                  $('#item').append('<option value="">Select Item</option>');

                  $.each(opts, function(i, d) {
                      // You will need to alter the below to get the right values from your json object.  Guessing that d.id / d.modelName are columns in your carModels data
                      $('#item').append('<option itemName="' + d.item_name + '" value="' + d.item_id + '" quantity = "'+ d.quantity +'" itemPrice = "'+d.item_price+'">' +d.part_no+"-"+ d.item_name + '</option>');

                  });
              }
          });


        });


       $('#create').on('click', '.remove', function(e){ //Once remove button is clicked
            e.preventDefault();
             var itemName = $(this).parent('div').find(".lblItem").text();
             var itemPrice = $(this).parent('div').find(".item-price").val();
             var itemId = $(this).parent('div').find('.item-id').val();
             // alert(itemId);
             count--;
             document.getElementById('count').value = count;
            $('#item').append('<option value="'+itemId+'" itemName ="'+itemName+'" itemPrice="'+itemPrice+'">'+itemName+'</option>');
            $(this).parent('div').remove(); //Remove field html
            if(count == 0){
              $('#itemHeader').remove();
            }

        });

</script>

<?php }else{ ?>





<div class="row">
        <div class="col-md-12">
            <h1 class="page-header">
                Edit Sales 
            </h1>
        </div>
    </div> 
     <!-- /. ROW  -->
  <div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Change Sales Information..
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-9">
                        <form role="form" method="post" action="<?php echo base_url();?>sales/update_sales/<?php echo $sales->sales_id;?>">

                            <div class="form-group">
                                <label>Sales Mode</label>
                                <select class="form-control" name="sales_mode" id="salesMode">
                                    <option value="">Select Mode</option>
                                    <option value="1" <?php if($sales->sales_mode==1){echo "selected";}?>>Dealer Sale</option>
                                    <option value="2" <?php if($sales->sales_mode==2){echo "selected";}?>>Regular Customer</option>
                                    <option value="3" <?php if($sales->sales_mode==3){echo "selected";}?>>Quick Sale</option>
                                </select>
                            </div>

                            <div class="form-group" id="customer" style="display:none">
                                <label>Select Customer</label>
                                <select class="form-control" name="customer_id" id="customerId">
                                    <option value="">select customer</option>
                                    <?php foreach($customer_list as $value){?>
                                    <option <?php if($sales->customer_id==$value->customer_id){ echo "selected";}?> value="<?php echo $value->customer_id; ?>"><?php echo $value->customer_name;?></option>
                                    <?php }?>
                                </select>
                            </div>

                            <div class="form-group" id="dealer" style="display:none">
                                <label>Select Dealer</label>
                                <select class="form-control" name="dealer_id" id="dealerId">
                                    <option value="">select dealer</option>
                                    <?php foreach($dealer_list as $value){?>
                                    <option <?php if($sales->dealer_id==$value->dealer_id){ echo "selected";}?> value="<?php echo $value->dealer_id; ?>"><?php echo $value->dealer_name;?></option>
                                <?php }?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Select Warehouse</label>
                                <select class="form-control" name="warehouse_id" id="warehouseId">
                                    <option value="">Select Warehouse</option>
                                    <?php foreach($warehouse_list as $value){?>
                                    <option <?php if($sales->warehouse_id==$value->warehouse_id){ echo "selected";}?>  value="<?php echo $value->warehouse_id; ?>" ><?php echo $value->warehouse_name;?></option>
                                <?php }?>
                                </select>
                            </div>


                            <div class="form-group">
                                <label>Select Item</label>
                                <select class="form-control select-tag" id="item" name="item_id">
                                    <option>select</option>
                                <?php foreach($item_list as $value){?>
                                    <option value="<?php echo $value->item_id; ?>" itemName="<?php echo $value->item_name;?>"><?php echo $value->item_name;?></option>
                                <?php }?>
                                </select>
                            </div>
                            <?php if($error_content!=NULL){?>
                            <?php for($i=0; $i<$error_content; $i++){?>
                            <label style="color:#F00;font-size:10px;"><?php echo form_error('quantity['.$i.']');?> </label>
                            <?php }}?>
                            <div class="col-lg-12" id="create">
                            <label style="color:#F00;font-size:10px;"><?php echo form_error('sales_price[]');?></label>
                            <br/>
                                <input type="hidden" id="count" value="0" name="count">
                            </div>

                           
                            <div class="form-group">
                                <label>Discount (%)</label>
                                <input class="form-control" placeholder = "Discount" name="sales_discount" value="<?php echo $sales->overall_discount;?>" type="number" step=".01" min="0" max="100">
                            </div>
                            <label>Sales Date</label>
                            <div class="input-group date" data-provide="datepicker">
                                <input type="text" class="form-control"  id="datepicker" name="sales_date" value="<?php echo $sales->sales_date;?>" required>
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-th"></span>
                                </div>
                            </div>
                            <label style="color:#F00;font-size:10px;"><?php echo form_error('sales_date');?></label>
                            <br/>
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


<script>
    <?php foreach($sales_detail as $value){?>
        // alert(<?php echo json_encode($value->item_name);?>);
        // alert( "Handler for .change() called."+this.value);
        var itemName = <?php echo json_encode($value->item_name);?>;
        var itemPrice = <?php echo json_encode($value->item_price);?>;
        count = document.getElementById('count').value;
        count++;
        var code = '<div class="col-lg-12" style="margin-bottom: 10px"><div class="col-lg-4"><label class="lblItem">'
        +itemName+'</label><input class="form-control item-id" type="hidden" name="item_id[]" value="'+<?php echo json_encode($value->item_id);?>+'">'
        +'<input class="form-control" type="hidden" name="item_name[]" value="'+itemName+'">'
        +'</div><div class="col-lg-2">'
        +'<input class="form-control" placeholder = "Price" name="sales_price[]" value="'+itemPrice+'" required type="hidden">'
        +'<label>MRP '+itemPrice+'/-</label>'
        +'</div><div class="col-lg-2">'
        +'<input class="form-control" placeholder = "Disc" name="discount[]" value="'+<?php echo json_encode($value->individual_discount);?>+'" required></div>'
        +'<div class="col-lg-2">'
        +'<input class="form-control" placeholder = "QTY" name="quantity[]" value="'+<?php echo json_encode($value->quantity);?>+'" required></div>'
        +'<a href="" class="col-lg-1 remove"><i class="fa fa-times fa-lg text-danger" aria-hidden="true"></i></a></div>';

        $('#create').append(code);
        document.getElementById('count').value = count;

        $("#item option[value='"+<?php echo json_encode($value->item_id);?>+"']").remove();
    <?php } ?>  
      
</script>

<script>
        $( "#item" ).change(function() {
          alert( "Handler for .change() called."+this.value);
          // var itemName = $('#item option:selected').text();
          var element = $(this).find('option:selected'); 
          var itemName = element.attr("itemName");

          var quantity = $(this).find('option:selected').attr('quantity');
          count = document.getElementById('count').value;
          var val = $('#item option:selected').val();
              if(val!=0){
                count++;
                var code = '<div class="col-lg-12" style="margin-bottom: 10px"><div class="col-lg-4"><label class="lblItem">'
                +itemName+'</label><input class="form-control item-id" type="hidden" name="item_id[]" value="'+this.value+'">'
                +'<input class="form-control" type="hidden" name="item_name[]" value="'+itemName+'">'
                +'</div><div class="col-lg-2">'
                +'<input class="form-control" placeholder = "Price" name="sales_price[]" required></div>'
                +'<div class="col-lg-2">'
                +'<input class="form-control" placeholder = "Discount" name="discount[]" required value="0"></div><div class="col-lg-2">'
                +'<input class="form-control" placeholder = "QTY" name="quantity[]" required></div><div class="col-lg-1"><label>('+quantity+')</label></div>'
                +'<a href="" class="col-lg-1 remove"><i class="fa fa-times fa-lg text-danger" aria-hidden="true"></i></a></div>';

                      $('#create').append(code);
                        document.getElementById('count').value = count;

                // $("#item option[value='"+this.value+"']").remove();
              }
        });


        
        var salesMode = $('#salesMode option:selected').val();

        if(salesMode == 1){
            $( "#dealer" ).show( 500 );
            $( "#customer" ).hide( 500 );
            $( "#customerId" ).val("");
          }else if (salesMode == 2){
            $( "#customer" ).show( 500 );
            $( "#dealer" ).hide( 500 );
            $( "#dealerId" ).val("");
          }else {
            $( "#customer" ).hide( 500 );
            $( "#dealer" ).hide( 500 );
            $( "#customerId" ).val("");
            $( "#dealerId" ).val("");
        }
        
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



         $( "#warehouseId" ).change(function() {
          // alert( "Handler for .change() called.");

          var warehouseId = $('#warehouseId option:selected').val();
          
          if($('#item').val()!="NULL"){
              $('#item').empty();
          }

          $('#create').empty();

          $('#create').append('<div id="quantity-error"></div><input type="hidden" id="count" value="0" name="count">');

          $.ajax({
              type: "POST",
              url: "<?php echo base_url()?>sales/get_item_by_warehouse_id/",
              data: { 'warehouseId': warehouseId  },
              success: function(data){
                  // Parse the returned json data
                  var opts = $.parseJSON(data);
                  // Use jQuery's each to iterate over the opts value
                  $('#item').append('<option value="">Select Item</option>');

                  $.each(opts, function(i, d) {
                      // You will need to alter the below to get the right values from your json object.  Guessing that d.id / d.modelName are columns in your carModels data
                      $('#item').append('<option itemName="' + d.item_name + '" value="' + d.item_id + '" quantity = "'+ d.quantity +'" itemPrice = "'+d.item_price+'">' +d.part_no+"-"+ d.item_name + '</option>');

                  });
              }
          });


        });



       $('#create').on('click', '.remove', function(e){ //Once remove button is clicked
            e.preventDefault();
             var itemName = $(this).parent('div').find(".lblItem").text();
             var itemId = $(this).parent('div').find('.item-id').val();
             alert(itemId);
             count--;
             document.getElementById('count').value = count;
            $('#item').append('<option value="'+itemId+'">'+itemName+'</option>');
            $(this).parent('div').remove(); //Remove field html

        });

</script>


<?php } ?>