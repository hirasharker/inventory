<?php if($warranty_claim==NULL){?>
<div class="row">
    <div class="col-md-12">
        <h1 class="page-header">
            Add Warranty Claim <small>create new claim</small>
        </h1>
    </div>
</div> 
 <!-- /. ROW  -->
<div class="row">
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            Insert warranty claim Information..
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-8">
                    <form role="form" method="post" action="<?php echo base_url();?>warranty_claim/add_warranty_claim" enctype="multipart/form-data">
                        <?php if($this->session->userdata('error') != NULL){ ?>
                        <div class="form-group">
                            <label style="color: #F00 !important;"><?php echo $this->session->userdata('error'); $this->session->unset_userdata('error'); ?> </label>
                        </div>
                        <?php } ?>
                      <!-- <form role="form" method="get" action="#" enctype="multipart/form-data"> -->
                        <div class="form-group">
                            <label>Mode of Claim</label>
                            <select class="form-control" id="claimMode" name="claim_mode">
                                <option value="1" >Claim against sold parts</option>
                                <option value="2" >Claim against sold vehicle</option>
                            </select>
                        </div>

                        <div class="form-group" id="engineNoContainer" style="display: none;">
                            <label>Engine No</label>
                            <input class="form-control" placeholder = "Engine No" name="engine_no" id="engineNo">
                        </div>
                        <div class="form-group" id="chassisNoContainer" style="display: none;">
                            <label>Chassis No</label>
                            <input class="form-control" placeholder = "Chassis No" name="chassis_no" id="chassisNo">
                        </div>
                        <div class="form-group" id="customerContainer" style="display: none;">
                            <label>Select Customer</label>
                            <select class="form-control" name="customer_id" id="customerId" style="width: 100% !important;">
                                <?php foreach($customer_list as $value){?>
                                <option customerName="<?php echo $value->customer_name
                                ;?>" value="<?php echo $value->customer_id
                                ;?>"><?php echo $value->customer_id.' - '.$value->customer_name;?></option>
                                <?php }?>
                            </select>
                        </div>
                        <input id="customerName" type="hidden" name="customer_name" value="">

                        <div class="form-group" id="salesIdContainer">
                            <label>Sales Invoice</label>
                            <select class="form-control" name="sales_id" id="sales-id" required>
                                <option value="0">Select Invoice</option>
                                <?php foreach($sales_list as $value){?>
                                <option customerId="<?php echo $value->customer_id;?>" customerName="<?php echo $value->customer_name;?>" value="<?php echo $value->sales_id;?>" ><?php echo $value->sales_id;?></option>
                                <?php }?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Select Warehouse</label>
                            <select class="form-control" name="warehouse_id">
                                <?php foreach($warehouse_list as $value){?>
                                <option value="<?php echo $value->warehouse_id;?>"><?php echo $value->warehouse_name;?></option>
                                <?php }?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Select Item</label>
                            <select class="form-control" name="item_id" id="item" >
                                <?php foreach($item_list as $value){?>
                                <!-- <option value="<?php echo $value->item_id;?>"><?php echo $value->part_no.' - '.$value->item_name;?></option> -->
                                <?php }?>
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
                        <div class="col-lg-12" id="item-summary">
                            
                        </div>

                        <!-- <div class="form-group">
                            <label>Serial No</label>
                            <input class="form-control" placeholder = "Serial No" name="item_serial_no" >
                        </div> -->

                        <div class="form-group">
                            <label>Type of Claim</label>
                            <select class="form-control" name="warranty_claim_type_id" required>
                                <?php foreach($wc_type_list as $value){?>
                                <option value="<?php echo $value->warranty_claim_type_id;?>"><?php echo $value->warranty_claim_type_name;?></option>
                                <?php }?>
                            </select>
                        </div>


                        <div class="form-group">
                          <label>Upload Document </label>
                            <input type="file" class="form-control" name="document_path">
                        </div>

                        <div class="form-group">
                            <label>Buyer Complain</label>
                            <textarea class="form-control" rows="2" name="buyer_complain" required></textarea>
                        </div>

                        <div class="form-group">
                            <label>Observation & Analysis</label>
                            <textarea class="form-control" rows="2" name="observation_note" required></textarea>
                        </div>

                        <label>Date of Claim</label>
                        <div class="input-group date" data-provide="datepicker">
                            <input type="text" class="form-control"  id="datepicker" name="warranty_claim_date" required >
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                        </div>

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

    



    $( "#sales-id" ).change(function() {
    // alert( "Handler for .change() called.");
      $( ".item-header" ).remove();
      $( ".item-summary" ).remove();
      $( ".item-list" ).remove();
      var count = 0;
      document.getElementById('count').value = count;
      var customerId = $(this).find('option:selected').attr('customerId');
      document.getElementById('customerId').value = customerId;
      var customerName = $(this).find('option:selected').attr('customerName');
      document.getElementById('customerName').value = customerName;
      // $('#item').empty();
      var salesId = $('#sales-id option:selected').val();

      if($('#item').val()!="NULL"){
          $('#item').empty();
      }
      $.ajax({
          type: "POST",
          url: "<?php echo base_url()?>warranty_claim/ajax_get_item_list_by_sales_id/",
          data: { 'sales_id': salesId  },
          success: function(data){
              // Parse the returned json data
              var opts = $.parseJSON(data);
              // Use jQuery's each to iterate over the opts value
              $('#item').append('<option value="">Select Item</option>');
              $.each(opts, function(i, d) {
                  // You will need to alter the below to get the right values from your json object.  Guessing that d.id / d.modelName are columns in your carModels data
                  $('#item').append('<option value="' + d.item_id + '" itemName="' + d.item_name + '" partNo="' + d.part_no + '"  itemPrice="' + d.item_price + '" stockQuantity="' + d.quantity + '" data-quantity = "'+ d.quantity +'">' +d.part_no+"-"+ d.item_name + '</option>');
              });
            }
        });
    }); // sales-id.change...............
    $('#customerId').change(function() {
        var customerName    =   $(this).find(':selected').attr('customerName');
        document.getElementById('customerName').value = customerName;
    }); //customerId.change

    $('#item').change(function() {
        var quantity    =   $(this).find(':selected').attr('data-quantity');

        $('#quantity').attr("max",quantity);
    });
</script>

<?php } else {?>

<div class="row">
    <div class="col-md-12">
        <h1 class="page-header">
            Edit Warranty Claim <small>edit claim</small>
        </h1>
    </div>
</div> 
 <!-- /. ROW  -->
<div class="row">
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            Change warranty claim Information..
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-5">
                    <form role="form" method="post" action="<?php echo base_url();?>warranty_claim/update_warranty_claim" enctype="multipart/form-data">
                        <input type="hidden" value="<?php echo $warranty_claim->warranty_claim_id; ?>" name="warranty_claim_id">

                        <?php if($this->session->userdata('error') != NULL){ ?>
                        <div class="form-group">
                            <label style="color: #F00 !important;"><?php echo $this->session->userdata('error'); $this->session->unset_userdata('error'); ?> </label>
                        </div>
                        <?php } ?>

                        <div class="form-group">
                            <label>Mode of Claim</label>
                            <select class="form-control" id="claimMode" name="claim_mode">
                                <option value="2" >Claim against sold vehicle</option>
                                <option value="1" >Claim against sold parts</option>
                            </select>
                        </div>

                        <div class="form-group" id="engineNoContainer" style="display: none;">
                            <label>Engine No</label>
                            <input class="form-control" placeholder = "Engine No" name="engine_no" id="engineNo" value="<?php echo $warranty_claim->engine_no; ?>" >
                        </div>
                        <div class="form-group" id="chassisNoContainer" style="display: none;">
                            <label>Chassis No</label>
                            <input class="form-control" placeholder = "Chassis No" name="chassis_no" id="chassisNo" value="<?php echo $warranty_claim->chassis_no; ?>">
                        </div>
                        <div class="form-group" id="customerContainer" style="display: none;">
                            <label>Select Customer</label>
                            <select class="form-control" name="customer_id" id="customerId" style="width: 100% !important;">
                                <?php foreach($customer_list as $value){?>
                                <option customerName="<?php echo $value->customer_name
                                ;?>" value="<?php echo $value->customer_id
                                ;?>"><?php echo $value->customer_id.' - '.$value->customer_name;?></option>
                                <?php }?>
                            </select>
                        </div>
                        <input id="customerName" type="hidden" name="customer_name" value="">

                        <div class="form-group" id="salesIdContainer">
                            <label>Sales Invoice</label>
                            <select class="form-control" name="sales_id" id="sales-id" required>
                                <option value="0">Select Invoice</option>
                                <?php foreach($sales_list as $value){?>
                                <option customerId="<?php echo $value->customer_id;?>" customerName="<?php echo $value->customer_name;?>" value="<?php echo $value->sales_id;?>" ><?php echo $value->sales_id;?></option>
                                <?php }?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Select Item</label>
                            <select class="form-control" name="item_id" id="item" >
                                <?php foreach($item_list as $value){?>
                                <!-- <option value="<?php echo $value->item_id;?>"><?php echo $value->part_no.' - '.$value->item_name;?></option> -->
                                <?php }?>
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
                        <div class="col-lg-12" id="item-summary">
                            
                        </div>

                        <!-- <div class="form-group">
                            <label>Serial No</label>
                            <input class="form-control" placeholder = "Serial No" name="item_serial_no" >
                        </div> -->

                        <div class="form-group">
                            <label>Type of Claim</label>
                            <select class="form-control" name="warranty_claim_type_id" required>
                                <?php foreach($wc_type_list as $value){?>
                                <option value="<?php echo $value->warranty_claim_type_id;?>" <?php if ($value->warranty_claim_type_id == $warranty_claim->warranty_claim_type_id) { echo 'selected'; } ?> ><?php echo $value->warranty_claim_type_name;?></option>
                                <?php }?>
                            </select>
                        </div>


                        <div class="form-group">
                          <label>Replace Document </label>
                            <input type="file" class="form-control" name="document_path">
                            <img src="<?php echo base_url().'files/'.$warranty_claim->document_path; ?>" alt="not found!" width = "50px">
                        </div>

                        <div class="form-group">
                            <label>Buyer Complain</label>
                            <textarea class="form-control" rows="2" name="buyer_complain" required><?php echo $warranty_claim->buyer_complain; ?></textarea>
                        </div>

                        <div class="form-group">
                            <label>Observation & Analysis</label>
                            <textarea class="form-control" rows="2" name="observation_note" required><?php echo $warranty_claim->observation_note; ?></textarea>
                        </div>

                        <label>Date of Claim</label>
                        <div class="input-group date" data-provide="datepicker">
                            <input type="text" class="form-control"  id="datepicker" name="warranty_claim_date" required value="<?php echo $warranty_claim->warranty_claim_date; ?>">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                        </div>

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
    <?php if($warranty_claim->claim_mode == 2){ ?>
      $( "#claimMode" ).val("2");
      $( "#salesIdContainer" ).hide( 500 );
      $( "#engineNoContainer" ).show( 500 );
      $( "#chassisNoContainer" ).show( 500 );
      $( "#customerContainer" ).show( 500 );
      $( "#sales-id" ).val("");
      $( "#sales-id" ).change();
      $( "#engineNo" ).attr("required",true);
      $( "#chassisNo" ).attr("required",true);
      $( "#sales-id" ).removeAttr("required");
      $.ajax({
        type: "POST",
        url: "<?php echo base_url()?>warranty_claim/ajax_get_all_items/",
        data: {},
        success: function(data){
            // Parse the returned json data
            $('#item').append('<option value="">Select Item</option>');
            var opts = $.parseJSON(data);
            // Use jQuery's each to iterate over the opts value
            $.each(opts, function(i, d) {
                // You will need to alter the below to get the right values from your json object.  Guessing that d.id / d.modelName are columns in your carModels data
                $('#item').append('<option value="' + d.item_id + '" itemName="' + d.item_name + '" partNo="' + d.part_no + '"  itemPrice="' + d.item_price + '" stockQuantity="' + d.quantity + '" data-quantity = "'+ d.quantity +'">' +d.part_no+"-"+ d.item_name + '</option>');
            });
          }
      }); //ajax.............
    <?php } else { ?>
      $( "#claimMode" ).val("1");
      $( "#engineNoContainer" ).hide( 500 );
      $( "#chassisNoContainer" ).hide( 500 );
      $( "#customerContainer" ).hide( 500 );
      $( "#salesIdContainer" ).show( 500 );
      $( "#sales-id" ).val("<?php echo $warranty_claim->sales_id; ?>");
      $( "#sales-id" ).change();
      $( "#engineNo" ).val("");
      $( "#chassisNo" ).val("");
      $( "#customerId" ).val("");
      $( "#item" ).empty();
      $( "#engineNo" ).removeAttr("required");
      $( "#chassisNo" ).removeAttr("required");
      $( "#sales-id" ).attr("required",true);

      var salesId = $('#sales-id option:selected').val();

      if($('#item').val()!="NULL"){
          $('#item').empty();
      }
      $.ajax({
          type: "POST",
          url: "<?php echo base_url()?>warranty_claim/ajax_get_preloaded_item_list_by_sales_id/",
          data: { 'sales_id': salesId  },
          success: function(data){
              // Parse the returned json data
              var opts = $.parseJSON(data);
              // Use jQuery's each to iterate over the opts value
              $('#item').append('<option value="">Select Item</option>');

              $.each(opts, function(i, d) {
                  // You will need to alter the below to get the right values from your json object.  Guessing that d.id / d.modelName are columns in your carModels data
                  $('#item').append('<option value="' + d.item_id + '" itemName="' + d.item_name + '" itemPrice="' + d.item_price + '" stockQuantity="' + d.quantity + '" data-quantity = "'+ d.quantity +'">' +d.part_no+"-"+ d.item_name + '</option>');

              });
            }
        });
    <?php } ?>
    $( "#sales-id" ).change(function() {
    // alert( "Handler for .change() called.");
      var salesId = $('#sales-id option:selected').val();

      if($('#item').val()!="NULL"){
          $('#item').empty();
      }

      $.ajax({
          type: "POST",
          url: "<?php echo base_url()?>warranty_claim/ajax_get_item_list_by_sales_id/",
          data: { 'sales_id': salesId  },
          success: function(data){
              // Parse the returned json data
              var opts = $.parseJSON(data);
              // Use jQuery's each to iterate over the opts value
              $('#item').append('<option value="">Select Item</option>');

              $.each(opts, function(i, d) {
                  // You will need to alter the below to get the right values from your json object.  Guessing that d.id / d.modelName are columns in your carModels data
                  $('#item').append('<option value="' + d.item_id + '" itemName="' + d.item_name + '" itemPrice="' + d.item_price + '" stockQuantity="' + d.quantity + '" data-quantity = "'+ d.quantity +'">' +d.part_no+"-"+ d.item_name + '</option>');

              });
            }
        });
    }); // warehouseId.change...............

    $('#item').change(function() {
        var quantity    =   $(this).find(':selected').attr('data-quantity');

        $('#quantity').attr("max",quantity);
    });
</script>

<script type="text/javascript">
  <?php foreach($warranty_claim_detail as $value){ ?>
      var itemId   =    <?php echo json_encode($value->item_id);?>;
      var itemName = <?php echo json_encode($value->item_name);?>;
      var itemPrice = <?php echo json_encode($value->item_price);?>;
      var partNo = <?php echo json_encode($value->part_no);?>;
      var stockQuantity = <?php echo json_encode($value->stock_quantity);?>;
      count = document.getElementById('count').value;
      if(count == 0){
        var itemHeader  = '<div class="col-lg-12 item-header" style="margin-bottom: 10px;border-bottom: 2px solid #09192a;" id="itemHeader">'
        +'<div class="col-lg-4"><label class="lblItem">Name</label></div>'
        +'<div class="col-lg-2"><label class="lblItem">Price</label></div>'
        +'<div class="col-lg-2"><label class="lblItem"></label></div>'
        +'<div class="col-lg-2"><label class="lblItem">QTY</label></div>'
        +'<div class="col-lg-1"><label class="lblItem">Stock</label></div>'
        +'</div>';
        
        $('#create').append(itemHeader);
      }

      count++;
      var code = '<div class="col-lg-12 item-list" style="margin-bottom: 10px"><div class="col-lg-4"><label class="lblItem">'
          +itemName+'</label><input class="form-control item-id" type="hidden" name="item_id[]" value="'+itemId+'">'
          +'<input class="form-control" type="hidden" name="item_name[]" value="'+itemName+'">'
          +'<input class="form-control part-no" type="hidden" name="part_no[]" value="'+partNo+'">'
          +'</div><div class="col-lg-2">'
          +'<input class="form-control item-price" placeholder = "Price" name="item_price[]" value="'+itemPrice+'" required type="hidden" >'
          +'<label>MRP '+itemPrice+'/-</label></div>'
          +'<div class="col-lg-2">'
          +'<input class="form-control stock-quantity" type="hidden" value="'+stockQuantity+'">'
          +'<input class="form-control" placeholder = "Discount" name="discount[]" required value="0" type="hidden"></div>'
          +'<input class="col-lg-2 qty" type="number" max="'+stockQuantity+'" placeholder = "QTY" name="quantity[]" value="'+<?php echo json_encode($value->quantity); ?>+'" required><div class="col-lg-1"><label>('+stockQuantity+')</label></div>'
          +'<a href="" class="col-lg-1 remove"><i class="fa fa-times fa-lg text-danger" aria-hidden="true"></i></a></div>';

      $('#create').append(code);
      document.getElementById('count').value = count;

      $("#item option[value='"+<?php echo json_encode($value->item_id);?>+"']").remove();
  <?php }?>
</script>



<?php }?>


