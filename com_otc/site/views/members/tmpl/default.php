<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

$document =& JFactory::getDocument();
$document->addStyleDeclaration('#limit {width: 60px}');
?>

<div>
   <ul class="nav nav-pills" style="margin-bottom: 0px">
    <li class="disabled">
      <a href="<?php echo $this->parseUrl('index.php?option=com_otc&view=members'); ?>"><i class="icon-user"></i> Registered Members</a>
    </li>
    <li>
      <a href="<?php echo $this->parseUrl('index.php?option=com_otc&view=companies'); ?>"><i class="icon-briefcase"></i> Listed Companies</a>
    </li>
    <li>
      <a href="<?php echo $this->parseUrl('index.php?option=com_otc&view=admin&layout=transactions'); ?>"><i class="icon-signal"></i> Transactions</a>
    </li>
  </ul>
  <hr style="margin-top: 0px" />
</div>

<div class="row-fluid well well-small" style="margin-bottom:1px">
  <div class="span4">
    <form action="<?php echo $this->parseUrl('index.php?option=com_otc&view=members'); ?>" style="margin-bottom: 0px" method="post" name="pagination-form">
    Display # <?php echo @$this->pagination->getLimitBox() ;?>
    </form>
  </div>
  
  <div class="span8" style="text-align:right">
    <a href="<?php echo $this->parseUrl('index.php?option=com_otc&view=members&layout=newuser'); ?>" class="btn btn-large btn-primary">
      <i class="icon-check"></i> Add Member
    </a>
    
    <button id="submitedit" class="btn btn-primary btn-large btn-success">
      <i class="icon-edit"></i> Edit
    </button>
    
    <button id="deletemember" class="btn btn-large btn-primary btn-danger">
      <i class="icon-remove"></i> Delete
    </button>
  </div>
</div>

<div class="row-fluid">

  <?php
  if (is_array($this->members) && count($this->members) > 0) :
  ?>
  <form name="members" id="members-form" method="GET" action="index.php">   
    <input type="hidden" name="option" value="com_otc">
    <input type="hidden" name="view" value="members">
    <input type="hidden" name="layout" value="edituser">
    <?php echo JHtml::_('form.token'); ?>
    
    <table class="table table-bordered table-striped">
    <thead>
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
          <td><input type="radio" name="id" value="<?php echo $member->id; ?>" /></td>
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
  
  <div class="row-fluid" style="text-align: center; border-top: 0px">
    <?php echo @$this->pagination->getPagesLinks(); ?>
  </div>
  
  <?php
    endif;
  ?>
</div>
<script>
jQuery.noConflict();

(function ($) {
    $(function () {
    
       var form = $("#members-form");
       
       form.on("submit", function (event) {
        
            if (!$("input[name=id]:checked").val()) {
                alert("Please select a member");
                return false;
            }
            
            return true;
        });
        
        $("#submitedit").on("click", function () {
            form.submit();
        });
        
        $("#deletemember").on("click", function () {
            var id = $("input[name=id]:checked").val(),
                answer;
            
            if (id) {
                answer = confirm("Are you sure you want to permanently delete that member?");
                
                if (answer) {
                    $("input[name=view]").remove();
                    $("input[name=layout]").remove();
                    form.attr({'method': 'POST', 'action': 'index.php?option=com_otc&task=members.removemember'}).submit();
                }
            }
            
            return false;
        });
    });
})(jQuery);
</script>
