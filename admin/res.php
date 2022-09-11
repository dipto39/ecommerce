<?php
include '../con.php';
session_start();
if(isset($_POST['login'])){
    $email=$_POST['email'];
    $pass=$_POST['pass'];
    $query=$conn->prepare("select * from admin where email= :email and pass = :pass");
    $query->bindParam(":email",$email);
    $query->bindParam(":pass",$pass);
    $query->execute();
    $res=$query->fetchAll(PDO::FETCH_ASSOC);
    if(count($res) > 0){
        $_SESSION['aid']= $res[0]['id'];
        $_SESSION['name']= $res[0]['name'];
    }else{
        echo "error";
    }
}
if(isset($_POST['logout'])){
    session_unset();
    
    if(session_destroy()){
        echo "logout";
    }
}

//get subcatagory 
if(isset($_POST['subcata'])){
    $data="";
    $cid=$_POST['subcata'];
    $query=$conn->prepare("select * from subcata where cid = :cid");
    $query->bindParam(":cid",$cid);
    $query->execute();
    $res=$query->fetchAll(PDO::FETCH_ASSOC);
    if(count($res) > 0){
        $data.=' <label for="subcategory">Sub Category</label>
        <select class="custom-select tm-select-accounts" name="subcategory" id="subcategory" >
          <option value="" selected  disabled>Select sub category</option>';
        foreach ($res as $key => $value) {
            $data.='<option value="'.$value['sid'].'">'.$value['subname'].'</option>';
        }
        $data.='</select>';
        echo $data;
    }

    
}
if(isset($_POST['supcata'])){
    $data="";
    $cid=$_POST['supcata'];
    $query=$conn->prepare("select * from sup where sub = :cid");
    $query->bindParam(":cid",$cid);
    $query->execute();
    $res=$query->fetchAll(PDO::FETCH_ASSOC);
    if(count($res) > 0){
        $data.=' <label for="supcategory">Super Category</label>
        <select class="custom-select tm-select-accounts" name="supcategory" id="supcategory">
          <option value="" disabled>Select</option>';
        foreach ($res as $key => $value) {
            $data.='<option value="'.$value['suid'].'">'.$value['supname'].'</option>';
        }
        $data.='</select>';
        echo $data;
    }
  
}

// ad product

