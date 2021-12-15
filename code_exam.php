<?php $title = 'Exam'; include('inc/headeruser.inc.php'); include_javascript_login('take_exam',$u); 


$sub = strip_tags(@$_POST['sub']);
$code = strip_tags(@$_POST['code']);
$date_array = getdate();
$now = $date_array['year'].'-'.$date_array['mon'].'-'.$date_array['mday'].' '.$date_array['hours'].':'.$date_array['minutes'].':'.$date_array['seconds'];
$getUserStatus = mysql_num_rows(mysql_query("SELECT * FROM exam_finished WHERE code='$code' AND user='$u'"));

$error = "";


if(isset($sub)){
    if (strlen($code) != 9) {
        $error = '<div class="alert alert-danger">Your code should be nine character long</div>';
    }else{
        $query = mysql_query("SELECT * FROM exams WHERE code='$code'");
        $getrowcode = mysql_num_rows($query);
        $assoc = mysql_fetch_assoc($query);
        if ($getrowcode == 1) {
            if ($assoc['added_by'] != $u) {
                if($getUserStatus != 1){
                    if($assoc['endless'] == 1){
                        $_SESSION['examcode'] = $code;
                        mysql_query("UPDATE users SET current_exam_code='$code' WHERE username='$u'");
                        header('Location: take_exam.php');
                    }else{
                        $getrowstarttime = mysql_num_rows(mysql_query("SELECT * FROM exams WHERE code='$code'AND start < '$now'"));
                        if($getrowstarttime == 1){
                            $getrowendtime = mysql_num_rows(mysql_query("SELECT * FROM exams WHERE code='$code'AND start < '$now' AND end > '$now'"));
                            if ($getrowendtime == 1) {
                                $_SESSION['examcode'] = $code;
                                mysql_query("UPDATE users SET current_exam_code='$code' WHERE username='$u'");
                                header('Location: take_exam.php');
                            }else{
                                $error = '<div class="alert alert-danger">Your exam has finished</div>';
                                $_SESSION['examcode'] = "";
                                mysql_query("UPDATE users SET current_exam_code='none' WHERE username='$u'");
                                mysql_query("UPDATE users SET current_exam_time='0' WHERE username='$u'");
                                
                                $noExaminer = $assoc['no_examiners'] + 1;
                                mysql_query("UPDATE exams SET no_examiners='$noExaminer' WHERE code='$code'");
                            }
                        }else{
                            $error = '<div class="alert alert-danger">Your exam isn\'t now.</div>';
                        }
                    }
                }else{
                    mysql_query("UPDATE users SET current_exam_code='none' WHERE username='$u'");
                    mysql_query("UPDATE users SET current_exam_time='0' WHERE username='$u'");
                    $error = '<div class="alert alert-danger">You have submitted your exam.</div>';
                }
            }else{
                $error = '<div class="alert alert-danger">You can\'t take an exam you have made.</div>';
            }
        }else{
            $error = '<div class="alert alert-danger">Your code is not correct</div>';
        }
    }
}

?>
<?php //echo $now; ?>
<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <form method="POST" style="text-align:center;">
            <h3>Enter your session code, please</h3>
            <input type="text" style="width:100%" name="code" placeholder="Code" class="form-control" /><br/>
            <input type="submit"  name="sub" class="btn btn-primary" value="Submit"/><br/>
        </form><br/>

    </div>
    <div class="col-md-4"></div>
</div>
<?php if(isset($_POST['sub'])){ echo $error;} ?> 
<?php include('inc/footer.inc.php')?>