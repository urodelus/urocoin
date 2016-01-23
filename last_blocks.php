<html>
   <title>Les derniers blocks</title>
   <head>
      <meta http-equiv="refresh" content="600"; url=http://localhost/uCoin/LastBlocks.php">
      <style>
         body {color: black; font-family: Courier-new; font-size: 14;}
         .block {color: blue; font-family: Courier-new; font-size: 14;}
         .nonce {color: red; font-family: Courier-new; font-size: 14;}
         .issuer {color: black; font-family: monospace; font-size: 14;}
      </style>
   </head>   
   <body>
      <?php
         date_default_timezone_set("Europe/Paris"); 
         setlocale(LC_TIME, 'fra_fra');
         echo strftime('%A %d %B %Y %H:%M:%S S%W'), '<br>';
      ?>
      <table border="0" cellpadding="5" cellspacing="2" >
      <tbody>
         <tr><td>Block</td><td>Nonce</td><td>Issuer</td><td>Time</td><td>Pow</td></tr>      
         <?php
            for ($t = 48750; $t>48500; $t--)
               {  $adresse = "http://192.168.1.94:9201/blockchain/block/".$t;
                  $AgetHeaders = @get_headers($adresse);
                  if (preg_match("|200|", $AgetHeaders[0]))
                     {  $page = file_get_contents ($adresse);
                        preg_match_all ('#"nonce": (.*),#', $page, $nonce);                     
                        for($i = 0; $i < count($nonce[1]); $i++)
                           { echo '<tr><td><span class="block">', $t, '</span></td><td><span class="nonce">', $nonce[1][$i], '</span></td>';
                           }               
                       preg_match_all ('#"issuer": "(.*)"#', $page, $issuer);
                        for($i = 0; $i < count($issuer[1]); $i++)
                           { echo '<td><span class="issuer">', $issuer[1][$i], '</span></td>'; 
                           }
                      preg_match_all ('#"time": (.*),#', $page, $time);                        
                        $heure=""; 
                        for($i = 0; $i < count($time[1]); $i++)
                           { $heure.=$time[1][$i];
                           }
                        echo '<td><span class="nonce"> ', ''.date('d/m/Y', $heure).' '.date('H:i:s', $heure), '</span></td>';
                       preg_match_all ('#"powMin": (.*),#', $page, $powMin);
                        for($i = 0; $i < count($powMin[1]); $i++)
                           { echo '<td><span class="issuer">', $powMin[1][$i], '</span></td>'; 
                           } 
                    }
                  else echo ''; 
               }
         ?>
      </tbody>
      </table>  
   </body>
</html>  
