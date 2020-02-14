#"# nws_cms_eval"

##Definition projet
###Mon projet est un cms pour lister, creer, éditer et supprimer des recettes
Choix techniques :  
- Utilisation de symfony car aisance sur la technologie et approfondissement de l'utilisation des forms
- Bootstrap pour le style rapide

Prérequis :
php, symfony, yarn, composer, BDD Mysql

##Installation
Cloner le projet github à cet URL :
https://github.com/bdomart/nws_cms_eval

Exécuter la commande suivante pour récupérer les librairies installées :
```composer install```

Pour compiler les fichiers JS et SCSS :
```yarn encore dev```

###Configuration de la base de donnée
Créer votre fichier .env.local à la racine du projet et modifier la ligne suivante selon les accès de votre BDD :
Exemple : DATABASE_URL=mysql://root:@127.0.0.1:3306/nws_cms_eval?serverVersion=5.7  
Lancer les migrations nécessaires : ```php bin/console doctrine:migrations:migrate```

###Enfin pour lancer le projet, utilisé la commande suivante :
Installer symfony au préalable si nécessaire : 
```symfony server:start``` (localhost:8000 ou localhost:8001)

##Fonctionnement rapide
Pour créer une recette, créer en premier les aliments nécessaire à la réalisation de la recette : /food/create
Créer une recette ensuite en incluant les aliments voulu en tant qu'ingrédients : /recipe/create

Tous les aliments et recettes sont consultables aux urls respectives : /foods ou /recipes

##Objectifs bonus à faire
Partie Composition des aliments à développer (Entity FoodComponent & FoodComposition)


