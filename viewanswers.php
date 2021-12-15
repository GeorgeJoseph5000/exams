<?php $title='View Answers'; include("inc/headeruser.inc.php");  

if(!isset($_GET['code']) || $_GET['code'] == ""){
    exitPage("Error");
}

$code = $_GET['code'];

$getFinishedRows = mysql_num_rows(mysql_query("SELECT * FROM exam_finished WHERE user='$u' AND code='$code'"));
if ($getFinishedRows != 1) {
    exitPage("You have not taken this exam");
}

$getFinishedRows = mysql_fetch_assoc(mysql_query("SELECT * FROM exam_finished WHERE user='$u' AND code='$code'"));

$getExamAssoc = mysql_fetch_assoc(mysql_query("SELECT * FROM exams WHERE code='$code'"));
$getQuestionsArray = mysql_query("SELECT * FROM questions WHERE code='$code'");

if($getFinishedRows['mark'] == "still"){
    $mark = "Not Corrected";
}else{
    $mark = $getFinishedRows['mark'].'/'.$getExamAssoc['no_questions'];
}
if($getFinishedRows['mark'] != "still"){
?>
<div class="alert alert-info"><h3>Your Mark is <?php echo $mark; ?></h3></div>
<?php } ?>
<br/>
<div class=row>

<?php
$i = 1;
while ($row = mysql_fetch_array($getQuestionsArray)) {
    $getAnswersAssoc = mysql_fetch_assoc(mysql_query("SELECT * FROM answers WHERE no='$i' AND exam_code='$code' AND username='$u'"));
    $getFlags = mysql_num_rows(mysql_query("SELECT * FROM flags WHERE no_question='$i' AND code='$code' AND user='$u'"));
    
?>
    <h2><?php if($getFlags == 1){ ?><span class="glyphicon glyphicon-flag"></span><?php } ?>Question <?php echo $i; ?></h2>
    <h3>Question: </h3><br/>
    <?php echo $row['question']; ?>
    <h4><?php
    if($row['choose'] == 1){
        echo 'A. '.$row['choice1'].'<br/>';
        echo 'B. '.$row['choice2'].'<br/>';
        echo 'C. '.$row['choice3'].'<br/>';
        echo 'D. '.$row['choice4'].'<br/>';
    }
    ?></h4><br/><br/><br/>
    <?php if($getAnswersAssoc['answer'] != ""){ ?>
    <h3>Your Answer: </h3><br/>
    <?php 
    if($row['is_text'] == 1){
        echo "<h4>".$getAnswersAssoc['answer']."</h4>";
    }else if($row['choose'] == 1){?>
        <h4>
        <?php
        if($getAnswersAssoc['answer'] == 1){
            echo 'A. '.$row['choice1'];
        }
        if($getAnswersAssoc['answer'] == 2){
            echo 'B. '.$row['choice2'];
        }
        if($getAnswersAssoc['answer'] == 3){
            echo 'C. '.$row['choice3'];
        }
        if($getAnswersAssoc['answer'] == 4){
            echo 'D. '.$row['choice4'];
        }
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
    }else{
        echo '<h3>You didn\'t answer</h3>';
    }
    ?>
    
    <br/><br/><hr style="background-color: #06F; height: 1px;" /><br/>


<?php
    $i++;
}
?>
</div>
<?php include("inc/footer.inc.php"); ?>