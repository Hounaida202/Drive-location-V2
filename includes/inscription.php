<?php
session_start();
require_once '../classes/database.php';
require_once '../classes/authentification.php';
require_once '../classes/user.php';
$error=[];
try {
  $Authentification = new Authentification();
  
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $username = trim($_POST['user_name']);
      $email = trim($_POST['email']);
      $password = $_POST['password'];
      $confirm_password = $_POST['confirm_password'];

      $errors = $Authentification->validateRegistration($username, $email, $password, $confirm_password);

      if (empty($errors)) {
          $user = $Authentification->register($username, $email, $password);
          if ($user instanceof user) {
              $_SESSION['user_id'] = $user->getId();
              $_SESSION['role_id'] = $user->getIsAdmin();
              $_SESSION['message'] = "Inscription réussie!";
              header('Location: ../includes/connexion.php');
              exit();
          } else {
              $errors[] = "Erreur lors de l'inscription";
          }
      }
  }
} catch (Exception $e) {
  $errors[] = "Error: " . $e->getMessage();
}





?>


<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inscription - CarRent</title>
  <link rel="stylesheet" href="styles.css">
</head>
<style>
    /* Barre de navigation */
    .navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem 2rem;
    background-color: #333;
    color: white;
  }
  
  .navbar .logo h1 {
    margin: 0;
    font-size: 1.5rem;
  }
  
  .nav-links {
    list-style: none;
    display: flex;
    gap: 1rem;
    margin: 0;
  }
  
  .nav-links a {
    text-decoration: none;
    color: white;
    transition: color 0.3s;
  }
  
  .nav-links a:hover {
    color: #f4a261;
  }
  /* Section formulaire */
.form-section {
  max-width: 500px;
  margin: 3rem auto;
  padding: 2rem;
  background-color: #f4f4f4;
  border-radius: 8px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  text-align: center;
}

.form-section h2 {
  font-size: 2rem;
  margin-bottom: 1rem;
  color: #333;
}

.form-section p {
  font-size: 1rem;
  margin-bottom: 2rem;
  color: #666;
}

.form {
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

.form-group {
  text-align: left;
}

.form-group label {
  display: block;
  margin-bottom: 0.5rem;
  font-weight: bold;
  color: #333;
}

.form-group input {
  width: 100%;
  padding: 0.8rem;
  font-size: 1rem;
  border: 1px solid #ccc;
  border-radius: 5px;
  outline: none;
  transition: border-color 0.3s;
}

.form-group input:focus {
  border-color: #f4a261;
}

.btn {
  width: 100%;
  padding: 0.8rem;
  font-size: 1rem;
  color: white;
  background-color: #333;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s;
}

.btn:hover {
  background-color: #f4a261;
}

/* Lien actif dans la navbar */
.nav-links .active {
  color: #f4a261;
  font-weight: bold;
}
 /* Pied de page */
 footer {
    text-align: center;
    padding: 1rem;
    background-color: #333;
    color: white;
  }
</style>

<body>
  <header>
    <nav class="navbar">
      <div class="logo">
        <h1>CarRent</h1>
      </div>
      <ul class="nav-links">
        <li><a href="index.html">Accueil</a></li>
        <li><a href="inscription.html" class="active">Inscription</a></li>
        <li><a href="../includes/connexion.php">Connexion</a></li>
      </ul>
    </nav>
  </header>

  <main>
    <section class="form-section">
      <h2>Créer un compte</h2>
      <p>Rejoignez-nous et commencez à louer votre voiture idéale dès aujourd'hui !</p>
      
      <?php if (!empty($errors)): ?>
                <div>
                    <?php foreach ($errors as $error): ?>
                        <p><?php echo htmlspecialchars($error); ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
      
      
      
      <form class="form" method="POST">
        <div class="form-group">
          <label for="nom">Nom complet</label>
          <input type="text" id="nom" name="user_name" value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>" placeholder="Votre nom complet" required>
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" placeholder="Votre email" required>
        </div>
        <div class="form-group">
          <label for="password">Mot de passe</label>
          <input type="password" id="password" name="password" placeholder="Votre mot de passe" required>
        </div>
        <div class="form-group">
          <label for="confirm-password">Confirmer le mot de passe</label>
          <input type="password" id="confirm-password" name="confirm_password" placeholder="Confirmez le mot de passe" required>
        </div>
        <button type="submit" class="btn">S'inscrire</button>
      </form>
    </section>
  </main>

  <footer>
    <p>&copy; 2025 CarRent. Tous droits réservés.</p>
  </footer>
</body>
</html>

