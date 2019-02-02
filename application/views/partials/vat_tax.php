<?php if($vat_tax_detail==NULL){?>
<div class="row">
        <div class="col-md-12">
            <h1 class="page-header">
                Add Rule <small>add new vat_tax's information..</small>
            </h1>
        </div>
    </div> 
     <!-- /. ROW  -->
  <div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Insert vat/tax's Information..
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-5">
                        <form role="form" method="post" action="<?php echo base_url();?>vat_tax/add_vat_tax_rule">
                            <div class="form-group">
                                <label>VAT amount</label>
                                <input class="form-control" type="number" placeholder = "amount" name="value_added_tax_percentage" min="0" required step=".000001">
                            </div>

                            <div class="form-group" style="display: none;">
                                <label>TAX amount</label>
                                <input class="form-control" type="number" placeholder = "amount" value="0" name="tax" min="0" required>
                            </div>
                            
                            <label>Effective Date</label>
                            <div class="input-group date" data-provide="datepicker">
                                <input type="text" class="form-control"  id="datepicker" name="effective_date" required >
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-th"></span>
                                </div>
                            </div>
                            <br>
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
<?php }else {?>
<div class="row">
        <div class="col-md-12">
            <h1 class="page-header">
                Update Rule <small>update new vat/tax's information..</small>
            </h1>
        </div>
    </div> 
     <!-- /. ROW  -->
  <div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Update vat/tax's Information..
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-5">
                        <form role="form" method="post" action="<?php echo base_url();?>vat_tax/update_vat_tax_rule">
                            <input type="hidden" value="<?php echo $vat_tax_detail->vat_tax_rule_id; ?>" name="vat_tax_rule_id">
                            <div class="form-group">
                                <label>VAT amount</label>
                                <input class="form-control" type="number" placeholder = "amount" name="value_added_tax_percentage" min="0" required step=".000001" value="<?php echo $vat_tax_detail->value_added_tax_percentage; ?>" required>
                            </div>

                            <div class="form-group" style="display: none;">
                                <label>TAX amount</label>
                                <input class="form-control" type="number" placeholder = "amount" value="<?php echo $vat_tax_detail->tax; ?>" name="tax" min="0" required>
                            </div>
                            
                            <label>Effective Date</label>
                            <div class="input-group date" data-provide="datepicker">
                                <input type="text" class="form-control"  id="datepicker" name="effective_date" value="<?php echo $vat_tax_detail->effective_date; ?>" required >
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-th"></span>
                                </div>
                            </div>
                            <br>
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
<?php }?>