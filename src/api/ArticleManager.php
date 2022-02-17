<?php
header("Access-control-Allow-Origin: *");
header('Access-Control-Request-Methods: POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
header("Access-Control-Request-Headers: X-Requested-With, Accept, Content-type");
header('Access-Control-Allow-Headers: X-Requested-With, Accept, Content-type');

require_once "bdd.php";

//$request = json_decode(file_get_contents("php://input"));
$title = htmlspecialchars($_POST['title']);
$text = htmlspecialchars($_POST['text']);
$image = $_FILES['file'];

$date = date("Y-m-d H:i:s");
$dir = "../../public/images/";
$random = rand(0,99999);
$image_name = $random."_".$image['name'];
$target_file = $dir.$image_name;


try {
    $req = $bdd->prepare("INSERT INTO article (title, text, image, date) VALUES (?, ?, ?, ?)");
    $req->execute([
        $title,
        $text,
        $image_name,
        $date
    ]);

   addImage($image, $dir, $target_file, $random);

} catch (Exception $e){
    echo "Erreur: " .$e;
}

function addImage($file, $dir, $target_file, $random)
{
//    if(!isset($file['name']) || empty($file['name']))
//        throw new Exception("Vous devez indiquer une image");

    if(!file_exists($dir))
        mkdir($dir,0777);

    $extension = strtolower(pathinfo($file['name'],PATHINFO_EXTENSION));

//    if(!getimagesize($file["tmp_name"]))
//        echo "Le fichier n'est pas une image";
    if($extension !== "jpg" && $extension !== "jpeg" && $extension !== "png" && $extension !== "gif" && $extension !=="svg")
        throw new Exception("L'extension du fichier n'est pas reconnu ");
    if(file_exists($target_file))
        echo "Le fichier existe déjà";
    if($file['size'] > 500000)
        echo "Le fichier est trop gros";
    if(!move_uploaded_file($file['tmp_name'], $target_file))
        echo "l'ajout de l'image n'a pas fonctionné";
    else return ($random."_".$file['name']);
}



