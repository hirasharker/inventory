<?php
        if($permission->permission_view!=1){
            redirect('vat_tax/','refresh');   
        }
 ?>

<div class="row">
    <div class="col-md-12">
        <h1 class="page-header">
            VAT & Tax rules List <small></small>
        </h1>
    </div>
</div> 
 <!-- /. ROW  -->
       
    <div class="row">
        <div class="col-md-12">
            <!-- Advanced Tables -->
            <div class="panel panel-default">
                <div class="panel-heading">
                     vat_taxs are listed here..
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="datatable-buttons1">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>VAT amount</th>
                                    <th>Effective Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1; foreach($vat_tax_rules_list as $value){?>
                                <tr class="gradeA">
                                    <td><?php echo $i;?></td>
                                    <td><?php echo $value->value_added_tax_percentage;?></td>
                                    <td><?php echo $value->effective_date;?></td>
                                    <td class="center">
                                    <?php if($permission->permission_edit==1){?>
                                    <a href="<?php echo base_url();?>vat_tax/index/<?php echo $value->vat_tax_rule_id;?>"> edit </a> | 
                                    <?php }else{?>
                                    <label style="color:#aea4a4; font-weight:normal;">edit</label>|
                                    <?php }?>
                                    <?php if($permission->permission_delete==1){?>
                                    <a data-href="<?php echo base_url();?>vat_tax/delete_vat_tax_rule/<?php echo $value->vat_tax_rule_id;?>" data-toggle="modal" data-target="#confirm-delete"> delete </a></td>
                                    <?php }else{?>
                                    <label style="color:#aea4a4; font-weight:normal;">delete</label>
                                    <?php }?>
                                </tr>
                                <?php $i++;}?>
                            </tbody>
                        </table>
                    </div>
                    
                </div>
            </div>
            <!--End Advanced Tables -->
        </div>
    </div>
        <!-- /. ROW  -->
