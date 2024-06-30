<?php
/**
 * VERIFICATION DE DONNEES ENTREES PAR L'USER DE FAçON GENERAL
 */
function verifParams(){

    if (isset($_POST) && sizeof($_POST)>0) {
        
        foreach ($_POST as $key => $value) {
            
            $data = trim($value);
            $data = stripslashes($data);
            $data = strip_tags($data);
            $data = htmlspecialchars($data);

            $_POST[$key] = $data;
        }
    }
}

/**
 * PAGE ACCUEIL
 */
function displayAccueil(){

    $result = '
    <div class="connexion-title">
        <h4>Se connecter</h4>
    </div>
    <form action="connexion" method="post" class="px-3 mt-3">
        <div class="form-row row">
            <div class="form-floating mb-3 col-6">
                <input type="email" class="form-control" name="email" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Email address</label>
            </div>
            <div class="form-floating col-6">
                <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Password</label>
            </div>
        </div>
        <div class="button mb-3">
            <button type="submit" class="btn btn-success">Connexion</button>
            <a href="'.BASE_URL.SP."inscription".'" class="btn btn-primary">Inscription</a>
       </div>
    </form>
    ';



    return $result;
}

/**
 * PAGE APROPOS
 */
function displayAbout(){

    $result = '
    <div class="about">
         <div class="about-text">
         is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s
          standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make
           a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, 
           remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing
            Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions 
            of Lorem Ipsum.
         </div>
    </div>
    ';



    return $result;
}

/**
 * PAGE INSCRIPTION
 */
function displayInscription(){

    $result = '
    <div class="connexion-title">
        <h4>S\'inscrire</h4>
    </div>';

    $result .= '<div class="bg-white shadow-sm rounded p-6 mt-3">
    <form action="actionInscription" method="post">
    <div class="mb-3">
        <div class="input-group input-group form">
            <input type="text" name="pseudo" value="" class="form-control" required="" placeholder="Entrer votre Pseudo" />
        </div>
    </div>
    <div class="mb-3">
        <div class="input-group input-group form">
        <input type="email" class="form-control" name="email" value="" required="" placeholder="Entrer votre adresse email"/>
        </div>
    </div>
    <div class="mb-3">
        <div class="input-group input-group form">
        <input type="password" class="form-control" name="password" value="" required="" placeholder="Entrer votre mot de passe"/>
        </div>
    </div>
    <button type="submit" class="btn btn-primary col-12">S\'inscrire</button>
    </form>
    </div>
    ';

    return $result;
}

/**
 * TRAITEMENT DE L'INSCRIPTION DE USER
 */
