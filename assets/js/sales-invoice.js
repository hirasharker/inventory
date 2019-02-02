/*------------------------------------------------------
    Author : Hira Sharker
---------------------------------------------------------  */

// $( "#customerType" ).change(function() {
//   resetForm();
//   var val = $('#customerType option:selected').val();
//   if(val == 1){
//     $( "#dealer" ).show( 500 );
//     $( "#customer" ).hide( 500 );
//     $( "#salesOrderId" ).hide(500);
//     $( "#customerId" ).val("");
//     $( "#orderId" ).val("");
//   }else if (val == 2){
//     $( "#customer" ).show( 500 );
//     $( "#dealer" ).hide( 500 );
//     $( "#salesOrderId" ).hide(500);
//     $( "#dealerId" ).val("");
//     $( "#orderId" ).val("");
//   }else if (val == 4){
//     $( "#salesOrderId" ).show(500);
//   }else {
//     $( "#customer" ).hide( 500 );
//     $( "#dealer" ).hide( 500 );
//     $( "#salesOrderId" ).hide(500);
//     $( "#customerId" ).val("");
//     $( "#dealerId" ).val("");
//   }
// }); // customerType.change..........

$("#salesAgainstOrder").click( function(){
  if( $(this).is(':checked') ) {
    // $('#customerType').val('');
    // $('#customerType').prop('disabled',true);
    resetForm();
    disableInputFields();
    $( "#salesOrderId" ).show(500);
  }else {
    // $('#customerType').val('');
    // $('#customerType').prop('disabled',false);
    resetForm();
  }
   

});

$( "#orderId" ).change(function() {
  // alert( "Handler for .change() called.");
  var orderId = $('#orderId option:selected').val();
  if(orderId != ''){

    count = document.getElementById('count').value;

    $('#create').empty();

    $('#create').append('<div id="quantity-error"></div><input type="hidden" id="count" value="0" name="count">');

    if(count == 0){
      var itemSummary  = '<div class="col-lg-12" style="margin-top: 10px;border-top: 1px dotted #09192a;" id="itemSummary">'
     
      +'<div class="col-lg-2"><label class="lblItem">Sub Total</label></div>'
      +'<div class="col-lg-1"><input style="background: rgba(0,0,0,0); border : none;" type="text" disabled id="sub-total" value="0"/></div>'
       +'<div class="col-lg-2"><label class="lblItem">VAT</label></div>'
      +'<div class="col-lg-1"><input style="background: rgba(0,0,0,0); border : none;" type="text" disabled id="vat" value="0"/></div>'
      +'<div class="col-lg-2"><label class="lblItem">Discount</label></div>'
      +'<div class="col-lg-1"><input style="background: rgba(0,0,0,0); border : none;" type="text" disabled id="discount-summary" value="0"/></div>'
       +'<div class="col-lg-2"><label class="lblItem">Total Price</label></div>'
      +'<div class="col-lg-1"><input style="background: rgba(0,0,0,0); border : none;" type="text" disabled id="total-price" value="0"/></div>'
      +'</div>';
      
      $('#item-summary').append(itemSummary);
    }

    getSalesOrder(orderId);
    getSalesOrderDetail(orderId);

   
  }else {
    resetForm();
    disableInputFields();
     $('#salesOrderId').show("500");
  }

}); //orderId.change................



$( ".reset" ).click(function() {
  resetForm();
});

function processSalesOrder(salesOrder){
  $('#warehouseId').val(salesOrder.warehouse_id);
  $('#discount').val(salesOrder.overall_discount);
  $( "#orderDateContainer" ).show( 500 );
  $('#orderDate').val(salesOrder.sales_order_date);
  if(salesOrder.customer_id!= "0"){
    $('#customerId').val(salesOrder.customer_id);
    $('#customerId').trigger('change');
    $( "#customer" ).show( 500 );
  }else{
    $( "#customer" ).hide( 500 );
    $('#customerId').val("0");
    $('#customerId').trigger('change');
  }
  // if(salesOrder.dealer_id!= "0"){
  //   $( "#dealer" ).show( 500 );
  //   $('#dealerId').val(salesOrder.dealer_id);
  //   $('#dealerId').trigger('change');
  // }else{
  //   $( "#dealer" ).hide( 500 );
  //   $('#dealerId').val("0");
  //   $('#dealerId').trigger('change');
  // }
  $('#sub-total').val(salesOrder.total_price);
 
}
function resetForm(){
  setDefaultValue();
  enableInputFields();
}

function disableInputFields(){
  $('#warehouseId').prop('disabled',true);
  $('#discount').prop('readonly',true);
  $('#orderDate').prop('disabled',true);
  $('#customerId').prop('disabled',true);
  // $('#dealerId').prop('disabled',true);
  $('#item').prop('disabled',true);
}

function enableInputFields(){
  $('#warehouseId').prop('disabled',false);
  $('#discount').prop('readonly',false);
  $('#customerId').prop('disabled',false);
  // $('#dealerId').prop('disabled',false);
  $('#item').prop('disabled',false);
}

function setDefaultValue (){
  $('#orderId').val('');
  // $('#orderId').trigger('change');
  $('#warehouseId').val('');
  $('#discount').val('0');
  $('#datepicker').val('');
  $('#customerId').val('0');
  $('#customerId').trigger('change');
  // $('#dealerId').val('0');
  // $('#dealerId').trigger('change');
  $('#item').val('0');
  // $("#customer").hide( 500 );
  // $("#dealer").hide( 500 );
  $("#salesOrderId").hide( 500 );
  $("#orderDateContainer").hide( 500 );

  $('#create').empty();

  $('#create').append('<div id="quantity-error"></div><input type="hidden" id="count" value="0" name="count">');

  $('#itemSummary').remove();
}






