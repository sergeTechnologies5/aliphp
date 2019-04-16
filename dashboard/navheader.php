<?php
       session_start();
       if(!isset($_SESSION['username'])){
          header('location:login.php');	
        }
        $username = $_SESSION['username'];
?>

<nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#"><?php echo  $username.' is logged in'?></a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-left">
                        <p class="hidden-lg hidden-md">Search</p>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li>
                           <a href="userprofile.php">
                               <p>Account Profile</p>
                            </a>
                        </li>
                        <li>
                            <a href="logout.php">
                                <p>Log out</p>
                            </a>
                        </li>
						<li class="separator hidden-lg hidden-md"></li>
                    </ul>
                </div>
            </div>
</nav>
       