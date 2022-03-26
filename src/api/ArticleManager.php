<?php

header("Access-control-Allow-Origin: *");
header('Access-Control-Request-Methods: POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
header("Access-Control-Request-Headers: X-Requested-With, Accept, Content-type");
header('Access-Control-Allow-Headers: X-Requested-With, Accept, Content-type');

require_once "ImageTrait.php";
require_once "Database.php";

class ArticleManager extends Database  {
    use ImageTrait;

    function getAllArticles(){
        try {
            $req = $this->getBdd()->prepare("SELECT * FROM article");
            $req->execute();
            $data = $req->fetchAll();
            if ($data != null) {
                echo json_encode($data);

            } else {
                return false;
            }
        } catch (Exception $e) {
            return json_encode("Erreur articles: ".$e);
        }
    }

    function pushArticleInBdd(){

//        $request = json_decode(file_get_contents("php://input"));
        $title = htmlspecialchars($_POST['title']);
        $text = htmlspecialchars($_POST['text']);
        $cat = 2;
        $image = $_FILES['file'];


        $date = date("Y-m-d H:i:s");
        $dir = "../../public/img/";
        $random = rand(0,99999);
        $image_name = $random."_".$image['name'];

        try {
            $req = $this->getBdd()->prepare("INSERT INTO article (title, text, image, date) VALUES (?, ?, ?, ?, ?)");
            $req->execute([
                $title,
                $text,
                $image_name,
                $date,
                $cat
            ]);

            $this->addImage($image, $dir);
            echo json_encode($title);
        } catch (Exception $e){
            echo "Erreur: " .$e;
        }
    }
}




