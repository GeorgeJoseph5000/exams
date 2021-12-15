<?php $title='Edit Exam'; include("inc/headeruser.inc.php");  


$date_array = getdate();
$now = $date_array['year'].'-'.$date_array['mon'].'-'.$date_array['mday'].' '.$date_array['hours'].':'.$date_array['minutes'].':'.$date_array['seconds'];


$error = '';

$code = $_GET['code'];

if(!isset($code) || $code == ""){
    exitPage("Error");
}

$checkquery = mysql_query("SELECT * FROM exams WHERE code='$code' AND added_by='$u'");
$checkqueryassoc = mysql_fetch_assoc($checkquery);
$datequery = $checkqueryassoc['start'];
$date_start_array = date_parse($datequery);
$datequery = $checkqueryassoc['end'];
$date_end_array = date_parse($datequery);
$date_start_month = $date_start_array['month'];
if($date_start_month < 10){
    $date_start_month = '0'.$date_start_month;
}
$date_start_day = $date_start_array['day'];
if($date_start_day < 10){
    $date_start_day = '0'.$date_start_day;
}
// yearmonthdayhourminutesecondfractionwarning_countwarningserror_counterrorsis_localtime


if(mysql_num_rows($checkquery) != 1){
    exitPage("Error");
}

if($user_pos != "admin"){
    exitPage("You are not allowed to do this");
}


$sub = strip_tags(@$_POST['sub']);
    $subject = $_POST['subject'];

    $year = strip_tags(@$_POST['year']);
    $date = strip_tags(@$_POST['date']);
    $notime = strip_tags(@$_POST['notime']);
    $fromh = strip_tags(@$_POST['fromhour']);
    $frommin = strip_tags(@$_POST['frommin']);
    $toh = strip_tags(@$_POST['tohour']);
    $tomin = strip_tags(@$_POST['tomin']);
    $noofquestions = strip_tags(@$_POST['noofquestions']);




if(isset($sub)){
    
    if($subject == '' || $code == '' || $year == '' || $code < 1){
        $error = '<div class="alert alert-danger">Fill in the fields with valid data</div>';
    }else{
        if($notime == "on"){
    if (strlen($code) != 9) {
        $error = '<div class="alert alert-danger">The code must be 9 characters./</div>';        
    }else{
        if ($noofquestions > 100 || $noofquestions < 1) {
            $error = '<div class="alert alert-danger">The number of questions can\'t be more than 100 questions.</div>';
        }else{
            if($notime != "on"){
    
            
                if($fromh < 0 || $frommin < 0 || $toh < 0 || $tomin < 0){
                    $error = '<div class="alert alert-danger">Time can\'t be negative</div>';
                }else{
                    if($fromh > 24 || $toh > 24 || $frommin > 60 || $tomin > 60){
                        $error = '<div class="alert alert-danger">Time is invalid</div>';
                    }else{
                        $time = ($toh - $fromh) * 60;
                        $start = '';
                        $end = '';
                        if($time < 0){
                            $error = '<div class="alert alert-danger">Use 24 hour clock</div>';
                        }else{
                            if($frommin > $tomin){
                                $min = $frommin - $tomin;
                                $time = $time - $min;
                            }
                            if($frommin < $tomin){
                                $min = $tomin - $frommin;
                                $time = $time + $min;
                            }
                            
                            $start = $date.' '.$fromh.':'.$frommin.':00';
                            $end = $date.' '.$toh.':'.$tomin.':00';
                            
                                $uuu = $_SESSION ['THEUSERLOGIN'];
                                mysql_query("DELETE FROM `exams` WHERE `exams`.`code` = $code");
                                mysql_query("INSERT INTO exams VALUES ('', '$code', '$subject', '$year', '$noofquestions', '0','0','$uuu','$time','$start','$end','0')");
                                //header("Location: edit_questions.php?code=$code&no=$noofquestions"); 
                                echo "<script>window.location.href = 'edit_questions.php?code=".$code."&no=".$noofquestions."'</script>";
                            
                        }
                    }
                }
            }else{
                
                    $uuu = $_SESSION ['THEUSERLOGIN'];
                    mysql_query("DELETE FROM `exams` WHERE `exams`.`code` = $code");
                    mysql_query("INSERT INTO exams VALUES ('', '$code', '$subject', '$year', '$noofquestions', '0','0','$uuu','','','','1')");
                    //header("Location: edit_questions.php?code=$code&no=$noofquestions"); 
                    echo "<script>window.location.href = 'edit_questions.php?code=".$code."&no=".$noofquestions."'</script>";  
                
            }
            
        }
    }
        }else{
            if($date == '' || $fromh == '' || $frommin == '' || $toh == '' || $tomin == ''){
                $error = '<div class="alert alert-danger">Fill in the fields with valid data</div>';
            }else{
    if (strlen($code) != 9) {
        $error = '<div class="alert alert-danger">The code must be 9 characters./</div>';        
    }else{
        if ($noofquestions > 100 || $noofquestions < 1) {
            $error = '<div class="alert alert-danger">The number of questions can\'t be more than 100 questions.</div>';
        }else{
            if($notime != "on"){
    
            
                if($fromh < 0 || $frommin < 0 || $toh < 0 || $tomin < 0){
                    $error = '<div class="alert alert-danger">Time can\'t be negative</div>';
                }else{
                    if($fromh > 24 || $toh > 24 || $frommin > 60 || $tomin > 60){
                        $error = '<div class="alert alert-danger">Time is invalid</div>';
                    }else{
                        $time = ($toh - $fromh) * 60;
                        $start = '';
                        $end = '';
                        if($time < 0){
                            $error = '<div class="alert alert-danger">Use 24 hour clock</div>';
                        }else{
                            if($frommin > $tomin){
                                $min = $frommin - $tomin;
                                $time = $time - $min;
                            }
                            if($frommin < $tomin){
                                $min = $tomin - $frommin;
                                $time = $time + $min;
                            }
                            
                            $start = $date.' '.$fromh.':'.$frommin.':00';
                            $end = $date.' '.$toh.':'.$tomin.':00';
                           
                                $uuu = $_SESSION ['THEUSERLOGIN'];
                                mysql_query("DELETE FROM `exams` WHERE `exams`.`code` = $code");
                                mysql_query("INSERT INTO exams VALUES ('', '$code', '$subject', '$year', '$noofquestions', '0','0','$uuu','$time','$start','$end','0')");
                                //header("Location: edit_questions.php?code=$code&no=$noofquestions"); 
                                echo "<script>window.location.href = 'edit_questions.php?code=".$code."&no=".$noofquestions."'</script>";  
                            
                        }
                    }
                }
            }else{               
                    $uuu = $_SESSION ['THEUSERLOGIN'];
                    mysql_query("DELETE FROM `exams` WHERE `exams`.`code` = $code");
                    mysql_query("INSERT INTO exams VALUES ('', '$code', '$subject', '$year', '$noofquestions', '0','0','$uuu','','','','1')");
                    //header("Location: edit_questions.php?code=$code&no=$noofquestions");   
                    echo "<script>window.location.href = 'edit_questions.php?code=".$code."&no=".$noofquestions."'</script>";  
                
            }
            
        }
    }
            }
        }
        
        
    }
}

