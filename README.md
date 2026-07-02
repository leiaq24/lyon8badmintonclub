# 🏸 Lyon 8 Badminton Club

> Site vitrine pour l'association Lyon 8 Badminton Club, visant à présenter le club, ses horaires, ses tarifs et ses informations de contact.

---

## 🛠️ Technologies & Stack

- **Frontend :** HTML5, CSS3, JavaScript
- **Backend :** PHP (formulaire de contact)
- **Polices :** Google Fonts (Bebas Neue, Inter)
- **Hébergement :** OVH Cloud

---

## 📁 Structure du projet

```
lyon8badmintonclub/
├── index.html               # Page principale
├── mentions-legales.html    # Page mentions légales
├── reglement-interieur.html # Page règlement intérieur
├── partenaires.html         # Page sponsors
├── style.css                # Styles globaux
├── pages.css                # Styles des pages légales
├── script.js                # Interactions & formulaire
├── send.php                 # Traitement du formulaire de contact
└── images/                 
    └── toutes les photos du sites, les logos, etc.
└── fichiers/
    └── fichiers utilisés + templates
```
---

## ⚙️ Configuration du formulaire
Avant la mise en ligne, ouvrir `send.php` et modifier les lignes suivantes :

```php
$config = [
    'email_destinataire' => 'lyon8badmintonclub@gmail.com', // adresse qui reçoit les messages
    'email_expediteur'   => 'contact@lyon8badmintonclub.fr',      // ⚠️ doit exister sur OVH
];
```

> L'adresse `email_expediteur` doit être une adresse email réelle créée sur votre hébergement OVH (rubrique **Emails** de l'espace client), sinon les emails risquent d'être rejetés ou d'atterrir en spam.

---

## 🌐 Mise en ligne sur OVH

### Option A — Déploiement Git (recommandé, méthode actuelle)
1. Dans l'espace client OVH → **Web Cloud → Hébergements → Multisite**, associez le dépôt GitHub au domaine
2. Cliquez sur **Déployer Git** pour synchroniser les derniers changements
3. Vérifiez que `send.php` est bien configuré (voir section ci-dessus)
4. Testez le formulaire de contact directement en ligne

### Option B — FTP (manuel)
1. Connectez-vous à votre hébergement via **FTP** (ex. avec [FileZilla](https://filezilla-project.org/))
2. Déposez tous les fichiers à la racine du répertoire `www/` (ou `public_html/`)
3. Vérifiez que `send.php` est bien configuré (voir section ci-dessus)
4. Testez le formulaire de contact directement en ligne

---

## 📄 Pages
| Page | Description |
|------|-------------|
| `/` | Accueil — hero, présentation du club, horaires, tarifs, contact |
| `/partenaires.html` | Devenir partenaire — formules de sponsoring |
| `/mentions-legales.html` | Mentions légales (loi française) |
| `/reglement-interieur.html` | Règlement intérieur de l'association |

---


## 👩‍💻 Auteure
Réalisé par **Leia Quilichini** — [leiaquilichini.fr](https://leiaquilichini.fr)