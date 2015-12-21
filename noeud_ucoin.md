Mise en service d'un nœud uCoin
=
Ayant découvert la [TRM](http://www.creationmonetaire.info/2012/11/theorie-relative-de-la-monnaie-2-718.html) par hasard, je me suis intéressé à la Monnaie et ai découvert le projet **uCoin**. Depuis janvier 2015, je faisais tourner le logiciel de test de monnaies libres **Cutecoin**.
À la sortie de **Sakia**, la nouvelle version de celui-ci, je me suis dit qu'il fallait aller plus loin. J'ai donc décidé de ne plus être seulement _client_ du réseau mais également _serveur_ afin de contribuer à sa décentralisation.
Mon principal soucis a été le système d'exploitation. **Habitué à Windows, comment utiliser Linux ?** Pas évidentes au premier abord, voici les étapes que j'ai suivies:
 
* Installation d'un machine virtuelle sur mon PC Windows (WIN 8.1 Pro 64 bits)
* Installation de Linux (Ubuntu 14.04.3 LTS) dans cette machine virtuelle
* Interfaçage réseau
* Installation du nœud uCoin

_Les procédures spéciques d'installation des différents logiciels sont aisément accessibles et ne sont pas décrites en détails ci-après._

### Installation d'une machine virtuelle
J'ai téléchargé et installé la machine virtuelle "**VirtualBox** 5.0.10 for Windows hosts  x86/amd64" ainsi que l'extension "VirtualBox 5.0.10 Oracle VM VirtualBox Extension Pack",  disponibles ici : [VirtualBox.org](https://www.virtualbox.org/wiki/Downloadsvirtualbox.org).
Je ne vous détaille pas la procédure, je me suis contenté de suivre les indications.
### Installation de Linux
J’ai téléchargé "**Ubuntu** 14.04.3 LTS (64 bits)", disponible ici : [ubuntu-fr](https://www.ubuntu-fr.org/telechargement).
Ensuite, il suffit de créer une nouvelle machine dans VirtualBox en spécifiant la version de Linux et la localisation du fichier .iso téléchargé juste avant !
>Afin d'autoriser la version 64 bits, j'ai dû activer la virtualisation (Hyper-V) dans le Bios de mon PC !

Dès lors, il suffit d'"Afficher" la machine. À la première ouverture l'installation d'Ubuntu s'effectue en suivant les indications.
Et voila, un nouveau système d'exploitation est disponible sur le PC.
> Afin d'augmenter la taille de la fenêtre d'Ubuntu, faire **"Barre de menu > Périphériques > Insérer l'image CD des Additions Invité…"** et lancer l'installation du logiciel. Choisir la taille désirée dans **"Barre de menus > Ecran > Ecran virtuelle n°1"**.

### Interfaçage réseau
À ce stade, depuis Ubuntu, l'accès vers l'extérieur (le Web) est déjà fonctionnel mais la box ADSL ne voit pas ! Quelques paramétrages m'ont été nécessaires:

- Dans VirtualBox,  dans la configuration de la machine virtuelle sélectionner **"Réseau >  Carte 1 > Mode d'accès réseau > Accès par pont"** afin que l'adresse Mac de la machine virtuelle soit visible dans la box.
- Dans la configuration de la box (NB4 en ce qui me concerne) **"Réseau > DHCP > Adresses statiques"**,  repérer l'adresse Mac de la machine virtuelle et ajouter une adresse statique à celle-ci (par exemple: 192.168.1.50).
- Dans la configuration de la box **"Réseau > DNS > DNS local"**, j'ai nommé l'adresse statique précédente (facultatif, mais si on ajoute d'autres machines c'est plus facile de les repérer !).
- Afin que le réseau uCoin discute avec votre futur nœud, il faut qu'il retrouve son adresse IP. Elle n'est pas fixe mais déterminée par mon fournisseur d'accès. J'ai alors choisi un service de management de DNS. Après inscription gratuite chez [NO-IP](https://www.noip.com/), un petit logiciel est installé sur le PC et se charge de fournir mon adresse IP chez NO-IP pour la coller sur le nom de domaine que j'ai créé : _urodelus.ddns.net_.
- Dans la configuration de la box, il faut paramétré cela **"Réseau > DynDNS > Activé"**, puis remplir les champs (dans mon cas : service=no-ip.com, nom d'utilisateur=urodelus, mot de passe=\********, nom de domaine=urodelus.ddns.net).
- Dans la configuration de la box "**Réseau > NAT > Désactivé UpNp** puis "**Réseau > NAT > Translation de ports** pour ouvrir un port pour le futur nœud, par exemple :

Nom         | Protocole  | Type Ports externes | Adresse IP de destination | Ports de destination
----------- | ---------- | ------------------- | ------------------------- | --------------------
ucoin_node  | les deux   | 9201                | 192.168.1.50              | 9201

###Installation et paramétrage du nœud uCoin
 Voilà, maintenant passons à ce qui nous intéresse ! Dans Ubuntu, le nœud uCoin est installé en ouvrant le terminal et tapant :
>$ curl -kL https: //raw.githubusercontent.com/ucoin-io/ucoin/master/install.sh | bash

Il faut maintenant le configurer en suivant les instructions :

>$ ucoind init

Voici un exemple des paramètres:
  
> Checking UPNp features...

> UPNp is *not* available, is this a public server (like a VPS) ? (Y/n) **No**

>$ Currency name: **meta_brouzouf**

>$ IPv4 interface: **eth0 192.168.1.50**

>$ IPv6 interface: **None**

>$ Port: **9201**

>$ Remote IPv4: **eth0 192.168.1.50**

> $ Remote IPv6: **None**

> $ Remote port: **9201**

> $ Does this server has a DNS name? **Yes**

> $ DNS name: **urodelus.ddns.net**

> $ You need a keypair to identify your node on the network. Would you like to automatically generate it ? (Y/n) **No**

> $ Key's salt: \********

> $ Key's password: \********

> Configuration saved.

Maintenant, on le synchronise avec le réseau :	
>$ ucoind sync metab.ucoin.io 9201
    
Il n'y a plus qu'à le faire travailler :
>$ ucoind start

À ce stade, le nœud avec synchronise avec le réseau. Il reçoit et réémet la **blockchain**.
Il peut faire encore plus en produisant des blocs de la blockchain.


>$ Participate writing the blockchain (when member) **Yes**

>$ Start computation of a new block if none received since (seconds) **600**

>$ Universal Dividend %growth: **0.1**

>$ Universal Dividend period (in seconds) **86400**

>$ First Universal Dividend (UD[0]) amount: **100**

>$ Delay between 2 identical certifications: **604800**

>$ Certification validity duration: **2629800**

>$ Number of valid certifications required to be a member: **3**

>$ Number of valid emitted certifications to be a distance checked member: **3**

>$ Membership validity duration: **2629800**

>$ Number of blocks on which is computed median time: **11**

>$ The average time for writing 1 block (wished time) **600**

>$ Frequency, in number of blocks, to wait for changing common difficulty: **20**

>$ Number of blocks to check in past for deducing personalized difficulty: **144**

>$ Weight in percent for previous issuers: **0.67**

Pour suivre son activité :
>$ ucoind logs