?>

<form method="POST">
    <div class="row">
        <div class="col-md-5">
            <h1>Edit Exam</h1>
            <input type="text" style="width:100%;" class="form-control" value="<?php echo $checkqueryassoc['subject']; ?>" placeholder="Subject" name="subject" /><br/>
            <input type="number" style="width:100%;" disabled value="<?php echo $checkqueryassoc['code']; ?>" class="form-control" placeholder="Code" name="code"/><br/>
            <input type="text" style="width:100%;" value="<?php echo $checkqueryassoc['acadmic_year']; ?>" class="form-control" placeholder="Year" name="year"/><br/>
            <input type="number" style="width:100%;" value="<?php echo $checkqueryassoc['no_questions']; ?>" class="form-control" placeholder="Number of Questions" name="noofquestions"/><br/>
            <h3 data-toggle="modal" data-target="#now">Date</h3>
            <input id="date" type="date" value="<?php echo $date_start_array['year']."-".$date_start_month.'-'.$date_start_day; ?>"  style="width:100%;" class="form-control" placeholder="" name="date"/><br/>
            <input id="date1" type="number" value="<?php echo $date_start_array['hour']; ?>" style="display: inline; width: 49%;margin-right: 1%;" class="form-control" placeholder="From (Hours)" name="fromhour"/><input id="date3" value="<?php echo $date_start_array['minute']; ?>" type="number" style="display: inline; width: 49%;margin-left: 1%;" class="form-control" placeholder="From (Minutes)" name="frommin"/><br/><br/>
            <input id="date2" type="number" value="<?php echo $date_end_array['hour']; ?>" style="display: inline;width: 49%;margin-right: 1%;" class="form-control" placeholder="To (Hours)" name="tohour"/><input id="date4" value="<?php echo $date_end_array['minute']; ?>" type="number" style="display: inline;width: 49%;margin-left: 1%;" class="form-control" placeholder="To (Minutes)" name="tomin"/><br/><br/>
<input type="checkbox" <?php echo $checkqueryassoc['endless'] == 1 ? 'checked' : ''; ?> name="notime" id="notime" style="display: inline-block;"/>
<div style="display: inline-block;">&nbsp; No time limit</div><br><br>            
<input type="submit" class="btn btn-primary" text="Submit" name="sub"/><br/><br/>

            <?php if(isset($_POST['sub'])){ echo $error;} ?>
        </div>
    </div>
</form>
<div class="modal fade" id="now" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">
                    Now
                </h4>
            </div>
            <div class="modal-body">
                <div id="postForm">
                    <?php echo $now; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
if (document.getElementById("notime").checked) {
            document.getElementById("date").disabled = true;

            document.getElementById("date1").disabled = true;

            document.getElementById("date2").disabled = true;

            document.getElementById("date3").disabled = true;
            document.getElementById("date4").disabled = true;

        }else{
            document.getElementById("date").disabled = false;

            document.getElementById("date1").disabled = false;

            document.getElementById("date2").disabled = false;

            document.getElementById("date3").disabled = false;

            document.getElementById("date4").disabled = false;
            
        }
    document.getElementById("notime").addEventListener("change", () => {
        if (document.getElementById("notime").checked) {
            document.getElementById("date").disabled = true;

            document.getElementById("date1").disabled = true;

            document.getElementById("date2").disabled = true;

            document.getElementById("date3").disabled = true;
            document.getElementById("date4").disabled = true;

        }else{
            document.getElementById("date").disabled = false;

            document.getElementById("date1").disabled = false;

            document.getElementById("date2").disabled = false;

            document.getElementById("date3").disabled = false;

            document.getElementById("date4").disabled = false;
            
        }
    });
</script>

<?php include("inc/footer.inc.php"); ?>