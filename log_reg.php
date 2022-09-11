<?php
session_start();
include 'con.php';
if(isset($_POST['login'])){
    $email= $_POST['lemail'];
    $pass= $_POST['lpass'];
    $pass=md5($pass);
    $query=$conn->prepare("select * from users where email = :email and pass =:pass");
    $query->bindParam(":email",$email);
    $query->bindParam(":pass",$pass);
    $query->execute();
    $res=$query->fetchAll(PDO::FETCH_ASSOC);
    if(count($res) > 0){
       // print_r($res);
       $_SESSION['uid']=$res[0]['id'];
       $_SESSION['uname']=$res[0]['name'];
    }else{
        echo "username or password not match";
    }
}
//log out
if(isset($_POST['logout'])){
    session_unset();
    session_destroy();
}

// registaion 
if(isset($_POST['regs'])){
    $email=$_POST['remail'];
    $regs=$_POST['regs'];
    $quer=$conn->prepare("select email from users where email = :email");
    $quer->bindParam(":email",$email);
    $quer->execute();
    $getE=$quer->fetchAll(PDO::FETCH_ASSOC);
    if(count($getE) > 0){
        echo "email is already here..";
    }else{
        $pass=md5($_POST['rpass']);
        $fullnanme=$_POST['rfname']." ".$_POST['rlname'];
        $phn=$_POST['rphone'];
    
        $vkey=md5($email).time();
        $querey=$conn->prepare("insert into users(name,email,pass,vkey,phone) values(:name,:email,:pass,:vkey,:phone)");
        $querey->bindParam(':email',$email);
        $querey->bindParam(':name',$fullnanme);
        $querey->bindParam(':pass',$pass);
        $querey->bindParam(':vkey',$vkey);
        $querey->bindParam(':phone',$phn);
        
        if($querey->execute()){
            $query=$conn->prepare("select * from users where email = :email and pass =:pass");
    $query->bindParam(":email",$email);
    $query->bindParam(":pass",$pass);
    $query->execute();
    $res=$query->fetchAll(PDO::FETCH_ASSOC);
    if(count($res) > 0){
       // print_r($res);
       $_SESSION['uid']=$res[0]['id'];
       $_SESSION['uname']=$res[0]['name'];
    }
        }
    }
    
}
if(isset($_POST['ses'])){
    if(isset($_SESSION['uid'])){
        echo $_SESSION['uname'];
    }else{
        echo "unsuccessful";
    }
}
?>