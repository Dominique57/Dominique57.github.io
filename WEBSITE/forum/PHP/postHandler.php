<?php
/**
 * Created by PhpStorm.
 * User: domin
 * Date: 26/04/2018
 * Time: 19:44
 */
include_once '../../Includes/session.php';

$urltogo = "../posts.php";

if(isset($_POST['articleId']) && isset($_POST['textContent'])) {
    $article_id = htmlspecialchars($_POST['articleId']);
    $text_content = htmlspecialchars($_POST['textContent']);
    $author_id = htmlspecialchars($_SESSION['id']);
}
else{
    $_SESSION['postResponse'] = "Some field are empty !";
    $_SESSION['postCode'] = "red";
    header('Location: '.$urltogo);
    return;
}
$urltogo .= '?q='.urlencode($_POST['articleId']);

$bdd = Database();

try {
    $req = $bdd->prepare("INSERT INTO posts (parentId, author, message) 
                               VALUES(:id, :author, :message)");
    $req->execute(array(
        'id' => $article_id,
        'author' => $author_id,
        'message' => $text_content));
}
catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    $_SESSION['postResponse'] = "An error occurred !";
    $_SESSION['postCode'] = "red";
    header('Location: '.$urltogo);
    return;
}
$_SESSION['postResponse'] = "The message has been successfully sent !";
$_SESSION['postCode'] = "green";
header('Location: '.$urltogo);
?>

