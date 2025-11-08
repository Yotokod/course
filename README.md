# 📚 Plateforme E-Learning Laravel

<p align="center">
  <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
</p>

<p align="center">
  <strong>Plateforme de cours en ligne complète avec Laravel 12, design glassmorphism, et gestion multi-rôles</strong>
</p>

---

## 🎯 À Propos du Projet

Plateforme e-learning moderne permettant aux formateurs de créer et gérer des formations en ligne, et aux étudiants de suivre des cours structurés avec quiz interactifs, suivi de progression, et système de support intégré.

### ✨ Fonctionnalités Principales

**🎓 Pour les Étudiants:**
- 📖 Catalogue de cours avec prévisualisation
- 🔐 Système de codes d'accès avec expiration
- 📹 Visionnage de leçons avec vidéos intégrées
- ✅ Quiz MCQ interactifs (70% requis pour réussir)
- 📊 Tableau de bord de progression personnalisé
- 🎫 Système de tickets de support
- 📈 Suivi des cours actifs et expirés

**👨‍💼 Pour les Administrateurs:**
- 📊 Dashboard avec statistiques en temps réel
- 📚 Gestion complète des modules (CRUD)
- 📑 Gestion des chapitres avec ordonnancement
- 📝 Gestion des leçons avec éditeur riche (TinyMCE ready)
- ❓ Création de quiz avec options MCQ dynamiques
- 👥 Gestion des utilisateurs et des rôles
- 🎫 Gestion des tickets de support
- 💰 Visualisation des achats et revenus

**🎨 Design Moderne:**
- ✨ Glassmorphism (effets de verre flou)
- 🔲 Neomorphism (ombres douces)
- 📱 Responsive design (mobile-friendly)
- 🎨 Interface utilisateur intuitive
- 🎭 Animations et transitions fluides

---

## 📋 Prérequis

Avant de commencer, assurez-vous d'avoir installé:

- **PHP** >= 8.2
- **Composer** >= 2.0
- **Node.js** >= 18.x et **NPM** >= 9.x
- **MySQL** >= 8.0 ou **SQLite** (recommandé pour développement)
- **Git**

### Vérifier les versions installées:

```bash
php --version
composer --version
node --version
npm --version
mysql --version
```

---

## 🚀 Installation

### 1. Cloner le Dépôt

```bash
git clone https://github.com/Yotokod/course.git
cd course
```

### 2. Installer les Dépendances PHP

```bash
composer install
```

### 3. Installer les Dépendances JavaScript

```bash
npm install
```

### 4. Configuration de l'Environnement

Copier le fichier d'exemple et configurer les variables d'environnement:

```bash
cp .env.example .env
```

**Option A: Avec MySQL (Recommandé pour Production)**

Éditer le fichier `.env`:

```env
APP_NAME="E-Learning Platform"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=elearning_db
DB_USERNAME=root
DB_PASSWORD=votre_mot_de_passe
```

Créer la base de données:

```bash
mysql -u root -p
CREATE DATABASE elearning_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
EXIT;
```

**Option B: Avec SQLite (Recommandé pour Développement)**

Éditer le fichier `.env`:

```env
APP_NAME="E-Learning Platform"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=sqlite
```

Créer le fichier de base de données:

```bash
touch database/database.sqlite
```

### 5. Générer la Clé d'Application

```bash
php artisan key:generate
```

### 6. Créer le Lien de Stockage

```bash
php artisan storage:link
```

### 7. Migrer la Base de Données

```bash
php artisan migrate
```

### 8. Peupler la Base avec des Données de Test

```bash
php artisan db:seed
```

Ceci créera des comptes de test:
- **Admin**: admin@example.com / password
- **Formateur**: formateur@example.com / password
- **Client**: client@example.com / password

### 9. Compiler les Assets Frontend

**Pour le développement (avec hot reload):**

```bash
npm run dev
```

**Pour la production:**

```bash
npm run build
```

### 10. Démarrer le Serveur

Dans un nouveau terminal:

```bash
php artisan serve
```

L'application sera accessible à: **http://localhost:8000**

---

## 🎮 Utilisation

### Accéder à l'Application

1. **Page d'accueil**: http://localhost:8000
2. **Connexion**: http://localhost:8000/login
3. **Inscription**: http://localhost:8000/register

### Comptes de Test

Utilisez ces comptes pour tester les différents rôles:

| Rôle | Email | Mot de passe | Accès |
|------|-------|--------------|-------|
| Admin | admin@example.com | password | Dashboard Admin complet |
| Formateur | formateur@example.com | password | Dashboard Admin (sans gestion utilisateurs) |
| Client | client@example.com | password | Dashboard Étudiant |

