<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>

  <?php require_once 'process.php' ; ?>

        <?php
        
            if (isset($_SESSION['message'])): 
        ?>
            <div class="alert  alert-<?=$_SESSION['msg_type']?>">
                <?php
                    echo $_SESSION['message'];
                    unset($_SESSION['message']);
                    ?>
            </div>

        <?php endif ?>

    <div class = "container">
    
    <?php 
       $mysqli = new mysqli('localhost' , 'root' ,'12345' , 'data')
       or die(mysqli_error($mysqli));
        $result = $mysqli->query("SELECT  * FROM users ") or die($mysqli-error);
        ?>

        <div class="row justify-content-center">
            <table class="table">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>name</th>
                        <th>surname</th>
                        <th>email</th>
                        <th colspan = "2">Action</th>
                    </tr>
                </thead>

            <?php 
            
                while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id'] ?></td>
                        <td><?php echo $row['name'] ?></td>
                        <td><?php echo $row['surname'] ?></td>
                        <td><?php echo $row['email'] ?></td>
                        <td>
                            <a href="index.php?edit=<?php  echo $row['id']; ?>"
                                class= "btn btn-info"
                            >Edit</a>
                            <a href="index.php?delete=<?php  echo $row['id']; ?>"
                                class= "btn btn-danger"
                            >Delete</a>
                        </td>
                    </tr>
                    <?php  endwhile; ?>


            </table>
        
        </div>



<div class = "row justify-content-center flex">
        <form action="process.php" method="POST">
         
            <div class="form-group">
            <label> ID </label>
            <input type="text" name = "id" class = "form-control" value = "<?php echo $id;?>" placeholder = "Enter the id">
            </div>
            <div class="form-group">
            <label> Name </label>
            <input type="text" name = "name" class = "form-control" value = "<?php echo $name; ?> " placeholder = "Enter the name">
            </div>
            <div class="form-group">
            <label> Surname </label>
            <input type="text" name = "surname" class = "form-control" value = "<?php echo $surname ;  ?>" placeholder = "Enter the surname">
            </div>
            <div class="form-group">
            <label> Email </label>
            <input type="text" name = "email" class = "form-control" value = "<?php echo $email;?>" placeholder = "Enter the email">
            </div>
            <?php if($update == true ): ?>
            <button class = "btn btn-info" type = "submit" name = "update">Update</button>
            <?php else: ?>
            <button class = "btn btn-primary" type = "submit" name = "save">Save</button>
            <?php endif; ?>
            
        </form>
        </div>
        </div>
</body>
</html>

