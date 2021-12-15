<?php
include('inc/connect.inc.php');
error_reporting(0);
$i = $_POST['no'];

$user = $_POST['user'];
$code = $_POST['code'];
$select_answer = $_POST['select'];
$question = $_POST['question'];
$answer = $_POST['answer'];
$choice1 = $_POST['choice1'];
$choice2 = $_POST['choice2'];
$choice3 = $_POST['choice3'];
$choice4 = $_POST['choice4'];

$questionimage = $_POST['questionimage'];
$choice1image = $_POST['choice1image'];
$choice2image = $_POST['choice2image'];
$choice3image = $_POST['choice3image'];
$choice4image = $_POST['choice4image'];

if ($questionimage != "") {
    if(!is_array(getimagesize($questionimage))){
        exit('These are not valid images');
    }
}
if ($choice1image != "") {
    if(!is_array(getimagesize($choice1image))){
        exit('These are not valid images');
    }
}
if ($choice2image != "") {
    if(!is_array(getimagesize($choice2image))){
        exit('These are not valid images');
    }
}
if ($choice3image != "") {
    if(!is_array(getimagesize($choice3image))){
        exit('These are not valid images');
    }
}
if ($choice4image != "") {
    if(!is_array(getimagesize($choice4image))){
        exit('These are not valid images');
    }
}

if ($question == '' && $questionimage == '') {
    echo 'Fill required fields';
}else if($select_answer == 'none'){
    echo 'Choose answering method';
}else if($select_answer == 'Choose'){
    if(($choice1 == '' && $choice1image == '') || ($choice2 == '' && $choice2image == '') || ($choice3 == '' && $choice3image == '') || ($choice4 == '' && $choice4image == '')){
        echo 'Fill required fields';
    }else{
        
        $query = "INSERT INTO questions VALUES(''";

        if($questionimage != ""){
            $query .= ",'&nbsp;$question&nbsp;<br/><img class=\"img-responsive\" src=\"$questionimage\"/>'";
        }else{
            $query .= ",'&nbsp;$question'";
        }

        if ($choice1image != "") {
            $query .= ",'&nbsp;$choice1&nbsp;<br/><img class=\"img-responsive\" src=\"$choice1image\"/>'";
        }else{
            $query .= ",'&nbsp;$choice1'";
        }


        if ($choice2image != "") {
            $query .= ",'&nbsp;$choice2&nbsp;<br/><img class=\"img-responsive\" src=\"$choice2image\"/>'";
        }else{
            $query .= ",'&nbsp;$choice2'";
        }
        
        if ($choice3image != "") {
            $query .= ",'&nbsp;$choice3&nbsp;<br/><img class=\"img-responsive\" src=\"$choice3image\"/>'";
        }else{
            $query .= ",'&nbsp;$choice3'";
        }
        
        if ($choice4image != "") {
            $query .= ",'&nbsp;$choice4&nbsp;<br/><img class=\"img-responsive\" src=\"$choice4image\"/>'";
        }else{
            $query .= ",'&nbsp;$choice4'";
        }

        $query .= ",'1','0','0','$code','$answer','$user','$i')";

        $query1 = mysql_query("SELECT * FROM questions WHERE code='$code' AND added_by='$user' AND no='$i'"); 
        $getQuestionNo = mysql_num_rows($query1);
        if($getQuestionNo == 0){
            mysql_query($query);
        }else{
            mysql_query("DELETE FROM questions WHERE code='$code' AND added_by='$user' AND no='$i'");
            mysql_query($query);
        }
        echo 'Question '.$i.' is submitted successfully';
    }
    
}else{    
    if ($select_answer == 'Text') {
        $query = "INSERT INTO questions VALUES(''";

        if($questionimage != ""){
            $query .= ",'&nbsp;$question&nbsp;<br/><img class=\"img-responsive\" src=\"$questionimage\"/>'";
        }else{
            $query .= ",'&nbsp;$question'";
        }

        if ($choice1image != "") {
            $query .= ",'&nbsp;$choice1&nbsp;<br/><img class=\"img-responsive\" src=\"$choice1image\"/>'";
        }else{
            $query .= ",'&nbsp;$choice1'";
        }


        if ($choice2image != "") {
            $query .= ",'&nbsp;$choice2&nbsp;<br/><img class=\"img-responsive\" src=\"$choice2image\"/>'";
        }else{
            $query .= ",'&nbsp;$choice2'";
        }
        
        if ($choice3image != "") {
            $query .= ",'&nbsp;$choice3&nbsp;<br/><img class=\"img-responsive\" src=\"$choice3image\"/>'";
        }else{
            $query .= ",'&nbsp;$choice3'";
        }
        
        if ($choice4image != "") {
            $query .= ",'&nbsp;$choice4&nbsp;<br/><img class=\"img-responsive\" src=\"$choice4image\"/>'";
        }else{
            $query .= ",'&nbsp;$choice4'";
        }

        $query .= ",'0','0','1','$code','$answer','$user','$i')";

        $query1 = mysql_query("SELECT * FROM questions WHERE code='$code' AND added_by='$user' AND no='$i'"); 
        $getQuestionNo = mysql_num_rows($query1);
        if($getQuestionNo == 0){
            mysql_query($query);
        }else{
            mysql_query("DELETE FROM questions WHERE code='$code' AND added_by='$user' AND no='$i'");
            mysql_query($query);
        }
        
    
    }
    if ($select_answer == 'Drawing') {
        mysql_query("INSERT INTO questions VALUES('','$question','$choice1','$choice2','$choice3','$choice4','0','1','0','$code','','$user','$i')");
    
    }
    echo 'Question '.$i.' is submitted successfully';
}








?>