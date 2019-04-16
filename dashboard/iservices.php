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

        if(isset($_POST['searchname']))
        {
          $serviceno = $_POST['searchname'];
            $selectquery = "SELECT * FROM services WHERE serviceno LIKE '%$serviceno%'";
            $services = $bdd->getAll($selectquery);
          }
          else {
                $selectquery = "SELECT * FROM services";
                $services = $bdd->getAll($selectquery);
          }
        //
        
         // select ALL from allrecoards
    ?>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                <div class="col-sm-4">
                </div>
                <div class="col-sm-4">
                                    <form action="iservices.php" method="POST" role="search">
                                        <div class="form-group col-md-12">
                                            <input name="searchname" type="text" class="form-control" placeholder="Search">
                                        </div>
                                    </form>
                                    </div>
                    <div class="col-md-12">
                    
                        <div class="card">
                            <div class="header">
                                <h4 class="title">All Services</h4>
                                <p class="category">Visit <a target="_blank" href="../index.php">Home</a></p>
                            </div>
                            
                            <div class="content all-icons">
                                <div class="row">

                                <?php
                                foreach ($services as  $value) {
                                  echo '<div class="font-icon-list col-lg-2 col-md-3 col-sm-4 col-xs-6 col-xs-6">
                                 
                                  <div class="font-icon-detail"><i class="pe-7s-album"></i>
                                  
                                    Service Name : '.$value['servicetitle'].'</br>
                                    Service No : '.$value['serviceno'].'</br>
                                    Service Fee : '.$value['fee'].'</br>
                                    Date : '.$value['date'].'
                                  </div>

                                </div>';
                                }
                                ?>
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
