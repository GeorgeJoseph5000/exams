<?php $title='Your Exam History'; include("inc/headeruser.inc.php");  
$query = mysql_query("SELECT * FROM exam_finished WHERE user='$u'");

if (mysql_num_rows($query) == 0) {
    exitPage("You didn't take any exam");
}
$row = 1;
?>
<div class="row">
<?php
while($row = mysql_fetch_assoc($query)){
    $code = $row['code'];
    $assocexam = mysql_fetch_assoc(mysql_query("SELECT * FROM exams WHERE code='$code'"));
    $numanswers = mysql_num_rows(mysql_query("SELECT * FROM answers WHERE exam_code='$code' AND username='$u'"));
    $numflags = mysql_num_rows(mysql_query("SELECT * FROM flags WHERE code='$code' AND user='$u'"));
    $getFinishedRows = mysql_fetch_assoc(mysql_query("SELECT * FROM exam_finished WHERE user='$u' AND code='$code'"));
    if($getFinishedRows['mark'] == "still"){
        $mark = "Not Corrected";
    }else{
        $mark = $getFinishedRows['mark'].'/'.$assocexam['no_questions'];
    }
    
?>
    <div class="col-md-3">
        <div class='panel panel-default' style='width:100%;'>
            <div class='panel-heading'>
                <h4><a href="viewanswers.php?code=<?php echo $code; ?>"><?php echo $assocexam['subject']; ?></a></h4>
            </div>
            <div class='panel-body'>
            <h4>Code:</h4>
            <?php echo $row['code']; ?>
            <h4>No of Questions:</h4>
            <?php echo $assocexam['no_questions']; ?>
            <h4>Solved Questions:</h4>
            <?php echo $numanswers; ?>
            <h4>Mark:</h4>
            <?php echo $mark; ?>
            <h4>Flagged Questions:</h4>
            <?php echo $numflags; ?>
            <h4>Time:</h4>
            <?php 
                if($assocexam['endless'] != 1){
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
            ?>
            </div>
        </div>
    </div>
<?php
} 
?>
</div>
<?php include("inc/footer.inc.php"); ?>