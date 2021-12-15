<?php

if($code != "none" && $code != ''){
    $getrowcode = mysql_num_rows(mysql_query("SELECT * FROM exams WHERE code='$code'"));
    $getUserStatus = mysql_num_rows(mysql_query("SELECT * FROM exam_finished WHERE code='$code' AND user='$u'"));
    $getassoccode = mysql_fetch_assoc(mysql_query("SELECT * FROM exams WHERE code='$code'"));
    $getrowcodequestions = mysql_num_rows(mysql_query("SELECT * FROM questions WHERE code='$code'"));
    $date_array = getdate();
    $now = $date_array['year'].'-'.$date_array['mon'].'-'.$date_array['mday'].' '.$date_array['hours'].':'.$date_array['minutes'].':'.$date_array['seconds'];
    if ($getrowcode == 1) {
         if($getassoccode['no_questions'] == $getrowcodequestions){
            if($getUserStatus != 1){
                if($getassoccode['endless'] != 1){
                    $getrowstarttime = mysql_num_rows(mysql_query("SELECT * FROM exams WHERE code='$code' AND start < '$now'"));
                    if($getrowstarttime == 1){
                        $getrowendtime = mysql_num_rows(mysql_query("SELECT * FROM exams WHERE code='$code'AND start < '$now' AND end > '$now'"));
                        if ($getrowendtime == 1) {
                            $_SESSION['examcode'] = $code;
                            header('Location: take_exam.php');
                        }else{
                            $_SESSION['examcode'] = "";
                            $time_exam = $getassoccode['time'];
                            mysql_query("UPDATE users SET current_exam_code='none' WHERE username='$u'");
                            mysql_query("UPDATE users SET current_exam_time='0' WHERE username='$u'");
                            mysql_query("INSERT INTO exam_finished VALUES('','$code','$u','$time_exam','still')");
                        }
                    }
                }else{
                    $_SESSION['examcode'] = $code;
                    header('Location: take_exam.php');
                }
            }else{
                $_SESSION['examcode'] = "";
                mysql_query("UPDATE users SET current_exam_code='none' WHERE username='$u'");
                mysql_query("UPDATE users SET current_exam_time='0' WHERE username='$u'");
            }
         }else{
             $_SESSION['examcode'] = "";
             mysql_query("UPDATE users SET current_exam_code='none' WHERE username='$u'");
             mysql_query("UPDATE users SET current_exam_time='0' WHERE username='$u'");
         }
    }
}else{
    $_SESSION['examcode'] = "";
}


?>