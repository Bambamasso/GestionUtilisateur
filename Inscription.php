<?php

require('Utilisateurs.php');
require('UtilisateursManager.php');

$dbPDO=new pdo("mysql:host=localhost;dbname=gestion_utilisateurs",'root','');
$dbPDO->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$manager=new  UtilisateursManager(                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              $dbPDO);
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
     $manager->inserer($utilisateur);
     $message = 'utilisateurs enregistrer'; 
    }
    else{
        $erreurs=$utilisateur->getErreurs();
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
        <?php if (isset( $erreurs) && in_array(Utilisateurs::NOM_INVALIDE,$erreurs)) echo 'Le nom est invalide </br>'; ?>
        <tr> <td>Nom:</td><td><input type="text" name="nom"></td></tr>
        <?php if (isset( $erreurs) && in_array(Utilisateurs::PRENOM_INVALIDE,$erreurs)) echo 'Le prenom est invalide </br>'; ?>
        <tr><td>Prénom:</td><td><input type="text" name="prenom"></td></tr>

        <tr><td>Tel:</td><td><input type="text" name="tel"></td></tr>
        <?php if (isset( $erreurs) && in_array(Utilisateurs::EMAIL_INVALIDE,$erreurs)) echo 'L\'email est invalide </br>'; ?>
        <tr><td>Email:</td><td><input type="text" name="email"></td></tr>

        <tr><td><input type="submit" value="Enregistrement" name="enregistrement"></td></tr>
        

    </table>

  </form>
  <?php if(!empty($message)){
    {
        echo $message;
    }
  } ?>
</body>
</html>