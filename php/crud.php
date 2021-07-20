<?php

//MVC
include_once("resp.php");
include_once("student.php");


if($_SERVER["REQUEST_METHOD"] == "POST"){
    $resp1=new resp;

    if(empty($_POST["accion"]))
    {
    $resp1->set("2001","ACTION REQUIRED","ID ". 0,"red");
    $myJSON = json_encode($resp1);
    echo $myJSON;
    return;
    }
}
$accion="";
$accion = $_POST["accion"];


//MVC

//json es un arreglo tridimensional
if($accion=="AGREGAR"){

    $studentsname="";
    $lastname="";
    $age="";
    $email="";
    

    $studentsname=$_POST["studentsname"];
    $lastname=$_POST["lastname"];
    $age=$_POST["age"];
    $email= $_POST["email"];

   
 
        $resp1=new resp;
    
        if(empty($studentsname))
        {
        $resp1->set("2001","NAME REQUIRED","ID ". 0,"red");
        $myJSON = json_encode($resp1);
        echo $myJSON;
        return;
        }
        if(empty($lastname))
        {
        $resp1->set("2001","LASTNAME REQUIRED","ID ". 0,"red");
        $myJSON = json_encode($resp1);
        echo $myJSON;
        return;
        }
        if(empty($age))
        {
        $resp1->set("2001","AGE REQUIRED","ID ". 0,"red");
        $myJSON = json_encode($resp1);
        echo $myJSON;
        return;
        }
        if(empty($email))
        {
        $resp1->set("2001","EMAIL REQUIRED","ID ". 0,"red");
        $myJSON = json_encode($resp1);
        echo $myJSON;
        return;
        }
    

    valida($studentsname);
    valida($lastname);
    valida($age);
    valida($email);

    if (!preg_match("/^[a-zA-Z-' ]*$/", $studentsname)) {
        $resp1->set("2001", "Only letters and spaces allowed -NAME", "ID: " . 0, "red");
        $myJson = json_encode($resp1);
        echo $myJson;
        return;
    }
    if (!preg_match("/^[a-zA-Z-' ]*$/", $lastname)) {
        $resp1->set("2001", "Only letters and spaces allowed - LASTNAME", "ID: " . 0, "red");
        $myJson = json_encode($resp1);
        echo $myJson;
        return;
    }
if (!preg_match("/^[1-9][0-9]{0,1}$/", $age)) {
        $resp1->set("2001", "Only numbers allowed - AGE", "ID: " . 0, "red");
        $myJson = json_encode($resp1);
        echo $myJson;
        return;
    }
    
    if (!preg_match('/^[a-z0-9](\.?[a-z0-9]){5,}@utlaguna\.edu\.mx$/',$email)){
        $resp1->set("2001", "dominio no correcto -EMAIL", "ID: " . 0, "red");
        $myJson=json_encode($resp1);
        echo $myJson;
        return;
    }


    $id =0;
    $student= new student();
    $student->set(0,$studentsname,$lastname,$age,$email);

    $resp1=new resp;
    include_once("conex_pdo.php");
    $stmt=$conn->prepare("INSERT INTO students(id, name, lastname, age, email) values(?,?,?,?,?);");
    $stmt->bind_param("issds",$id,$studentsname,$lastname,$age,$email);
    


    if($stmt->execute()){
       // echo "1000";

        $idstudent= mysqli_insert_id($conn);
        $resp1-> set("1000","INSERT SUCCESS","ID: ".$idstudent,"green");
        $myJson = json_encode($resp1);
        echo $myJson;

    }else{
        //echo "2000";
        $resp1-> set("2000","ERROR, CAN'T INSERT",0,"red");
        $myJson= json_encode($resp1);
        echo $myJson;
}
    $conn->close();
}
     //cerrar el puerto


if ($accion=="BORRAR")
{
    $idstudents= "";
    $idstudents= $_POST["idstudents"];

        $resp1=new resp;
    
        if(empty($_POST["idstudents"]))
        {
        $resp1->set("2001","ID REQUIRED","ID ". 0,"red");
        $myJSON = json_encode($resp1);
        echo $myJSON;
        return;
        }
    

    valida($idstudents);

    if (!preg_match("/^[0-9][0-9]{0,2}$/", $idstudents)) {
        $resp1->set("2001", "Only numbers allowed -ID", "ID: " . 0, "red");
        $myJson = json_encode($resp1);
        echo $myJson;
        return;
    }

   // $student= new student();
    //$student->set($id= $_POST["idstudents"],$name=$name=$_POST["studentsname"],$lastname=$_POST["lastname"],$age=$_POST["age"],$email= $_POST["email"]);

    $resp1=new resp;
    include_once("conex_pdo.php");

    $stmt= $conn->prepare("DELETE FROM students WHERE id= ?");
    $stmt -> bind_param("i",$idstudents);
    if ($stmt->execute()) {
        $idstudent = mysqli_insert_id($conn);
        $resp1->set("1000", "Delete Success", "Id: ".$idstudents ,"green");
        $myJSON =json_encode($resp1);
        echo $myJSON;

    } else {
        $resp1->set("2000","Error Can't Delete",0,"red");
        $myJSON =json_encode($resp1);
        echo $myJSON;
    }
    $conn->close();

}

