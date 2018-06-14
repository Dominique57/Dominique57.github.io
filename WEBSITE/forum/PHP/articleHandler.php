<?php
/**
 * Created by PhpStorm.
 * User: domin
 * Date: 26/04/2018
 * Time: 19:44
 */
include_once '../../Includes/session.php';

$urltogo = "../articles.php";
$urlcreated = "../posts.php";

if(isset($_POST['subsectionId']) && isset($_POST['titleArticle']) && isset($_POST['textContent'])) {
    $subsec_id = htmlspecialchars($_POST['subsectionId']);
    $article_title = $_POST['titleArticle'];
    $text_content = htmlspecialchars($_POST['textContent']);
    $author_id = htmlspecialchars($_SESSION['id']);
}
else{
    $_SESSION['articleResponse'] = "Some field are empty !";
    $_SESSION['articleCode'] = "red";
    header('Location: '.$urltogo);
    return;
}

$bdd = Database();
$urltogo .= '?q='.urlencode($_POST['subsectionId']);

try {
    $req = $bdd->prepare("INSERT INTO articles (parentId, title, author) 
                               VALUES(:id, :title, :author)");
    $req->execute(array(
        'id' => $subsec_id,
        'title' => $article_title,
        'author' => $author_id));
    if(!$req){
        $_SESSION['articleResponse'] = "An error occurred when creating the article in the database !";
        $_SESSION['articleCode'] = "red";
        header('Location: '.$urltogo);
        return;
    }
    $article_id = $bdd->lastInsertId();

    $req = $bdd->prepare("INSERT INTO posts (parentId, author, message) 
                               VALUES(:id, :author, :message)");
    $req->execute(array(
        'id' => $article_id,
        'author' => $author_id,
        'message' => $text_content));
}

catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    $_SESSION['articleResponse'] = "An error occurred !";
    $_SESSION['articleCode'] = "red";
    header('Location: '.$urltogo);
    return;
}
$_SESSION['articleResponse'] = "The article has been successfully created !";
$_SESSION['articleCode'] = "green";
$urlcreated .= '?q='.urlencode($article_id);
header('Location: '.$urlcreated);
?>

