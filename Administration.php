<?php 
require('Utilisateurs.php');
require('UtilisateursManager.php');

$dbPDO=new PDO("mysql:host=localhost;dbname=gestion_utilisateurs",'root','');
$dbPDO->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$manager=new UtilisateursManager($dbPDO);

if(isset($_GET['modifier'])){
   $utilisateur= $manager->getUtilisateur( (int)$_GET['modifier']);
}

if(isset($_POST['nom'])){
   $utilisateur = new Utilisateurs(
      [
      'nom'=>$_POST['nom'],
      'prenom'=>$_POST['prenom'],
      'tel'=>$_POST['tel'],
      'email'=>$_POST['email'],
   ]
      );

      if(isset($_GET['modifier'])){
         $utilisateur->setId($_GET['modifier']);
      }

      if($utilisateur->isUserValide()){
         $manager->mettreAjour($utilisateur);
         $message='utilisateur modifier';
      }
      else{
         $erreurs=$utilisateur->getErreurs();
      }
}

if(isset($_GET['supprimer'])){
   $manager->supprimer( (int) $_GET['supprimer']);
}
else{
   
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style type="text/css">
     table,td{
        border:1px solid black;
     }
     table{
        margin:auto;
        border-collapse:collapse;
     }
     td{
        padding:3px;
     }

    </style>
</head>
<body>
     <p><a href="index.php">Acceder à l'accueil du site </a></p>

     <p><h1>modification </h1></p>
       <form action="" method="post">
    <table> 

        <?php if (isset( $erreurs) && in_array(Utilisateurs::NOM_INVALIDE,$erreurs)) echo 'Le nom est invalide </br>'; ?>
        <tr> <td>Nom:</td><td><input type="text" name="nom"  value="<?php if(isset($utilisateur)){echo $utilisateur->getNom();} ?>"></td></tr>
        <?php if (isset( $erreurs) && in_array(Utilisateurs::PRENOM_INVALIDE,$erreurs)) echo 'Le prenom est invalide </br>'; ?>
        <tr><td>Prénom:</td><td><input type="text" name="prenom" value="<?php if(isset($utilisateur)){echo $utilisateur->getPrenom();} ?>"></td></tr>

        <tr><td>Tel:</td><td><input type="text" name="tel"  value="<?php  if(isset($utilisateur)){echo $utilisateur->getTel();}?>"></td></tr>
        <?php if (isset( $erreurs) && in_array(Utilisateurs::EMAIL_INVALIDE,$erreurs)) echo 'L\'email est invalide </br>'; ?>
        <tr><td>Email:</td><td><input type="text" name="email"  value="<?php if(isset($utilisateur)){echo $utilisateur->getEmail();} ?>"></td></tr>
        <?php 
        if(isset($utilisateur))
        {
         ?>
        <input type="hidden" name='id' value='<?php $utilisateur->getId() ;?>'>
        <?php 
       }
       ?>
      <tr><td><input type="submit" value="modifier" name="modifier"></td></tr>
       
    </table>
    
  </form>


     <table>
     <?php echo'<br></br>' ?>
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Téléphone</th>
            <th>Email</th>
            <th>Action de modification</th>
        </tr>
        <?php 
        foreach($manager->getListeUtilisateurs() as $values):?>
        <tr>
            <td><?php echo  $values->getNom()?></td>
            <td><?php echo $values->getPrenom()?></td>
            <td><?php echo $values->getTel()?></td>
            <td><?php echo $values->getEmail()?></td>
            <td><a href="?modifier=<?php echo $values->getId();?>">Modifier</a></td>
            <td><a href="?supprimer=<?php echo $values->getId();?>">Suprimer</a></td>
        </tr>
       
        <?php endforeach;?>

     </table>
</body>
</html>