if ($accion=="ACTUALIZAR")
{
    $idstudents= "";
    $studentsname="";
    $lastname="";
    $age="";
    $email="";
    

    $idstudents= $_POST["idstudents"];
    $studentsname=$_POST["studentsname"];
    $lastname=$_POST["lastname"];
    $age=$_POST["age"];
    $email= $_POST["email"];

   

  
        $resp1=new resp;
    
        if(empty($_POST["idstudents"]))
        {
        $resp1->set("2001","ID REQUIRED","ID ". 0,"red");
        $myJSON = json_encode($resp1);
        echo $myJSON;
        return;
        }
        if(empty($_POST["studentsname"]))
        {
        $resp1->set("2001","NAME REQUIRED","ID ". 0,"red");
        $myJSON = json_encode($resp1);
        echo $myJSON;
        return;
        }
        if(empty($_POST["lastname"]))
        {
        $resp1->set("2001","LASTNAME REQUIRED","ID ". 0,"red");
        $myJSON = json_encode($resp1);
        echo $myJSON;
        return;
        }
        if(empty($_POST["age"]))
        {
        $resp1->set("2001","AGE REQUIRED","ID ". 0,"red");
        $myJSON = json_encode($resp1);
        echo $myJSON;
        return;
        }
        if(empty($_POST["email"]))
        {
        $resp1->set("2001","EMAIL REQUIRED","ID ". 0,"red");
        $myJSON = json_encode($resp1);
        echo $myJSON;
        return;
        }
    


    valida($idstudents);
    valida($studentsname);
    valida($lastname);
    valida($age);
    valida($email);



    if (!preg_match("/^[0-9][0-9]{0,9}$/", $idstudents)) {
        $resp1->set("2001", "Only numbers allowed - ID", "ID: " . 0, "red");
        $myJson = json_encode($resp1);
        echo $myJson;
        return;
    }
    if (!preg_match("/^[a-zA-Z-' ]*$/", $studentsname)) {
        $resp1->set("2001", "Only letters and spaces allowed -NAME", "ID: " . 0, "red");
        $myJson = json_encode($resp1);
        echo $myJson;
        return;
    }
    if (!preg_match("/^[a-zA-Z-' ]*$/", $lastname)) {
        $resp1->set("2001", "Only letters and spaces allowed - LASTNAME", "ID: " . 0, "red");
        $myJson = json_encode($resp1);
        echo $myJson;
        return;
    }
if (!preg_match("/^[1-9][0-9]{0,1}$/", $age)) {
        $resp1->set("2001", "Only numbers allowed - AGE", "ID: " . 0, "red");
        $myJson = json_encode($resp1);
        echo $myJson;
        return;
    }
    
    if (!preg_match('/^[a-z0-9](\.?[a-z0-9]){5,}@utlaguna\.edu\.mx$/',$email)){
        $resp1->set("2001", "dominio no correcto -EMAIL", "ID: " . 0, "red");
        $myJson=json_encode($resp1);
        echo $myJson;
        return;
    }
    //$student= new student();
    //$student->set($id= $_POST["idstudents"],$name=$_POST["studentsname"],$lastname=$_POST["lastname"],$age=$_POST["age"],$email= $_POST["email"]);

    $resp1=new resp;
    include_once("conex_pdo.php");

    $stmt= $conn->prepare("UPDATE students SET name=?, lastname=?, age=?, email=? where id=?;");
    $stmt->bind_param("ssdsi",$studentsname,$lastname,$age,$email,$idstudents);

    if($stmt->execute()){
        // echo "1000";
        $idstudent = mysqli_insert_id($conn);
        $resp1->set("1000", "Update Success", "Id: ".$idstudents ,"green");
        $myJSON =json_encode($resp1);
        echo $myJSON;
    }else{
        echo "2000"; //el codigo 2000, significa que son errores
        $resp1->set("2000", "Error. Can't Update",0,"red");
        $myJSON =json_encode($resp1);
        echo $myJSON;
    }

    $conn->close();
}



function valida($x1){
$x1 = trim($x1);
$x1= stripslashes($x1);
$x1 =htmlspecialchars($x1);
return ($x1);
}

