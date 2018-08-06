<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
            <tr>
                <th rowspan="2" style="vertical-align:middle; text-align:center;">Date</th>
                <th colspan="4" style="vertical-align:middle; text-align:center;">Sales</th>
                <th colspan="2" style="vertical-align:middle; text-align:center;">Payment</th>
                <th rowspan="2" style="vertical-align:middle; text-align:center;">Balance</th>
            </tr>
            <tr>
                <th style="vertical-align:middle; text-align:center;">Product</th>
                <th style="vertical-align:middle; text-align:center;">Qty</th>
                <th style="vertical-align:middle; text-align:center;">Rate</th>
                <th style="vertical-align:middle; text-align:center;">Amount</th>
                <th style="vertical-align:middle; text-align:center;">Date</th>
                <th style="vertical-align:middle; text-align:center;">Amount</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($sales as $s_value){?>
           <tr>
           		<td style="vertical-align:middle; text-align:center;"><?php echo $s_value->sales_date;?></td>
           		<td style="vertical-align:middle; text-align:center;"><?php echo $s_value->item_name;?></td>
           		<td style="vertical-align:middle; text-align:center;"><?php echo $s_value->quantity?></td>
           		<td style="vertical-align:middle; text-align:center;"><?php echo $s_value->item_rate;?></td>
           		<td style="vertical-align:middle; text-align:center;"><?php echo $s_value->item_rate*$s_value->quantity;?></td>
       				<td style="vertical-align:middle; text-align:center;"><?php echo $s_value->money_receipt_date;?></td>
       				<td style="vertical-align:middle; text-align:center;"><?php echo $s_value->received_amount;?></td>
           		<td style="vertical-align:middle; text-align:center;">4500</td>
           </tr>
        <?php }?>
        </tbody>
    </table>
</div>