### Navigation

**Espace Admin** (http://localhost:8000/admin/dashboard):
- Dashboard avec statistiques
- Modules → Créer/Modifier/Supprimer
- Chapitres → Organiser par module
- Leçons → Ajouter contenu et vidéos
- Quiz → Créer des MCQ interactifs
- Utilisateurs → Gérer les rôles (admin seulement)
- Tickets → Répondre aux demandes de support

**Espace Étudiant** (http://localhost:8000/dashboard):
- Dashboard personnalisé avec progression
- Cours → Explorer le catalogue
- Mes Cours → Cours accessibles
- Leçons → Visionner et compléter
- Quiz → Tester ses connaissances
- Support → Créer des tickets

---

## 🗂️ Structure du Projet

```
course/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/         # Contrôleurs admin (Module, Chapter, Lesson, Quiz, User, Ticket, Purchase)
│   │   │   ├── Student/       # Contrôleurs étudiant (Course, Lesson, Quiz, Progress)
│   │   │   ├── TicketController.php
│   │   │   └── PageController.php
│   │   └── Middleware/
│   │       └── CheckRole.php  # Middleware pour vérifier les rôles
│   ├── Models/
│   │   ├── User.php
│   │   ├── Module.php
│   │   ├── Chapter.php
│   │   ├── Lesson.php
│   │   ├── Quiz.php
│   │   ├── QuizOption.php
│   │   ├── AccessCode.php
│   │   ├── Purchase.php
│   │   ├── Ticket.php
│   │   └── UserProgress.php
│   └── ...
├── database/
│   ├── migrations/            # Migrations pour toutes les tables
│   └── seeders/
│       └── DatabaseSeeder.php # Données de test
├── resources/
│   ├── views/
│   │   ├── admin/            # Vues admin (dashboard, modules, chapters, lessons, quizzes, users, tickets)
│   │   ├── student/          # Vues étudiant (courses, lessons, progress)
│   │   ├── tickets/          # Vues tickets (create, index, show)
│   │   ├── pages/            # Pages publiques (about, contact, faq)
│   │   ├── layouts/          # Layouts principaux
│   │   └── landing.blade.php # Page d'accueil
│   ├── css/
│   └── js/
├── routes/
│   └── web.php               # Toutes les routes
├── public/
│   ├── css/
│   │   └── styles.css        # CSS custom (glassmorphism, neomorphism)
│   └── ...
└── ...
```

---

## 🛠️ Technologies Utilisées

### Backend
- **Laravel 12** - Framework PHP
- **Laravel Breeze** - Authentification
- **Eloquent ORM** - Gestion base de données
- **MySQL/SQLite** - Base de données

### Frontend
- **Blade Templates** - Moteur de templates
- **Tailwind CSS** (CDN) - Framework CSS
- **Alpine.js** (CDN) - JavaScript réactif
- **Font Awesome** (CDN) - Icônes
- **Sortable.js** (CDN) - Drag & drop
- **Swiper.js** (CDN) - Carrousels

### Design
- **Glassmorphism** - Effets de verre flou
- **Neomorphism** - Ombres douces 3D
- **Responsive Design** - Mobile-friendly

---

## 📊 Schéma de la Base de Données

```
users
├── id
├── name
├── email
├── role (admin, formateur, client)
└── ...

modules                     chapters                   lessons
├── id                      ├── id                     ├── id
├── name                    ├── module_id (FK)         ├── chapter_id (FK)
├── description             ├── name                   ├── name
├── price                   ├── order                  ├── content
├── created_by (FK)         └── ...                    ├── video_url
└── ...                                                └── ...

quizzes                     quiz_options               user_progress
├── id                      ├── id                     ├── id
├── lesson_id (FK)          ├── quiz_id (FK)           ├── user_id (FK)
├── question                ├── option_text            ├── lesson_id (FK)
├── type                    ├── is_correct             ├── completed
└── points                  └── ...                    └── score

access_codes                purchases                  tickets
├── id                      ├── id                     ├── id
├── user_id (FK)            ├── user_id (FK)           ├── user_id (FK)
├── module_id (FK)          ├── module_id (FK)         ├── subject
├── code                    ├── amount                 ├── description
├── expires_at              ├── payment_status         ├── status
└── used_at                 └── ...                    └── ...
```

---

## 🔐 Sécurité

- ✅ **CSRF Protection** sur tous les formulaires
- ✅ **Validation des inputs** côté serveur
- ✅ **Hashing des mots de passe** avec Bcrypt
- ✅ **Middleware d'authentification** Laravel Breeze
- ✅ **Contrôle d'accès basé sur les rôles** (RBAC)
- ✅ **Protection contre les injections SQL** via Eloquent
- ✅ **Codes d'accès sécurisés** avec expiration

### Bonnes Pratiques

- Ne jamais commiter le fichier `.env`
- Changer les mots de passe par défaut en production
- Configurer HTTPS pour la production
- Activer la vérification d'email (optionnel)
- Limiter les tentatives de connexion (Rate limiting)

---

## 🧪 Tests

### Exécuter les Tests

```bash
# Tous les tests
php artisan test

# Tests spécifiques
php artisan test --filter UserTest

# Avec couverture de code
php artisan test --coverage
```

### Tests Disponibles

- ✅ Tests d'authentification (Breeze)
- ✅ Tests de profil utilisateur
- ✅ Tests de routes protégées

---

## 🌐 Déploiement

### Production avec MySQL

1. **Configurer `.env` pour production:**

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://votre-domaine.com

DB_CONNECTION=mysql
DB_HOST=votre-serveur-mysql
DB_PORT=3306
DB_DATABASE=nom_base_production
DB_USERNAME=utilisateur_production
DB_PASSWORD=mot_de_passe_securise
```

2. **Optimiser l'application:**

```bash
composer install --optimize-autoloader --no-dev
php artisan config:cache
php artisan route:cache
php artisan view:cache
npm run build
```

3. **Migrer la base de données:**

```bash
php artisan migrate --force
php artisan db:seed --force
```

4. **Configurer le serveur web (Apache/Nginx)**

Pointer le document root vers `/public`

### Hébergement Recommandé

- **Laravel Forge** - Gestion serveur automatisée
- **DigitalOcean** - VPS avec Laravel preset
- **AWS Elastic Beanstalk** - Cloud scalable
- **Heroku** - Platform-as-a-Service

---

## 📝 Améliorations Futures

### Fonctionnalités à Implémenter

- [ ] **Paiement en ligne** - Intégration Stripe/KKiaPay
- [ ] **Notifications email** - Configuration Laravel Mail
- [ ] **Certificats de complétion** - Génération PDF
- [ ] **Upload de fichiers** - Attachements tickets
- [ ] **Vidéos externes** - Intégration YouTube/Vimeo
- [ ] **Analytics avancés** - Graphiques de progression
- [ ] **API REST** - Pour applications mobiles
- [ ] **Notifications push** - Nouveaux cours/messages
- [ ] **Système de notation** - Reviews des cours
- [ ] **Chat en direct** - Support instantané

### Optimisations

- [ ] Cache Redis pour performances
- [ ] Queue jobs pour emails
- [ ] CDN pour assets statiques
- [ ] Compression images
- [ ] Lazy loading

---

## 🤝 Contribution

Les contributions sont les bienvenues! Pour contribuer:

1. Fork le projet
2. Créer une branche (`git checkout -b feature/AmazingFeature`)
3. Commit les changements (`git commit -m 'Add some AmazingFeature'`)
4. Push vers la branche (`git push origin feature/AmazingFeature`)
5. Ouvrir une Pull Request

---

## 🐛 Dépannage

### Erreur: "No application encryption key has been specified"

```bash
php artisan key:generate
```

### Erreur: "SQLSTATE[HY000] [1045] Access denied"

Vérifier les identifiants MySQL dans `.env`

### Erreur: "npm ERR! code ENOENT"

```bash
rm -rf node_modules package-lock.json
npm install
```

### Erreur: "Class 'App\Models\Module' not found"

```bash
composer dump-autoload
```

### Styles CSS ne s'appliquent pas

```bash
npm run build
php artisan view:clear
```

---

## 📧 Support

Pour toute question ou problème:

- **Email**: yotokod@example.com
- **Issues GitHub**: [Créer une issue](https://github.com/Yotokod/course/issues)
- **Documentation Laravel**: [laravel.com/docs](https://laravel.com/docs)

---

## 📄 Licence

Ce projet est sous licence MIT. Voir le fichier [LICENSE](LICENSE) pour plus de détails.

---

## 🙏 Remerciements

- **Laravel Team** - Framework exceptionnel
- **Tailwind CSS** - Styling moderne
- **Font Awesome** - Icônes de qualité
- **Alpine.js** - JavaScript réactif simple
- **GitHub Copilot** - Assistance au développement

---

<p align="center">
  Développé avec ❤️ pour l'éducation en ligne
</p>

<p align="center">
  <strong>© 2025 E-Learning Platform. Tous droits réservés.</strong>
</p>
