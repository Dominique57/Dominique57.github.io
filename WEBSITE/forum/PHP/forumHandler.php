<?php
/**
 * Created by PhpStorm.
 * User: domin
 * Date: 26/04/2018
 * Time: 19:44
 */
include_once '../../Includes/session.php';

if(isset($_POST['form_add']) && isset($_POST['title_add'])) {
    $form_add = htmlspecialchars($_POST['form_add']);
    $title_add = htmlspecialchars($_POST['title_add']);
}
if(isset($_POST['form_edit']) && isset($_POST['title_edit']) && isset($_POST['edit_choice'])) {
    $form_edit = htmlspecialchars($_POST['form_edit']);
    $title_edit = htmlspecialchars($_POST['title_edit']);
    $edit_choice = htmlspecialchars($_POST['edit_choice']);
}
if(isset($_POST['form_del']) && isset($_POST['del_choice'])) {
    $form_del = htmlspecialchars($_POST['form_del']);
    $del_choice = htmlspecialchars($_POST['del_choice']);
}


$urltogo = '../forum.php';


$bdd = Database();

if(isset($form_add) && !empty($form_add)) {
    try {
        $req = $bdd->prepare("INSERT INTO section (title) 
                                   VALUES(:title)");
        $req->execute(array(
            'title' => $title_add));
    }
    catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        return;
    }
    header('Location: '.$urltogo);
}
if(isset($form_edit) && !empty($form_edit)) {
    try {
        $req = $bdd->prepare("UPDATE section SET title=:title WHERE id=:id");
        $req->execute(array(
            'title' => $title_edit,
            'id' => $edit_choice));
    }
    catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        return;
    }
    header('Location: '.$urltogo);
}
if(isset($form_del) && !empty($form_del)) {
    try {
        $req = $bdd->prepare("DELETE FROM section WHERE id=:id");
        $req->execute(array(
            'id' => $del_choice));
    }
    catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        return;
    }
    header('Location: '.$urltogo);
}
    ?>