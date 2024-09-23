<div class="row">
      <div class="col-md-4">
            
<div id="infoMessage"><?php echo $message;?></div>

<?php echo form_open(uri_string());?>

<p>
      <?php echo lang('edit_user_fname_label', 'first_name');?> <br />
      <?php echo form_input($first_name);?>
</p>

<p>
      <?php echo lang('edit_user_lname_label', 'last_name');?> <br />
      <?php echo form_input($last_name);?>
</p>

<p>
      <?php echo lang('edit_user_company_label', 'company');?> <br />
      <?php echo form_input($company);?>
</p>

<p>
      <?php echo lang('edit_user_phone_label', 'phone');?> <br />
      <?php echo form_input($phone);?>
</p>

<p>
      <?php echo lang('edit_user_password_label', 'password');?> <br />
      <?php echo form_input($password);?>
</p>

<p>
      <?php echo lang('edit_user_password_confirm_label', 'password_confirm');?><br />
      <?php echo form_input($password_confirm);?>
</p>
<?php if ($this->ion_auth->is_admin()): ?>

    <h4><?php echo lang('edit_user_groups_heading');?></h4>
    <?php foreach ($groups as $group):?>
        <label style="margin-left: 20px;" class="checkbox">
        <input type="checkbox" name="groups[]" value="<?php echo $group['id'];?>" <?php echo (in_array($group, $currentGroups)) ? 'checked="checked"' : null; ?>>
        <?php echo htmlspecialchars($group['name'],ENT_QUOTES,'UTF-8');?>     ( <?php echo htmlspecialchars($group['description'],ENT_QUOTES,'UTF-8');?> )
        </label>
    <?php endforeach?>

<?php endif ?>

<?php echo form_hidden('id', $user->id);?>
<?php echo form_hidden($csrf); ?>

<p><?php echo form_submit('submit', lang('edit_user_submit_btn'), 'class="btn btn-primary"');?></p>

<?php echo form_close();?>




      </div>
</div>