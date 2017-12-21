<html>
<?php
if($this->session->userdata('username') !=''){
$username = $this->session->userdata('username');
$email = $this->session->userdata('email');
} 
//print_r($user_id);die(); 
?>
<div id="w">
    <div id="content" class="clearfix">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Fill this Form.</h3>
                    </div>
                    <div class="panel-body">
                        <?php echo form_open('main/add_listing'); ?>
                        <fieldset>
                            <div class="form-group">
                                <?php
                                echo "<div class='error_msg'>";
                                if (isset($message_display)) {
                                    echo $message_display;
                                }
                                echo validation_errors();
                                echo "</div>";
                                ?>
                            </div>

                            <div class="form-group">
                                <?php $name = array(
                                    'type' => 'text',
                                    'name' => 'item_sku',
                                    'placeholder' => 'Item sku name..',
                                    'class' => 'form-control'
                                );
                                echo form_input($name);  ?> </div>
                            <div class="form-group">
                                <?php $data = array(
                                    'type' => 'text',
                                    'name' => 'product_name',
                                    'placeholder' => 'Product name..',
                                    'class' => 'form-control'
                                );
                                echo form_input($data);  ?>
                            </div>
                            <div class="form-group">
                                <?php $data = array(
                                    'type' => 'text',
                                    'name' => 'cat_name',
                                    'placeholder' => 'category name..',
                                    'class' => 'form-control'
                                );
                                echo form_input($data); ?>
                            </div>
                            <div class="form-group">
                                <?php $data = array(
                                    'type' => 'text',
                                    'name' => 'barcode',
                                    'placeholder' => 'Barcode..',
                                    'class' => 'form-control'
                                );
                                echo form_input($data);  ?>
                            </div>
                            <div class="form-group">
                                <?php $data = array(
                                    'type' => 'text',
                                    'name' => 'prices',
                                    'placeholder' => 'Prices..',
                                    'class' => 'form-control'
                                );
                                echo form_input($data);  ?>
                            </div>
                            <input type="submit"  class="btn btn-lg btn-success btn-block" value="Submit" name="submit"/><br />

                        </fieldset>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- @end #content -->
  </div><!-- @end #w -->
