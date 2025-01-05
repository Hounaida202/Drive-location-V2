<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Location de Voitures</title>
</head>
<style>
  /* Styles généraux */
body {
    margin: 0;
    font-family: Arial, sans-serif;
    line-height: 1.6;
  }
  
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
  
  /* Section hero */
  .hero {
    text-align: center;
    padding: 5rem 2rem;
    height: 400px;
    background-image: url(https://th.bing.com/th/id/R.b0300d1c8c7fbd241ddad56f0a8feb7c?rik=mhXv3L5Qls89AQ&riu=http%3a%2f%2fwww.aktuweb.com%2fwp-content%2fuploads%2f2021%2f03%2flocation-voiture3.jpg&ehk=uTdHLSSIkL0iHuCSZlw%2bD8yWmHnGuRWHlAwnC4OYVpA%3d&risl=&pid=ImgRaw&r=0);
  }
  
  .hero h2 {
    font-size: 2.5rem;
    margin-bottom: 1rem;
    color: #333;
  }
  
  .hero p {
    font-size: 1.2rem;
    margin-bottom: 2rem;
    color: #666;
  }
  
  .hero .btn {
    display: inline-block;
    padding: 0.8rem 1.5rem;
    font-size: 1rem;
    color: white;
    background-color: #333;
    border: none;
    border-radius: 5px;
    text-decoration: none;
    cursor: pointer;
    transition: background-color 0.3s;
  }
  
  .hero .btn:hover {
    background-color: #f4a261;
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
        <li><a href="#">Accueil</a></li>
        <li><a href="inscription.php">Inscription</a></li>
        <li><a href="#">Connexion</a></li>
      </ul>
    </nav>
  </header>

  <main>
    <section class="hero">
      <h2>Location de voitures simple et rapide</h2>
      <p>Trouvez la voiture parfaite pour vos besoins, où que vous soyez.</p>
      <a href="#" class="btn">Commencez maintenant</a>
    </section>
  </main>

  <footer>
    <p>&copy; 2025 CarRent. Tous droits réservés.</p>
  </footer>
</body>
</html>


