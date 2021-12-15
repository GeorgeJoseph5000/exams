<?php $title='Add Exam'; include("inc/headeruser.inc.php");  

$date_array = getdate();
$now = $date_array['year'].'-'.$date_array['mon'].'-'.$date_array['mday'].' '.$date_array['hours'].':'.$date_array['minutes'].':'.$date_array['seconds'];


$error = '';

if($user_pos != "admin"){
    exitPage("You are not allowed to do this");
}

                                
$sub = strip_tags(@$_POST['sub']);
$subject = strip_tags(@$_POST['subject']);
$code = strip_tags(@$_POST['code']);
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
                            $codecheck = mysql_num_rows(mysql_query("SELECT * FROM exams WHERE code = '$code'"));
                            if($codecheck != 0){
                                $error = '<div class="alert alert-danger">This code has been used.</div>';
                            }else{
                                $uuu = $_SESSION ['THEUSERLOGIN'];
                                mysql_query("INSERT INTO exams VALUES ('', '$code', '$subject', '$year', '$noofquestions', '0','0','$uuu','$time','$start','$end','0')");
                                //header("Location: add_questions.php?code=$code&no=$noofquestions");
                                echo "<script>window.location.href = 'add_questions.php?code=".$code."&no=".$noofquestions."'</script>";
                            }
                        }
                    }
                }
            }else{
                $codecheck = mysql_num_rows(mysql_query("SELECT * FROM exams WHERE code = '$code'"));
                if($codecheck != 0){
                    $error = '<div class="alert alert-danger">This code has been used.</div>';
                }else{
                    $uuu = $_SESSION ['THEUSERLOGIN'];
                    mysql_query("INSERT INTO exams VALUES ('', '$code', '$subject', '$year', '$noofquestions', '0','0','$uuu','','','','1')");
                    //header("Location: add_questions.php?code=$code&no=$noofquestions");
                    echo "<script>window.location.href = 'add_questions.php?code=".$code."&no=".$noofquestions."'</script>";   
                }
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
                            $codecheck = mysql_num_rows(mysql_query("SELECT * FROM exams WHERE code = '$code'"));
                            if($codecheck != 0){
                                $error = '<div class="alert alert-danger">This code has been used.</div>';
                            }else{
                                $uuu = $_SESSION ['THEUSERLOGIN'];
                                mysql_query("INSERT INTO exams VALUES ('', '$code', '$subject', '$year', '$noofquestions', '0','0','$uuu','$time','$start','$end','0')");
                                //header("Location: add_questions.php?code=$code&no=$noofquestions");  
                                echo "<script>window.location.href = 'add_questions.php?code=".$code."&no=".$noofquestions."'</script>"; 
                            }
                        }
                    }
                }
            }else{
                $codecheck = mysql_num_rows(mysql_query("SELECT * FROM exams WHERE code = '$code'"));
                if($codecheck != 0){
                    $error = '<div class="alert alert-danger">This code has been used.</div>';
                }else{
                    $uuu = $_SESSION ['THEUSERLOGIN'];
                    mysql_query("INSERT INTO exams VALUES ('', '$code', '$subject', '$year', '$noofquestions', '0','0','$uuu','','','','1')");
                    //header("Location: add_questions.php?code=$code&no=$noofquestions");  
                    echo "<script>window.location.href = 'add_questions.php?code=".$code."&no=".$noofquestions."'</script>"; 
                }
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
            <h1>Add Exam</h1>
            <input type="text" style="width:100%;" class="form-control" placeholder="Subject" name="subject" /><br />
            <input type="number" style="width:100%;" class="form-control" placeholder="Code" name="code" /><br />
            <input type="text" style="width:100%;" class="form-control" placeholder="Year" name="year" /><br />
            <input type="number" style="width:100%;" class="form-control" placeholder="Number of Questions"
                name="noofquestions" /><br />
            <h3 data-toggle="modal" data-target="#now">Date</h3>
            <input type="date" style="width:100%;" class="form-control" placeholder="" id="date" name="date" /><br />
            <input type="number" id="fromhour" style="display: inline; width: 49%;margin-right: 1%;"
                class="form-control" placeholder="From (Hours)" name="fromhour" /><input type="number" id="frommin"
                style="display: inline; width: 49%;margin-left: 1%;" class="form-control" placeholder="From (Minutes)"
                name="frommin" /><br /><br />
            <input type="number" id="tohour" style="display: inline;width: 49%;margin-right: 1%;" class="form-control"
                placeholder="To (Hours)" name="tohour" /><input type="number" id="tomin"
                style="display: inline;width: 49%;margin-left: 1%;" class="form-control" placeholder="To (Minutes)"
                name="tomin" /><br /><br />
            <input type="checkbox" name="notime" id="notime" style="display: inline-block;">
            <div style="display: inline-block;">&nbsp; No time limit</div><br><br>
            <input type="submit" class="btn btn-primary" text="Submit" name="sub" /><br /><br />
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
    document.getElementById("notime").addEventListener("change", () => {
        if (document.getElementById("notime").checked) {
            document.getElementById("fromhour").disabled = true;
            document.getElementById("tohour").disabled = true;
            document.getElementById("frommin").disabled = true;
            document.getElementById("tomin").disabled = true;
            document.getElementById("date").disabled = true;
        }else{
            document.getElementById("fromhour").disabled = false;
            document.getElementById("tohour").disabled = false;
            document.getElementById("frommin").disabled = false;
            document.getElementById("tomin").disabled = false;
            document.getElementById("date").disabled = false;
            
        }
    });
</script>

<?php include("inc/footer.inc.php"); ?>	