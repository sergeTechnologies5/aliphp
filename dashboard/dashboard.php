<!doctype html>
<html lang="en">

<?php
        include('head.php');
?>
<body>

<div class="wrapper">
    
    <?php
        include('sidebar.php');
        include('../config/config.php');
        $bdd = new db(); // create a new object, class db()

             //admins
        $services = 'CREATE TABLE IF NOT EXISTS services (
            id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            servicetitle VARCHAR(100) NOT NULL,
            fee VARCHAR(100) NOT NULL,
                serviceno VARCHAR(100) NOT NULL,
                date VARCHAR(100) NOT NULL,
                description VARCHAR(100) DEFAULT "",
            date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP ,
            date_modified DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            )';
            try{
            $response = $bdd->execute($services);  
        } catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
        $selectquery = "SELECT * FROM services";
        $services = $bdd->getAll($selectquery); // select ALL from allrecoards  
        if(isset($_POST['servicetitle'])&&isset($_POST['fee'])&&isset($_POST['serviceno'])&&isset($_POST['date'])&&isset($_POST['description'])&&isset($_POST['create']))
        {
            $description = $_POST['description'];
            $servicetitle = $_POST['servicetitle'];
            $fee = $_POST['fee'];
            $serviceno = $_POST['serviceno'];
            $date = $_POST['date'];
            $role_id = 1;
            $createquery = "INSERT INTO services (fee,servicetitle,serviceno,date,description) values('$fee','$servicetitle','$serviceno','$date','$description')";
           
            try 
            {
             $response = $bdd->execute($createquery);	
             if($response==1){
                 header("location:dashboard.php");
             }else{
                 echo("Error Creating the Service Try Again");
             }
            }catch(Exception $ex){
            }   
                 
        }else{
           echo("FILL ALL FIELDS");
        }
    ?>
    <div class="main-panel">
        <?php
             include('navheader.php');
        ?>
     
        <div class="content">
            <div class="container-fluid">
               
                <div class="row">
                    <div class="col-md-6">
                        <div class="card ">
                            <div class="header">
                                <h4 class="title">Create Service</h4>
                                <p class="category">Please Provide Details About The Service</p>
                            </div>
                            <div class="content">
                            <form method="POST" action="dashboard.php">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Service Title</label>
                                                <input name="servicetitle" type="text" class="form-control" placeholder="Enter Service Title">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Fee </label>
                                                <input name="fee" type="text" class="form-control" placeholder="Enter Fee" >
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Service No</label>
                                                <input name="serviceno" type="text" class="form-control" placeholder="Enter Service Number">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Date</label>
                                                <input name="date" type="date" class="form-control" placeholder="Pick Date">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Description</label>
                                                <textarea name="description" rows="5" class="form-control" placeholder="Describe the service here" ></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <button name="create" type="submit" class="btn btn-info btn-fill pull-right">Create Service</button>
                                    <div class="clearfix"></div>
                                </form>

                                <div class="footer">
                                    <div class="legend">
                                        <i class="fa fa-circle text-info"></i>
                                        <i class="fa fa-circle text-danger"></i>
                                    </div>
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-check"></i> Data information certified
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card ">
                            <div class="header">
                                <h4 class="title">All Services</h4>
                                <p class="category">County Services</p>
                            </div>
                            <div class="content">
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <th>ID</th>
                                    	<th>Service Name</th>
                                    	<th>Service No</th>
                                    	<th>Desription</th>
                                    	<th>Date</th>
                                    </thead>
                                    <tbody>
                                    <?php
                                    //
                                    foreach ($services as $value) {
                                    echo ' <tr>
                                    <td>'.$value['id'].'</td>
                                    <td>'.$value['servicetitle'].'</td>
                                    <td>'.$value['serviceno'].'</td>
                                    <td>'.$value['description'].'</td>
                                    <td>'.$value['date'].'</td>
                                    <td> <a href="deleteservice.php/?id='.$value['id'].'">Delete </a> </td>
                                    <td><form action="updateiservice.php" method="POST">
                                    <button name="id" value="'.$value['id'].'" type="submit" class="btn btn-primary">Update </button>
                                    </form> </td>
                                    </tr>';
                                    }
                                    ?>    
                                    </tbody>
                                </table>
                            </div>
                                <div class="footer">
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-history"></i><?php
                                                                    echo 'Total Services  '. count($services);?>
                                    </div>
                                </div>
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

    

</html>