<script type="text/javascript">
  
  $( "#item" ).change(function(){
    // alert( "Handler for .change() called."+this.value);
    // var itemName = $('#item option:selected').text();
    var element = $(this).find('option:selected'); 
    var itemName = element.attr("itemName");
    var partNo = element.attr("partNo");

    var itemPrice = $(this).find('option:selected').attr('itemPrice');
    var stockQuantity = $(this).find('option:selected').attr('stockQuantity');
    count = document.getElementById('count').value;
    if(count == 0){
      var itemHeader  = '<div class="col-lg-12 item-header" style="margin-bottom: 10px;border-bottom: 2px solid #09192a;" id="itemHeader">'
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
          var code = '<div class="col-lg-12 item-list" style="margin-bottom: 10px"><div class="col-lg-4"><label class="lblItem">'
          +itemName+'</label><input class="form-control item-id" type="hidden" name="item_id[]" value="'+this.value+'">'
          +'<input class="form-control" type="hidden" name="item_name[]" value="'+itemName+'">'
          +'<input class="form-control part-no" type="hidden" name="part_no[]" value="'+partNo+'">'
          +'</div><div class="col-lg-2">'
          +'<input class="form-control item-price" placeholder = "Price" name="item_price[]" value="'+itemPrice+'" required type="hidden" >'
          +'<label>MRP '+itemPrice+'/-</label></div>'
          +'<div class="col-lg-2">'
          +'<input class="form-control stock-quantity" type="hidden" value="'+stockQuantity+'">'
          +'<input class="form-control" placeholder = "Discount" name="discount[]" required value="0" type="hidden"></div>'
          +'<input class="col-lg-2 qty" type="number" max="'+stockQuantity+'" placeholder = "QTY" name="quantity[]" required><div class="col-lg-1"><label>('+stockQuantity+')</label></div>'
          +'<a href="" class="col-lg-1 remove"><i class="fa fa-times fa-lg text-danger" aria-hidden="true"></i></a></div>';

          if(this.value != 0){
               $('#create').append(code);
                  document.getElementById('count').value = count;
          }

          $("#item option[value='"+this.value+"']").remove();
      }
  }); //item.change..............


  $('#create').on('click', '.remove', function(e){ //Once remove button is clicked
      e.preventDefault();
       var itemName = $(this).parent('div').find(".lblItem").text();
       var partNo = $(this).parent('div').find(".part-no").val();
       var itemPrice = $(this).parent('div').find(".item-price").val();
       var itemId = $(this).parent('div').find('.item-id').val();
       var stockQuantity = $(this).parent('div').find('.stock-quantity').val();

       count--;
       document.getElementById('count').value = count;
      $('#item').append('<option value="'+itemId+'" itemName ="'+itemName+'" partNo ="'+partNo+'"itemPrice="'+itemPrice+'" stockQuantity="'+stockQuantity+'">'+partNo+' - '+itemName+'</option>');
      $(this).parent('div').remove(); //Remove field html
      if(count == 0){
        $('#itemHeader').remove();
      }
  }); //create.on('click', '.remove', function(e).............
