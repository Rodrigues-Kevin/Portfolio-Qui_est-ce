<html>
   <head>
       <title>Résultat</title>
       <meta charset="UTF-8">
   </head>
   <body style="font-size: 200%;">
       <center>
           <h1><u>Résultat</u></h1>
           <?php
               //Réception des réponses sous forme de bits et si l'utilisateur n'a pas répondu à toutes les questions, tout les bits sont mis à 0 :
               if (isset($_POST["bit1"]) && isset($_POST["bit2"]) && isset($_POST["bit3"]) && isset($_POST["bit4"]) && isset($_POST["bit5"]) && isset($_POST["bit6"]) && isset($_POST["bit7"]))
               {
                   $bit1 = $_POST["bit1"];
                   $bit2 = $_POST["bit2"];
                   $bit3 = $_POST["bit3"];
                   $bit4 = $_POST["bit4"];
                   $bit5 = $_POST["bit5"];
                   $bit6 = $_POST["bit6"];
                   $bit7 = $_POST["bit7"];
               }
               else
               {
                   $bit1 = "0";
                   $bit2 = "0";
                   $bit3 = "0";
                   $bit4 = "0";
                   $bit5 = "0";
                   $bit6 = "0";
                   $bit7 = "0";
               }

               //Concaténation des bits pour trouver le personne choisi par l'utilisateur :
               $personnage_choisi = $bit1 . $bit2 . $bit3 . $bit4 . $bit5 . $bit6 . $bit7;

               //Initialisation d'une liste contenant le nombre binaire de chaque personnage et d'une liste contenant les résultats des syndromes :
               $personnages = array("0101010", "0001111", "1111111", "1000110", "1010101", "1110000", "0000000", "1100011", "0100101", "0111001", "0110110", "0010011", "1100100", "1011010", "0011100", "1001001");
               $resultats_syndromes = array("1010101", "0110110", "0001111");

               //Vérification que le personnage de l'utilisateur est dans la liste des personnages :
               $dansListe = False;
               for ($i = 0; $i < count($personnages); $i++)
               {
                   if ($personnages[$i] == $personnage_choisi)
                   {
                       $reponse = "Vous n'avez pas menti. Vous avez choisi le personnage :";
                       $dansListe = True;
                       break;
                   }
               }

               //Si le personnage de l'utilisateur n'est pas dans la liste des personnages, on calcule les syndromes pour trouver à quelle question l'utilisateur a menti :
               if ($dansListe == False)
               {
                   //Calcul des syndromes :
                   $s1 = $personnage_choisi[0] . $personnage_choisi[2] . $personnage_choisi[4] . $personnage_choisi[6];
                   $s2 = $personnage_choisi[1] . $personnage_choisi[2] . $personnage_choisi[4] . $personnage_choisi[5];
                   $s3 = $personnage_choisi[3] . $personnage_choisi[4] . $personnage_choisi[5] . $personnage_choisi[6];

                   //Met la valeur 1 aux syndromes qui ont un nombre de 1 impair et 0 si ils ont un nombre de 1 pair :
                   $s1 = strval((substr_count($s1, "1")) % 2);
                   $s2 = strval((substr_count($s2, "1")) % 2);
                   $s3 = strval((substr_count($s3, "1")) % 2);

                   //Trouve la question où l'utilisateur a menti en comparant les syndromes et la liste des résultats des syndromes :
                   for ($i = 0; $i < 7; $i++)
                   {
                       if ($s1 == $resultats_syndromes[0][$i] && $s2 == $resultats_syndromes[1][$i] && $s3 == $resultats_syndromes[2][$i])
                       {
                           //Trouve le personnage auquel l'utilisateur a menti en changeant le bit de la fausse réponse :
                           if ($personnage_choisi[$i] == "0")
                           {
                               $personnage_choisi[$i] = "1";
                           }
                           else if ($personnage_choisi[$i] == "1")
                           {
                               $personnage_choisi[$i] = "0";
                           }

                           $reponse = "Vous avez menti à la question " . ($i + 1) . ". Vous aviez choisi le personnage :" ;
                           break;
                       }
                   }
               }

               //Affichage du résultat du jeu :
               echo $reponse . "<br><br>";
               echo "<img src='personnages_id/" . $personnage_choisi . ".jpg'><br><br><br><br><br><br><br><br>";
               echo "<a href='choix_personnage.html'>Recommencer</a>";
           ?>
       </center>
   </body>
</html>