if(isset($_POST['addp'])){
     $name=$_POST['pname'];
     $des=$_POST['des'];
     $adinfo=$_POST['ainfo'];
     $price=$_POST['price'];
     $off=$_POST['off'];
     $stock=$_POST['stock'];
     $mcata=$_POST['category'];
     $cata=$_POST['category'];
    if(isset($_POST['subcategory'])){
         $cata.=",".$_POST['subcategory'];
    }
    if(isset($_POST['supcategory'])){
         $cata.=",".$_POST['supcategory'];
    }
     $color=$_POST['colors'];
     $size=$_POST['sizes'];
     $pcode=uniqid();
     $queryy=$conn->prepare("select * from product where pcode =:pcod");
     $queryy->bindParam(":pcod",$pcode);
     $queryy->execute();
     $getcode=$queryy->fetchAll();
     if(count($getcode) > 0){
        $pcode=uniqid();
     }
     $ftname=$_FILES['photo']['tmp_name'];
     $fname=$_FILES['photo']['name'];
     $fsize=$_FILES['photo']['size'];
       //Getting the file ext
       if($fsize < 5242880){
        $fileExt = explode('.',$fname);
        $fileActualExt = strtolower(end($fileExt));
        $fileNemeNew = $name.$pcode.".".$fileActualExt;
         if(true){

            $query=$conn->prepare("insert into product(pcode,pname,price,off,pp,stock,catagory) values(:pcode,:pname,:price,:off,:pp,:stock,:cata)");
            $query->bindParam(":pcode",$pcode);
            $query->bindParam(":pname",$name);
            $query->bindParam(":cata",$cata);
            $query->bindParam(":price",$price);
            $query->bindParam(":off",$off);
            $query->bindParam(":pp",$fileNemeNew);
            $query->bindParam(":stock",$stock);
            $query->execute();
            $last=$conn->lastInsertId();

            if($query->rowCount() == 1){
                $query2=$conn->prepare("insert into pdetails(pid,dis,addinfo,color,size) values(:pid,:dis,:addifo,:color,:size)");
                $query2->bindParam(":pid",$last);
                $query2->bindParam(":dis",$des);
                $query2->bindParam(":addifo",$adinfo);
                $query2->bindParam(":color",$color);
                $query2->bindParam(":size",$size);
                $query2->execute();
                $query5=$conn->prepare("update category set product=product+1 where cid = :pid");
                       $query5->bindParam(":pid",$mcata);
                       $query5->execute();
                if($query2->rowCount() == 1){
                    if(isset($_POST['subcategory'])){
                        $subcata=$_POST['subcategory'];
                       $query3=$conn->prepare("update subcata set product=product+1 where sid = :sub");
                       $query3->bindParam(":sub",$subcata);
                       $query3->execute();
                   }
                   if(isset($_POST['supcategory'])){
                    $supcata=$_POST['supcategory'];
                    $query4=$conn->prepare("update sup set product=product+1 where suid = :sub");
                    $query4->bindParam(":sub",$supcata);
                    $query4->execute();
                   }
                }
               if( move_uploaded_file($ftname,"img/products/".$fileNemeNew)){
                echo "Product added successfully";
               }
            
                
                // $res=$query2->rowCount();
            }
            
           
         }
       }else{
        echo "file size is too large";
       }

}
// get product
if(isset($_POST['getp'])){
    $qeur=$conn->prepare("select * from product inner join pdetails on product.pid = pdetails.pid");
    $qeur->execute();
    $res=$qeur->fetchAll(PDO::FETCH_ASSOC);
    foreach ($res as $key => $value) {
      echo ' <tr>
      
      <th scope="row"><input type="checkbox" value='.$value['pid'].' /></th>
      <td class="tm-product-name" data-id="'.$value['pid'].'"> <a href="'.$domain.'/admin/edit-product.php?pid='.$value['pid'].'" >'.$value['pname'].'</a> </td>
      <td><img src="img/products/'.$value['pp'].'" alt="'.$value['pname'].' "></td>
      <td>'.$value['sold'].'</td>
      <td>'.$value['stock'].'</td>
      <td>#'.$value['pcode'].'</td>
      <td>
        <a href="#" class="tm-product-delete-link" data-attr="'.$value['pid'].'">
          <i class="far fa-trash-alt tm-product-delete-icon"></i>
        </a>
      </td>
    </tr>';
    }
}

//get search order
if(isset($_POST['oserarch'])){
    $id="%".$_POST['oserarch']."%";
    $qeur=$conn->prepare("select * from product inner join pdetails on product.pid = pdetails.pid where pcode like :val");
                $qeur->bindParam(":val",$id);
                $qeur->execute();
                $res=$qeur->fetchAll(PDO::FETCH_ASSOC);
                if(count($res) == 0){
                    echo ' <tr><th colspan="7" class="text-center p-0 pr-5">
                    <p> NO record found !</p>
                </th></tr>';
                }
                foreach ($res as $key => $value) {
                  echo ' <tr>
                  
                  <th scope="row"><input type="checkbox" value='.$value['pid'].' /></th>
                  <td class="tm-product-name" data-id="'.$value['pid'].'"> <a href="'.$domain.'/admin/edit-product.php?pid='.$value['pid'].'" >'.$value['pname'].'</a> </td>
                  <td><img src="img/products/'.$value['pp'].'" alt="'.$value['pname'].' "></td>
                  <td>'.$value['sold'].'</td>
                  <td>'.$value['stock'].'</td>
                  <td>#'.$value['pcode'].'</td>
                  <td>
                    <a href="#" class="tm-product-delete-link" data-attr="'.$value['pid'].'">
                      <i class="far fa-trash-alt tm-product-delete-icon"></i>
                    </a>
                  </td>
                </tr>';
                }
}