</script>

<script type="text/javascript">
  $( "#claimMode" ).change(function() {
      // alert( "Handler for .change() called."+this.value);
      var count = 0;
      document.getElementById('count').value = count;
      var val = $('#claimMode option:selected').val();
      $( ".item-header" ).remove();
      $( ".item-summary" ).remove();
      $( ".item-list" ).remove();
      if(val == 1){
        $( "#engineNoContainer" ).hide( 500 );
        $( "#chassisNoContainer" ).hide( 500 );
        $( "#customerContainer" ).hide( 500 );
        $( "#salesIdContainer" ).show( 500 );
        $( "#engineNo" ).val("");
        $( "#chassisNo" ).val("");
        $( "#customerId" ).val("");
        $( "#item" ).empty();
        $( "#engineNo" ).removeAttr("required");
        $( "#chassisNo" ).removeAttr("required");
        $( "#sales-id" ).attr("required",true);
      }else {
        $( "#salesIdContainer" ).hide( 500 );
        $( "#engineNoContainer" ).show( 500 );
        $( "#chassisNoContainer" ).show( 500 );
        $( "#customerContainer" ).show( 500 );
        $( "#sales-id" ).val("");
        $( "#sales-id" ).change();
        $( "#engineNo" ).attr("required",true);
        $( "#chassisNo" ).attr("required",true);
        $( "#sales-id" ).removeAttr("required");
        $.ajax({
          type: "POST",
          url: "<?php echo base_url()?>warranty_claim/ajax_get_all_items/",
          data: {},
          success: function(data){
              // Parse the returned json data
              $('#item').append('<option value="">Select Item</option>');
              var opts = $.parseJSON(data);
              // Use jQuery's each to iterate over the opts value
              $.each(opts, function(i, d) {
                  // You will need to alter the below to get the right values from your json object.  Guessing that d.id / d.modelName are columns in your carModels data
                  $('#item').append('<option value="' + d.item_id + '" itemName="' + d.item_name + '" partNo="' + d.part_no + '"  itemPrice="' + d.item_price + '" stockQuantity="' + d.quantity + '" data-quantity = "'+ d.quantity +'">' +d.part_no+"-"+ d.item_name + '</option>');
              });
            }
        }); //ajax.............
      }
    });
</script>
