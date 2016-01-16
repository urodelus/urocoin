<html>

   <title>Les derniers blocks</title>

   <head>
      <style>
         .block {color: blue; font-family: Courier-new; font-size: 14;}
         .nonce {color: red; font-family: Courier-new; font-size: 14;}
         .issuer {color: black; font-family: Courier-new; font-size: 14;}
      </style>
   </head>
   
   <body>
      <?php
   // Pas de retour d'erreurs (block vide...)
         error_reporting(E_ALL);
         ini_set('display_errors','Off');
   // Lectures des blocks t
         for ($t = 48550; $t>48450; $t--)
            {
  // Met le contenu de $adresse dans $page
            $adresse = "http://192.168.1.50:9201/blockchain/block/".$t;
            $page = file_get_contents ($adresse);
  // Extrait de $page tous les caractères (.*) compris entre "issuer": " & " et les range dans le tableau $issuer
            preg_match_all ('#"issuer": "(.*)"#', $page, $issuer);
            preg_match_all ('#"nonce": (.*),#', $page, $nonce);
            for($i = 0; $i < count($nonce[1]); $i++) // On parcourt le tableau $issuer[1] 'le contenu entre ()'
               { echo '<span class="block"> ', $t, '  </span><span class="nonce">', $nonce[1][$i], '</span>'; // On affiche toute la capture
               }
            for($i = 0; $i < count($issuer[1]); $i++)
               { echo '<span class="issuer">  ', $issuer[1][$i], '</span>'; 
               }
            }
      ?>  
   </body>

</html>
