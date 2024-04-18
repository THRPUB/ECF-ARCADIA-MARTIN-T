const inputNom = document.getElementById("NomInput");
const inputAnimal = document.getElementById("AnilmalInput");
const inputEtatAnimal = document.getElementById("EtatInput");
const inputNourritureProposee = document.getElementById("NourritureInput");
const inputGrammageNourriture = document.getElementById("GrammageInput");
const inputDatePassage = document.getElementById("DatePassageInput");
const inputDetailEtatAnimal = document.getElementById("DetailEtatInput");
const btnEnvois = document.getElementById("btnEnvois");
const visiteForm = document.getElementById("VisiteForm");
const tablePassages = document.getElementById("tablePassages");
const tableAvisBody = document.getElementById("tableAvisBody");
const inputNomVeterinaire = document.getElementById("NomVeterinaireInput");
const inputNomHabitat = document.getElementById("NomHabitatInput");
const inputAvis = document.getElementById("AvisInput");
const btnEnvoisAvis = document.getElementById("btnEnvoisAvis");
const avisForm = document.getElementById("AvisForm");

// Appeler validateForm une fois au début pour désactiver le bouton si nécessaire
validateForm();
validateAvisForm();

inputNom.addEventListener("input", validateForm);
inputAnimal.addEventListener("input", validateForm);
inputEtatAnimal.addEventListener("input", validateForm);
inputNourritureProposee.addEventListener("input", validateForm);
inputGrammageNourriture.addEventListener("input", validateForm);
inputDatePassage.addEventListener("input", validateForm);
inputDetailEtatAnimal.addEventListener("input", validateForm);
btnEnvois.addEventListener("click", envoyerVisite);
inputNomVeterinaire.addEventListener("input", validateAvisForm);
inputNomHabitat.addEventListener("input", validateAvisForm);
inputAvis.addEventListener("input", validateAvisForm);
btnEnvoisAvis.addEventListener("click", envoyerAvis);

updatePassagesTable();
updateAnimalTable()
updateVisiteTable()
updateHabitatTable()
updateAvisTable();

