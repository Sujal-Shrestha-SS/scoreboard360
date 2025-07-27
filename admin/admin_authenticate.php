<?php

$username = $_POST['username'];
$pw = $_POST['password'];

if($username == 'admin' && $pw == 'admin123'){
   header("Location: admin_fixture.html");
}

else{
    echo "<script>
    alert('Invalid Login Credentials');
    window.location.href = 'admin_login.html';
    </script>";


    
}

?>