// delete product
if(isset($_POST['delete'])){
    $did=$_POST['delete'];
    $que2=$conn->prepare("select catagory,pp from product where pid = :pid");
    $que2->bindParam(":pid",$did);
    $que2->execute();
    $res2=$que2->fetchAll(PDO::FETCH_ASSOC);
    $img=$res2[0]['pp'];
    $res2=explode(",",$res2[0]['catagory']);
    $c=$res2[0];
    $s=0;
    $su=0;
    $sql="delete from pdetails where pid = :dat;delete from product where pid = :dat;update category set product=product-1 where cid = :pid;";
    if(array_key_exists(1,$res2)){
        $s=$res2[1];
        $sql.='update subcata set product=product-1 where sid = :sub;';
    }
    if(array_key_exists(2,$res2)){
        $su=$res2[2];
        $sql.='update sup set product=product-1 where suid = :suid';
    }
    $que=$conn->prepare($sql);
    $que->bindParam(":dat",$did);
    $que->bindParam(":pid",$c);
    if(array_key_exists(1,$res2)){
        $que->bindParam(":sub",$s);
    }
    if(array_key_exists(1,$res2)){
        $que->bindParam(":suid",$s);
    }
    $que->execute();
    if($que->rowCount() > 0){
        if(unlink("img/products/".$img)){
            echo "delete";
        }
       
    }
   

}

/// update product 
if(isset($_POST['upproduct'])){
    $name=$_POST['pname'];
    $pid=$_POST['id'];
    $des=$_POST['des'];
    $adinfo=$_POST['ainfo'];
    $price=$_POST['price'];
    $off=$_POST['off'];
    $stock=$_POST['stock'];
    $color=$_POST['colors'];
    $size=$_POST['sizes'];
    $pcode=$_POST['pcode'];
    $fsize=0;
    $q=$conn->prepare("select pp from product where pid = $pid");
    $q->execute();
    $q=$q->fetchAll(PDO::FETCH_ASSOC);
    $q=$q[0]['pp'];
    $sql="";
    if(!$_FILES['photo']['name'] == ""){ 
        echo "ball is not ";
        echo $_FILES['photo']['tmp_name'];
        $ftname=$_FILES['photo']['tmp_name'];
        $fname=$_FILES['photo']['name'];
        $fsize=$_FILES['photo']['size'];
        $fileExt = explode('.',$fname);
        $fileActualExt = strtolower(end($fileExt));
        $fileNemeNew = $name.$pcode.".".$fileActualExt;
        $sql=",pp = :pp";
    }
       
      //Getting the file ext
      if($fsize < 5242880){

        if(true){

           $query=$conn->prepare("update product set pname = :pname ,price = :price,off =:off,stock = :stock $sql where pid = :pid");
           $query->bindParam(":pname",$name);
           $query->bindParam(":price",$price);
           $query->bindParam(":off",$off);
           if(!$_FILES['photo']['name'] == ""){
            $query->bindParam(":pp",$fileNemeNew);
            }
           $query->bindParam(":stock",$stock);
           $query->bindParam(":pid",$pid);
           $query->execute();
               $query2=$conn->prepare("update pdetails set dis = :dis ,addinfo = :addinfo,color =:color,size = :size where pid = :pid");
               $query2->bindParam(":dis",$des);
               $query2->bindParam(":addinfo",$adinfo);
               $query2->bindParam(":color",$color);
               $query2->bindParam(":size",$size);
               $query2->bindParam(":pid",$pid);
               $query2->execute(); 
               if(!$_FILES['photo']['name'] == ""){ 
                unlink("img/products/".$q);
                if( move_uploaded_file($ftname,"img/products/".$fileNemeNew)){
                    echo "Product Update successfully";
                   }
               }else{
                echo "success";
               }
              
        }
      }else{
       echo "file size is too large";
      }

}


