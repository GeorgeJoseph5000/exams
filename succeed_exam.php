<?php $title='Exam Submit'; include("inc/headeruser.inc.php");


if (!isset($_GET['code']) || $_GET['code'] == "") {
    exitPage("Error");
}else{
    $code = $_GET['code'];
}
$getRows = mysql_num_rows(mysql_query("SELECT * FROM exam_finished WHERE user='$u' AND code='$code'"));
if ($getRows != 1) {
    exitPage("Error");
}

?>


<div class="row">
    <h3 style="width: 100%;" class="alert alert-success">Congratulations, you have submitted your exam</h3>
</div>



<?php include("inc/footer.inc.php"); ?>