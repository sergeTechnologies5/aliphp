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
                include_once("../config/config.php");
                $bdd = new db(); // create a new object, class db()
                $role_id= 2;
                $bdd = new db();
                if(isset($_POST['searchname'])){
                $username = $_POST['searchname'];
                $query = "SELECT * FROM users WHERE role_id='$role_id' AND  username LIKE '%$username%'";
                $users =$bdd->getAll($query);
                $role_id = 2;
                }else {
                    $query = "SELECT * FROM users where role_id='$role_id'";
                    $users =$bdd->getAll($query);
                }

                // 
                if(isset($_POST['searchcitizenname'])){
                    $username = $_POST['searchcitizenname'];
                    $id= 3;
                    $citizenquery = "SELECT * FROM users WHERE role_id='$id' AND  username LIKE '%$username%'";
                    $citizenusers =$bdd->getAll($citizenquery);
                   
                    }else {
                        $id = 3;
                        $citizenquery = "SELECT * FROM users where role_id='$id'";
                        $citizenusers =$bdd->getAll($citizenquery);
                    }
        ?>

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                            <!--  -->
                            <div class="card">
                            <div class="header">
                                <div class="row">
                                    <div class="col-sm-4">
                                            <h4 class="title">All Users</h4>
                                            <p class="category">Here is a list of Users</p>
                                    </div>
                                    <div class="col-sm-4">
                                    <form action="users.php" method="POST" role="search">
                                        <div class="form-group col-md-12">
                                            <input name="searchname" type="text" class="form-control" placeholder="Search">
                                        </div>
                                    </form>
                                    </div>
                                    <div class="col-sm-2">
                                        <form action="createuser.php" method="post">
                                        <button type="submit" class="btn btn-primary"> Create User</button>
                                        </form>
                                       
                                    </div>
                                </div>
                                
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <th>ID</th>
                                    	<th>First Name</th>
                                    	<th>Username</th>
                                    	<th>Last Name</th>
                                    	<th>Email</th>
                                    </thead>
                                    <tbody>
                                    <?php
                                            foreach ($users as $value) {
                                               echo'<tr>
                                               <td>'.$value['id'].'</td>
                                               <td>'.$value['firstname'].'</td>
                                               <td>'.$value['username'].'</td>
                                               <td>'.$value['lastname'].'</td>
                                               <td>'.$value['email'].'</td>
                                               <td> <a href="deleteuser.php/?id='.$value['id'].'">Delete User </a> </td>
                                                </tr>';
                                            }
                                    ?>
                                        
                                    
                                    </tbody>
                                </table>

                            </div>
                        </div>
                            <!--  -->
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="header">
                                <div class="row">
                                    <div class="col-sm-4">
                                            <h4 class="title">All Citizen Users</h4>
                                            <p class="category">Here is a list of Citizen Users</p>
                                    </div>
                                    <div class="col-sm-4">
                                    <form action="users.php" method="POST" role="search">
                                        <div class="form-group col-md-12">
                                            <input name="searchcitizenname" type="text" class="form-control" placeholder="Search">
                                        </div>
                                    </form>
                                    </div>
                                    <div class="col-sm-2">
                                        <form action="createuser.php" method="post">
                                        <button type="submit" class="btn btn-primary"> Create User</button>
                                        </form>
                                       
                                    </div>
                                </div>
                                
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <th>ID</th>
                                    	<th>First Name</th>
                                    	<th>Username</th>
                                    	<th>Last Name</th>
                                    	<th>Email</th>
                                    </thead>
                                    <tbody>
                                    <?php
                                            foreach ($citizenusers as $value) {
                                               echo'<tr>
                                               <td>'.$value['id'].'</td>
                                               <td>'.$value['firstname'].'</td>
                                               <td>'.$value['username'].'</td>
                                               <td>'.$value['lastname'].'</td>
                                               <td>'.$value['email'].'</td>
                                               <td> <a href="deleteuser.php/?id='.$value['id'].'">Delete User </a> </td>
                                                </tr>';
                                            }
                                    ?>
                                        
                                    
                                    </tbody>
                                </table>

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
