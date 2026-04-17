#  Cahier des charges – Vite Gourmand

---

##  1. Contexte du projet

L’entreprise **Vite & Gourmand**, spécialisée dans la restauration événementielle depuis 25 ans, souhaite développer une application web afin d’augmenter sa visibilité et faciliter la gestion de ses menus et commandes.

Le projet est confié à l’entreprise FastDev, dans laquelle nous intervenons en tant que développeur web.

---

##  2. Objectifs

- Présenter les menus du restaurant en ligne
- Permettre aux clients de passer commande
- Gérer les commandes via un espace interne
- Améliorer la visibilité de l’entreprise
- Centraliser les informations (menus, avis, commandes)



##  3. Utilisateurs

- Visiteurs (non connectés)
- Utilisateurs (clients)
- Employés
- Administrateur

---

##  4. Description générale

L’application web doit permettre :
- Une navigation simple et intuitive
- Une consultation des menus sans connexion
- Une gestion complète des commandes
- Une séparation des rôles (utilisateur, employé, admin)

---

##  5. Fonctionnalités

###  5.1 Front-end (utilisateur)

- Page d’accueil (présentation + avis)
- Consultation des menus
- Création de compte
- Connexion / mot de passe 
- Consultation détaillée d’un menu
- Passage de commande


---

###  5.2 Espace utilisateur

- Voir ses commandes
- Modifier ses informations et son profil
- Modifier / annuler une commande (si non livreé)
- Suivre l’état des commandes
- Laisser un avis après livraison

---

###  5.3 Espace employé

- Gérer les horaires
- Gérer les commandes (statuts)
- Filtrer les commandes
- Valider ou refuser les avis

---

### 🔹 5.4 Espace administrateur

- Créer des comptes employés
- Désactiver un compte
- Visualiser statistiques (graphique commandes)
- Calcul du chiffre d’affaires

---

### 🔹 5.5 Commande

- Formulaire avec informations client
- Calcul automatique du prix
- Gestion livraison (distance + coût)


---

### 🔹 5.6 Contact

- Formulaire de contact
- Envoi d’email à l’entreprise

---

##  6. Données

### Base relationnelle :
- Utilisateurs (users)
- Menus (menus)
- Commandes (orders)
- Avis (reviews)

### Base NoSQL :
- Statistiques (commandes, graphiques)

---

## 🛠️ 7. Contraintes techniques

- PHP (architecture MVC)
- HTML / CSS / JavaScript
- Base de données relationnelle (MySQL)
- Base NoSQL (MongoDB)
- Utilisation de Composer

---

## 🔒 8. Sécurité

- Authentification sécurisée
- Mot de passe sécurisé (minimum 10 caractères)
- Gestion des rôles
- Respect RGPD
- Protection des données utilisateurs

---

## 🎨 9. Contraintes UX/UI

- Interface simple et intuitive
- Responsive (mobile + desktop)
- Accessibilité (RGAA)

---

## 🚀 10. Déploiement

- Application accessible en ligne
- Hébergement (Heroku, Vercel, Fly.io…)


---

## 📦 11. Livrables

- Code source (GitHub)
- Application en ligne
- README.md
- Manuel utilisateur
- Cahier des charges
- Documentation technique
- Maquettes (desktop + mobile)
- Diagrammes (MCD, UML)

---

## 📌 12. Conclusion

Ce projet vise à développer une application web complète permettant de gérer les menus et les commandes d’un restaurant, tout en garantissant une expérience utilisateur optimale et une gestion interne efficace.