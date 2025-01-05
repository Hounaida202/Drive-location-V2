<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Liste des Véhicules</title>
  <link rel="stylesheet" href="styles.css">
</head>
<style>


body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
  background-color: #f4f4f9;
}

header {
  background-color: #333;
  color: white;
  padding: 10px 20px;
}

.navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.nav-links {
  list-style: none;
  display: flex;
  gap: 15px;
}

.nav-links li a {
  color: white;
  text-decoration: none;
  font-size: 16px;
}

main {
  padding: 20px;
}

.cars-section h2 {
  text-align: center;
  margin-bottom: 20px;
}

.cars-container {
  display: flex;
  flex-wrap: wrap;
  gap: 20px;
  justify-content: center;
}

.card {
  background-color: white;
  border: 1px solid #ddd;
  border-radius: 8px;
  padding: 20px;
  width: 300px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  text-align: center;
}

.card img {
  width: 100%;
  height: auto;
  border-radius: 8px;
  margin-bottom: 15px;
}

.rating-section {
  display: flex;
  gap: 10px;
  margin: 15px 0;
  justify-content: center;
}

.rating-input {
  width: 60%;
  padding: 8px;
  font-size: 14px;
  border: 1px solid #ccc;
  border-radius: 4px;
}

.rating-btn {
  background-color: #007bff;
  color: white;
  padding: 8px 12px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

.rating-btn:hover {
  background-color: #0056b3;
}

.rating-result {
  font-size: 16px;
  color: #555;
}

footer {
  text-align: center;
  background-color: #333;
  color: white;
  padding: 10px 0;
}

</style>
<body>
  <header>
    <nav class="navbar">
      <div class="logo">
        <h1>CarRent</h1>
      </div>
      <ul class="nav-links">
        <li><a href="user_page.php">Accueil</a></li>
        <li><a href="vehiculesReserves.php">Véhicules</a></li>
        <li><a href="#">Logout</a></li>
      </ul>
    </nav>
  </header>

  <main>
    <section class="cars-section">
      <h2>Nos Véhicules</h2>
      <div class="cars-container">
        <!-- Exemple de carte de véhicule -->
        <div class="card">
          <img src="suv1.jpg" alt="SUV 1">
          <h3>Nom du véhicule : SUV Premium</h3>
          <p>Modèle : 2023</p>
          <p>Disponibilité : Disponible</p>
          <p>Prix : 100 € / jour</p>
          <div class="rating-section">
            <input type="number" class="rating-input" placeholder="Votre note (1-10)" min="1" max="10">
            <button class="rating-btn" onclick="submitRating(this)">Évaluer</button>
          </div>
          <p class="rating-result">Note actuelle : Non évalué</p>
        </div>

        <!-- Ajouter plus de cartes similaires ici -->
        <div class="card">
          <img src="suv2.jpg" alt="SUV 2">
          <h3>Nom du véhicule : Sedan Luxe</h3>
          <p>Modèle : 2022</p>
          <p>Disponibilité : Indisponible</p>
          <p>Prix : 80 € / jour</p>
          <div class="rating-section">
            <input type="number" class="rating-input" placeholder="Votre note (1-10)" min="1" max="10">
            <button class="rating-btn" onclick="submitRating(this)">Évaluer</button>
          </div>
          <p class="rating-result">Note actuelle : Non évalué</p>
        </div>
      </div>
    </section>
  </main>

  <footer>
    <p>&copy; 2025 CarRent. Tous droits réservés.</p>
  </footer>

  <script>
    function submitRating(button) {
      const card = button.closest('.card'); // Trouver la carte parent
      const ratingInput = card.querySelector('.rating-input'); // Champ de saisie de la note
      const ratingResult = card.querySelector('.rating-result'); // Élement affichant la note

      const rating = parseFloat(ratingInput.value);

      if (rating >= 1 && rating <= 10) {
        ratingResult.textContent = `Note actuelle : ${rating}/10`;
      } else {
        alert("Veuillez entrer une note entre 1 et 10.");
      }
    }
  </script>
</body>
</html>