function displayActionInscription(){

    global $model;

    $pseudo = $_POST['pseudo'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $dataUser = $model->createUsers($pseudo,$email,$password);

    if ($dataUser) {
        
        $authenUser = $model->authentifier($email, $password);

        if ($authenUser) {
            
            $_SESSION['user'] = $authenUser;

            return '<button class="btn btn-success mt-3 w-100">Inscription réussie '.$_SESSION['user']['pseudo'].'</button>'.'</br>'.displayEvent();

        }else{
            return '<button class="btn btn-danger w-100">Probleme d\'autehntification !</button>'.displayInscription();
        }
    }else{
        
        return displayInscription();
    }

    
}

/**
 * TRAITEMENT CONNEXION
 */
function displayConnexion(){

    global $model;
    $email = $_POST['email'];
    $password = $_POST['password'];

    $authenUser = $model->authentifier($email, $password);

    if ($authenUser) {

        $_SESSION['user'] = $authenUser;

        return '<button class="btn btn-success mt-3 w-100">Authentification réussie '.$_SESSION['user']['pseudo'].'</button>'.'</br>'.displayEvent();
        
    }else{
        return '<button class="btn btn-danger mt-3 w-100">Authentification échouée, veuillez vous inscrire </button>'.'</br>'.displayAccueil();
        
    }
}


/**
 * DECONNECTION USER
 */
function displayDeconnexion(){
    
    unset($_SESSION['user']);
     
    return '<button class="btn btn-danger w-100">Vous êtes déconnecté, connectez vous !</button>'.'</br>'.displayAccueil();
}

/**
 * PROFIL
 */
function displayProfil(){

    if (isset($_SESSION['user']['sexe'])) {
            
        if ($_SESSION['user']['sexe'] == 1) {
            
            $_SESSION['user']['sexe'] = "Masculin";
        }else{
            $_SESSION['user']['sexe'] = "Féminin";
        }
    }
    
    $result = '

    <ul class="list-group mt-3">
    <li class="list-group-item active" aria-current="true">Bienvenu sur votre profil '.$_SESSION['user']['pseudo'].'</li>
    <li class="list-group-item">Sexe : '.$_SESSION['user']['sexe'].'</li>
    <li class="list-group-item">Pseudo : '.$_SESSION['user']['pseudo'].'</li>
    <li class="list-group-item">Prénom : '.$_SESSION['user']['firstname'].'</li>
    <li class="list-group-item">Nom : '.$_SESSION['user']['lastname'].'</li>
    <li class="list-group-item">Téléphone : '.$_SESSION['user']['telephone'].'</li>
    <li class="list-group-item">Email : '.$_SESSION['user']['email'].'</li>
    </ul>

    <div class="mt-3">
    <a href="'.BASE_URL.SP."updateProfil".'" class="btn btn-block btn-success">Mettre à jour mes données</a>
    </div>
    ';

    return $result;
}

/**
 * MISE A JOUR PROFIL
 */
function displayUpdateProfil(){
    $result  = '
    <form action="updateAction" method="post">
    <div class="form-row row my-3 mx-3">
        <div class="form-group col-md-3">
            <label for="inputFirstname">Sexe : </label><br />
            <select name="sexe" class="form-control"> 
            <option value="1">Masculin</option> 
            <option value="2">Féminin</option>  
            </select> 
        </div>
        <div class="form-group col-md-3">
            <label for="inputPseudo">Pseudo : </label><br />
            <input type="text" name="pseudo" value="'.$_SESSION['user']['pseudo'].'" class="form-control" id="inpuTpseudo" />
        </div>
        <div class="form-group col-md-3">
            <label for="inputFirstname">Prénom : </label><br />
            <input type="text" name="firstname" value="'.$_SESSION['user']['firstname'].'" class="form-control" id="inputFirstname" />
        </div>
        <div class="form-group col-md-3">
            <label for="inputName">Nom : </label><br />
            <input type="text" name="lastname" value="'.$_SESSION['user']['lastname'].'" class="form-control" id="inputName" required />
        </div>
        <div class="form-group col-md-3">
            <label for="inputEmail">Email</label><br />
            <input type="email" name="email" value="'.$_SESSION['user']['email'].'" class="form-control" id="inputEmail" />
        </div>
        <div class="form-group col-md-3">
            <label for="inputTelephone">Télephone : </label><br />
            <input type="text" name="telephone" value="'.$_SESSION['user']['telephone'].'" class="form-control"  />
        </div>
    </div>
    <button type="submit" class="btn btn-success mt-3 mx-3">Mettre à jour</button>
    </form> 
    ';

    return $result;
}

/**
 * TRAITEMENT DES DONNEES MISE A JOUR USER
 */
function displayUpdateAction(){
    global $model;
    
    $_POST['id'] = $_SESSION['user']['id'];

    $updateUser = $model->updateInfosUsers($_POST);

    if ($updateUser) {

        $_SESSION['user'] = $_POST;
        return  '<button type="submit" class="btn btn-success w-100">Votre profil a été mise à jour</button>'.displayProfil();
    }else{
        return  '<button type="submit" class="btn btn-danger w-100">Echec mise à jour</button>'.displayUpdateProfil();

    }
}

/**
 * AFFICHAGE DES EVENEMENTS
 */
function displayEvent(){
    global $model;

    $dataEvent = $model->getEvent(NULL, NULL, NULL, NULL);

    $result = '
    <div class="bg-success">
    <div class="connexion-title">
        <h4>Liste des Evènements</h4>
    </div>
    <a href="'.BASE_URL.SP."addEvent".'" class="btn btn-success w-100 mb-3 fs-2">Ajouter un Evènement</a>
    ';
    
    $result .='<div class="card-container d-flex flex-wrap justify-content-around">'; 
    if (!empty($dataEvent)) {

        /**
         * AFFICHAGE DES EVENEMENTS PAR FILTRE DE RECHERCHE : CATEGORIE, DATE OU HEURE
         */
        if (!empty($_POST['searchEvent']) && isset($_POST['searchEvent'])) {
            
            $searchEvent = ucwords($_POST['searchEvent']);

            $categorieData = $model->getEvent(NULL, $searchEvent, NULL, NULL);
            //print_r($categorieData[0]); exit();
            $date_eventData = $model->getEvent(NULL, NULL, $searchEvent, NULL);
            $time_eventData = $model->getEvent(NULL, NULL, NULL, $searchEvent);

            if (isset($categorieData[0]) && $searchEvent === $categorieData[0]['categorie']) {
                
                foreach ($categorieData as $key => $value) {

                    $result .='
                    <div class="card mb-3" style="max-width: 640px; height: 330px;">
                        <div class="row g-0 h-100">
                            <div class="col-md-6 h-100">
                            <img src="'.BASE_URL.SP."images".SP.$value['image_name'].'" class="img-fluid rounded-start w-100 h-100" alt="...">
                            </div>
                            <div class="col-md-6 h-100">
                                <div class="card-body h-100  d-flex flex-column justify-content-center align-items-center">
                                    <h5 class="card-title fw-bold text-center mt-3">'.$value['nom'].'</h5>
                                    <p class="card-text text-center my-3" style="font-size:0.8em">'.$value['description'].'</p>
                                    <p class="card-text text-center fw-bold text-success">'.$value['categorie'].'</p>
                                    <p class="card-text text-center">Date : '.$value['date_event'].'</p>
                                    <p class="card-text text-center">Heure : '.$value['time_event'].'</p>
                                    <a href="'.BASE_URL.SP."voir".SP.$value['id'].'"class="btn btn-primary my-3">Voir</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    ';
                }
               
            }elseif(isset($date_eventData[0]) && $searchEvent === $date_eventData[0]['date_event']) {
                
                foreach ($date_eventData as $key => $value) {

                    $result .='
                    <div class="card mb-3" style="max-width: 640px; height: 330px;">
                        <div class="row g-0 h-100">
                            <div class="col-md-6 h-100">
                            <img src="'.BASE_URL.SP."images".SP.$value['image_name'].'" class="img-fluid rounded-start w-100 h-100" alt="...">
                            </div>
                            <div class="col-md-6 h-100">
                                <div class="card-body h-100  d-flex flex-column justify-content-center align-items-center">
                                    <h5 class="card-title fw-bold text-center mt-3">'.$value['nom'].'</h5>
                                    <p class="card-text text-center my-3" style="font-size:0.8em">'.$value['description'].'</p>
                                    <p class="card-text text-center fw-bold text-success">'.$value['categorie'].'</p>
                                    <p class="card-text text-center">Date : '.$value['date_event'].'</p>
                                    <p class="card-text text-center">Heure : '.$value['time_event'].'</p>
                                    <a href="'.BASE_URL.SP."voir".SP.$value['id'].'"class="btn btn-primary my-3">Voir</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    ';
                }
               
            }elseif(isset($time_eventData[0]) && $searchEvent === $time_eventData[0]['time_event']) {
                
                foreach ($time_eventData as $key => $value) {

                    $result .='
                    <div class="card mb-3" style="max-width: 640px; height: 330px;">
                        <div class="row g-0 h-100">
                            <div class="col-md-6 h-100">
                            <img src="'.BASE_URL.SP."images".SP.$value['image_name'].'" class="img-fluid rounded-start w-100 h-100" alt="...">
                            </div>
                            <div class="col-md-6 h-100">
                                <div class="card-body h-100  d-flex flex-column justify-content-center align-items-center">
                                    <h5 class="card-title fw-bold text-center mt-3">'.$value['nom'].'</h5>
                                    <p class="card-text text-center my-3" style="font-size:0.8em">'.$value['description'].'</p>
                                    <p class="card-text text-center fw-bold text-success">'.$value['categorie'].'</p>
                                    <p class="card-text text-center">Date : '.$value['date_event'].'</p>
                                    <p class="card-text text-center">Heure : '.$value['time_event'].'</p>
                                    <a href="'.BASE_URL.SP."voir".SP.$value['id'].'"class="btn btn-primary my-3">Voir</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    ';
                }
               
            }


            
            
        }else{

            /**
             * AFFICHAGE DE TOUS LES EVENEMENTS
             */
            foreach ($dataEvent as $key => $value) {
    
                $result .='
                <div class="card mb-3" style="max-width: 640px; height: 330px;">
                    <div class="row g-0 h-100">
                        <div class="col-md-6 h-100">
                        <img src="'.BASE_URL.SP."images".SP.$value['image_name'].'" class="img-fluid rounded-start w-100 h-100" alt="...">
                        </div>
                        <div class="col-md-6 h-100">
                            <div class="card-body h-100  d-flex flex-column justify-content-center align-items-center">
                                <h5 class="card-title fw-bold text-center mt-3">'.$value['nom'].'</h5>
                                <p class="card-text text-center my-3" style="font-size:0.8em">'.$value['description'].'</p>
                                <p class="card-text text-center fw-bold text-success">'.$value['categorie'].'</p>
                                <p class="card-text text-center">Date : '.$value['date_event'].'</p>
                                <p class="card-text text-center">Heure : '.$value['time_event'].'</p>
                                <a href="'.BASE_URL.SP."voir".SP.$value['id'].'"class="btn btn-primary my-3">Voir</a>
                            </div>
                        </div>
                    </div>
                </div>
                ';
            }
        }
    }

   $result .='
   </div>
   '; 

    return $result;
}

/**
 * AJOUTER UN EVENEMENT
 */
function displayAddEvent(){

    $result = '
    <form action="addEventAction" method="post" enctype="multipart/form-data" class="my-3 mx-3">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Nom</label>
            <input type="text" class="form-control" name="nameEvent" id="exampleFormControlInput1" placeholder="Nom de l\'évenèment" required>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Description</label>
            <textarea class="form-control" name="descriptionEvent" id="exampleFormControlTextarea1" rows="3" required></textarea>
        </div>
       <div class="input-group mb-3">
            <label class="input-group-text" for="inputGroupSelect01">Catégorie</label>
            <select class="form-select" id="inputGroupSelect01" name="categorieEvent">
                <option selected>Choose...</option>
                <option value="Anniversaire">Anniversaire</option>
                <option value="Conference">Conference</option>
                <option value="Mariage">Mariage</option>
            </select>
        </div>
         <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Date</label>
            <input type="date" class="form-control" name="date_event">
        </div>

         <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Date</label>
            <input type="time" class="form-control" name="time_event">
        </div>
         <div class="mb-3">
            <input type="file" class="form-control" name="imageEvent">
        </div>

        <button class="btn btn-success">Ajouter</button>
        <a href="'.BASE_URL.SP."event".'" class="btn btn-light me-3">Retour</a>
    </form>
    ';

    return $result;
}

/**
 * TRAITEMENT DES DONNEES SUR L'AJOUT D'UN EVENEMENT
 */
function displayAddEventAction(){

    global $model;

    if (!empty($_POST) && isset($_POST)) {
        
        $nom = ucwords($_POST['nameEvent']);
        $description = $_POST['descriptionEvent'];
        $categorie = ucwords($_POST['categorieEvent']);
        $date_event = $_POST['date_event'];
        $time_event = $_POST['time_event'];
    }

    if (isset($_FILES['imageEvent']['name']) && $_FILES['imageEvent']['error']==0) {
        
        $image_name = $_FILES['imageEvent']['name'];
        $image_tmp = $_FILES['imageEvent']['tmp_name'];

        
        $destination = "images"."/".$image_name;
        move_uploaded_file($image_tmp, $destination);
    }

    $eventData = $model->createEvent($nom, $description, $categorie, $date_event, $time_event, $image_name, $image_tmp);

    //print_r($eventData); exit();

    if ($eventData) {
        
        return displayEvent();
    }else{

        return "<p class='btn btn-danger'>Echec, veuillez réessayer !</p>".displayAddEvent();
    }

    //print_r($_FILES['imageEvent']); exit();
}

/**
 * VOIR UN EVENEMENT
 */
function displayVoir(){

    global $model;
    global $url;

    $idEvent = $url[1];

    $dataEvent = $model->getEvent($idEvent);
    
    $result = '<table class="table caption-top">
        <thead class=" bg-dark text-light">
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nom</th>
            <th scope="col">Description</th>
            <th scope="col">Catégorie</th>
            <th scope="col">Date/Heure</th>
            <th scope="col">Image</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">'.$dataEvent[0]['id'].'</th>
                <td>'.$dataEvent[0]['nom'].'</td>
                <td>'.$dataEvent[0]['description'].'</td>
                <td>'.$dataEvent[0]['categorie'].'</td>
                <td>'.$dataEvent[0]['date_event'].' / '.$dataEvent[0]['time_event'].'</td>
                <td><img src="'.BASE_URL.SP."images".SP.$dataEvent[0]['image_name'].'" alt=""></td>
                <td> <a href="'.BASE_URL.SP."supprimer".SP.$dataEvent[0]['id'].'" class="btn btn-block btn-primary">Supprimer</a></td>
            </tr>
        </tbody>
        </table> 
    ';

    $result .='<a href="'.BASE_URL.SP."reservation".SP.$dataEvent[0]['id'].'" class="btn btn-success mb-3 w-50">Réservation</a>';
    $result .='<a href="'.BASE_URL.SP."event".'" class="btn btn-light mb-3 w-50">Retour</a>';

    return $result;
}

/**
 * RESERVER UN EVENEMENT
 */
function displayReservation(){

    global $model;
    global $url;
   
    if (isset($_SESSION['user'])) {
        $idUser = $_SESSION['user']['id'];
        $idEvent = $url[1];
    
        $reservation = $model->reservation($idUser, $idEvent);
    
        if ($reservation) {
            
            return '<p class="btn btn-light w-100">Merci de faire la réservation. Nous vous contacterons dans 2 heures.</p>'.displayEvent();
        }else{
            return '<p class="btn btn-danger w-100">Echec de la réservation. Veuillez réessayer.</p>'.displayVoir();
            
        }
    }else{
        return '<p class="btn btn-danger w-100">Connectez vous afin d\'effectuer une réservation.</p>'.displayAccueil();

    }
}

/**
 * SUPPRIMER UN EVENEMENT
 */
function displaySupprimer(){

    global $model;

    if (isset($_SESSION['user'])) {
        global $url;
        $idEvent = $url[1];
    
        $event = $model->deleteEvent($idEvent);
    
        if ($event) {
            
            return '<p class="btn btn-light w-100">Evènement supprimé avec success !</p>'.displayEvent();
        }else{
            return '<p class="btn btn-danger w-100">Echec de la réservation. Veuillez réessayer.</p>'.displayVoir();
            
        }
    }else{
        return '<p class="btn btn-danger w-100">Connectez vous afin d\'effectuer une réservation.</p>'.displayAccueil();

    }


}
?>