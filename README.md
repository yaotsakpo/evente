Veuillez suivre ces instructions point par point pour pouvoir installer l'application 

Ce tutoriel est dédié à un système d'exploitation windows

1- decompresser le fichier compressé applicationDeVente

2- installez le logiciel wampserver3.1.0_x86.exe ( c'est un gestionnaire de serveur web et de base de données) il contient donc le serveur de base de données MySql et le serveur web appache qu'on utilisera pour faire fonctionner notre application

Ne vous inquittez par des termes techniques mais suiviez juste les instructions.... 

3- demarrez le logiciel que vous venez d'installer ( wampserver ).il doit avoir un raccourci sur votre bureau
( après démarrage, vous verrez une icone verte dans la bare de notification de windows generalement en bas à droite )

4- Ensuite, ouvrez n'importe lequel de vos navigateur web (Chrome de préférence ) puis accedez à l'adresse suivante http://localhost/phpmyadmin/ ( le nom d'utilisateur est par defaut root et le mot de passe vide puis vous appuyez sur exécuter )

5- après etre redirigé sur une interface; Vous devriez voir un onglet SQL sur lequel il faut cliquer

6- vous serrez ensuite dirigé sur une interface vous permettant de saisir du texte( hihi ce n'est pas du texte à saisir mais plutot du code SQL). copiez cette commande "CREATE DATABASE evente;" puis cliquez sur Exécuter

7- reouvrez ensuite un autre onglet de votre navigateur puis copiez cette adresse et y accedez http://localhost/phpmyadmin/db_sql.php?db=evente

8- vous serrez ensuite dirigé sur une interface vous permettant de saisir du texte( hihi ce n'est pas du texte à saisir mais plutot du code SQL. Retournez donc au dossier que vous avez decompressé au point 1- puis copié le contenu du fichier BaseDeDonnees.sql et vous venez le coller dans la zone de texte qui vous est laissé pour saisir du texte et decocher la case Activer la vérification des clés étrangères qui est en bas de la zone de texte par defaut coché puis vous cliquez sur exécuter)

Ne vous decouragez surtout pas vous y etes presque hihi 


9- Copiez le dossier evente se trouvant dans le dossier que vous avez decompressé et allez le coller dans le repertoire dons le chemin est C:\wamp\www (vous pouvez y acceder directement en saisissant cette adresse dans la barre d'adresse d'un explorateur de fichier)

10- Et enfin votre aplication est installée. Ouvrez donc un navigateur et saisissez l'adresse suivante http://localhost/evente/web/

11- vous devriez etre redigé vers une page d'authentification. 

vous pouvez utiliser ces identifiants pour vous connecter

compte adminstrateur:

le nom d'utilisateur: eventeadmin
mot de passe : admin

ce compte est un compte administrateur donc vous avez tous les droits et toutes les fonctionnalités

compteur vendeur: 

le nom d'utilisateur: eventeutilisateur
mot de passe : utilisateur

ce compte est un compte vendeur donc vous ne pouvez que essentiellement vendre



Merci d'avoir suivi ce tutoriel !!! pour plus d'information ou tout problème rencontré veuillez contacter le +228 98882471/ 93643336 ou email : emmanueltsakpo5@gmail.com
