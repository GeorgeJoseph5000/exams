<div class="navbar navbar-inverse navbar-fixed-top" id="navigationbar">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Exams</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Products <b class="caret"></b></a>
                            
                <ul class="dropdown-menu" >

                <li><a  href="../main">Portfolio</a></li>   
                <li><a  href="../templates">HTML Templates</a></li> 
                <li class="divider"></li>   
				<li><a  href="index.php">Exams</a></li>
                <li><a  href="../eailio">Eailio</a></li>
                <li class="divider"></li>
                <li><a  href="../eailio2020">Eailio 2020</a></li>
                <li><a href="../challengemananger/">Challenge Manager</a></li>
                <li class="divider"></li>
				<li><a  href="../main/android.php">Focus</a></li>
				<li><a  href="../main/flutter.php">CloneGram</a></li> 
                </ul>
            </li>
                <?php if($u != ''){?>
                <!-- <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="glyphicon glyphicon-user"></span> Account 
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="settings.php">Settings</a></li>
                        <li><a href="exam.php">Exam</a></li>
                        <li><a href="homeworks.php">Homeworks</a></li>
                        <li><a href="emails.php">Emails</a></li>
                        <li><a href="chatting.php">Chatting</a></li>
                    </ul>
                </li> -->
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="glyphicon glyphicon-pencil"></span> Exam 
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="code_exam.php">Take Exam</a></li>
                        <li><a href="solved_exams.php">View Solved Exams</a></li>
                    </ul>
                </li>
                
                <?php if($user_pos == "admin"){ ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="glyphicon glyphicon-record"></span> Admin 
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="add_exam.php">Add Exam</a></li>
                        <li><a href="manage_exams.php">Manage Exams</a></li>
                        <li><a href="add_user.php">Add User</a></li>
                        <li><a href="manage_users.php">Manage Users</a></li>
                    </ul>
                </li>
                
                <?php
                      } 
                    } ?>
            </ul>
            
            <ul class="nav navbar-nav navbar-right">
                <?php if($u != ''){?>
                <li><a href="profile.php">Hello, <?php echo $fn; ?></a></li>
                <li><a href="logout.php">Log out</a></li>
                <?php }else{ ?>
                <li><a href="index.php">Login</a></li>
                <li><a href="register.php">Register</a></li>
                
                <?php } ?>
            </ul>
        </div>
    </div>
</div>
<br/><br/><br/><br/>
<div class="container body-content">