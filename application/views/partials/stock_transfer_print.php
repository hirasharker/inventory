<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Inventory Management by Hira Sharker</title>
    <!-- Bootstrap Styles-->
     <!-- FontAwesome Styles-->
    <link href="<?php echo base_url();?>assets/css/font-awesome.css" rel="stylesheet" />
        <!-- Custom Styles-->
    <link href="<?php echo base_url();?>assets/invoice_css/custom.css" rel="stylesheet" />
     <!-- Google Fonts-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

</head>
<body>
    <div id="wrapper">
      <div id="banner">
        <div id="title">
          <div id="logo">
            <img src="<?php echo base_url(); ?>files/simpleLogo.png" alt="logo">
          </div>
          <h1>IFAD MOTORS LTD</h1>
        </div>
        <p>Kagojipukur Bazar, Benapole, Jessore. Mobile : 01966670891</p>
        <p>Corporate Office : Sonartori Tower (13th- 18th fl), 12 Biponon C/A, Sonargaon Road, Dhaka -1000</p>
        <hr>
      </div>

      <h2>Stock Transfer</h2>
      <div id="header">
        <div class="left">
          <table border="0">
          <?php foreach($warehouse_list as $w_value){ if($w_value->warehouse_id == $stock_transfer->previous_warehouse_id){ ?> 
            <tr>
              <th rowspan="6" style="vertical-align:top;">Source Depot: </th>
              <th style="padding-left: 10px; text-align: left;"><?php echo $w_value->warehouse_name; ?></th>
            </tr>
            <tr>
              <td style="padding-left: 10px; text-align: left;"><?php echo $w_value->warehouse_location;?></td>
            </tr>
            <tr>
              <td style="padding-left: 10px; text-align: left;">Phone: </td>
            </tr>
          <?php } }?>
          </table>
          <table border="0">
            <!-- <tr>
              <td style="padding-left: 10px; text-align: left;">Chittagong.</td>
            </tr> -->
          <?php foreach($warehouse_list as $w_value){ if($w_value->warehouse_id == $stock_transfer->current_warehouse_id){ ?> 
            <tr>
              <th rowspan="6" style="vertical-align:top;">Destination Depot: </th>
              <th style="padding-left: 10px; text-align: left;"><?php echo $w_value->warehouse_name; ?></th>
            </tr>
            <tr>
              <td style="padding-left: 10px; text-align: left;"><?php echo $w_value->warehouse_location;?></td>
            </tr>
            <tr>
              <td style="padding-left: 10px; text-align: left;">Phone: </td>
            </tr>
          <?php } }?>
          </table>
        </div>
        <div class="right">
          <table border="0">
            <tr>
              <td >Date: </td>
              <td style="padding-left: 10px;"><?php echo $stock_transfer->stock_transfer_date;?></td>
            </tr>
            <tr>
              <td>Transfer No:</td>
              <td style="padding-left: 10px;">Sl#<?php echo $stock_transfer->stock_transfer_id;?></td>
            </tr>
          </table>
        </div>
      </div><!-- header -->
      <div id="content">
        <table>
          <tr>
            <th>SL #</th>
            <th>Item Detail</th>
            <th>Quantity/Unit</th>
            <th>Rate<br/>(in BDT)</th>
            <th>Unit</th>
            <th>Amount <br/>(in BDT)</th>
          </tr>
        <?php $i=1; foreach($stock_transfer_detail as $value){?>
          <tr>
            <td><?php echo $i;?></td>
            <td><?php echo $value->item_name;?></td>
            <td><?php echo $value->quantity;?></td>
            <td><?php echo $value->item_price;?></td>
            <td>Pcs</td>
            <td><?php echo ($value->item_price*$value->quantity); ?></td>
          </tr>
        <?php $i++; }?>
          
          <tr>
            <td colspan="2" style="text-align: right;"><b>Sub Total:</b></td>
            <td style="text-align: right;" ><b><?php echo $stock_transfer_summary->total_quantity; ?>  pcs</b></td>
            <td colspan="2" style="text-align: right;"><b>Sub Total:</b></td>
            <td><b><?php echo $stock_transfer_summary->sub_total; ?></b></td>
          </tr>
          <tr>
            <td style="border-right: none"></td>
            <td style="text-align: right; width: 39.88%; border-left: none;"><b>Transferred Total:</b></td>
            <td  colspan="2" style="text-align: right; width: 42.3%"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td  style="text-align: right;"><?php echo $stock_transfer_summary->sub_total; ?></td>
          </tr>
          <tr>
            <td style="border-right: none"></td>
            <!-- <td style="text-align: right; width: 39.88%; border-left: none; border-right:none;"><b>Transferred Total:</b></td> -->
           
          </tr>
        </table>
      </div>
      <div id="footer">
        <!-- <p>Amount Chargeable (in word): (in BDT) <?php echo $total_in_words;?> Only.</p> -->
        <table width="100%">
          <tr>
            <td style="width : 25%">Narration</td>
            <td style="width : 45%; text-align: right;">&nbsp;&nbsp;&nbsp; <?php echo $total_in_words; ?></td>
            <td style="text-align: right; width:30%"><b></b>&nbsp; </td>
          </tr>
          <tr>
          <!-- <?php if(isset($customer)){?>
            <td colspan="2" style="width : 70%; padding-bottom: .4in; padding-top: .2in;"><b>For&nbsp;<?php echo $stock_transfer->customer_name;?></b></td>
          <?php } elseif (isset($dealer)) {?>
            <td colspan="2" style="width : 70%; padding-bottom: .4in; padding-top: .2in;"><b>For&nbsp;<?php echo $stock_transfer->dealer_name;?></b></td>
          <?php }?> -->
            <!-- <td style="width : 30%; text-align: right;"><b>for <?php echo $company_detail->company_name;?></b></td> -->
          </tr>
        </table>
        <table width="100%" style="margin-top: .4in;">
           <tr>
           <!-- <?php if(isset($customer)){?>
            <td style="width : 15%; text-align: left; border-top: 2px solid #000;"><b>Customer Signature</b></td>
          <?php } elseif (isset($dealer)) {?>
            <td style="width : 15%; text-align: left; border-top: 2px solid #000;"><b>Dealer Signature</b></td>
          <?php }?> -->
            <td style="width : 70%; color: #FFF">..........................................................................</td>
            <td style="width : 15%; text-align: center; border-top: 2px solid #000;">Authorised Signature</td>
          </tr>
        </table>
        <!-- <p>Declaration: SOLD GOODS ARE NOT TAKEN BACK, NB: THE PAYMENT BY CHEQUE ONLY</p> -->
      </div>
    </div><!-- wrapper -->
</body>

</html>