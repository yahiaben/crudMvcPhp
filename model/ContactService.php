<?php
class ContactService {
    private $bdd = NULL;
    private function openBDD(){
        try
        {
            $this->bdd = new PDO('mysql:host=localhost;dbname=contacts;charset=utf8', 'root', 'root');
        }
        catch (Exception $e)
        {
            die('Erreur : ' . $e->getMessage());
        }
    }

    private function closeBDD(){
        $bdd = null;
    }

    public function get_contacts(){
        try{
            $this->openBDD();
            $reponse = $this->bdd->query('Select * from contact order by nom');
            $reponse = $reponse->fetchall();
            $this->closeBDD();            
            return $reponse;
        }
        catch (Exception $e) {
            $this->closeBDD();
            throw $e;
        }
    }

    public function ajouter_contact($c){
        try{
            $this->openBDD();
            if(($c->getNom() == null) || empty($c->getNom())){
                $this->closeBDD();
            }
            else{
            $stmt = $this->bdd->prepare("INSERT INTO contact (id, nom,prenom,societe, adresse, num, email, site, statut) VALUES (NULL, :nom , :prenom , :societe , :adresse , :num , :email , :siteWeb , :statut )");
            $stmt->execute(array(
            "nom" => $c->getNom(), 
            "prenom" => $c->getPrenom(),
            "societe" => $c->getSociete(),
            "adresse" => $c->getAdresse(),
            "num" => $c->getNum(),
            "email" => $c->getEmail(),
            "siteWeb" => $c->getSite(),
            "statut" => $c->getStatut()
            ));
            $this->closeBDD();
            }
        }
        catch(Exception $e){
            $this->closeBDD();
            throw $e;
        }
    }

    public function getContactAModifier($id){
        $this->openBDD();
        $stmt = $this->bdd->query("SELECT * FROM contact WHERE id = " .$id);
        $reponse = $stmt->fetchall();
        $this->closeBDD();
        return $reponse;
    }

    public function update_contact($id,$c){
         try{
            $this->openBDD();
            if(($c->getNom() == null) || empty($c->getNom())){
                $this->closeBDD();
            }
            else{
            $stmt = $this->bdd->prepare("UPDATE contact SET nom = :nom ,prenom = :prenom ,societe = :societe , adresse = :adresse, num = :num, email = :email, site = :siteWeb, statut = :statut WHERE id= :id");
            $stmt->execute(array(
            "nom" => $c->getNom(), 
            "prenom" => $c->getPrenom(),
            "societe" => $c->getSociete(),
            "adresse" => $c->getAdresse(),
            "num" => $c->getNum(),
            "email" => $c->getEmail(),
            "siteWeb" => $c->getSite(),
            "statut" => $c->getStatut(),
            "id" => $id
            ));
            $this->closeBDD();
            }
        }
        catch(Exception $e){
            $this->closeBDD();
            throw $e;
        }
    }

    public function supprimer_contact($id){
        try{
            $this->openBDD();
            $stmt = $this->bdd->prepare("DELETE FROM contact WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $this->closeBDD();
        }
        catch(Exception $e){
            $this->closeBDD();
            throw $e;
        }
    }
}