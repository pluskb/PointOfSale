<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
echo $links; 
foreach ($row as $erow){
   
?>


<table >
    <?php echo form_open('employees/delete_selected_employees') ?>
    <tr><td><input type="checkbox" name="mycheck[]" value="<?php echo $erow->id ?>" /><td style="width: 100px"><?php echo $erow->first_name; ?>
        </td><td  style="width: 100px"><?php echo $erow->phone ?></td><td  style="width: 150px"><?php echo $erow->email ?></td>
        <td style="width: 100px"><?php echo $erow->emp_id ?></td><td  style="width: 100px"><?php echo $erow->group ?></td>
        <td style="width: 100px"><a href="<?php echo base_url() ?>index.php/employees/edit_employee_details/<?php echo $erow->id ?>">Edit</a><td><td style="width: 100px"><a href="<?php echo base_url() ?>index.php/employee_permissions/edit_employee_permission/<?php echo $erow->id ?>">Edit permission</a></td>
    
    </tr>
    
</table>
<?php }


?>  
<tb><input type="submit" name="delete_all" value="Delete Selected Message"></td><tb><input type="submit" name="Add_employee" value="Add New Employee"></td><tb><input type="submit" name="edit_all" value="Send Email"></td>
     <?php echo form_close() ?> 