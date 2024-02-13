<?php
    include 'dbconnect.php';
    $username=$_POST['username'];
    $password=md5($_POST['password']);
    
    $query=mysqli_query($conn,"INSERT INTO tb_masyarakat VALUES('','','$username','$password','')");
    
    if($query===TRUE)
    {
        echo 
            "<script>   
                alert('Register Sukses')
                location.href='index.php';
            </script>";
    }
    else
    {
        echo 
            "<script>
                alert('Register Gagal')
                location.href='index.php';
            </script>";
    }
?>