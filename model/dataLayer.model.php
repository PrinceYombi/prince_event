<?php

class DataLayer{

    private $connexion;

    //COnnexion DB prince_event
    function __construct(){

        
        try {
            $this->connexion = new PDO("mysql:host=".DB_HOST."; dbname=".DB_NAME."", DB_USER, DB_PASSWORD);
            //echo "Connexion établie avec success";
        } catch (\Throwable $th) {
            //echo "Echec";
        }
    }

    
    /**Fonction qui crèe un user dans la base de données
     * @param pseudo, le pseudo du user
     * @param email, l'eamil du user
     * @param password, le password du user
     * 
     * @return TRUE, le user est céé avec succes
     * @return NULL, une exception
     * 
     */
    function createUsers($pseudo, $email, $password){

        $sql = "INSERT INTO users (pseudo, email, password) VALUES(:pseudo, :email, :password)";
        try {
            $result = $this->connexion->prepare($sql);
            $var = $result->execute(array(
                ':pseudo'=>$pseudo,
                ':email'=>$email,
                ':password'=>sha1($password)
            ));

            if ($var) {
                return TRUE;
            }else{
                return FALSE;
            }

        } catch (PDOException $th) {
            //throw $th;
            return null;
        }

    }

    /**Fonction qui permet d'autentifier un user par son email et password dans la base de données
     * @param email, l'eamil du customer
     * @param password, le password du customer
     * 
     * @return $data, retourne les données du customer authentifié
     * @return NULL, une exception
     * 
     */
    function authentifier($email, $password){

        $sql = "SELECT * FROM users WHERE email = :email";
        try {
            $result = $this->connexion->prepare($sql);
            $result->execute(array(
                ":email"=>$email
            ));
            $data = $result->fetch(PDO::FETCH_ASSOC);
            if ($data && ($data['password'] == sha1($password))) {
                
                unset($data['password']); 
                return $data;
            }else{
                return FALSE;
            }
        } catch (PDOException $th) {
            //throw $th;
            return null;
        }
    }

    /**MISE A JOUR DES DONNEES D'UN UTILISSATEUR
     * 
     */
    function updateInfosUsers($newInfos){

        $sql = "UPDATE users SET ";

        $idUser = $newInfos['id'];
        unset($newInfos['id']);

        try {
            
            foreach ($newInfos as $key => $value) {
                
                $sql .= " $key = '$value' ,";
            }

            $sql = substr($sql,0,-1);
            $sql .= "WHERE id=:idUser";

            $result = $this->connexion->prepare($sql);
            $var = $result->execute(array(":idUser"=>$idUser));

            if ($var) {
                return TRUE;
            }else{
                return FALSE;
            }

        } catch (\Throwable $th) {
            return NULL;
        }
    }

    /**
     * REQUETTE DE CERATION D'UN EVENEMENT
     */
    function createEvent($nom, $description, $categorie, $date_event, $time_event, $image_name, $image_tmp){

        $sql = "INSERT INTO `evenement` (`nom`, `description`, `categorie`, `date_event`, `time_event`, `image_name`, `image_tmp`) VALUES(:nom, :description, :categorie, :date_event, :time_event, :image_name, :image_tmp)";

        try {
            
            $result = $this->connexion->prepare($sql);
            $var = $result->execute(array(
                ":nom"=>$nom,
                ":description"=>$description,
                ":categorie"=>$categorie,
                ":date_event"=>$date_event,
                ":time_event"=>$time_event,
                ":image_name"=>$image_name,
                ":image_tmp"=>$image_name
            ));

            if ($var) {
                
                return TRUE;
            }else{
                return FALSE;
            }

        } catch (\Throwable $th) {
            return NULL;
        }
    }

    /**
     * REQUETTE DE RECUPERATION D'EVENEMENT 
     */
    function getEvent($idEvent=NULL, $categorie=NULL, $date_event=NULL, $time_event=NULL){

        $sql = "SELECT * FROM evenement ";

        try {
            if (isset($idEvent)) {
                $sql .= "WHERE id = $idEvent";
            }
            if (isset($categorie)) {
                $sql .= "WHERE categorie = '$categorie'";
            }
            if (isset($date_event)) {
                $sql .= "WHERE date_event = '$date_event'";
            }
            if (isset($time_event)) {
                $sql .= "WHERE time_event = '$time_event'";
            }
            $result = $this->connexion->prepare($sql);
            $result->execute(array());

            $dataEvent = $result->fetchAll(PDO::FETCH_ASSOC);

            if ($dataEvent) {
                
                return $dataEvent;
            }else{
                return FALSE;
            }

        } catch (\Throwable $th) {
            return NULL;
        }

    }

    /**
     * REQUETTE DE STOCKAGE DES DONNEES SUR LA RESERVATION
     */
    function reservation($idUser, $idEvent){

        $sql = "INSERT INTO reservation (idUser, idEvent) VALUES (:idUser, :idEvent)";
        try {
            $result = $this->connexion->prepare($sql);

            //print_r($sql); exit();
            $var = $result->execute(array(
                ":idUser"=>$idUser,
                ":idEvent"=>$idEvent
            ));

            if ($var) {
                return TRUE;
            }else{
                return FALSE;
            }

        } catch (PDOException $th) {
            //throw $th;
            return null;
        }
    }

    /**
     * SUPPRIMER UN EVENEMENT
     */
    function deleteEvent($idEvent){

        $sql = "DELETE FROM evenement WHERE id = :idEvent";
        try {
            $result = $this->connexion->prepare($sql);

            //print_r($sql); exit();
            $var = $result->execute(array(
                ":idEvent"=>$idEvent
            ));

            if ($var) {
                return TRUE;
            }else{
                return FALSE;
            }

        } catch (PDOException $th) {
            //throw $th;
            return null;
        }
    }
}

?>