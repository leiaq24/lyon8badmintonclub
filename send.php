<?php
/* =============================================
   CONFIGURATION — à modifier
   ============================================= */
$config = [
    'email_destinataire' => 'lyon8badmintonclub@gmail.com', // adresse qui reçoit les messages
    'email_expediteur'   => 'leia.quilichini@outlook.fr',      // adresse d'envoi (doit être sur ton domaine OVH)
    'sujet_prefix'       => '[Lyon 8 Badminton Club]',    // préfixe dans l'objet du mail
];

/* =============================================
   SÉCURITÉ — headers & vérifications
   ============================================= */

// Autoriser uniquement les requêtes POST depuis ton domaine
header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Méthode non autorisée.']);
    exit;
}

// Protection CSRF basique : vérifier l'origine
$origine = $_SERVER['HTTP_REFERER'] ?? '';
$domaine = $_SERVER['HTTP_HOST'] ?? '';
if (!empty($origine) && !str_contains($origine, $domaine)) {
    http_response_code(403);
    echo json_encode(['success' => false, 'message' => 'Origine non autorisée.']);
    exit;
}

// Anti-spam honeypot : champ invisible rempli = bot
if (!empty($_POST['website'])) {
    // On fait semblant que ça marche pour ne pas alerter le bot
    echo json_encode(['success' => true]);
    exit;
}

/* =============================================
   RÉCUPÉRATION & VALIDATION DES DONNÉES
   ============================================= */
$nom     = trim($_POST['nom'] ?? '');
$email   = trim($_POST['email'] ?? '');
$message = trim($_POST['message'] ?? '');
$errors  = [];

// Validation nom
if (empty($nom)) {
    $errors[] = 'Le nom est requis.';
} elseif (strlen($nom) > 100) {
    $errors[] = 'Le nom est trop long (100 caractères max).';
}

// Validation email
if (empty($email)) {
    $errors[] = "L'email est requis.";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "L'adresse email n'est pas valide.";
} elseif (strlen($email) > 200) {
    $errors[] = "L'email est trop long.";
}

// Validation message
if (empty($message)) {
    $errors[] = 'Le message est requis.';
} elseif (strlen($message) < 10) {
    $errors[] = 'Le message est trop court (10 caractères min).';
} elseif (strlen($message) > 5000) {
    $errors[] = 'Le message est trop long (5000 caractères max).';
}

if (!empty($errors)) {
    http_response_code(422);
    echo json_encode(['success' => false, 'message' => implode(' ', $errors)]);
    exit;
}

/* =============================================
   NETTOYAGE DES DONNÉES
   ============================================= */
$nom     = htmlspecialchars($nom,     ENT_QUOTES, 'UTF-8');
$email   = htmlspecialchars($email,   ENT_QUOTES, 'UTF-8');
$message = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');

/* =============================================
   ENVOI DE L'EMAIL AU CLUB
   ============================================= */
$sujet = $config['sujet_prefix'] . ' Message de ' . $nom;

$corps = "Vous avez reçu un nouveau message depuis le site web.\n\n";
$corps .= "-------------------------------------------\n";
$corps .= "Nom    : " . $nom . "\n";
$corps .= "Email  : " . $email . "\n";
$corps .= "-------------------------------------------\n\n";
$corps .= "Message :\n" . $message . "\n\n";
$corps .= "-------------------------------------------\n";
$corps .= "Envoyé le : " . date('d/m/Y à H:i') . "\n";

$headers  = "From: " . $config['email_expediteur'] . "\r\n";
$headers .= "Reply-To: " . $email . "\r\n";
$headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

$envoye = mail($config['email_destinataire'], $sujet, $corps, $headers);

if (!$envoye) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => "Une erreur s'est produite lors de l'envoi. Veuillez réessayer ou nous contacter par téléphone."]);
    exit;
}

/* =============================================
   EMAIL DE CONFIRMATION À L'UTILISATEUR
   ============================================= */
$sujet_confirmation = $config['sujet_prefix'] . ' Nous avons bien reçu votre message';

$corps_confirmation  = "Bonjour " . $nom . ",\n\n";
$corps_confirmation .= "Nous avons bien reçu votre message et nous vous répondrons dans les plus brefs délais.\n\n";
$corps_confirmation .= "-------------------------------------------\n";
$corps_confirmation .= "Votre message :\n" . $message . "\n";
$corps_confirmation .= "-------------------------------------------\n\n";
$corps_confirmation .= "Cordialement,\n";
$corps_confirmation .= "Lyon 8 Badminton Club\n";
$corps_confirmation .= $config['email_destinataire'] . "\n";

$headers_confirmation  = "From: " . $config['email_expediteur'] . "\r\n";
$headers_confirmation .= "Reply-To: " . $config['email_destinataire'] . "\r\n";
$headers_confirmation .= "X-Mailer: PHP/" . phpversion() . "\r\n";
$headers_confirmation .= "Content-Type: text/plain; charset=UTF-8\r\n";

// On envoie la confirmation mais on ne bloque pas si ça échoue
mail($email, $sujet_confirmation, $corps_confirmation, $headers_confirmation);

/* =============================================
   SUCCÈS
   ============================================= */
echo json_encode(['success' => true, 'message' => 'Votre message a bien été envoyé. Nous vous répondrons rapidement !']);