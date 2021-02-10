<?php  
  $bdd = new PDO("mysql:host=localhost;dbname=gradien","root","morgan");
  $erreur= "";
 if (isset($_POST["submit"])){
    //  mes Variables
                @$nom = $_POST["nom"];
                @$prenom = $_POST["prenom"];
                @$email = $_POST["email"];
                @$date = $_POST["datedenaissance"];
                @$mdp = ($_POST["mdp"]);
                @$mdp2 = ($_POST["mdp2"]);
                @$a = rand(100000, 400000);

// on verifie si les champs sont vide ou pas
if( empty($mdp) && empty($mdp2) && empty($nom) && empty($email) && empty($prenom) && empty($date)){
    $erreur= "<p style= 'text-align:center;
                    font-weight: 600;
                    font-size: 10px;
                     padding-bottom: 10px;
                     background: red;
                     border-radius: 5px;
                     margin-bottom: 10px;
                     padding-top: 10px;
                     width:88%'>Veuillez remplir les champs obligatoires !</p>";
    
}
  else{
    //   on verifie si l'email est correct
         if(filter_var($email, FILTER_VALIDATE_EMAIL)){
             if(empty($nom) && empty($prenom)){
              $erreur=  " <p style= 'text-align:center;
                 font-weight: 600;
                 font-size: 10px;
                  padding-bottom: 10px;
                  background: red;
                  border-radius: 5px;
                  margin-bottom: 10px;
                  padding-top: 10px;
                  width:88%;'>Veuillez remplir les champs obligatoires !</p>";
             }
             else{
              if($mdp == $mdp2 && !empty($mdp)){ 
              $options = [
                'cost' => 12,
            ];
             $hashpass = password_hash($mdp, PASSWORD_BCRYPT, $options);     
                
               
                $query = $bdd->prepare("INSERT INTO inscription(nom, prenom, email, datedenaissance, mdp, numero_dossier) VALUE(?, ?, ?, ?, ?, ?)");
                $query->execute([ $nom, $prenom, $email, $date, $mdp, $a]);
                $erreur=  " <p style='text-align:center;
                    font-weight: 600;
                    font-size: 10px;
                     padding-bottom: 10px;
                     background: red;
                     border-radius: 5px;
                     margin-bottom: 10px;
                     padding-top: 10px;
                     width:88%'>Bienvenue !</p> ";

            }
            else{
              $erreur=  "<p style= 'text-align:center;
                 font-weight: 600;
                 font-size: 10px;
                  padding-bottom: 10px;
                  background: red;
                  border-radius: 5px;
                  margin-bottom: 10px;
                  padding-top: 10px;
                  width:88%'>Les mots de passe ne sont pas identiques !</p>";
            }
               }

             }else{
              $erreur=  "<p style= 'text-align:center;
                   font-weight: 600;
                   font-size: 10px;
                    padding-bottom: 10px;
                    background: red;
                    border-radius: 5px;
                    margin-bottom: 10px;
                    padding-top: 10px;
                    width:88%'> Email invalide !</p>";
               }

           

           }         
       }                                     
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="CSS/inscription_final.css" />
    <script src="popup._mailto.js"></script>
    <link
      href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600&display=swap"
      rel="stylesheet"
    />
    <style>
      @import url("https://fonts.googleapis.com/css2?family=Noto+Sans+SC&display=swap");
    </style>

    <title>Login</title>
  </head>
  <body>
    <div id="wrap">
      <div class="header">
        <h1 class="h1">BIENVENUE AU CENTRE DE FORMATION DE L'A.F.P.A</h1>
      </div>
    </div>

    <section class="section">
      <div class="box">
        <div class="form">
          <h2>Créer un compte</h2>
          <form action="" method="POST">
            <div class="inputbox">
              <input type="text" name="nom" placeholder="Nom" />
              <img src="./CSS/assets/ID.png" />
            </div>
            <div class="inputbox">
              <input type="text" name="prenom" placeholder="Prénom" />
              <img src="./CSS/assets/ID.png" />
            </div>
            <div class="inputbox">
              <input type="email" name="email" placeholder="Votre email" />
              <img src="./CSS/assets/ID.png" />
            </div>
            <div class="inputbox">
              <input type="date" name="datedenaissance" placeholder="" class="birthday" />
             
            </div>
            <div class="inputbox passe">
              <input type="password" name="mdp" placeholder="Mot de Passe (6 caractères mini)" />
              <img src="./CSS/assets/verrouiller.png" />
            </div>
            <div class="inputbox passe">
              <input type="password" name="mdp2" placeholder="Confirmez votre Mot de Passe" />
              <img src="./CSS/assets/verrouiller.png" />
            </div>
            <?php
    echo $erreur;
    ?>
            <div class="inputbox">
              <input type="submit" name="submit"value="Créer mon compte" />
            </div>
          </form>

          <p>
            <a href="./connexion.php">J'ai déjà un compte
            </a>
          </p>
        </div>
      </div>
    </section>
  </body>
</html>