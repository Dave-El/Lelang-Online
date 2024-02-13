<?php
    include 'dbconnect.php';
    session_start();
    $username=$_POST['username'];
    $password=md5($_POST['password']);

    $query=mysqli_query($conn,"SELECT * FROM tb_petugas WHERE username='$username' AND password='$password'");
    $count=mysqli_num_rows($query);
    $data=mysqli_fetch_array($query);

    if($count>0 && $data['id_level']==1)
    {
        $_SESSION['username']=$data['username'];
        $_SESSION['password']=$data['password'];
        $_SESSION['id_level']=$data['id_level'];
        echo"
        <script>
            alert('Login sebagai Administrator Berhasil');
            location.href='petugas/index.php';
        </script>";
    }
    else if($count>0 && $data['id_level']==2)
    {
        $_SESSION['username']=$data['username'];
        $_SESSION['password']=$data['password'];
        $_SESSION['id_level']=$data['id_level'];
        echo"
        <script>
            alert('Login sebagai Petugas Berhasil');
            location.href='petugas/index.php';
        </script>";
    }
    else if($count==0)
    {
        $query=mysqli_query($conn,"SELECT * FROM tb_masyarakat WHERE username='$username' AND password='$password'");
        $count=mysqli_num_rows($query);
        $data=mysqli_fetch_array($query);

        if($count>0)
        {
            $_SESSION['username']=$data['username'];
            $_SESSION['password']=$data['password'];
            $_SESSION['status']="User";
            
            echo"
            <script>
                alert('Login Berhasil');
                location.href='masyarakat/index.php';
            </script>";
        }
        else
        {
            echo"
            <script>
                alert('Login Gagal');
                location.href='index.php';
            </script>";
        }
    }
    else
    {
        echo"
        <script>
            alert('Login Gagal');
            location.href='index.php';
        </script>";
    }
?>