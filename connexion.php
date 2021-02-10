<?php

 $bdd = new PDO("mysql:host=localhost;dbname=gradien","root","morgan");
 $erreur= "";
   if (isset($_POST["submit"])){
    //  mes Variables
                @$email = $_POST["email"];
                @$mdp = $_POST["mdp"];
               
               
         
// on verifie si les champs sont vides ou pas
      if(empty($email) && empty($mdp)){
             $erreur = "<p style= 'text-align:center;
             font-weight: 600;
             font-size: 10px;
             padding-bottom: 10px;
             background: red;
             border-radius: 5px;
             margin-bottom: 10px;
             padding-top: 10px;'> Veuillez remplir les champs obligatoires !</p>";
            
                
         }
          else{
            //   on verifie si l'email est correct
                 if(filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($mdp)){
                         
                          $requser = $bdd->prepare("SELECT * FROM inscription WHERE email = ? AND mdp = ?");
                          $requser->execute(array($email, $mdp));
                          $userexist = $requser->rowCount();
                          
                          if($userexist == 1)
                          { 
                            $mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT);
                            $query = $bdd->prepare("INSERT INTO connexion(email, mdp) VALUE(?,?)");
                            $query->execute([$email, $mdp]);
                            $erreur= "<p style= 'text-align:center;
                            font-weight: 600;
                            font-size: 10px;
                            padding-bottom: 10px;
                            background: red;
                            border-radius: 5px;
                            margin-bottom: 10px;
                            padding-top: 10px;'> Bienvenue !</p>";

                          }
                          else
                          {$erreur = "<p style= 'text-align:center;
                            font-weight: 600;
                            font-size: 10px;
                            padding-bottom: 10px;
                            background: red;
                            border-radius: 5px;
                            margin-bottom: 10px;
                            padding-top: 10px;'> Mail ou Mot de passe non reconnus !</p>";
                            // echo "<p style= 'color:red'> Mauvais mail ou mots de passe ! </p>";
                          }

                       } else{$erreur = "
                         <p style= 'text-align:center;
                         font-weight: 600;
                         font-size: 10px;
                         padding-bottom: 10px;
                         background: red;
                         border-radius: 5px;
                         margin-bottom: 10px;
                         padding-top: 10px;'> 
                        Veuillez remplir les champs obligatoires !</p>";
                          //  echo "<p style= 'color:red'> veuillez remplir les champs obligatoire! </p>";
                       }


                   }         
                }                                     

                                            
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="CSS/connexion_final.css" />
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
          <h2>Se connecter</h2>
        
          <form action="" method="POST">
            <div class="inputbox">
              <input type="text" name="email" placeholder="Email" />
              <img src="./CSS/assets/ID.png" />
            </div>
            <div class="inputbox">
              <input type="password" name="mdp" placeholder="Mot de passe" />
              <img src="./CSS/assets/verrouiller.png" />
            </div>
            <?php
    echo $erreur;
    ?>
            <label class="remember">
              <input type="checkbox" />Se souvenir de moi
            </label>
            
            <div class="inputbox">
              <input type="submit" name="submit" value="Se connecter" />
            </div>
          </form>
          <p>
           
            <a href="#" Mot de passe> Mot de Passe Oublié</a>
          </p>
          <p>
            <a href="./inscription.php">Je n'ai pas encore de compte
            </a>
          </p>
        </div>
      </div>
    </section>
  
  </body>
</html>
