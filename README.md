# Product Management App

Ce projet inclut :
- Création, lecture, modification et suppression de clients, produits et commandes
- Gestion des relations entre entités
- Authentification et sécurité
- Interface responsive avec Bootstrap

## Fonctionnalités
✔ Gestion des clients 
✔ Gestion des produits avec upload d’image
✔ Gestion des commandes
✔ Authentification obligatoire pour certaines actions  
✔ Interface utilisateur claire avec Bootstrap


## Installation

### Clonez le dépôt

git clone https://github.com/brejnev12/New-project-management.git
cd New-projet-management

### Installez les dépendances
- composer install
- npm install
- npm run dev

### Configuration
cp .env .env.local

### Configurez la base de données dans .env.local
Copie le fichier .env en .env.local et adapte la configuration XAMPP

DATABASE_URL="mysql://root:@127.0.0.1:3306/product_management?serverVersion=8.0"

### Créez la base de données
php bin/console doctrine:database:create

### Créez la structure
php bin/console doctrine:migrations:migrate

### Authentification
php bin/console make:user
php bin/console make:auth

### Lancer le serveur
symfony server