// get order 
if(isset($_POST['geto'])){
    $qeur=$conn->prepare("select * from orders inner join users on orders.uid = users.id order by orders.adate desc");
    $qeur->execute();
    $res=$qeur->fetchAll(PDO::FETCH_ASSOC);
    $data="";
    $i=1;
    foreach ($res as $key => $value) {
    $data.= ' <tr>
    <th scope="row"><b>'.$i.'</b></th>
    <th scope="row"><b>'.$value['oid'].'</b></th>
    <td class="pointer d-flex" data-toggle="modal" data-attr="'.$value['oid'].'" data-target="#changes" data-toggle="tooltip"
    data-placement="top" title="Click to change status">';
        $data.='<div class="tm-status-circle mt-2 ';

        if($value['sta'] == "0"){
            $data.= 'pending';
        }
        if($value['sta'] == "1"){
            $data.= 'moving';
        }
        if($value['sta'] == "2"){
            $data.= 'cancelled';
        }
        $data.='"></div>';

    if($value['sta'] == 0){
        $data.= 'pending';
    }
    if($value['sta'] == 1){
        $data.= 'moving';
    }
    if($value['sta'] == 2){
        $data.= 'cancelled';
    }
   $data.= ' </td>
    <td><b>'.$value['name'].'</b></td>
    <td><b>'.$value['addr'].'</b></td>
    <td><b>'.$value['pcode'].'</b></td>
    <td>'.$value['adate'].'</td>
    <td>'.$value['ddate'].'</td>
</tr>';
$i++;
    }
echo $data;

}


/// get confirmation 
if(isset($_POST['sta'])){
    $data= $_POST['sta'];
    // $ele= $_POST['ele'];
    // echo $ele;
    echo ' <div class="d-flex justify-content-around">
    <button type="button" id="confirm" class="btn btn-success" data-attr="'.$data.'">Confirm</button>
    <button type="button" id="cnacel" class="btn btn-danger" data-attr="'.$data.'">Cancel</button>
</div>';
}
/// get confirmation 
if(isset($_POST['conf'])){
    $data= $_POST['conf'];
    $sql=$conn->prepare("update orders set sta = 1 where oid = :oid");
    $sql->bindParam(":oid",$data);
    if($sql->execute()){
        echo '<div class="tm-status-circle mt-2 moving"></div> moving';
    }
   
}
if(isset($_POST['canc'])){
    $data= $_POST['canc'];
    $sql=$conn->prepare("update orders set sta = 2 where oid = :oid");
    $sql->bindParam(":oid",$data);
    if($sql->execute()){
        echo '<div class="tm-status-circle mt-2 cancelled"></div> cancelled';
    }
   
}
/// gate cata 
if(isset($_POST['mcata'])){
    $data= $_POST['mcata'];
    $qu=$conn->prepare("select * from subcata where cid = :data");
    $qu->bindParam(":data",$data);
    $qu->execute();
    $subcata=$qu->fetchAll(PDO::FETCH_ASSOC);
    $d='
    <label for="category">Sub Category</label>
    <select class="custom-select tm-select-accounts" id="asubcata"><option selected value="">Select Sub category</option>';
    foreach ($subcata as $key => $value) {
        $d.='<option value="'.$value['sid'].'">'.$value['subname'].'</option>';
    }
    $d.='</select>';
    echo $d;
} 
// add maincata
if(isset($_POST['amcata'])){
    $val=$_POST['amcata'];
    $que=$conn->prepare("insert into category(cname) values(:val)");
    $que->bindParam(":val",$val);
    
    if($que->execute()){
        echo "Main Catagory add success...";

    }
}

