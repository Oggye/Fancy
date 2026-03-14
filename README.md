# Fancy 🛍️

## 📌 Description

**Fancy** est une application web e-commerce développée avec **Symfony (PHP)** permettant aux utilisateurs de consulter des produits, effectuer des recherches, gérer un panier et passer des commandes.

Le projet utilise **Doctrine ORM** pour la gestion de la base de données et suit l’architecture **MVC** fournie par Symfony.

---

## 🚀 Fonctionnalités

* 📦 **Catalogue de produits**

  * Affichage de la liste des produits
  * Consultation du détail d’un produit

* 🔎 **Recherche de produits**

  * Recherche dans le catalogue

* 🛒 **Gestion du panier**

  * Ajouter un produit au panier
  * Supprimer un produit du panier
  * Voir les produits dans le panier

* 📑 **Commande**

  * Création d’une commande à partir du panier


## 🏗️ Architecture du projet

```
Fancy
│
├── assets/              # Fichiers front-end (JS, CSS, Stimulus)
├── bin/                 # Commandes Symfony
├── config/              # Configuration de l'application
├── migrations/          # Migrations de base de données
├── public/              # Point d'entrée public (index.php)
│   └── images/          # Images du site (logo, icônes, etc.)
├── src/
│   ├── Controller/      # Contrôleurs de l'application
│   │   ├── CommandeController.php
│   │   ├── PanierController.php
│   │   ├── ProduitController.php
│   │   └── RechercheController.php
│   │
│   ├── Entity/          # Entités Doctrine
│   │   ├── Produit.php
│   │   ├── Panier.php
│   │   └── User.php
│   │
│   ├── Repository/      # Repositories Doctrine
│   └── Form/            # Formulaires Symfony
│
├── templates/           # Templates Twig
├── .env                 # Variables d'environnement (template)
├── composer.json        # Dépendances PHP
└── composer.lock        # Versions verrouillées des dépendances
```


## ⚙️ Technologies utilisées

* **PHP**
* **Symfony**
* **Doctrine ORM**
* **Twig**
* **MySQL**


## 📦 Installation

### 1️⃣ Cloner le projet

```bash
git clone <repo-url>
cd Fancy
```

### 2️⃣ Installer les dépendances

```bash
composer install
```

### 3️⃣ Configurer les variables d’environnement

Copier le fichier .env en .env.local
```
cp .env .env.local
```

Modifier le fichier `.env` :

```
DATABASE_URL="mysql://utilisateur:motdepasse@127.0.0.1:3306/fancy_db"
```

### 4️⃣ Créer la base de données

```bash
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```

### 5️⃣ Lancer le serveur

```bash
symfony server:start
```

## 📄 Licence

Projet réalisé dans un cadre pédagogique.
