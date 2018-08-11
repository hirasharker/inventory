<style type="text/css">
    .icon-flipped {
    transform: scaleX(-1);
    -moz-transform: scaleX(-1);
    -webkit-transform: scaleX(-1);
    -ms-transform: scaleX(-1);
    }
</style>

<?php
    $group_permission               =   array();
    $item_permission                =   array();
    $inventory_report_permission    =   array();
    $vendor_permission              =   array();
    $purchase_invoice_permission    =   array();
    $payment_permission             =   array(); 
    $payable_permission             =   array();
    $customer_permission            =   array();
    $dealer_permission              =   array();
    $sales_invoice_permission       =   array();
    $money_receipt_permission       =   array();
    $receivable_permission          =   array();
    $sales_report_permission        =   array();
    $backup_permission              =   array(); 
    $warehouse_slot_permission      =   array();
    foreach ($user_permission as $value) {
        if($value->module_id==16){
            $warehouse_permission = $value;
        }
        if($value->module_id==18){
            $warehouse_slot_permission = $value;
        }

        if($value->module_id==19){
            $dealer_permission = $value;
        }

        if($value->module_id==1){
            $group_permission = $value;
        }
        if($value->module_id==2){
            $item_permission = $value;
        }
        if($value->module_id==3){
            $inventory_report_permission = $value;
        }
        if($value->module_id==4){
            $vendor_permission = $value;
        }
        if($value->module_id==5){
            $purchase_invoice_permission = $value;
        }
        if($value->module_id==6){
            $payment_permission = $value;
        }
        if($value->module_id==7){
            $payable_permission = $value;
        }
        if($value->module_id==8){
            $customer_permission = $value;
        }
        if($value->module_id==9){
            $sales_invoice_permission = $value;
        }
        if($value->module_id==17){
            $sales_return_permission = $value;
        }

        if($value->module_id==10){
            $money_receipt_permission = $value;
        }
        if($value->module_id==11){
            $receivable_permission = $value;
        }
        if($value->module_id==12){
            $sales_report_permission = $value;
        }
        if($value->module_id==15){
            $stock_transfer_permission = $value;
        }
        if($value->module_id==13){
            $backup_permission = $value;
        }

    }

?>

<nav class="navbar navbar-default top-navbar" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?php echo base_url();?>"><?php echo $company_name;?></a>
        </br>
        </br>
    </div>

    <ul class="nav navbar-top-links navbar-right">
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="<?php echo base_url();?>" aria-expanded="false">
                <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li style="margin-left:2em; color:#225081;">Hello, <?php echo $this->session->userdata('user_name');?>!</li>

                <?php if($this->session->userdata('user_type')==1){?>
                <li><a href="<?php echo base_url();?>user"><i class="fa fa fa-user-plus fa-fw"></i> Create user</a>
                </li>
                <?php if($this->session->userdata('user_type')==1){?>
                <li><a href="<?php echo base_url();?>user/view_users"><i class="fa fa-users fa-fw"></i> All users</a>
                </li>
                <?php }?>
                <li><a href="<?php echo base_url();?>user/user_profile"><i class="fa fa-file fa-fw"></i> My Profile</a>
                </li>
                <li class="divider"></li>
                <li><a href="<?php echo base_url();?>settings"><i class="fa fa-gear fa-fw"></i> Settings</a></li>

                <?php if($backup_permission->permission_allow==1){?>
                <li><a href="<?php echo base_url();?>utility/backup"><i class="fa fa-hdd-o fa-fw" aria-hidden="true"></i> Backup</a></li>
                <?php }?>
                <li class="divider"></li>
                <?php } else{?>
                <li><a href="<?php echo base_url();?>user/user_profile"><i class="fa fa-file fa-fw"></i> My Profile</a>
                </li>
                <li class="divider"></li>
                <?php }?>

                <li><a href="<?php echo base_url();?>log_out"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                </li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
