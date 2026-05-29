# 🏸 Lyon 8 Badminton Club

> Site vitrine pour l'association Lyon 8 Badminton Club, visant à présenter le club, ses horaires, ses tarifs et ses informations de contact.

---

## 🛠️ Technologies & Stack

- **Frontend :** HTML5, CSS3, JavaScript vanilla
- **Backend :** PHP (formulaire de contact)
- **Polices :** Google Fonts (Bebas Neue, Inter)
- **Hébergement :** OVH (mutualisé)

---

## 📁 Structure du projet

```
lyon8badmintonclub/
├── index.html               # Page principale (one-page)
├── mentions-legales.html    # Page mentions légales
├── reglement-interieur.html # Page règlement intérieur
├── style.css                # Styles globaux
├── pages.css                # Styles des pages légales
├── script.js                # Interactions & formulaire
└── send.php                 # Traitement du formulaire de contact
```

---

## 🚀 Lancement rapide (local)

> ⚠️ Le formulaire de contact nécessite PHP et ne fonctionnera pas en ouvrant simplement `index.html` dans un navigateur. Pour tester l'intégralité du site en local, utilisez un serveur PHP local.

### Avec PHP intégré

```bash
# Cloner le projet
git clone https://github.com/leiaq24/lyon8badmintonclub.git
cd lyon8badmintonclub

# Lancer le serveur PHP local
php -S localhost:8000
```

Puis ouvrir [http://localhost:8000](http://localhost:8000) dans votre navigateur.

### Sans PHP (pages statiques uniquement)

Ouvrez simplement `index.html` dans votre navigateur. Le formulaire de contact ne sera pas fonctionnel mais le reste du site s'affichera correctement.

---

## ⚙️ Configuration du formulaire

Avant la mise en ligne, ouvrir `send.php` et modifier les lignes suivantes :

```php
$config = [
    'email_destinataire' => 'Lyon8badmintonclub@mail.fr', // adresse qui reçoit les messages
    'email_expediteur'   => 'noreply@votredomaine.fr',    // ⚠️ doit exister sur OVH
    'sujet_prefix'       => '[Lyon 8 Badminton Club]',
];
```

> L'adresse `email_expediteur` doit être une adresse email réelle créée sur votre hébergement OVH, sinon les emails risquent d'être rejetés ou d'atterrir en spam.

---

## 🌐 Mise en ligne sur OVH

1. Connectez-vous à votre hébergement via **FTP** (ex. avec [FileZilla](https://filezilla-project.org/))
2. Déposez tous les fichiers à la racine du répertoire `www/` (ou `public_html/`)
3. Vérifiez que `send.php` est bien configuré (voir section ci-dessus)
4. Testez le formulaire de contact directement en ligne

---

## 📄 Pages

| Page | Description |
|------|-------------|
| `/` | Accueil — hero, présentation du club, horaires, tarifs, contact |
| `/mentions-legales.html` | Mentions légales (loi française) |
| `/reglement-interieur.html` | Règlement intérieur de l'association |

---

## ✏️ Contenu à compléter

Avant la mise en ligne, pensez à mettre à jour :

- [ ] Adresse exacte du gymnase
- [ ] Numéro RNA de l'association
- [ ] Nom du/de la président(e) (mentions légales)
- [ ] Horaires et niveaux des créneaux réels
- [ ] Tarifs réels (Tarif 1, 2, 3)
- [ ] Photos du club (remplacer les images placeholder)
- [ ] Adresse email expéditrice dans `send.php`

---

## 👩‍💻 Auteure

Réalisé par **Leia Quilichini** — [leiaquilichini.fr](https://leiaquilichini.fr)