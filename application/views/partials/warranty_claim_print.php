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
    <link href="<?php echo base_url();?>assets/invoice_css/warranty-claim.css" rel="stylesheet" />
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

      <h2>Warranty Claim</h2>
      <h3>Sales Return</h3>
      <div id="header">
        <div class="left">
          <table border="0">
            <tr>
              <th rowspan="6" style="vertical-align:top;"></th>
            </tr>
          </table>
          <br>
          <table border="0">
            <!-- <tr>
              <td style="padding-left: 10px; text-align: left;">Chittagong.</td>
            </tr> -->
            <tr>
              <th style="vertical-align:top;">Customer Name</th>
              <th style="padding-left: 10px; text-align: left;"><?php echo $warranty_claim->customer_name; ?></th>
            </tr>
            <tr>
              <td></td>
              <td style="padding-left: 10px; text-align: left;">Tongi, Gazipur</td>
            </tr>
            <tr>
              <td></td>
              <td style="padding-left: 10px; text-align: left;">Phone: </td>
            </tr>
            <tr>
              <td><b>Engine No:</b></td>
              <td><?php echo $warranty_claim->engine_no; ?></td>
            </tr>
            <tr>
              <td><b>Chassis No:</b></td>
              <td><?php echo $warranty_claim->chassis_no; ?></td>
            </tr>
          </table>
        </div>

        <div class="right">
          <table border="0">
            <tr>
              <td >Claim Date: </td>
              <td style="padding-left: 10px;"><?php echo $warranty_claim->warranty_claim_date; ?></td>
            </tr>
            <tr>
              <td>Claim No:</td>
              <td style="padding-left: 10px;"> <?php echo $warranty_claim->warranty_claim_id; ?></td>
            </tr>
          </table>
        </div>
      </div><!-- header -->
      <div id="content">
        <table >
          <tr>
            <th style="font-size: 8pt !important;">SL #</th>
            <th style="font-size: 8pt !important;">Item Detail</th>
            <th style="font-size: 8pt !important;">Rate<br/>(in BDT)</th>
            <th style="font-size: 8pt !important;">Quantity/Unit</th>
            <th style="font-size: 8pt !important;">Unit</th>
            <th style="font-size: 8pt !important;">Amount <br/>(in BDT)</th>
          </tr>
        
        <?php $i=1; foreach($warranty_claim_detail as $value){?>
          <tr>
            <td style="font-size: 8pt !important;"><?php echo $i;?></td>
            <td style="font-size: 8pt !important;"><?php echo $value->part_no.' - '.$value->item_name;?></td>
            <td style="font-size: 8pt !important;"><?php echo $value->item_price;?></td>
            <td style="font-size: 8pt !important;"><?php echo $value->quantity;?></td>
            <td style="font-size: 8pt !important;"><?php echo $value->unit;?></td>
            <td style="font-size: 8pt !important;"><?php echo $value->item_price * $value->quantity;?></td>
          </tr>
        <?php $i++; }?>
          
          <tr>
            <td colspan="2" style="text-align: right;"><b></b></td>
            <td style="text-align: right;" ><b>30  pcs</b></td>
            <td colspan="2" style="text-align: right;"><b>Claim Total:</b></td>
            <td><b><?php echo $price_detail->total_price;?></b></td>
          </tr>
        </table>
      </div>
      <div id="footer">
        <!-- <p>Amount Chargeable (in word): (in BDT) <?php echo $total_in_words;?> Only.</p> -->
        <table width="100%">
          <tr>
            <td style="width : 25%">Narration</td>
            <!-- <td style="width : 45%; text-align: right;">&nbsp;&nbsp;&nbsp; <?php echo $total_in_words; ?></td> -->
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