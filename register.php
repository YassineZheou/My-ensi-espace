<?php
require 'config.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST["nom"];
    $email = $_POST["email"];
    $mot_de_passe = $_POST["mot_de_passe"];

    $sql = "INSERT INTO etudiants (nom, email, mot_de_passe) VALUES (?, ?, ?)";
    $r1 = $conn->prepare($sql);
    $r1->bind_param("sss", $nom, $email, $mot_de_passe);

    try {
        $r1->execute();
        $message = "✅ Inscription réussie ! <a href='login.html'>Se connecter</a>";
    } catch (mysqli_sql_exception $e) {
        if ($conn->errno === 1062) {
            $message = "⚠️ Cet email est déjà inscrit. <a href='login.html'>Se connecter ?</a>";
        } else {
            $message = "❌ Erreur inconnue : " . $conn->error;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Inscription ENSI</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="form-container">
    <img src="ensi logo.png" alt="Logo ENSI" class="logo">
    <h2>Créer un compte étudiant</h2>

    <?php if (!empty($message)): ?>
      <p style="color: green; font-weight: bold;"><?php echo $message; ?></p>
    <?php endif; ?>

    <form action="register.php" method="post">
      <input type="text" name="nom" placeholder="Nom complet" required>
      <input type="email" name="email" placeholder="Adresse email" required>
      <input type="password" name="mot_de_passe" placeholder="Mot de passe" required>
      <button type="submit">S'inscrire</button>
    </form>
    <p>Déjà un compte ? <a href="login.html">Connexion</a></p>
  </div>
</body>
</html>
