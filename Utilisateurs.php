<?php
class Utilisateurs{
Private $erreurs=[],$id,$nom,$prenom,$tel,$email;

const NOM_INVALIDE=1;
const PRENOM_INVALIDE=2;
const EMAIL_INVALIDE=3;
// const TEL_INVALIDE=4;

public function __construct($donnees=[]){
if(!empty($donnees)){
    $this->hydrater($donnees);
}
}

public function hydrater($donnees=[]){

    foreach($donnees as $attribut=>$value){
        $methodeSetters='set'.ucfirst($attribut);
        $this->$methodeSetters($value);
    }

}
//les setteurs ou mutateurs 

public function setId($id){
  if(!empty($id)){
    $this->id= (int)$id;
  }
}
public function setNom($nom){
    if(!is_string($nom)|| empty($nom)){
        $this->erreur[]=self::NOM_INVALIDE;
      } else{
        $this->nom=$nom;
      }
}
public function setPrenom($prenom){
    if(!is_string($prenom)|| empty($prenom)){
        $this->erreur[]=self::PRENOM_INVALIDE;
      } else{
        $this->prenom=$prenom;
      }
}
public function setEmail($email){
   if(filter_var($email,FILTER_VALIDATE_EMAIL)){
    $this->email=$email;
   }else{
    $this->erreurs[]=self::EMAIL_INVALIDE;
   }
}
public function setTel($tel){
   $this->tel=$tel;
}

//les getteurs 

public function getId(){
   return $this->id; 
}
public function getNom(){
    return $this->nom; 
}
public function getPrenom(){
    return $this->prenom; 
}
public function getTel(){
    return $this->tel; 
}
public function getEmail(){
    return $this->email; 
}
public function getErreurs(){
    return $this->erreurs; 
}

public function isUserValide(){
    return !(empty($this->nom)||empty($this->prenom)||empty($this->email));
}





















}
?>