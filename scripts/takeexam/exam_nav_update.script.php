<?php


$totalno = $_POST['totalno'];
$code = $_POST['code'];
$user = $_POST['user'];

include("../inc/check_passed_info.php");



for ($i=1; $i <= $totalno; $i++) { 

    $getNumRow = mysql_num_rows(mysql_query("SELECT * FROM answers WHERE username='$user' AND exam_code='$code' AND no='$i'"));
    $getAssoc = mysql_fetch_assoc(mysql_query("SELECT * FROM answers WHERE username='$user' AND exam_code='$code' AND no='$i'"));
    $flag = mysql_num_rows(mysql_query("SELECT * FROM flags WHERE no_question='$i' AND code='$code' AND user='$user'"));


    if ($getNumRow == 1 && $getAssoc['answer'] != '') {   
?>
    <button onclick="openquestion('<?php echo $totalno; ?>','<?php echo $i; ?>','<?php echo $code; ?>')" id="exam_nav_no_<?php echo $i; ?>" class="aside_exam_link_finished">►Question <?php echo $i; ?><span id="exam_nav_no_<?php echo $i; ?>_flag" style="display:<?php if($flag != 1){?>none<?php }else{ ?>block<?php } ?>;float:right;" class="glyphicon glyphicon-flag"></span></button>
<?php
    }else{
?>
    <button onclick="openquestion('<?php echo $totalno; ?>','<?php echo $i; ?>','<?php echo $code; ?>')" id="exam_nav_no_<?php echo $i; ?>" class="aside_exam_link">►Question <?php echo $i; ?><span id="exam_nav_no_<?php echo $i; ?>_flag" style="display:<?php if($flag != 1){?>none<?php }else{ ?>block<?php } ?>;float:right;" class="glyphicon glyphicon-flag"></span></button>
<?php 
    }
} 

?>