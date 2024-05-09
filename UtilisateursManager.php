<?php
class UtilisateursManager{

    private $bdPDO;

    public function __construct( PDO $bdPDO){
    $this->bdPDO=$bdPDO;
    }

    public function inserer( Utilisateurs $utilisateur){
     $requet=$this->bdPDO->prepare('INSERT INTO utilisateurs(nom,prenom,tel,email) VALUES(:nom,:prenom,:tel,:email)');
     $requet->bindValue(':nom',$utilisateur->getNom());
     $requet->bindValue(':prenom',$utilisateur->getPrenom());
     $requet->bindValue(':tel',$utilisateur->getTel());
     $requet->bindValue(':email',$utilisateur->getEmail());
     $requet->execute();
    }

    public function getListeUtilisateurs(){
    $requet=$this->bdPDO->query('SELECT * FROM utilisateurs ORDER BY nom ASC');
    $requet->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Utilisateurs'); 

    $listeUtilisateurs=$requet->fetchAll();
    $requet->closeCursor();
    return $listeUtilisateurs;
 }

 public function getUtilisateur($id){
    $requet=$this->bdPDO->prepare('SELECT * FROM utilisateurs WHERE id=:id');
    $requet->bindValue(':id',(int) $id, PDO::PARAM_INT);
    $requet->execute();

   $requet->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Utilisateurs');
   $utilisateur=$requet->fetch();
   return $utilisateur;
 }

public function mettreAjour(Utilisateur $utilisateur){
$requet=$this->bdPDO->prepare('UPDATE utilisateurs SET nom=:nom,prenom=:prenom,tel=:tel,email=:email WHERE id=:id');
$requet->bindValue(':id', $utilisateur->getId() ,PDO::PARAM_INT);
$requet->bindValue(':nom', $utilisateur->getNom() );
$requet->bindValue(':prenom', $utilisateur->getPrenom() );
$requet->bindValue(':tel', $utilisateur->getTel() );
$requet->bindValue(':email', $utilisateur->getEmail() );
$requet->execute();
}































}
?>