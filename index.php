<?php $title = 'Login'; include('inc/header.inc.php'); 
$msg = '<div class="alert alert-danger">Login, Please.</div>';

if ($u != '') {
    echo '<script>window.location.href = "profile.php"</script>';
    exit();
}

$submit = strip_tags(@$_POST['sub']);
$user = strip_tags(@$_POST['us']);
$pass = strip_tags(@$_POST['ps']);
$error = '';


if(isset($submit)){
    if($user == '' || $pass == ''){
        $error = '<div class="alert alert-danger">Enter your information, please!</div>';
    }else{
        $query = "SELECT * FROM users WHERE username='$user' AND password='$pass' LIMIT 1";
        $query_ex = mysql_query($query);
        $query_nr = mysql_num_rows($query_ex);
        if($query_nr == 1){
            $_SESSION['THEUSERLOGIN'] = $user;
            header('Location: profile.php');
            exit();
        }else{
            $error = '<div class="alert alert-danger">Your input does not exist.</div>';
        }
    }
     

}


?>
<div class="row">

    <div class="col-md-8">
        <img src="http://www.dailynews.lk/sites/default/files/news/2020/12/13/10-Online-01.jpg" style="width: 100%;"/>
    </div>
    <div class="col-md-4">
        <h1>Login</h1>
        <form method="POST" style="text-align:center;">
            <input type="text" style="width:100%" name="us" placeholder="Username" class="form-control" /><br/>
            <input type="password" style="width:100%"  name="ps" placeholder="Password" class="form-control"/><br/>
            <input type="submit"   name="sub" class="btn btn-primary" value="Login"/><br/>
        </form><br/>
    </div>
    
</div>
<?php  if(isset($_GET['login'])){if(!isset($_POST['sub']) && $_GET['login'] == 1){echo $msg;}} if(isset($_POST['sub'])){ echo $error;} ?>



<?php include('inc/footer.inc.php')?>

