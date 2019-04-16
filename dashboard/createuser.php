<!doctype html>
<html lang="en">
<?php
      include('head.php');
?>

<body>


<div class="wrapper">
    <?php
        include('sidebar.php');
    ?>

    <div class="main-panel">
        
            <?php
                include('navheader.php');
            ?>

<?php
include_once("../config/config.php");
$bdd = new db(); // create a new object, class db()
   
   if(isset($_POST['firstname'])&&isset($_POST['lastname'])&&isset($_POST['email'])&&isset($_POST['password'])&&isset($_POST['username']))
   {
		
	   $username = $_POST['username'];
       $firstname = $_POST['firstname'];
       $lastname = $_POST['lastname'];
       $email = $_POST['email'];
       $password = $_POST['password'];
	   $role_id = 2;
       
       $query = "INSERT INTO users (firstname,lastname,username,email,password,role_id) values('$firstname','$lastname','$username','$email','$password','$role_id')";
           try {
            
            $response = $bdd->execute($query);	
            if($response ==1){
                echo("User Created Successfully");
            }else{
                echo"Error Creating Account Try Again!!";  
            }
           } catch (Exception $e) {
              echo"The error is : ",$e->getMessage();
           }    
   }else{
      echo("FILL ALL FIELDS");
   }
?>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Create User</h4>
                            </div>
                            <div class="content">
                                <form action="createuser.php" method="POST">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Username</label>
                                                <input name="username" type="text" class="form-control" placeholder="Enter Username">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input name="password" type="password" class="form-control" placeholder="Enter Password">
                                            </div>
                                        </div>
                                      
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>First Name</label>
                                                <input name="firstname" type="text" class="form-control" placeholder="First Name">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Last Name</label>
                                                <input name="lastname"  type="text" class="form-control" placeholder="Last Name">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input name="email"  type="email" class="form-control" placeholder="Enter Email">
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-info btn-fill pull-right">Create User</button>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                
                </div>
            </div>


        </div>

<?php
        include('footer.php');
?>
    </div>
</div>


</body>

        <!--   Core JS Files   -->
    

</html>
