<?php
session_start();
include 'config.php';

// Vérifier que l'utilisateur est bien connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

// Récupérer les infos de l'utilisateur connecté
$requete = $conn->prepare("SELECT email FROM etudiants WHERE id = ?");
$requete->bind_param("i", $_SESSION['user_id']);
$requete->execute();
$requete->bind_result($email_utilisateur);
$requete->fetch();
$requete->close();
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tableau de bord ENSI</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h1>Espace Étudiant ENSI</h1>
</header>

<main>
    <section>
        <h2>Bienvenue 👋</h2>
        <p>Vous êtes connecté avec l'adresse : <strong><?= htmlspecialchars($email_utilisateur); ?></strong></p>
        <a href="logout.php" class="logout-btn">🔓 Se déconnecter</a>
    </section>
</main>

<footer>
    <h2>À propos de l’ENSI</h2>
    <p>
        Depuis 1984, l’ENSI forme des ingénieurs informaticiens d’excellence. Notre mission : 
        allier théorie, pratique, innovation et éthique pour former des leaders du numérique. 
    </p>
    <p>
        Grâce à ses filières variées (IA, Data, Finance, IoT, Génie Logiciel...), l’ENSI reste à la pointe de l’évolution technologique.
    </p>
    <p>
        L’école s’appuie sur un corps enseignant engagé, des infrastructures modernes et une vie étudiante riche pour offrir le meilleur à ses élèves.
    </p>
</footer>

</body>
</html>
