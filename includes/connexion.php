<?php
session_start();
require_once '../classes/database.php';
require_once '../classes/authentification.php';
require_once '../classes/user.php';

try {
    $authentification = new authentification;
    $userClass = new User;
    $errors = [];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = trim($_POST['email']);
        $password = $_POST['password'];

        $errors = $authentification->validateLogin($email, $password);

        if (empty($errors)) {
            $user = $authentification->getUserByEmail($email);

            if ($user) {
                // Stocker les informations utilisateur dans la session
                $_SESSION['username'] = $user['user_name'];
                $_SESSION['user_id'] = $user['user_id']; // Adaptez 'id' selon votre base de données

                // Redirection basée sur l'ID de l'utilisateur
                if ($user['role_id'] == 1) {
                    header('Location: ../includes/dashbrd.php'); // Corrigé
                } else if ($user['role_id'] == 2) {
                    header('Location: ../includes/user_page.php');
                } else {
                    header('Location: ../includes/unauthorized.php');
                }
                exit();
            } else {
                $errors[] = "Utilisateur non trouvé. Vérifiez votre email.";
            }
        }
    }
} catch (Exception $e) {
    die("Erreur : " . $e->getMessage());
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Page de Connexion</title>
  <link rel="stylesheet" href="../Styles/styleconnexion.css">
</head>

<body>
<header>
    <nav class="navbar">
      <div class="logo">
        <h1>CarRent</h1>
      </div>
      <ul class="nav-links">
        <li><a href="index.html">Accueil</a></li>
        <li><a href="inscription.php" class="active">Inscription</a></li>
        <li><a href="connexion.php">Connexion</a></li>
      </ul>
    </nav>
  </header>
  <!-- Section de connexion -->
  <section id="connexion">
    <div class="form-container">
      <h2 class="text-center">Connectez-vous à votre compte</h2>

      <?php if (!empty($errors)): ?>
                <div class="">
                    <?php foreach ($errors as $error): ?>
                        <p><?php echo htmlspecialchars($error); ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_SESSION['message'])): ?>
                <div class="">
                    <?php 
                    echo htmlspecialchars($_SESSION['message']);
                    unset($_SESSION['message']);
                    ?>
                </div>
            <?php endif; ?>

      <form action="#" method="POST" class="form-login">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" placeholder="Votre email" required>

        <label for="motdepasse">Mot de passe</label>
        <input type="password" id="motdepasse" name="password"  placeholder="Votre mot de passe" required>

        <button type="submit" class="btn-login">Se connecter</button>
        <p class="text-center mt-4">
          Pas encore de compte ? <a href="../includes/inscription.php" class="text-blue-500">Inscrivez-vous ici</a>
        </p>
      </form>
    </div>
  </section>

  <footer>
      <p>&copy; 2025 CarRent. Tous droits réservés.</p>
    </footer>
</body>
</html>
