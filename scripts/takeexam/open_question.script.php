<?php



$no = $_POST['question'];
$code = $_POST['code'];
$user = $_POST['user'];
include("../inc/check_passed_info.php");


$getquestion =  mysql_fetch_assoc(mysql_query("SELECT * FROM questions WHERE no='$no' AND code='$code'"));
$question = $getquestion['question'];
$is_choose = $getquestion['choose'];
$choices = array($getquestion['choice1'],$getquestion['choice2'],$getquestion['choice3'],$getquestion['choice4']);
$is_text = $getquestion['is_text'];


?>

<div>
    <?php echo $question; ?>
</div><br/><br/>

<?php 
if($is_choose == 1){
    foreach ($choices as $key => $value) {
        $i = $key+1;
        $getAnswerRow = mysql_num_rows(mysql_query("SELECT * FROM answers WHERE username='$user' AND exam_code='$code' AND no='$no' AND answer='$i'"));
        if ($getAnswerRow == 1) {  ?>
<button onclick="choice('<?php echo $i; ?>','<?php echo $no; ?>','<?php echo $code; ?>');" id="choice<?php echo $i; ?>"  class="btn_exam_choosed">►<?php echo $value; ?></button><br/><br/>
<?php  }else{
?>
<button onclick="choice('<?php echo $i; ?>','<?php echo $no; ?>','<?php echo $code; ?>');" id="choice<?php echo $i; ?>"  class="btn_exam_choose">►<?php echo $value; ?></button><br/><br/>
<?php
       } 
    }
} ?>
<?php if($is_text == 1){ 
$getAnswerRow = mysql_fetch_assoc(mysql_query("SELECT * FROM answers WHERE username='$user' AND exam_code='$code' AND no='$no'"));
?>

<textarea onchange="change_textfield('<?php echo $no; ?>','<?php echo $code; ?>');" id="textfield_answer<?php echo $no; ?>" style="width: 100%;height: 100px;" class="form form-control" placeholder="Enter your answer"><?php echo $getAnswerRow['answer']; ?></textarea>
<?php } ?>

