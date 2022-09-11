<?php
include 'con.php';
if(isset($_POST['search'])){
    $val ="%".$_POST["val"]."%";
    
    $quer=$conn->prepare("select * from product where pname like :val");
    $quer->bindParam(':val',$val);
    $quer->execute();
    $res=$quer->fetchAll(PDO::FETCH_ASSOC);
    if(count($res)>0){
        foreach($res as $key => $value){
            echo ' <li><a href="search.php?sid='.$value['pid'].'">'.$value['pname'].'</a></li>';
        }
    }else{
        echo ' <li class="h4 text-danger">No record found !</li>';
    }
}
// $val='%m%';
// $quer=$conn->prepare("select * from product where pname like :val ");
//     $quer->bindParam(':val',$val);
//     $quer->execute();
//     $res=$quer->fetchAll(PDO::FETCH_ASSOC);
//     print_r($res);
?>