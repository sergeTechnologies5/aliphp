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
            $user_id = $_SESSION['id'];
            $selectuser = "SELECT * FROM users WHERE id='$user_id'";
            include_once("../config/config.php");
            $bdd = new db(); // create a new object, class db()
                 //admins
            $admins = 'CREATE TABLE IF NOT EXISTS address (
                id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                address VARCHAR(100) NOT NULL,
                city VARCHAR(100) NOT NULL,
                user_id INT NOT NULL,
                    county VARCHAR(100) NOT NULL,
                    postalcode VARCHAR(100) DEFAULT "",
                    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
                date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP ,
                date_modified DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                )';
                try{
                $response = $bdd->execute($admins);  
            } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
            }
            //header('location:cancle.php');
            $result = $bdd->getOne($selectuser);
            $selectaddress="SELECT * FROM address where id='$user_id'";
            $addressresult = $bdd->getOne($selectaddress); 

            if(isset($_POST['updateprofile'])){
                $firstname = $_POST['firstname'];
                $username = $_POST['username'];
                $aboutme = $_POST['aboutme'];
                $email = $_POST['email'];
                $lastname = $_POST['lastname'];
                $city = $_POST['city'];
                $county = $_POST['county'];
                $address = $_POST['address'];
                $zip = $_POST['zip'];

                $updateuserquery = "UPDATE users SET aboutme='$aboutme',email='$email', firstname='$firstname',username='$username', lastname='$lastname' WHERE id='$user_id'";
                $updateaddressquery = "UPDATE address SET city='$city', county='$county',postalcode='$zip', address='$address' WHERE id='$user_id'";

                $updateuserresult = $bdd->execute($updateuserquery);
                $updateuserresult = $bdd->execute($updateaddressquery);
                header("location:/ali/dashboard/userprofile.php");
            }else if(isset($_POST['addaddress'])){
                //address
                $city = $_POST['city'];
                $county = $_POST['county'];
                $address = $_POST['address'];
                $zip = $_POST['zip'];
                $query = "INSERT INTO address (city,county,address,postalcode,user_id) values('$city','$county','$address','$zip','$user_id')";
           try {
            
            $response = $bdd->execute($query);
            if($response==1){
                header("location:/ali/dashboard/userprofile.php");
            }
           }catch(Exception $ex){

           }

            }
        
        ?>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Edit Profile</h4>
                               
                            </div>
                            <div class="content">
                                <form action="userprofile.php" method="POST">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Full Name</label>
                                                <input type="text" class="form-control"  placeholder="Company" value="<?php echo $result['firstname'].' '.$result['lastname'];?>">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Username</label>
                                                <input name="username" type="text" class="form-control" placeholder="Username" value="<?php echo $result['username'];?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Email address</label>
                                                <input name="email" type="email" class="form-control" placeholder="Email" value="<?php echo $result['email'];?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>First Name</label>
                                                <input name="firstname" value="<?php echo $result['firstname'];?>" type="text" class="form-control" placeholder="Company" value="Mike">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Last Name</label>
                                                <input name="lastname" value="<?php echo $result['lastname'];?>" type="text" class="form-control" placeholder="Last Name" value="Andrew">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <input name="address" type="text" value="<?php echo $addressresult['address'];?>" class="form-control" placeholder="Home Address">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>City</label>
                                                <input value="<?php echo $addressresult['city'];?>" name="city" type="text"  class="form-control" placeholder="City">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>County</label>
                                                <input name="county" type="text" value="<?php echo $addressresult['county'];?>" class="form-control" placeholder="County">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Postal Code</label>
                                                <input name="zip" type="number" value="<?php echo $addressresult['postalcode'];?>" class="form-control" placeholder="ZIP Code">
                                            </div>
                                        </div>
                                    </div>
                                   <?php
                                   if($addressresult<1){
                                       echo '<div class="row">
                                       <div class="col-md-12">
                                           <div class="form-group">
                                           <button name="addaddress" class="btn btn-info btn-fill pull-right">Add Address</button>  
                                           </div>
                                       </div>
                                   </div>';
                                   }
                                   ?>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>About Me</label>
                                                <textarea name="aboutme" value="aboutme" rows="5" class="form-control" placeholder="Here can be your description"><?php echo $result['aboutme'];?></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <button name="updateprofile" type="submit" class="btn btn-info btn-fill pull-right">Update Profile</button>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-user">
                            
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

</html>
