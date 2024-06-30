<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    <?php if($action !== "voir" || $action !== "reservation"|| $action !== "supprimer"):?>
        <link rel="stylesheet" href="style.css">
    <?php endif?>
    <?php if($action === "voir" || $action === "reservation" || $action === "supprimer"):?>
        <link rel="stylesheet" href="../style.css">
    <?php endif?>

    <title><?php echo $title ?></title>
</head>
<body>

    <header class="header bg-primary">
        <nav class="navbar">
            <div class="container-fluid">
                <ul class="m-0">
                    <li class="nav-item">
                    <a class="nav-link" href="<?php echo BASE_URL.SP."accueil" ?>">Accueil</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="<?php echo BASE_URL.SP."event" ?>">Evènement</a>
                    </li>
                    <li class="nav-item">
                    <a href="<?php echo BASE_URL.SP."about" ?>" class="nav-link">Apropos</a>
                    </li>
                </ul>
                <form action="event" method="post" class="w-50">
                    <div class="input-group">
                        <input type="text" class="form-control" name="searchEvent" placeholder="Réchercher un évènement par nom, date ou heure ...">
                        <button class="btn btn-outline-secondary btn-light" type="submit" id="button-addon1"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </form>
                <?php if(isset($_SESSION['user'])):?>
                    <div class="user-connexion">
                        <a href="<?php echo BASE_URL.SP."profil"?>" class="btn btn-warning pe-3 me-3">Profil</a>
                        <a href="<?php echo BASE_URL.SP."deconnexion"?>" class="btn btn-warning">Déconnexion</a>
                    </div>
                <?php endif?>
            </div>
        </nav>
    </header>
    <div class="slide">
        <?php if($action === "about"):?>
            <h2>APROPOS DE NOUS</h2>
        <?php endif?>
        <?php if($action !== "about"):?>
            <h2>Bienvenu à Prince Event</h2>
        <?php endif?>
        <div class="overflow"></div>
    </div>
    <div class="container-fluid">
        <?php echo $content ?>
    </div>  
    
    <footer>
        <div class="title">
            <h4>Contactez - Nous</h4>
        </div>
        <div class="icons">
            <div class="phone">
                <i class="fa-solid fa-phone"></i>
                <p>+242 06 433 9009</p>
            </div>
            <div class="email">
                <i class="fa-solid fa-envelope"></i>
                <p>lightyombi2@gmail.com</p>
            </div>
        </div>
        <p class="copyright">Copyright © 2024 - Prince Event | <span>LightSoft</span></p>
    </footer>

</body>
</html>