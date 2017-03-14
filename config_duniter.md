# Point configuration box / Duniter

## DNS

J'utilise _No-Ip_ comme fournisseur. Sur mon compte, je crée un 'nom de domaine' ("**uro**.ddns.net" par exemple) que je relie à mon adresse Ip externe 'XXX.XXX.XXX.XXX' en cours. _No-Ip_ se charge ensuite de toujours associé mon adresse Ip (dynamique) à ce nom de domaine (statique). Cela se fait grace à un petit logiciel à installer qui relève et transmet cette adresse toutes les 5 minutes.

N.B.: Ce service est gratuit, il faut donc penser à revalider cette association dans les 30 jours sinon elle ne fonctionnera plus. De plus le hostname 'perdu' ne semble pas renouvelable, il faudra donc en changer. Ce n'est pas gênant ici.

> Le lien **WEB->Box** est créé

## BOX

* Il faut informer la box de la manip précédente. Dans l'onglet DynDNS, activer DynDNS puis choisir le service dans le menu déroulant ici _No-Ip_ puis entrer les identifiant et mot de passe du compte et enfin le nom de domaine choisi. Valider. Le statut doit passer au vert (et y rester !).
* Il faut maintenant faire pointer ce nom de domaine vers l'adresse Ip du PC sur le réseau interne (derrière la box). Dans l'onglet DNS, entrer une adresse fixe par exemple '192.168.1.**50**' puis le nom de domaine puis cliquer sur ajouter.
* Il faut maintenant associer cette adresse fixe au PC. Dans l'onglet DHCP, dans le champs adresses statiques, ajouter cette adresse '192.168.1.**50**' et sélectionner l'adresse Mac du PC dans la liste puis cliquer sur ajouter.
* Il est aussi possible dans l'onglet NAT d'activer le service UPnP qui gérera automatiqueement les règles de translation de ports si nécessaire.

> Le lien **WEB->Box->PC** est créé

## Duniter

Le logiciel Duniter étant installé, il faut lui indiquer par quelle porte passent ces communications avec l'extérieur. Pour cela, il faut se rendre dans l'onglet Settings, puis Network. Mettre Ipv6 à 'None'. Dans Ipv4, Private (computer), mettre l'adresse Ip interne 'Ethernet 192.168.1.**50**'. Dans Public (box/router), mettre l'adresse Ip externe 'conf XXX.XXX.XXX.XXX'. Cocher 'use UPnP'. Dans Domain name, entrer le nom de domaine. Dans Port, entrer un numéro de port non utilisé.

> Le lien **WEB->Box->PC--port-->Duniter** est créé

=
_ box SFR (NB4-SER-r2) + windows 8.1 + [Duniter](https://github.com/duniter/duniter/releases "Page des releases") v0.50.5 décembre 2016_


