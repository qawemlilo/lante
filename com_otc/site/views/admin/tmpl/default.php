<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

?>

<div>
   <ul class="nav nav-pills" style="margin-bottom: 0px">
    <li class="disabled">
      <a href="<?php echo JRoute::_(JURI::base() . 'index.php?option=com_otc&view=admin'); ?>"><i class="icon-user"></i> Registered Members</a>
    </li>
    <li>
      <a href="<?php echo JRoute::_(JURI::base() . 'index.php?option=com_otc&view=admin&layout=companies'); ?>"><i class="icon-briefcase"></i> Listed Companies</a>
    </li>
    <li>
      <a href="<?php echo JRoute::_(JURI::base() . 'index.php?option=com_otc&view=admin&layout=transactions'); ?>"><i class="icon-signal"></i> Transactions</a>
    </li>
  </ul>
  <hr style="margin-top: 0px" />
</div>

<div class="row-fluid">
  <p style="text-align:right">
    <a href="<?php echo JRoute::_(JURI::base() . 'index.php?option=com_otc&view=admin&layout=newuser'); ?>" class="btn btn-primary" type="button">
      <i class="icon-check"></i> Add Member
    </a>
    
    <button class="btn btn-primary btn-success">
      <i class="icon-edit"></i> Edit
    </button>
    
    <button type="submit" class="btn btn-primary btn-danger">
      <i class="icon-cancel"></i> Delete
    </button>
  </p>
  <?php
  if (is_array($this->members) && count($this->members) > 0) :
  ?>
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th colspan="5" style="text-align:center;">Registered Members</th>
      </tr>
      <tr>
        <th>&nbsp;</th>
        <th>Name</th>
        <th>Email</th>
        <th>Cell Number</th>
        <th>Work Number</th>
      </tr>
    </thead>
    <tbody>
    <?php
      foreach($this->members as $member) :
    ?>
        <tr>
          <td><input type="checkbox" name="ids[]" /></td>
          <td><?php echo $member->name . ' ' . $member->surname; ?></td>
          <td><?php echo $member->email; ?></td>
          <td>0<?php echo $member->cell_number; ?></td>
          <td>0<?php echo $member->work_number; ?></td>
        </tr>
    <?php
      endforeach;
    ?>
    </tbody>
  </table>
  <?php
    endif;
  ?>
</div>