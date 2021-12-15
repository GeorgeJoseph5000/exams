<?php $title='Manage Users'; include("inc/headeruser.inc.php");   include_javascript("user_manage");
$query = mysql_query("SELECT * FROM users");

?>

<div class="row">
<?php
$i = 0;
while($row = mysql_fetch_assoc($query)){
    if($u != $row['username']){
    ?>
    <div class="col-md-3" id="<?php echo $i; ?>">
        <div class='panel panel-default' style='width:100%;'>
            <div class='panel-heading'>
                <h4><?php echo $row['username']; ?></h4>
            </div>
            <div class='panel-body'>
            <h4>Email:</h4>
            <?php echo $row['email']; ?>
            <h4>Name:</h4>
            <?php echo $row['firstname'].' '.$row['lastname']; ?>
            <h4>Gender:</h4>
            <?php echo $row['gender']; ?>
            <h4>Academic Year:</h4>
            <?php echo $row['academic_year']; ?>
            <h4>School:</h4>
            <?php echo $row['school']; ?><br/><br/>
            <?php if($row['user_pos'] == "nor"){?>
            <button onclick="delete_user('<?php echo $row['username']; ?>','<?php echo $i; ?>');" class="btn btn-danger">Delete</button>
            <button onclick="make_admin('<?php echo $row['username']; ?>','<?php echo $i; ?>');" class="btn btn-primary">Make Admin</button><br/><br/>
            <div class="alert alert-success" style="display:none;" id="results<?php echo $i; ?>" ></div>
            <?php  } ?>
            </div>
        </div>
    </div>
<?php
    }
    $i++;
} 
?>
</div>
<?php include("inc/footer.inc.php"); ?>