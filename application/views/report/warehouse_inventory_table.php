<table class="table table-striped table-bordered table-hover text-center" id="dataTables-example" >
    <thead>
        <tr>
            <th class="text-center" colspan="3">Item Detail</th>
            <th class="text-center">Purchase</th>
            <th class="text-center">Sales</th>
            <th class="text-center" colspan="2">Stock Transfer</th>
            <th class="text-center" colspan="3">Current Stock</th>
        </tr>
    </thead>
    <tbody>
        <tr class="gradeA">
            <th class="text-center">Item ID</th>
            <th class="text-center">Part No</th>
            <th class="text-center">Description</th>
            <th class="text-center">Qty</th>
            <th class="text-center">Qty</th>
            <th class="text-center">Received</th>
            <th class="text-center">Sent</th>
            <th class="text-center">Qty</th>
            <!-- <th class="text-center">Rate</th> -->
            <th class="text-center">Value</th>
        </tr>

        <?php foreach($item_data as $i_value){?>
        <tr class="gradeA">
            <td class="text-center"><?php echo $i_value->item_id?></td>

            <td class="text-center"><?php echo $i_value->part_no;?></td>

            <td class="text-center"><?php echo $i_value->item_name?></td>
            
            <?php $purchase_quantity = 0; foreach($purchase_data as $p_value){if($p_value->item_id == $i_value->item_id){
                $purchase_quantity = $p_value->purchase_quantity;
                }}?>
            <td class="text-center"><?php echo $purchase_quantity;?></td>
            
            <?php $sales_quantity = 0; foreach($sales_data as $s_value){ if($i_value->item_id==$s_value->item_id){ $sales_quantity= $s_value->sales_quantity;}}?>

            <td class="text-center"><?php echo $sales_quantity;?></td>

            <?php $received_stock_quantity = 0; foreach($received_stock_data as $rs_value){ if($i_value->item_id==$rs_value->item_id){ $received_stock_quantity= $rs_value->total_received_quantity;}}?>

            <td class="text-center"><?php echo $received_stock_quantity;?></td>

            <?php $sent_stock_quantity = 0; foreach($sent_stock_data as $ss_value){ if($i_value->item_id==$ss_value->item_id){ $sent_stock_quantity= $ss_value->total_sent_quantity;}}?>

            <td class="text-center"><?php echo $sent_stock_quantity;?></td>
            <td class="text-center"><?php echo $i_value->stock_quantity; ?></td>
            <!-- <td class="text-center"><?php echo $i_value->item_price;?></td> -->
            <td class="text-center"><?php echo $i_value->item_price * $i_value->stock_quantity;?></td>
        </tr>
        <?php }?> 
    </tbody>
</table>