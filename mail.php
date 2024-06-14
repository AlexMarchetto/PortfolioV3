<?php
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les informations du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $message = $_POST['message'];

    // Créer l'e-mail
    $to = "alex.marchetto@etu.univ-grenoble-alpes.fr";
    $subject = "Nouveau message de $prenom $nom";
    $headers = "From: noreply@yourdomain.com";

    // Envoyer l'e-mail
    if(mail($to, $subject, $message, $headers)) {
        echo "Message envoyé avec succès";
    } else {
        echo "Erreur lors de l'envoi du message";
    }
}
?>
