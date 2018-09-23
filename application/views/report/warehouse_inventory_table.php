<table class="table table-striped table-bordered table-hover text-center" id="dataTables-example" >
    <thead>
        <tr>
            <th class="text-center" colspan="2">Purchase</th>
            <th class="text-center">Sales</th>
            <th class="text-center" colspan="3">Closing Stock</th>
        </tr>
    </thead>
    <tbody>
        <tr class="gradeA">
            <th class="text-center">Item Name</th>
            <th class="text-center">Qty</th>
            <th class="text-center">Qty</th>
            <th class="text-center">Qty</th>
            <th class="text-center">Rate</th>
            <th class="text-center">Value</th>
        </tr>

        <?php foreach($purchase_data as $value){?>
        <tr class="gradeA">
            <td class="text-center"><?php echo $value->item_name?></td>
            
            <td class="text-center"><?php echo $value->purchase_quantity;?></td>
            
            <?php $sales_quantity = 0; foreach($sales_data as $s_value){ if($value->item_id==$s_value->item_id){ $sales_quantity= $s_value->sales_quantity;}}?>

            <td class="text-center"><?php echo $sales_quantity;?></td>

            <?php $purchase_quantity = 0; $sales_quantity= 0;
                foreach($total_purchase_quantity as $p_value){
                    if($value->item_id == $p_value->item_id){ $purchase_quantity = $p_value->total_purchase_quantity;}
                }
                foreach($total_sales_quantity as $s_value){
                    if($value->item_id == $s_value->item_id){ $sales_quantity = $s_value->total_sales_quantity;}
                }
            ?>

            <td class="text-center"><?php echo $stock = $purchase_quantity-$sales_quantity?></td>
           
            <td class="text-center"><?php echo $value->item_rate;?></td>
            <td class="text-center"><?php echo $value->item_rate * $stock;?></td>
        </tr>
        <?php }?> 
    </tbody>
</table>