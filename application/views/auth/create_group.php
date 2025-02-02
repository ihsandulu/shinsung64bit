 <div class="row">
       <div class="col-md-4">
             <?php if (isset($message)): ?>
                  <div class="alert alert-info alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <?php echo $message;?>
                  </div>
            <?php endif ?>

            <?php echo form_open("auth/create_group");?>

                  <p>
                        <?php echo lang('create_group_name_label', 'group_name');?> <br />
                        <?php echo form_input($group_name);?>
                  </p>

                  <p>
                        <?php echo lang('create_group_desc_label', 'description');?> <br />
                        <?php echo form_input($description);?>
                  </p>

                  <p><?php echo form_submit('submit', lang('create_group_submit_btn'), 'class="btn btn-primary btn-sm"');?></p>

            <?php echo form_close();?>
       </div>
 </div>