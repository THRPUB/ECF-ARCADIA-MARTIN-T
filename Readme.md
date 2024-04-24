# __Projet Arcadia__

## __Getting Started__

Ces instructions vous permettront d'obtenir une copie du projet en cours d'exécution sur votre machine locale à des fins de développement et de test. Consultez le déploiement pour obtenir des notes sur la manière de déployer le projet sur un système en direct.

### __Prérequis__

PHP 8.2 or above </br>
Symfony CLI 5.7 or above </br>
Symfony 7.0.5 or above <br />
NodeJS <br />
mySQL </br>
noSQL </br>
MongoDB: 7.0.6 </br>
VSCODE </br>
GIT </br>

Extension VSCODE PHP Server sur localHost3000 pour naviguer dans le html
(Appuyer sur l'icone bleu "PHP" en haut a droite pour lancer la visualisation)

### __Installation__
Un guide pas à pas pour créer un environnement de développement fonctionnel.

#### Installer Git

__Windows__ </br>
Installer Scoop
```
Set-ExecutionPolicy -ExecutionPolicy RemoteSigned -Scope CurrentUser
Invoke-RestMethod -Uri https://get.scoop.sh | Invoke-Expression
```
Installer git
```
scoop install git
````

#### Installer Symfony CLI
```
scoop install symfony-cli
```

#### Vérifier l'installation
```
symfony check:requirements -v
```

#### Cloner le repo </br>
-Créer un nouveau dossier, se positionner à l'aide d'un terminal  dans ce dossier et effectuer la commande:
```
mkdir ECF_MT
```
```
cd ECF_MT
```
```
git clone https://github.com/THRPUB/ECF-ARCADIA-MARTIN-T.git
```

#### Configurer les variables d'environnement:

Afin de pouvoir tester correctement ce projet il nous faut également configurer les variables d'environnement:
Se positionner dans le dossier Arcadia, créer un fichier nommé .env.local
Dans ce fichier, ajouter les lignes suivantes:
```
cd ECF-ARCADIA-MARTIN-T
```
Puis créer le fichier .env.local
Windows powershell:
```
ni .env.local
```
Linux: 
```
touch .env.local
```
Dans ce fichier .env.local , ajouter les variables d'environnement:

```
DATABASE_URL="mysql://root@127.0.0.1:3306/Zooarcadia_db?serverVersion=10.11.2-MariaDB&charset=utf8mb4" 

MONGODB_URL=mongodb://localhost:27017 
```
#### Installer les dépendances avec composer
- A l'aide d'un terminal, se positionner dans le dossier 'ECF-ARCADIA-MARTIN-T'
```
cd ECF-ARCADIA-MARTIN-T
```
Installer les dépendances
```
composer install
```
L'installation des dépendances peut prendre plusieurs minutes.

```bash
$ php bin/console d:d:c   # Create your DATABASE related to your .env.local configuration
$ php bin/console d:m:m   # Run migrations to setup your DATABASE according to your entities
```

-> Dans votre interface PhpMyAdmin inserez les données présentes dans le fichier SQL "insert_data.sql"

Créer la base de données Nosql en se servant du fichier Nosql:

-> Allez sur MongoDB COMPASS
-> Créez une Database : animalDB avec comme collection -> animals

-> Cliquez sur ADDDATA et importez le fichier json présent dans le dossier SQL & NOSQL

#### Initialiser le serveur node pour Compeur NoSql </br>

```
npm init -y
npm install express mongoose
npm install cors
node animalsMongodb.js
```

## Usage

```bash
$ symfony server:start    # Use this command to start a local server.
`
