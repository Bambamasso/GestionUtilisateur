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

































}
?>