</nav>
<!--/. NAV TOP  -->
<nav class="navbar-default navbar-side" role="navigation" style="margin-top: 25px;">
    <div class="sidebar-collapse">
        <ul class="nav" id="main-menu">
            <li class="<?php if ($dev_key == "inventory" || $dev_key == "warehouse" || $dev_key == "group" || $dev_key == "item" || $dev_key == "stock_transfer") {echo 'active';} ?>">
                <a href="<?php echo base_url();?>"><i class="fa fa-sitemap"></i> Inventory<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level <?php if ($dev_key == "inventory" || $dev_key == "group" || $dev_key == "item") {echo 'collapse in';} ?>">


                    <li class="<?php if ($dev_key == "warehouse") {echo 'active';} ?>">
                        <a href="<?php echo base_url();?>">Warehouse<span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level <?php if ($dev_key == "warehouse") {echo 'collapse in';} ?>">
                            <?php if($warehouse_permission->permission_add==1){?>
                            <li class="<?php if ($selected == "add_warehouse") {echo 'active-menu';} ?>">
                                <a href="<?php echo base_url();?>warehouse">Add Warehouse</a>
                            </li>
                            <?php }?>
                            <?php if($warehouse_permission->permission_view==1){?>
                            <li class="<?php if ($selected == "all_warehouses") {echo 'active-menu';} ?>">
                                <a href="<?php echo base_url();?>warehouse/view_warehouses">All Warehouse</a>
                            </li>
                             <?php }?>
                            <?php if($warehouse_slot_permission->permission_view==1){?>
                            <li class="<?php if ($selected == "add_warehouse_slot") {echo 'active-menu';} ?>">
                                <a href="<?php echo base_url();?>warehouse/warehouse_slot">Add Warehouse Slot</a>
                            </li>
                             <?php }?>
                            <?php if($warehouse_slot_permission->permission_view==1){?>
                            <li class="<?php if ($selected == "all_warehouse_slot") {echo 'active-menu';} ?>">
                                <a href="<?php echo base_url();?>warehouse/view_warehouse_slots">All Slots</a>
                            </li>
                             <?php }?>
                        </ul>
                    </li>


                    
                    <li class="<?php if ($dev_key == "group") {echo 'active';} ?>">
                        <a href="<?php echo base_url();?>">Group<span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level <?php if ($dev_key == "group") {echo 'collapse in';} ?>">
                            <?php if($group_permission->permission_add==1){?>
                            <li class="<?php if ($selected == "add_group") {echo 'active-menu';} ?>">
                                <a href="<?php echo base_url();?>group">Add Group</a>
                            </li>
                            <?php }?>
                            <?php if($group_permission->permission_view==1){?>
                            <li class="<?php if ($selected == "all_groups") {echo 'active-menu';} ?>">
                                <a href="<?php echo base_url();?>group/view_groups">All Groups</a>
                            </li>
                             <?php }?>
                        </ul>
                    </li>
                   
                    
                    <li class="<?php if ($dev_key == "item") {echo 'active';} ?>">
                        <a href="<?php echo base_url();?>">Item<span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level <?php if ($dev_key == "item") {echo 'collapse in';} ?>">
                            <?php if($item_permission->permission_add==1){?>
                            <li class="<?php if ($selected == "add_item") {echo 'active-menu';} ?>">
                                <a href="<?php echo base_url();?>item/">Add Item</a>
                            </li>
                            <?php }?>
                            <?php if($item_permission->permission_view==1){?>
                            <li class="<?php if ($selected == "all_items") {echo 'active-menu';} ?>">
                                <a href="<?php echo base_url();?>item/view_items">All Items</a>
                            </li>
                            <?php }?>
                        </ul>
                    </li>


                    <li class="<?php if ($dev_key == "stock_transfer") {echo 'active';} ?>">
                        <a href="<?php echo base_url();?>">Stock Transfer<span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level <?php if ($dev_key == "stock_transfer") {echo 'collapse in';} ?>">
                            <?php if($stock_transfer_permission->permission_add==1){?>
                            <li class="<?php if ($selected == "create_transfer") {echo 'active-menu';} ?>">
                                <a href="<?php echo base_url();?>stock_transfer/">New Transfer</a>
                            </li>
                            <?php }?>
                            <?php if($stock_transfer_permission->permission_view==1){?>
                            <li class="<?php if ($selected == "all_transfer_records") {echo 'active-menu';} ?>">
                                <a href="<?php echo base_url();?>stock_transfer/view_transfer_records/">All Transfer Records</a>
                            </li>
                            <?php }?>
                        </ul>
                    </li>


                   
                    <?php if($inventory_report_permission->permission_view==1){?>
                    <li class="<?php if ($dev_key == "inventory") {echo 'active';} ?>">
                        <a href="<?php echo base_url();?>">Inventory Reports<span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level <?php if ($dev_key == "inventory") {echo 'collapse in';} ?>">
                            <li class="<?php if ($selected == "individual_report") {echo 'active-menu';} ?>">
                                <a href="<?php echo base_url();?>inventory/">Individual Report</a>
                            </li>
                            <li class="<?php if ($selected == "group_inventory") {echo 'active-menu';} ?>">
                                <a href="<?php echo base_url();?>inventory/group_inventory">Group Inventory</a>
                            </li>
                        </ul>
                    </li>
                    <?php }?>
                </ul>
            </li>
            <li class="<?php if ($dev_key == "payment" || $dev_key == "vendor" || $dev_key == "purchase") {echo 'active';} ?>">
                <a href="<?php echo base_url();?>"><i class="fa fa-shopping-cart"></i> Purchase<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level <?php if ($dev_key == "vendor" || $dev_key == "purchase") {echo 'collapse in';} ?>">
                    
                    <li class="<?php if ($dev_key == "vendor") {echo 'active';} ?>">
                        <a href="<?php echo base_url();?>">Vendor<span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level <?php if ($dev_key == "vendor") {echo 'collapse in';} ?>">
                            <?php if($vendor_permission->permission_add==1){?>
                            <li class="<?php if ($selected == "add_vendor") {echo 'active-menu';} ?>">
                                <a href="<?php echo base_url();?>purchase/vendor">Add Vendor</a>
                            </li>
                            <?php }?>
                            <?php if($vendor_permission->permission_view==1){?>
                            <li class="<?php if ($selected == "all_vendors") {echo 'active-menu';} ?>">
                                <a href="<?php echo base_url();?>purchase/view_vendors">All Vendors</a>
                            </li>
                             <?php }?>
                        </ul>
                    </li>
                    <?php if($purchase_invoice_permission->permission_add==1){?>
                    <li class="<?php if ($selected == "add_purchase") {echo 'active-menu';} ?>">
                        <a href="<?php echo base_url();?>purchase">Add Purchase Invoice</a>
                    </li>
                    <?php }?>
                    <?php if($purchase_invoice_permission->permission_view==1){?>
                    <li class="<?php if ($selected == "all_purchases") {echo 'active-menu';} ?>">
                        <a href="<?php echo base_url();?>purchase/view_purchases">Purchase Invoice List</a>
                    </li>
                    <?php }?>
                   
                    <li class="<?php if ($dev_key == "payment") {echo 'active';} ?>">
                        <a href="<?php echo base_url();?>">Payment<span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level <?php if ($dev_key == "payment") {echo 'collapse in';} ?>">
                            <?php if($payment_permission->permission_add==1){?>
                            <li class="<?php if ($selected == "add_payment") {echo 'active-menu';} ?>">
                                <a href="<?php echo base_url();?>payment/">Add Payment</a>
                            </li>
                            <?php }?>
                            <?php if($payment_permission->permission_view==1){?>
                            <li class="<?php if ($selected == "all_payments") {echo 'active-menu';} ?>">
                                <a href="<?php echo base_url();?>payment/view_payments">All Payments</a>
                            </li>
                            <?php }?>
                        </ul>
                    </li>
                    
                    <?php if($payable_permission->permission_view==1){?>
                    <li class="<?php if ($selected == "payable") {echo 'active-menu';} ?>">
                        <a href="<?php echo base_url();?>purchase/payable">Payable</a>
                    </li>
                    <?php }?>
                </ul>
            </li>
            <li class="<?php if ($dev_key == "money_receipt" || $dev_key == "customer" || $dev_key == "dealer"|| $dev_key == "sales" || $dev_key == "receivable" || $dev_key == "sales_report") {echo 'active';} ?>">
                <a href="<?php echo base_url();?>"><i class="fa fa-shopping-cart icon-flipped"></i></i> Sales<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level <?php if ($dev_key == "customer" || $dev_key == "sales") {echo 'collapse in';} ?>">

                    <li class="<?php if ($dev_key == "dealer") {echo 'active';} ?>">
                        <a href="<?php echo base_url();?>">Dealer<span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level <?php if ($dev_key == "dealer") {echo 'collapse in';} ?>">
                            <?php if($dealer_permission->permission_add==1){?>
                            <li class="<?php if ($selected == "add_dealer") {echo 'active-menu';} ?>">
                                <a href="<?php echo base_url();?>dealer">Add Dealer</a>
                            </li>
                            <?php }?>
                            <?php if($dealer_permission->permission_view==1){?>
                            <li class="<?php if ($selected == "all_dealers") {echo 'active-menu';} ?>">
                                <a href="<?php echo base_url();?>dealer/view_dealers/">All Dealers</a>
                            </li>
                            <?php }?>
                        </ul>
                    </li>

                   
                    <li class="<?php if ($dev_key == "customer") {echo 'active';} ?>">
                        <a href="<?php echo base_url();?>">Customer<span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level <?php if ($dev_key == "customer") {echo 'collapse in';} ?>">
                            <?php if($customer_permission->permission_add==1){?>
                            <li class="<?php if ($selected == "add_customer") {echo 'active-menu';} ?>">
                                <a href="<?php echo base_url();?>sales/customer">Add Customer</a>
                            </li>
                            <?php }?>
                            <?php if($customer_permission->permission_view==1){?>
                            <li class="<?php if ($selected == "all_customers") {echo 'active-menu';} ?>">
                                <a href="<?php echo base_url();?>sales/view_customers">All Customers</a>
                            </li>
                            <?php }?>
                        </ul>
                    </li>
                   

                    <?php if($sales_invoice_permission->permission_add==1){?>
                    <li class="<?php if ($selected == "add_sales") {echo 'active-menu';} ?>">
                        <a href="<?php echo base_url();?>sales">Add Sales Invoice</a>
                    </li>
                    <?php }?>
                    <?php if($sales_invoice_permission->permission_view==1){?>
                    <li class="<?php if ($selected == "all_sales") {echo 'active-menu';} ?>">
                        <a href="<?php echo base_url();?>sales/view_sales">Sales Invoice List</a>
                    </li>
                    <?php }?>



                    <li class="<?php if ($dev_key == "sales_return") {echo 'active';} ?>">
                        <a href="<?php echo base_url();?>">Sales Return<span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level <?php if ($dev_key == "money_receipt") {echo 'collapse in';} ?>">
                            <?php if($sales_return_permission->permission_add==1){?>
                            <li class="<?php if ($selected == "add_sales_return") {echo 'active-menu';} ?>">
                                <a href="<?php echo base_url();?>sales/sales_return">Add Sales Return</a>
                            </li>
                            <?php }?>
                            <?php if($sales_return_permission->permission_view==1){?>
                            <li class="<?php if ($selected == "all_sales_returns") {echo 'active-menu';} ?>">
                                <a href="<?php echo base_url();?>sales/view_sales_returns">All Sales Return</a>
                            </li>
                            <?php }?>
                        </ul>
                    </li>


                    
                    <li class="<?php if ($dev_key == "money_receipt") {echo 'active';} ?>">
                        <a href="<?php echo base_url();?>">Money Receipt<span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level <?php if ($dev_key == "money_receipt") {echo 'collapse in';} ?>">
                            <?php if($money_receipt_permission->permission_add==1){?>
                            <li class="<?php if ($selected == "add_money_receipt") {echo 'active-menu';} ?>">
                                <a href="<?php echo base_url();?>sales/money_receipt">Add Money Receipt</a>
                            </li>
                            <?php }?>
                            <?php if($money_receipt_permission->permission_view==1){?>
                            <li class="<?php if ($selected == "all_money_receipts") {echo 'active-menu';} ?>">
                                <a href="<?php echo base_url();?>sales/view_money_receipts">All Money Receipts</a>
                            </li>
                            <?php }?>
                        </ul>
                    </li>
                    
                    <!-- <li class="<?php if ($selected == "receivable") {echo 'active-menu';} ?>">
                        <a href="<?php echo base_url();?>sales/receivable">Receivable</a>
                    </li> -->
                    <?php if($receivable_permission->permission_view==1){?>
                    <li class="<?php if ($dev_key == "receivable") {echo 'active';} ?>">
                        <a href="<?php echo base_url();?>">Receivable<span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level <?php if ($dev_key == "recievable_status") {echo 'collapse in';} ?>">
                            <li class="<?php if ($selected == "individual_receivable") {echo 'active-menu';} ?>">
                                <a href="<?php echo base_url();?>sales/individual_receivable">Individual Statement</a>
                            </li>
                            <li class="<?php if ($selected == "group_receivable") {echo 'active-menu';} ?>">
                                <a href="<?php echo base_url();?>sales/group_receivable">Group Statement</a>
                            </li>
                        </ul>
                    </li>
                    <?php }?>
                    <?php if($sales_report_permission->permission_view==1){?>
                    <li class="<?php if ($dev_key == "sales_report") {echo 'active';} ?>">
                        <a href="<?php echo base_url();?>">Sales Report<span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level <?php if ($dev_key == "sales_report") {echo 'collapse in';} ?>">
                            <li class="<?php if ($selected == "individual_sales_report") {echo 'active-menu';} ?>">
                                <a href="<?php echo base_url();?>sales/individual_sales_report">Individual Sales Report</a>
                            </li>
                            <li class="<?php if ($selected == "group_sales_report") {echo 'active-menu';} ?>">
                                <a href="<?php echo base_url();?>sales/group_sales_report">Group Sales Report</a>
                            </li>
                        </ul>
                    </li>
                    <?php }?>
                </ul>
            </li>
            <?php if($this->session->userdata('user_type')==1){?>

            
            
            <li class="<?php if ($dev_key == "utility") {echo 'active';} ?>">
                <a href="<?php echo base_url();?>"><i class="fa fa-gear fa-fw"></i> Settings<span class="fa arrow"></span></a>
                <ul class="nav nav-third-level <?php if ($dev_key == "utility") {echo 'collapse in';} ?>">
                    <li class="<?php if ($selected == "company") {echo 'active-menu';} ?>">
                        <a href="<?php echo base_url();?>company"><i class="fa fa-building-o"></i> Company</a>
                    </li>
                    <?php if($backup_permission->permission_allow==1){?>
                    <li class="<?php if ($selected == "backup") {echo 'active-menu';} ?>">
                        <a href="<?php echo base_url();?>utility/backup"><i class="fa fa-hdd-o fa-fw" aria-hidden="true"></i> Backup</a>
                    </li>
                    <?php }?>
                </ul>
            </li>
            <?php }?>
        </ul>
    </div>

</nav>
<!-- /. NAV SIDE  -->