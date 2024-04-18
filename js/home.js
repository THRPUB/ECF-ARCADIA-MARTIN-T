const inputPseudo = document.getElementById("PseudoInput");
const inputAvis = document.getElementById("AvisInput");
const btnEnvois = document.getElementById("btnEnvois");
const avisContainer = document.getElementById("avisContainer");
const avisForm = document.getElementById("ServiceForm");

// Appeler validateForm une fois au début pour désactiver le bouton si nécessaire
validateForm();

inputPseudo.addEventListener("input", validateForm);
inputAvis.addEventListener("input", validateForm);

btnEnvois.addEventListener("click", envoyerAvis);

// Function permettant de valider tout le formulaire
function validateForm() {
  const pseudoOk = validateRequired(inputPseudo);
  const avisOk = validateRequired(inputAvis);

  if (pseudoOk && avisOk) {
    btnEnvois.disabled = false;
  } else {
    btnEnvois.disabled = true;
  }
}

// Function de validation de champ requis
function validateRequired(input) {
  if (input.value.trim() !== '') {
    input.classList.add("is-valid");
    input.classList.remove("is-invalid");
    return true;
  } else {
    input.classList.remove("is-valid");
    input.classList.add("is-invalid");
    return false;
  }
}

// Function appelée lors du clic sur le bouton d'envoi de l'avis
function envoyerAvis() {
  // Récupérer les valeurs du formulaire
  const pseudo = inputPseudo.value.trim();
  const avisText = inputAvis.value.trim();

  // Construire l'objet d'avis
  const avis = {
    "Pseudo": pseudo,
    "Avis": avisText
  };

  // Effectuer la requête POST avec fetch
  fetch("http://127.0.0.1:8000/api/avis", {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify(avis)
  })
  .then(response => response.json())
  .then(result => {
    console.log(result);
    alert("Avis enregistré avec succès!");
    // Actualiser la page après l'envoi réussi
    location.reload();
  })
  .catch(error => {
    console.error('Erreur lors de l\'envoi de l\'avis:', error);
    alert("Erreur lors de l'envoi de l'avis. Veuillez réessayer.");
  });
}

// Fonction pour charger les avis depuis la base de données et les afficher dans un tableau
function chargerAvisDepuisBDD() {
  fetch("http://127.0.0.1:8000/api/avis")
    .then(response => response.json())
    .then(avis => {
      // Filtrer les avis avec validation=true
      const avisValides = avis.filter(avisItem => avisItem.validation === true);

      // Créer un tableau pour afficher les avis
      const table = document.createElement('table');
      table.classList.add('table');

      // Pour chaque avis valide récupéré
      avisValides.forEach(avisItem => {
        // Créer une nouvelle ligne dans le tableau
        const row = table.insertRow();

        // Créer une cellule pour le pseudo
        const pseudoCell = row.insertCell();
        pseudoCell.textContent = avisItem.Pseudo;
        pseudoCell.classList.add('black-text'); // Ajouter la classe pour le texte noir

        // Créer une cellule pour l'avis
        const avisCell = row.insertCell();
        avisCell.textContent = avisItem.Avis;
        avisCell.classList.add('black-text'); // Ajouter la classe pour le texte noir
      });

      // Ajouter le tableau au conteneur d'affichage des avis
      document.getElementById('avisContainer').appendChild(table);
    })
    .catch(error => {
      console.error('Erreur lors du chargement des avis depuis la base de données:', error);
      alert("Erreur lors du chargement des avis depuis la base de données. Veuillez réessayer.");
    });
}

// Appeler la fonction pour charger les avis depuis la base de données
chargerAvisDepuisBDD();
