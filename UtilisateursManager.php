<?php
class UtilisateursManager{

    private $bdPDO;

    public function __construct( PDO $bdPDO){
    $this->bdPDO=$bdPDO;
    }

    public function inserer( Utilisateurs $utilisateur){
     $requet=$this->bdPDO->prepare('INSERT INTO idutilisateurs(nom,prenom,tel,email) VALUES(:nom,:prenom,:tel,:email)');
     $requet->bindValue(':nom',$utilisateur->getNom());
     $requet->bindValue(':prenom',$utilisateur->getPrenom());
     $requet->bindValue(':tel',$utilisateur->getTel());
     $requet->bindValue(':email',$utilisateur->getEmail());
     $requet->execute();
    }

    public function getListeUtilisateurs(){
    $requet=$this->bdPDO->query('SELECT * FROM idutilisateurs ORDER BY nom ASC');
    $requet->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Utilisateurs'); 

    $listeUtilisateurs=$requet->fetchAll();
    $requet->closeCursor();
    return $listeUtilisateurs;
 }

 public function getUtilisateur($id){
    $requet=$this->bdPDO->prepare('SELECT * FROM idutilisateurs WHERE id=:id');
    $requet->bindValue(':id',(int) $id, PDO::PARAM_INT);
    $requet->execute();

   $requet->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Utilisateurs');
   $utilisateur=$requet->fetch();
   return $utilisateur;
 }


public function mettreAjour(Utilisateurs $utilisateur){
   $requet=$this->bdPDO->prepare('UPDATE idutilisateurs SET nom=:nom,prenom=:prenom,tel=:tel,email=:email WHERE id=:id');

$requet->bindValue(':id', $utilisateur->getId() ,PDO::PARAM_INT);
$requet->bindValue(':nom', $utilisateur->getNom() );
$requet->bindValue(':prenom', $utilisateur->getPrenom() );
$requet->bindValue(':tel', $utilisateur->getTel() );
$requet->bindValue(':email', $utilisateur->getEmail() );
 $requet->execute();

}

public function supprimer($id){
 $requet=$this->bdPDO->prepare('DELETE FROM idutilisateurs WHERE id=:id');
 $requet->bindValue(':id',(int) $id, PDO::PARAM_INT);
 $requet->execute();

}































}
?>