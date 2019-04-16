<!doctype html>
<html lang="en">

<?php
        include_once('head.php');
       
        if(isset($_POST['id'])){
            $id = $_POST['id']; 
          
        }
        
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
        
        $selectquery = "SELECT * FROM services WHERE id='$id'";
        $services = $bdd->getOne($selectquery); // select ALL from allrecoards  
        
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
                            <form method="POST" action="updateservice.php">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="hidden" invisible value="<?php echo $services['id']?>" name ="id">
                                                <label>Service Title</label>
                                                
                                                <input value="<?php echo $services['servicetitle']?>" name="servicetitle" type="text" class="form-control" placeholder="Enter Service Title">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Fee </label>
                                                <input value="<?php echo $services['fee']?>" name="fee" type="text" class="form-control" placeholder="Enter Fee" >
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Service No</label>
                                                <input value="<?php echo $services['serviceno']?>" name="serviceno" type="text" class="form-control" placeholder="Enter Service Number">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Date</label>
                                                <input value="<?php echo $services['date']?>" name="date" type="date" class="form-control" placeholder="Pick Date">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Description</label>
                                                <textarea  name="description" rows="5" class="form-control" placeholder="Describe the service here" ><?php echo $services['description']?></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <button name="create" type="submit" class="btn btn-info btn-fill pull-right">Update Iservice</button>
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
</html>
