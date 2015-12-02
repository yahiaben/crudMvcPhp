<?php
require_once ('model/ContactService.php');
require_once ('model/contact.php');
class ContactsController{
	private $contactService = NULL;

	public function __construct() {
		$this->contactService = new ContactService();
	}

	public function handleRequest(){
		$req = isset($_GET['req'])?$_GET['req']:NULL;
		try {
			if ($req == 'listContacts' ) {
				$this->list_contacts();

			}
			else if($req =='ajouterContact'){
				$this->saveContact();
			}            
            else if($req =='formulaire'){
                $this->showForm();
            }
			else if($req=='supprimerContact'){
				$this->deleteContact();
			}
			else if($req=='modifierContact'){
				$this->modifierContact();
			}
			else{
				//$this->list_contacts();
				$this->redirect('index.php?req=listContacts');
			}
		}
		catch ( Exception $e ) {
			$this->showError("Erreur dans la requete", $e->getMessage());
		}

	}

	public function list_contacts(){
		$donnees = $this->contactService->get_contacts();
		include 'view/ViewContacts.php';
	}

	public function modifierContact(){
		$id = isset($_GET['id'])?$_GET['id']:NULL;
    	$donnees = $this->contactService->getContactAModifier($id);
    	$nom = '';
        $prenom = '';
        $societe = '';
        $adresse = '';
        $num = '';
        $email = '';
        $site = '';
        $statut = '';
		foreach($donnees as $donnee){
        	$nom = $donnee['nom'];
        	$prenom = $donnee['prenom'];
        	$societe = $donnee['societe'];
        	$adresse = $donnee['adresse'];
        	$num = $donnee['num'];
        	$email = $donnee['email'];
        	$site = $donnee['site'];
        	$statut = $donnee['statut'];
		}
    	if ( isset($_POST['form-submitted']) ) {
            $nom = isset($_POST['nom']) ?$_POST['nom']:NULL;
            $prenom = isset($_POST['prenom'])?$_POST['prenom']:NULL;
            $societe = isset($_POST['societe'])?$_POST['societe']:NULL;
            $adresse = isset($_POST['adresse'])?$_POST['adresse']:NULL;
            $num = isset($_POST['num'])?$_POST['num']:NULL;
            $email = isset($_POST['email'])?$_POST['email']:NULL;
            $site = isset($_POST['site'])?$_POST['site']:NULL;
            $statut = isset($_POST['particulierOuPro'])?$_POST['particulierOuPro']:NULL;
            $c = new Contact($nom,$prenom,$societe,$adresse,$num,$email,$site,$statut);
            try {
                $this->contactService->update_contact($id,$c);
                $this->redirect('index.php?req=listContacts');  
                return;
            } 
            catch (Exception $e) {
                throw $e;
            }
        }
        include 'view/ModifierContactView.php';

    }

	public function deleteContact(){
		$id = isset($_GET['id'])?$_GET['id']:NULL;
		$this->contactService->supprimer_contact($id);
		$this->redirect('index.php?req=listContacts');
	}

	public function redirect($location) {
		header('Location: '.$location);
	}

	public function saveContact() {
		
        $nom = '';
        $prenom = '';
        $societe = '';
        $adresse = '';
        $num = '';
        $email = '';
        $site = '';
        $statut = '';
        if (isset($_POST['form-submitted'])) {
            $nom = isset($_POST['nom']) ?$_POST['nom']:NULL;
            $prenom = isset($_POST['prenom'])?$_POST['prenom']:NULL;
            $societe = isset($_POST['societe'])?$_POST['societe']:NULL;
            $adresse = isset($_POST['adresse'])?$_POST['adresse']:NULL;
            $num = isset($_POST['num'])?$_POST['num']:NULL;
            $email = isset($_POST['email'])?$_POST['email']:NULL;
            $site = isset($_POST['site'])?$_POST['site']:NULL;
            $statut = isset($_POST['particulierOuPro'])?$_POST['particulierOuPro']:NULL;
            $c = new Contact($nom,$prenom,$societe,$adresse,$num,$email,$site,$statut);
            try {
                $this->contactService->ajouter_contact($c);
           		$this->redirect('index.php?req=listContacts');
                return;
            } 
            catch (Exception $e) {
                throw $e;
            }
        }
        include("view/AjouterContactView.php");

    }
    public function erreur() {
		include 'view/error.php';
	}
}