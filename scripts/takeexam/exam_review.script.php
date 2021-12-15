<?php




$totalno = $_POST['totalno'];
$code = $_POST['code'];
$user = $_POST['user'];


include("../inc/check_passed_info.php");


$flag = $_POST['flag'];
$unsolved = $_POST['unsolved'];

for ($i=1; $i <= $totalno; $i++) { 
    $queryAnswer = mysql_query("SELECT * FROM answers WHERE username='$user' AND exam_code='$code' AND no='$i' ");
    $getAnswersRow = mysql_num_rows($queryAnswer);
    $getAssocAnswers = mysql_fetch_assoc($queryAnswer);
    $answer = $getAssocAnswers['answer'];


    $queryFlag = mysql_query("SELECT * FROM flags WHERE user='$user' AND code='$code' AND no_question='$i' ");
    $getFlagRow = mysql_num_rows($queryFlag);
    if($flag == "true" && $unsolved == "true"){
        if($getFlagRow == 1 && ($getAnswersRow != 1 || $answer == "")){
            ?>
            <div style="margin-bottom: 5px;" class="col-md-12">
                <button data-dismiss="modal" onclick="openquestion(<?php echo $totalno;?>,<?php echo $i; ?>,<?php echo $code; ?>);" class="btn btn-default" style="font-size:20px;width:100%;">
                    <span class="glyphicon glyphicon-flag"></span> <?php echo 'Question No. '.$i; ?>
                </button>
            </div>
            <?php
        }
    }
    if($flag == "true" && $unsolved == "false"){
        if($getFlagRow == 1){
            ?>
            <div style="margin-bottom: 5px;" class="col-md-12">
                <button data-dismiss="modal" onclick="openquestion(<?php echo $totalno;?>,<?php echo $i; ?>,<?php echo $code; ?>);" class="btn btn-default <?php if($getAnswersRow == 1 && $answer != ""){ ?> solved_review_item<?}?>" style="font-size:20px;width:100%;">
                    <span class="glyphicon glyphicon-flag"></span> <?php echo 'Question No. '.$i; ?>
                </button>
            </div>
            <?php
        }

    }
    if($flag == "false" && $unsolved == "true"){
        if($getAnswersRow != 1 || $answer == ""){
            ?>
            <div style="margin-bottom: 5px;" class="col-md-12">
                <button data-dismiss="modal" onclick="openquestion(<?php echo $totalno;?>,<?php echo $i; ?>,<?php echo $code; ?>);" class="btn btn-default" style="font-size:20px;width:100%;">
                    <?php if ($getFlagRow == 1){ ?><span class="glyphicon glyphicon-flag"></span> <?php } echo 'Question No. '.$i; ?>
                </button>
            </div>
            <?php
        }
    }
    if($flag == "false" && $unsolved == "false"){
        ?>

        <div style="margin-bottom: 5px;" class="col-md-12">
            <button data-dismiss="modal" onclick="openquestion(<?php echo $totalno;?>,<?php echo $i; ?>,<?php echo $code; ?>);" class="btn btn-default<?php if($getAnswersRow == 1 && $answer != ""){ ?> solved_review_item<?}?>" style="font-size:20px;width:100%;">
                <?php if ($getFlagRow == 1){ ?><span class="glyphicon glyphicon-flag"></span> <?php } echo 'Question No. '.$i; ?>
            </button>
        </div>
    
        <?php
    }

    
}

