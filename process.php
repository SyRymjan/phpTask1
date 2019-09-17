<?php
    session_start();
    $update = false;
    $name = '';
    $surname = '';
    $email = '';
$mysqli = new mysqli('localhost' , 'root' ,'12345' , 'data')
 or die(mysqli_error($mysqli));
    
    
    if(isset($_POST['save']))
    {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $email = $_POST['email'];
       
        $mysqli->query("INSERT INTO users (id, name, surname, email) VALUES  ('$id', '$name', '$surname' , '$email') ")
        or die($mysqli->error);
         
        $_SESSION['message'] = "Record has been saved!";
        $_SESSION['msg_type'] = "success";
        header("location: index.php");
    }
    if(isset($_GET['delete']))
    {
        $id = $_GET['delete'];
        $mysqli->query("DELETE FROM users where  id = $id") or die($mysqli-> error());
        $_SESSION['message'] = "Record has been deleted!";
        $_SESSION['msg_type'] = "danger";
        header("location: index.php");
    }
    if(isset($_GET['edit']))
    {
        $update = true;
        $id = $_GET['edit'];
        $result = $mysqli->query("SELECT * FROM users WHERE id = $id ") or die($mysqli->error());
        if(count($result) == 1)
        {
         $row = $result->fetch_array();
         $name = $row['name'];
         $surname = $row['surname'];
         $email = $row['email'];
        }
    }
    if(isset($_POST['update']))
    {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $surname=$_POST['surname'];
        $email = $_POST['email'];
        $mysqli->query("UPDATE users SET name = '$name' , surname = '$surname' , email = '$email' where id = '$id'  ")
        or die($mysqli->error);
        
    }
?>