if(isset($_POST['ascata'])){
    $val=$_POST['ascata'];
    $cid=$_POST['cid'];
    $que=$conn->prepare("insert into subcata(subname,cid) values(:val,:cid);update category set sub = sub+1 where cid =:cid");
    $que->bindParam(":val",$val);
    $que->bindParam(":cid",$cid);
    
    if($que->execute()){
        echo "Sub Catagory add success...";

    }
}
if(isset($_POST['asucata'])){
    $val=$_POST['asucata'];
    $cid=$_POST['cid'];
    $sid=$_POST['sid'];
    $que=$conn->prepare("insert into sup(supname,mcata,sub) values(:val,:mcata,:sub);update category set sub = sub+1 where cid =:mcata;update subcata set sup = sup +1 where sid = :sub");
    $que->bindParam(":val",$val);
    $que->bindParam(":mcata",$cid);
    $que->bindParam(":sub",$sid);
    if($que->execute()){
        echo "Super Catagory add success...";

    }
}

// delete main catagory
if(isset($_POST['dmcata'])){
    $val=$_POST['dmcata'];
    $pre=$conn->prepare("delete from category where cid= :cid");
    $pre->bindParam(":cid",$val);
    if($pre->execute()){
        echo $val.' delete successfully';
    }
    
}
if(isset($_POST['dsubcata'])){
    $val=$_POST['dsubcata'];
    $val =explode(',',$val);
    $cid=$val[0];
    $sid=$val[1];
    $pre=$conn->prepare("delete from subcata where sid= :sid;update category set sub = sub-1 where cid =:cid");
    $pre->bindParam(":sid",$sid);
    $pre->bindParam(":cid",$cid);
    if($pre->execute()){
        echo $sid.' delete successfully';
    }
    
}
if(isset($_POST['dsupcata'])){
    $val=$_POST['dsupcata'];
    $val =explode(',',$val);
    $cid=$val[0];
    $sid=$val[1];
    $suid=$val[2];
    $pre=$conn->prepare("delete from sup where suid= :suid;update category set sub = sub-1 where cid =:cid;update subcata set sup = sup -1 where sid = :sid");
    $pre->bindParam(":cid",$cid);
    $pre->bindParam(":sid",$sid);
    $pre->bindParam(":suid",$suid);
    if($pre->execute()){
        echo $suid.' delete successfully';
    }
    
}

//oreder serach
if(isset($_POST['orserarch'])){
    $id=$_POST['orserarch'];
    $qeur=$conn->prepare("select * from orders inner join users on orders.uid = users.id where oid = :val");
    $qeur->bindParam(":val",$id);
    $qeur->execute();
    $res=$qeur->fetchAll(PDO::FETCH_ASSOC);
    $data="";
    $i=1;
    foreach ($res as $key => $value) {
    $data.= ' <tr>
    <th scope="row"><b>'.$i.'</b></th>
    <th scope="row"><b>'.$value['oid'].'</b></th>
    <td class="pointer d-flex" data-toggle="modal" data-attr="'.$value['oid'].'" data-target="#changes" data-toggle="tooltip"
    data-placement="top" title="Click to change status">';
        $data.='<div class="tm-status-circle mt-2 ';

        if($value['sta'] == "0"){
            $data.= 'pending';
        }
        if($value['sta'] == "1"){
            $data.= 'moving';
        }
        if($value['sta'] == "2"){
            $data.= 'cancelled';
        }
        $data.='"></div>';

    if($value['sta'] == 0){
        $data.= 'pending';
    }
    if($value['sta'] == 1){
        $data.= 'moving';
    }
    if($value['sta'] == 2){
        $data.= 'cancelled';
    }
   $data.= ' </td>
    <td><b>'.$value['name'].'</b></td>
    <td><b>'.$value['addr'].'</b></td>
    <td><b>'.$value['pcode'].'</b></td>
    <td>'.$value['adate'].'</td>
    <td>'.$value['ddate'].'</td>
</tr>';
$i++;
    }
echo $data;

}
?>