// Function permettant de valider tout le formulaire
function validateForm() {
  const nomOk = validateRequired(inputNom);
  const animalOk = validateRequired(inputAnimal);
  const etatAnimalOk = validateRequired(inputEtatAnimal);
  const nourritureOk = validateRequired(inputNourritureProposee);
  const grammageOk = validateRequired(inputGrammageNourriture);
  const dateOk = validateRequired(inputDatePassage);

  if (nomOk && animalOk && etatAnimalOk && nourritureOk && grammageOk && dateOk) {
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

// Function appelée lors du clic sur le bouton d'envoi de la visite vétérinaire
function envoyerVisite() {
  // Récupérer les valeurs du formulaire
  const nom = inputNom.value.trim();
  const animal = inputAnimal.value.trim();
  const etatAnimal = inputEtatAnimal.value.trim();
  const nourritureProposee = inputNourritureProposee.value.trim();
  const grammageNourriture = inputGrammageNourriture.value.trim();
  const datePassage = inputDatePassage.value;
  const detailEtatAnimal = inputDetailEtatAnimal.value.trim();

  // Construire l'objet de la visite vétérinaire
  const visiteVeterinaire = {
    "animal": animal,
    "etat_animal": etatAnimal,
    "nourriture_proposee": nourritureProposee,
    "grammage_nourriture": grammageNourriture,
    "date_passage": datePassage,
    "detail_etat_animal": detailEtatAnimal,
    "Nom_veterinaire": nom
  };

  // Effectuer la requête POST avec fetch
  fetch("http://127.0.0.1:8000/api/visite-veterinaire", {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify(visiteVeterinaire)
  })
  .then(response => response.text())
  .then(result => {
    console.log(result);
    alert("Visite vétérinaire enregistrée avec succès!");
    updateVisiteTable()
    // Réinitialiser le formulaire après l'envoi réussi
    visiteForm.reset();
  })
  .catch(error => {
    console.error('Erreur lors de l\'envoi de la visite vétérinaire:', error);
    alert("Erreur lors de l'envoi de la visite vétérinaire. Veuillez réessayer.");
  });
}

// Function permettant de valider tout le formulaire
function validateAvisForm() {
  const nomVeterinaireOk = validateRequired(inputNomVeterinaire);
  const nomHabitatOk = validateRequired(inputNomHabitat);
  const avisOk = validateRequired(inputAvis);

  if (nomVeterinaireOk && nomHabitatOk && avisOk) {
    btnEnvoisAvis.disabled = false;
  } else {
    btnEnvoisAvis.disabled = true;
  }
}

// Function appelée lors du clic sur le bouton d'envoi d'avis
function envoyerAvis() {
  // Récupérer les valeurs du formulaire
  const nomVeterinaire = inputNomVeterinaire.value.trim();
  const nomHabitat = inputNomHabitat.value.trim();
  const avis = inputAvis.value.trim();

  // Construire l'objet d'avis sur l'habitat
  const avisHabitat = {
    "nomveterinaire": nomVeterinaire,
    "nomhabitat": nomHabitat,
    "avis": avis
  };

  // Effectuer la requête POST avec fetch
  fetch("http://127.0.0.1:8000/api/avis-habitats", {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify(avisHabitat)
  })
  .then(response => response.text())
  .then(result => {
    console.log(result);
    alert("Avis sur l'habitat enregistré avec succès!");
    updateAvisTable(); // Mettre à jour la table des avis après l'envoi réussi
    // Réinitialiser le formulaire après l'envoi réussi
    avisForm.reset();
  })
  .catch(error => {
    console.error('Erreur lors de l\'envoi de l\'avis sur l\'habitat:', error);
    alert("Erreur lors de l'envoi de l'avis sur l'habitat. Veuillez réessayer.");
  });
}


// Fonction pour mettre à jour la table des passages d'employé
function updatePassagesTable() {
  // Récupérer la liste des passages depuis l'API
  fetch("http://127.0.0.1:8000/api/passage-employe")
    .then(response => response.json())
    .then(passages => {
      // Trier les passages du plus récent au plus vieux en utilisant la date de passage
      passages.sort((a, b) => new Date(b.dateDePassage) - new Date(a.dateDePassage));

      // Conserver uniquement les 10 derniers passages
      passages = passages.slice(0, 15);

      // Effacer le contenu actuel du corps du tableau
      const tbody = tablePassages.querySelector('tbody');
      tbody.innerHTML = "";

      passages.forEach(passage => {
        const row = tbody.insertRow(); // Insérer une nouvelle ligne dans le corps du tableau

        // Créer chaque cellule du tableau
        const cellAnimalId = row.insertCell();
        const cellAnimalNom = row.insertCell();
        const cellNourriture = row.insertCell();
        const cellGrammage = row.insertCell();
        const cellDate = row.insertCell();
        const cellHeure = row.insertCell();

        // Remplir les cellules avec les données
        cellAnimalId.textContent = passage.animal.animalId;
        cellAnimalNom.textContent = passage.animal.prenom;
        cellNourriture.textContent = passage.nourritureApportee;
        cellGrammage.textContent = passage.grammageDeLaNourriture;
        cellDate.textContent = passage.dateDePassage;
        cellHeure.textContent = passage.heureDePassage;

        // Appliquer les couleurs directement aux cellules
        cellAnimalId.style.color = "black";
        cellAnimalNom.style.color = "black";
        cellNourriture.style.color = "black";
        cellGrammage.style.color = "black";
        cellDate.style.color = "black";
        cellHeure.style.color = "black";
      });
    })
    .catch(error => {
      console.error('Erreur lors de la récupération des passages:', error);
      alert("Erreur lors de la récupération des passages. Veuillez réessayer.");
    });
}

// Appeler la fonction pour charger les passages d'employé au chargement de la page
document.addEventListener("DOMContentLoaded", function() {
  updatePassagesTable();
});


function updateVisiteTable() {
  // Récupérer la liste des visites vétérinaires depuis l'API
  fetch("http://127.0.0.1:8000/api/visite-veterinaire")
    .then(response => response.json())
    .then(visites => {
      // Trier les visites par date de passage (du plus récent au plus ancien)
      visites.sort((a, b) => new Date(b.datePassage) - new Date(a.datePassage));

      // Effacer le contenu actuel du corps du tableau
      const tbody = tableVisites.querySelector('tbody');
      tbody.innerHTML = "";

      // Remplir la table avec les données des visites vétérinaires
      visites.forEach(visite => {
        const row = tbody.insertRow(); // Insérer une nouvelle ligne dans le corps du tableau

        // Créer chaque cellule du tableau
        const cellAnimalId = row.insertCell(); // Cellule pour l'ID de l'animal
        const cellAnimal = row.insertCell();
        const cellEtatAnimal = row.insertCell();
        const cellNourritureProposee = row.insertCell();
        const cellGrammageNourriture = row.insertCell();
        const cellDatePassage = row.insertCell();
        const cellDetailEtatAnimal = row.insertCell();
        const cellVeterinaire = row.insertCell();

        // Remplir les cellules avec les données de la visite vétérinaire
        cellAnimalId.textContent = visite.animal.animalId; // Ajout de l'ID de l'animal
        cellAnimal.textContent = visite.animal.prenom;
        cellEtatAnimal.textContent = visite.etatAnimal;
        cellNourritureProposee.textContent = visite.nourritureProposee;
        cellGrammageNourriture.textContent = visite.grammageNourriture;
        
        // Formater la date au format "YYYY-MM-DD"
        const datePassage = new Date(visite.datePassage);
        const formattedDate = datePassage.toISOString().split('T')[0];
        cellDatePassage.textContent = formattedDate;
        
        cellDetailEtatAnimal.textContent = visite.detailEtatAnimal;
        cellVeterinaire.textContent = visite.nomVeterinaire;

        // Appliquer les couleurs directement aux cellules
        cellAnimalId.style.color = "black";
        cellAnimal.style.color = "black";
        cellEtatAnimal.style.color = "black";
        cellNourritureProposee.style.color = "black";
        cellGrammageNourriture.style.color = "black";
        cellDatePassage.style.color = "black";
        cellDetailEtatAnimal.style.color = "black";
        cellVeterinaire.style.color = "black";
      });
    })
    .catch(error => {
      console.error('Erreur lors de la récupération des visites vétérinaires:', error);
      alert("Erreur lors de la récupération des visites vétérinaires. Veuillez réessayer.");
    });
}

// Fonction pour mettre à jour la table des avis
function updateAvisTable() {
  fetch("http://127.0.0.1:8000/api/avis-habitats")
      .then(response => response.json())
      .then(avis => {
          tableAvisBody.innerHTML = ""; // Effacer le contenu actuel du corps du tableau

          avis.forEach(avisItem => {
              const row = tableAvisBody.insertRow(); // Insérer une nouvelle ligne dans le corps du tableau

              // Créer chaque cellule du tableau
              const cellId = row.insertCell();
              const cellNomVeterinaire = row.insertCell();
              const cellNomHabitat = row.insertCell();
              const cellAvis = row.insertCell();

              // Remplir les cellules avec les données
              cellId.textContent = avisItem.id;
              cellNomVeterinaire.textContent = avisItem.nomveterinaire;
              cellNomHabitat.textContent = avisItem.nomhabitat;
              cellAvis.textContent = avisItem.avis;

              // Appliquer les styles pour écrire en noir
              cellId.style.color = "black";
              cellNomVeterinaire.style.color = "black";
              cellNomHabitat.style.color = "black";
              cellAvis.style.color = "black";
          });
      })
      .catch(error => {
          console.error('Erreur lors de la récupération des avis:', error);
          alert("Erreur lors de la récupération des avis. Veuillez réessayer.");
      });
}

function updateAnimalTable() {
  // Récupérer la liste des animaux depuis l'API
  fetch("http://127.0.0.1:8000/api/animals")
    .then(response => response.json())
    .then(animals => {
      // Effacer le contenu actuel du corps du tableau des animaux
      const tbody = document.getElementById('tableAnimalBody');
      tbody.innerHTML = "";

      // Remplir le tableau avec les données des animaux
      animals.forEach(animal => {
        const row = tbody.insertRow(); // Insérer une nouvelle ligne dans le corps du tableau

        // Créer chaque cellule du tableau
        const cellAnimalId = row.insertCell(); // Cellule pour l'ID de l'animal
        const cellPrenomAnimal = row.insertCell();
        const cellRace = row.insertCell();
        const cellHabitat = row.insertCell();

        // Remplir les cellules avec les données de l'animal
        cellAnimalId.textContent = animal.animal_id; // Ajout de l'ID de l'animal
        cellPrenomAnimal.textContent = animal.prenom;
        cellRace.textContent = animal.race;
        cellHabitat.textContent = animal.habitat;

        // Appliquer les styles si nécessaire
        // Par exemple, pour changer la couleur du texte en noir :
        cellAnimalId.style.color = "black";
        cellPrenomAnimal.style.color = "black";
        cellRace.style.color = "black";
        cellHabitat.style.color = "black";
      });
    })
    .catch(error => {
      console.error('Erreur lors de la récupération des animaux:', error);
      alert("Erreur lors de la récupération des animaux. Veuillez réessayer.");
    });
}


function updateHabitatTable() {
  // Récupérer la liste des habitats depuis l'API
  fetch("http://127.0.0.1:8000/api/habitat")
    .then(response => response.json())
    .then(habitats => {
      // Effacer le contenu actuel du corps du tableau des habitats
      const tbody = document.getElementById('tablehabitatBody');
      tbody.innerHTML = "";

      // Remplir le tableau avec les données des habitats
      habitats.forEach(habitat => {
        const row = tbody.insertRow(); // Insérer une nouvelle ligne dans le corps du tableau

        // Créer chaque cellule du tableau
        const cellHabitatId = row.insertCell(); // Cellule pour l'ID de l'habitat
        const cellNomHabitat = row.insertCell(); // Cellule pour le nom de l'habitat

        // Remplir les cellules avec les données de l'habitat
        cellHabitatId.textContent = habitat.habitatId; // Ajout de l'ID de l'habitat
        cellNomHabitat.textContent = habitat.nom; // Ajout du nom de l'habitat

        // Appliquer les styles si nécessaire
        // Par exemple, pour changer la couleur du texte en noir :
        cellHabitatId.style.color = "black";
        cellNomHabitat.style.color = "black";
      });
    })
    .catch(error => {
      console.error('Erreur lors de la récupération des habitats:', error);
      alert("Erreur lors de la récupération des habitats. Veuillez réessayer.");
    });
}
