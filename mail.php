<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $desc = $_POST['desc'];

    // Validation basique
    if (empty($prenom) || empty($nom) || empty($email) || empty($desc)) {
        echo "Tous les champs sont obligatoires.";
        exit;
    }

    // Sanitize inputs
    $prenom = filter_var($prenom, FILTER_SANITIZE_STRING);
    $nom = filter_var($nom, FILTER_SANITIZE_STRING);
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $desc = filter_var($desc, FILTER_SANITIZE_STRING);

    $mail = new PHPMailer(true);

    try {
        // Configuration du serveur SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.example.com';  // Remplacez par le serveur SMTP
        $mail->SMTPAuth = true;
        $mail->Username = 'your_email@example.com';  // Remplacez par votre email SMTP
        $mail->Password = 'your_password';  // Remplacez par votre mot de passe SMTP
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;  // Port TCP à utiliser pour la connexion SMTP

        // Destinataires
        $mail->setFrom($email, "$prenom $nom");
        $mail->addAddress('alex.marchetto@etu.univ-grenoble-alpes.fr');  // Ajouter le destinataire

        // Contenu de l'email
        $mail->isHTML(true);  // Set email format to HTML
        $mail->Subject = 'Nouveau message de contact';
        $mail->Body    = "Vous avez reçu un nouveau message de <b>$prenom $nom</b>.<br><br>Email: $email<br><br>Message: <br>$desc";
        $mail->AltBody = "Vous avez reçu un nouveau message de $prenom $nom.\n\nEmail: $email\n\nMessage:\n$desc";

        $mail->send();
        echo 'Le message a été envoyé';
    } catch (Exception $e) {
        echo "Le message n'a pas pu être envoyé. Erreur Mailer: {$mail->ErrorInfo}";
    }
} else {
    echo "Méthode de requête non autorisée.";
}
?>
