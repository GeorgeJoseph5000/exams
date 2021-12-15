<?php $title='Correct'; include("inc/headeruser.inc.php");  include_javascript_login('correct',$u); 

$total_mark = 0;

if($user_pos != "admin"){
    exitPage("You are not allowed to do this");
}


if(!isset($_GET['code']) || $_GET['code'] == ""){
    exitPage("Error");
}

if(!isset($_GET['user']) || $_GET['user'] == ""){
    exitPage("Error");
}


$code = $_GET['code'];
$user = $_GET['user'];

$getExamRows = mysql_num_rows(mysql_query("SELECT * FROM exams WHERE code='$code' AND added_by='$u'"));
if ($getExamRows != 1) {
    exitPage("Error");
}

$getFinishedRows = mysql_num_rows(mysql_query("SELECT * FROM exam_finished WHERE user='$user' AND code='$code'"));
$getFinishedAssoc = mysql_fetch_assoc(mysql_query("SELECT * FROM exam_finished WHERE user='$user' AND code='$code'"));
if ($getFinishedRows != 1) {
    exitPage("User have not taken this exam");
}
if ($getFinishedAssoc['mark'] != 'still') {
    exitPage("This exam have been corrected");
}




$getExamAssoc = mysql_fetch_assoc(mysql_query("SELECT * FROM exams WHERE code='$code' AND added_by='$u'"));

$getQuestionsArray = mysql_query("SELECT * FROM questions WHERE code='$code'");

?>
<h1><?php echo $user." 's Exam".' - '.$getExamAssoc['subject']; ?></h1>
<?php
$i = 1;
while ($row = mysql_fetch_array($getQuestionsArray)) {
    $getAnswersAssoc = mysql_fetch_assoc(mysql_query("SELECT * FROM answers WHERE no='$i' AND exam_code='$code' AND username='$user'"));
    $getFlags = mysql_num_rows(mysql_query("SELECT * FROM flags WHERE no_question='$i' AND code='$code' AND user='$user'"));
    
?>

<div class=row>
    <div class="col-md-10">
        <h2>Question <?php echo $i; ?></h2>
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
            echo "<h4>".$getAnswersAssoc['answer']."</h4><br/><button id='add$i' class='btn btn-primary' onclick='add($i);'>Correct</button> <button id='minus$i' class='btn btn-danger' onclick='minus($i);'>Not Correct</button>".'<script type="text/javascript">check.push('.$i.');</script>';
            ?>
    </div>
    <div class="col-md-2">
        <br>
        <h3 id="result<?php echo $i; ?>"></h3>
    </div>
</div>
<br/><br/><hr style="background-color: #06F; height: 1px;" /><br/>

        <?php }else if($row['choose'] == 1){ ?>
            
            

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
            }?>


            <br/><br/><br/><h3>Correct Answer: </h3><br/>
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
            if($getAnswersAssoc['answer'] == $row['choose_answer']){
                echo '<script type="text/javascript">addChoose();</script>';
            ?>
    </div>
    <div class="col-md-2">
        <br>
        <h3 id="result<?php echo $i; ?>">+1</h3>
    </div>
</div>
<br/><br/><hr style="background-color: #06F; height: 1px;" /><br/>
                <?php
            }else{
                echo '<script type="text/javascript">minusChoose();</script>';
                ?>
    </div>
    <div class="col-md-2">
        <br>
        <h3 id="result<?php echo $i; ?>">-1</h3>
    </div>
</div>
<br/><br/><hr style="background-color: #06F; height: 1px;" /><br/>
                <?
            }
        }
            ?>
            </h4>
            
            <?php
        }else{
            echo '<h3>User didn\'t answer</h3>';
            echo '<script type="text/javascript">minusChoose();</script>';
            ?>
    </div>
    <div class="col-md-2">
        <br>
        <h3 id="result<?php echo $i; ?>">-1</h3>
    </div>
</div>
<br/><br/><hr style="background-color: #06F; height: 1px;" /><br/>
            <?php
        }
        ?>
        
    

<?php
    
$i++;
}
echo '<script type="text/javascript">questionno = '.$i.';questionno--;</script>';
?>
<br/><br/>
<div class="row">
    <div class="col-md-2" >
        <h3 id="total_mark_div"></h3>
        <script text="text/javascript">setH3Marks();</script>
    </div>
    <div class="col-md-10">
        <button class="btn btn-primary" style="width:100%;" onclick="saveMark('<?php echo $user; ?>','<?php echo $code; ?>');">Save</button>
    </div>
    
</div>

<br/><div class="alert" style="display: none;" id="savingResults"></div>

<br/>

<div id="resultSaveMark"></div>
<?php include("inc/footer.inc.php"); ?>