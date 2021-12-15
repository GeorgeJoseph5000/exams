<?php $title = 'Exam'; include('inc/headeruser.inc.exam.php'); 

$examcode = $_SESSION['examcode'];
$getrowcode = mysql_num_rows(mysql_query("SELECT * FROM exams WHERE code='$examcode'"));
$getassoccode = mysql_fetch_assoc(mysql_query("SELECT * FROM exams WHERE code='$examcode'"));

$date_array = getdate();
$now = $date_array['year'].'-'.$date_array['mon'].'-'.$date_array['mday'].' '.$date_array['hours'].':'.$date_array['minutes'].':'.$date_array['seconds'];
$getUserStatus = mysql_num_rows(mysql_query("SELECT * FROM exam_finished WHERE code='$examcode' AND user='$u'"));

$getrowcodequestions = mysql_num_rows(mysql_query("SELECT * FROM questions WHERE code='$examcode'"));

if($getassoccode['no_questions'] != $getrowcodequestions){
    exitPage('The exam is not ready');
}

if($examcode == ''){
    exitPage('There is no exam code');
}
if ($code == $examcode) {
    if ($getrowcode == 1) {
        if($getUserStatus != 1){
            if($getassoccode['endless'] != '1'){
                $getrowstarttime = mysql_num_rows(mysql_query("SELECT * FROM exams WHERE code='$examcode'AND start < '$now'"));
                if($getrowstarttime == 1){
                    $getrowendtime = mysql_num_rows(mysql_query("SELECT * FROM exams WHERE code='$examcode'AND start < '$now' AND end > '$now'"));
                    if ($getrowendtime == 1) {
                        $_SESSION['examcode'] = $code;
                    }else{
                        exitPage('Your exam has finished');
                        $_SESSION['examcode'] = "";
                        $time_exam = $getassoccode['time'];
                        mysql_query("UPDATE users SET current_exam_code='none' WHERE username='$u'");
                        mysql_query("UPDATE users SET current_exam_time='0' WHERE username='$u'");
                        mysql_query("INSERT INTO exam_finished VALUES('','$code','$u','$time_exam','still')");
                    }
                }else{
                    exitPage('Your exam isn\'t now.');
                }
            }
        }else{
            mysql_query("UPDATE users SET current_exam_code='none' WHERE username='$u'");
            mysql_query("UPDATE users SET current_exam_time='0' WHERE username='$u'");
            exitPage('You have submitted your exam');
        }
    }else{
        exitPage('Your code is not correct');
    }
}else{
    $_SESSION['examcode'] = "";
    exitPage('Enter your code first');
}


$getcodeinfo = mysql_fetch_assoc(mysql_query("SELECT * FROM exams WHERE code='$code'"));
$title = $getcodeinfo['subject'].' '.$getcodeinfo['acadmic_year'];
$totalno = $getcodeinfo['no_questions'];

if($getassoccode['endless'] != 1){
    $timeformat = "";
    $time_exam_hour = floor($getcodeinfo['time'] / 60);
    $time_exam_min = $getcodeinfo['time'];
    $time_exam_sec = $getcodeinfo['time'] * 60;
    $currentmin = $time_exam_min - ($time_exam_hour * 60);
    if($time_exam_hour < 10){
        $timeformat .= ("0".$time_exam_hour.":");
    }else{
        $timeformat .= ($time_exam_hour.":");
    }
    if($currentmin < 10){
        $timeformat .= ("0".$currentmin.":");
    }else{
        $timeformat .= ($currentmin.":");
    }
    $timeformat .= "00";


    $getAssocUser = mysql_fetch_assoc(mysql_query("SELECT * FROM users WHERE username='$u' AND current_exam_code='$code'"));
    $time_sec = $getAssocUser['current_exam_time'] * 60;
    echo "<script>var dataseconds = $time_sec;var mustseconds = $time_exam_sec;var examcode = $code;var notime = false;</script>";
    include_javascript_login('take_exam',$u); 
}else{
    echo "<script>var notime = true;var dataseconds = 0;var examcode = $code;</script>";
    include_javascript_login('take_exam',$u);
}

?>
<div class="row">
    <div class="col-xs-9">
        <h1><?php echo $title; ?></h1>
    </div>
    <?php
    if($getassoccode['endless'] != 1){
    ?>
    <div class="col-xs-3">
        <div style="float: right;">
            <div id="timePane" class="alert alert-info"><p style="display: inline;" id="time">00:00:00</p> From <p style="display: inline;"><?php echo $timeformat; ?></p></div>
        </div>
    </div>
    <?php }?>
</div>
<div class="row">
    <div id="exam_arena" class="col-xs-8">
        <script> openquestion('<?php echo $totalno; ?>','first','<?php echo $code; ?>'); </script>
    </div>
    <div id="exam_nav" class="col-xs-3">
        <div id="exam_nav_in" class="aside_exam"></div>
    </div>
    
    <div id="preferences" class="col-xs-1">
        <div class="aside_exam_preference">
            <button class="norm"><span class="glyphicon glyphicon-fullscreen"></span></button>
            <button class="norm" data-toggle="modal" data-target="#endExamModal"><span class="glyphicon glyphicon-upload"></span></button>
            <button data-toggle="modal" data-target="#reviewPage" onclick="updateReview('<?php echo $totalno; ?>','<?php echo $code; ?>');" class="norm"><span class="glyphicon glyphicon-calendar"></span></button>
            <button class="norm" onclick="flag('<?php echo $code; ?>')" id="flag" ><span class="glyphicon glyphicon-flag"></span></button>
        </div>
        
    </div>
</div>
<br/><br/>
<div style="float: right;">
    <button class="btn btn-default" style="display:none;" id="before" onclick="before('<?php echo $totalno; ?>','<?php echo $code; ?>');">◀︎</button>
    <button class="btn btn-primary" id="next" onclick="next('<?php echo $totalno; ?>','<?php echo $code; ?>');">Next</button>
    <button class="btn btn-primary" style="display: none;" data-toggle="modal" data-target="#reviewPage" onclick="updateReview('<?php echo $totalno; ?>','<?php echo $code; ?>');" id="review"><span class="glyphicon glyphicon-calendar"></span> Review</button>
</div>

<div class="modal fade" id="reviewPage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">
                    <span class="glyphicon glyphicon-calendar"></span> Review
                </h4>
            </div>
            <div class="modal-body">
                <div id="postForm">
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <input id="flagReview" onclick="updateReview('<?php echo $totalno; ?>','<?php echo $code; ?>');" type="checkbox"> <shit style="font-size: 17px;">Flagged <span class="glyphicon glyphicon-flag"></span></shit></input>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input id="unsolvedReview" onclick="updateReview('<?php echo $totalno; ?>','<?php echo $code; ?>');" type="checkbox"> <shit style="font-size: 17px;">Unsolved</shit></input>
                        </div>
                        <div class="col-md-3"></div>
                    </div><br/>
                    <div id="examReview" class="row" style="overflow-y: scroll;height: 400px;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="endExamModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">
                    ALERT!
                </h4>
            </div>
            <div class="modal-body">
                <div id="postForm">
                    Are you sure you want to end the exam now?<br/><br/>
                    <button onclick="finish('<?php echo $code; ?>',minutes)"  class="btn btn-danger">YES I AM SURE</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('inc/footer.inc.php');?>


