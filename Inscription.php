<?php
require('Utilisateurs.php');
require('UtilisateursManager.php');

$dbPDO=new pdo("mysql:host=localhost;dbname=gestion_utilisateurs",'root','');
$dbPDO->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$manager=new UtilisateursManager(                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              $dbPDO);
if(isset($_POST['nom'])){
    $utilisateur=new Utilisateurs(
        [
            'nom'=>$_POST['nom'],
            'prenom'=>$_POST['prenom'],
            'tel'=>$_POST['tel'],
            'email'=>$_POST['email']
            
        ]
    );

    if($utilisateur->isUserValide()){
     $manager->inserer();
     
     echo 'utilisateurs enregistrer'; 
    }
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription </title>
</head>
<body>
    <p><h1>Inscription </h1></p>
  <form action="" method="post">
    <table>
        <tr> <td>Nom:</td><td><input type="text" name="nom"></td></tr>

        <tr><td>Prénom:</td><td><input type="text" name="prenom"></td></tr>

        <tr><td>Tel:</td><td><input type="text" name="tel"></td></tr>

        <tr><td>Email:</td><td><input type="text" name="email"></td></tr>

        <tr><td><input type="submit" value="Enregistrement" name="enregistrement"></td></tr>
        

    </table>

  </form>
  
</body>
</html>