<?php
/**
 * Created by PhpStorm.
 * User: domin
 * Date: 26/04/2018
 * Time: 19:44
 */
include_once '../../Includes/session.php';

if(isset($_POST['form_add']) && isset($_POST['title_add']) && isset($_POST['text_add'])) {
    $form_add = htmlspecialchars($_POST['form_add']);
    $title_add = htmlspecialchars($_POST['title_add']);
    $text_add = htmlspecialchars($_POST['text_add']);
}
if(isset($_POST['form_edit']) && isset($_POST['title_edit']) && isset($_POST['text_edit']) && isset($_POST['edit_choice'])) {
    $form_edit = htmlspecialchars($_POST['form_edit']);
    $title_edit = htmlspecialchars($_POST['title_edit']);
    $text_edit = htmlspecialchars($_POST['text_edit']);
    $edit_choice = htmlspecialchars($_POST['edit_choice']);
}
if(isset($_POST['form_del']) && isset($_POST['del_choice'])) {
    $form_del = htmlspecialchars($_POST['form_del']);
    $del_choice = htmlspecialchars($_POST['del_choice']);
}
if(isset($_POST['page_id']))
    $page_id = htmlspecialchars($_POST['page_id']);


if(isset($page_id))
    $urltogo = '../forum.php?q='.urlencode($page_id);
else
    $urltogo = '../subsection.php?q=1';


$bdd = Database();

if(isset($form_add) && !empty($form_add)) {
    try {
        $req = $bdd->prepare("INSERT INTO subsection (parentId, title, description) 
                                   VALUES(:id, :title, :description)");
        $req->execute(array(
            'id' => $page_id,
            'title' => $title_add,
            'description' => $text_add));
    }
    catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        return;
    }
    header('Location: '.$urltogo);
}
if(isset($form_edit) && !empty($form_edit)) {
    try {
        $req = $bdd->prepare("UPDATE subsection SET title=:title, description=:description WHERE id=:id");
        $req->execute(array(
            'title' => $title_edit,
            'description' => $text_edit,
            'id' => $page_id));
    }
    catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        return;
    }
    header('Location: '.$urltogo);
}
if(isset($form_del) && !empty($form_del)) {
    try {
        $req = $bdd->prepare("DELETE FROM subsection  WHERE id=:id");
        $req->execute(array(
            'id' => $del_choice));
    }
    catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        return;
    }
    header('Location: '.$urltogo);
}
header('Location: '.$urltogo);
?>

