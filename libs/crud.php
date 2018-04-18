<?php

// fonctions debug
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

include "utility.php";

$exec;
$db = connectDB("localhost","dames","root","laurie");

$profil_ = getProfil_();

if (isset($_GET["id"])){
    $profil = getProfil($_GET["id"]);
}

if (isset($_POST["update_profil"])){
    UpdateProfil();
}

if(isset($_POST["create_profil"])){
    createProfil();
}

if (isset($_POST['delete_profil_'])){
    removeProfil();
}

function getProfil_(){
    global $db;
    global $exec;

    $sql = "SELECT * FROM profile";
    $exec = $db->query($sql);
    return $exec->fetchAll(PDO::FETCH_OBJ);
}

function getProfil($id){
    global $db;
    $sql = "SELECT * FROM profile WHERE id=:id";
    $statement = $db->prepare($sql);
    $statement->bindParam(":id", $id, PDO::PARAM_INT);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_OBJ);
}

function UpdateProfil(){
    global $db;
    $sql = "UPDATE profile SET nom = :nom, age = :age WHERE id = :id";
    

    $statement = $db->prepare($sql);
    $statement->bindParam(":id", $_POST["id"], PDO::PARAM_INT);
    $statement->bindParam(":nom", $_POST["nom"], PDO::PARAM_STR);
    $statement->bindParam(":age", $_POST["age"], PDO::PARAM_INT);
    $statement->execute();
    header("location: index.php");

}

function createProfil(){
    global $db;

        $sql ="INSERT INTO profile (nom, age)
               VALUES(:nom, :age)";

    $statement = $db->prepare($sql);
    $statement->bindParam(":nom", $_POST["nom"], PDO::PARAM_STR);
    $statement->bindParam(":age", $_POST["age"], PDO::PARAM_INT);
    $res=$statement->execute();
    $msg_crud=($res===true)? "insertion ok" : "soucis à l'insertion";
    header("Location:index.php");
}

function removeProfil(){
    global $db;

    $chekeds = $_POST['delete_profil_ids'];

    $sql = "DELETE FROM `profile` WHERE `id` = :id";
    foreach($_POST["delete_profil_ids"] as $id ){
        $statement = $db->prepare( $sql);
        $statement->bindParam(":id",$id,PDO::PARAM_STR);
        $res = $statement->execute();
    }
    header("location: index.php");
}


// function removeProfil(){

//     $sql = "DELETE FROM profile";

//         $statement = $db->prepare( $sql);
//         // $statement->bindParam(":id",$id,PDO::PARAM_INT);
//         $res = $statement->execute();

//     header("location: index.php");
// }

?>