<?php $title='View Your Exam'; include("inc/headeruser.inc.php"); 

if($user_pos != "admin"){
    exitPage("You are not allowed to do this");
}

if(!isset($_GET['code']) || $_GET['code'] == ""){
    exitPage("Error");
}

$code = $_GET['code'];


$getExamAssoc = mysql_fetch_assoc(mysql_query("SELECT * FROM exams WHERE code='$code'"));
$getQuestionsArray = mysql_query("SELECT * FROM questions WHERE code='$code'");
?>
<?php
$query = mysql_query("SELECT * FROM exam_finished WHERE mark!='still' AND code='$code'");
?>
<div class="row">
<h2>Corrected</h2>
<?php
if(mysql_num_rows($query) == 0){
    echo '<div class="alert alert-danger">No Corrected exams</div>';
}
while($row = mysql_fetch_assoc($query)){
    $code = $row['code'];
    $user = $row['user'];
    $assocexam = mysql_fetch_assoc(mysql_query("SELECT * FROM exams WHERE code='$code'"));
    $numanswers = mysql_num_rows(mysql_query("SELECT * FROM answers WHERE exam_code='$code' AND username='$user'"));
    $numflags = mysql_num_rows(mysql_query("SELECT * FROM flags WHERE code='$code' AND user='$user'"));
    $getFinishedRows = mysql_fetch_assoc(mysql_query("SELECT * FROM exam_finished WHERE user='$user' AND code='$code'"));
    if($getFinishedRows['mark'] == "still"){
        $mark = "Not Corrected";
    }else{
        $mark = $getFinishedRows['mark'].'/'.$assocexam['no_questions'];
    }
    
?>
    <div class="col-md-3">
        <div class='panel panel-default' style='width:100%;'>
            <div class='panel-heading'>
                <h4><a href="correct.php?user=<?php echo $user; ?>&code=<?php echo $code; ?>"><?php echo $user; ?></a></h4>
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
<br/><br/><hr style="background-color: #06F; height: 1px;" /><br/>
<?php
$query = mysql_query("SELECT * FROM exam_finished WHERE mark='still' AND code='$code'");
?>
<div class="row">
<h2>Still Not Corrected</h2>
<?php
if(mysql_num_rows($query) == 0){
    echo '<div class="alert alert-danger">No Incorrected exams</div>';
}
while($row = mysql_fetch_assoc($query)){
    $code = $row['code'];
    $user = $row['user'];
    $assocexam = mysql_fetch_assoc(mysql_query("SELECT * FROM exams WHERE code='$code'"));
    $numanswers = mysql_num_rows(mysql_query("SELECT * FROM answers WHERE exam_code='$code' AND username='$user'"));
    $numflags = mysql_num_rows(mysql_query("SELECT * FROM flags WHERE code='$code' AND user='$user'"));
    $getFinishedRows = mysql_fetch_assoc(mysql_query("SELECT * FROM exam_finished WHERE user='$user' AND code='$code'"));
    if($getFinishedRows['mark'] == "still"){
        $mark = "Not Corrected";
    }else{
        $mark = $getFinishedRows['mark'].'/'.$assocexam['no_questions'];
    }
    
?>
    <div class="col-md-3">
        <div class='panel panel-default' style='width:100%;'>
            <div class='panel-heading'>
            <h4><a href="correct.php?user=<?php echo $user; ?>&code=<?php echo $code; ?>"><?php echo $user; ?></a></h4>
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
<br/><br/><hr style="background-color: #06F; height: 1px;" /><br/>
<div class=row>
<?php
$i = 1;
while ($row = mysql_fetch_array($getQuestionsArray)) {
   
?>
    <h2>Question <?php echo $i; ?></h2>
    <h3>Question: </h3><br/>
    <?php echo $row['question']; ?><br/><br/>
    <?php 
    if($row['choose'] == 1){?>
        <h4>
        <?php
        echo 'A. '.$row['choice1']."<br/>";
        echo 'B. '.$row['choice2']."<br/>";
        echo 'C. '.$row['choice3']."<br/>";
        echo 'D. '.$row['choice4']."<br/>";
        
        ?>
        </h4>
        <br/><h3>Correct Answer: </h3><br/>
        <h4>
        <?php
        if($row['choose_answer'] == 1){
            echo 'A. '.$row['choice1'];
        }
        if($row['choose_answer'] == 2){
            echo 'B. '.$row['choice2'];
        }
        if($row['choose_answer'] == 3){
            echo 'C. '.$row['choice3'];
        }
        if($row['choose_answer'] == 4){
            echo 'D. '.$row['choice4'];
        }
        ?>
        </h4>
        <?php
    }
    
    ?>
    
    <br/><br/><hr style="background-color: #06F; height: 1px;" /><br/>
<?php
    $i++;
}



?>
</div>
<?php include("inc/footer.inc.php"); ?>