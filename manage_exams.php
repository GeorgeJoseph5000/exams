<?php $title='Manage Exams'; include("inc/headeruser.inc.php"); 


if($user_pos != "admin"){
    exitPage("You are not allowed to do this");
}

$query = mysql_query("SELECT * FROM exams WHERE added_by='$u'");

if (mysql_num_rows($query) == 0) {
    exitPage("You didn't make any exam");
}

?>
<div class="row">
<?php
while($row = mysql_fetch_assoc($query)){
    $code = $row['code'];
?>
    <div class="col-md-3">
        <div class='panel panel-default' style='width:100%;'>
            <div class='panel-heading'>
                <h4><a href="viewexam.php?code=<?php echo $code; ?>"><?php echo $row['subject']; ?></a></h4>
            </div>
            <div class='panel-body'>
            <h4>Code:</h4>
            <?php echo $row['code']; ?>
            <h4>No of Questions:</h4>
            <?php echo $row['no_questions']; ?>
            <h4>No of examiners:</h4>
            <?php echo $row['no_examiners']; ?>
            <h4>Time:</h4>
            <?php 
            if($row['endless'] != 1){
                $min = $row['time'];
                $hour = floor($min / 60);
                $currentmin = 0;
                if($min >= 60){
                    $currentmin = $min - ($hour*60);
                }else{
                    $currentmin = $min;
                }
                echo $hour.' hours '.$currentmin.' minutes';
            }else{
                echo "Endless";
            }
            ?><br/><br/>
            <a class="btn btn-primary" href="edit_exam.php?code=<?php echo $code; ?>">Edit</a>
            </div>
        </div>
    </div>
<?php
} 
?>
</div>

<?php include("inc/footer.inc.php"); ?>