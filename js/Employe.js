const inputAnimal = document.getElementById("AnilmalInput");
const inputNourritureApportee = document.getElementById("NourritureInput");
const inputGrammageNourriture = document.getElementById("GrammageInput");
const inputDatePassage = document.getElementById("DatePassageInput");
const inputHeurePassage = document.getElementById("HeurePassageInput");
const btnEnvois = document.getElementById("btnEnvois");
const passageForm = document.getElementById("VisiteForm");
const tablePassages = document.getElementById("tablePassages");

// Appeler validateForm une fois au début pour désactiver le bouton si nécessaire
validateForm();

inputAnimal.addEventListener("input", validateForm);
inputNourritureApportee.addEventListener("input", validateForm);
inputGrammageNourriture.addEventListener("input", validateForm);
inputDatePassage.addEventListener("input", validateForm);
inputHeurePassage.addEventListener("input", validateForm);

btnEnvois.addEventListener("click", envoyerPassage);

// Appeler la fonction pour mettre à jour la table des passages dès l'ouverture de la page
updatePassagesTable();
updateAnimalTable()
updateHabitatTable()

// Function permettant de valider tout le formulaire
function validateForm() {
  const animalOk = validateRequired(inputAnimal);
  const nourritureOk = validateRequired(inputNourritureApportee);
  const grammageOk = validateRequired(inputGrammageNourriture);
  const dateOk = validateRequired(inputDatePassage);
  const heureOk = validateRequired(inputHeurePassage);

  if (animalOk && nourritureOk && grammageOk && dateOk && heureOk) {
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

// Function appelée lors du clic sur le bouton d'envoi du passage employé
function envoyerPassage() {
  // Récupérer les valeurs du formulaire
  const animal = inputAnimal.value.trim();
  const nourritureApportee = inputNourritureApportee.value.trim();
  const grammageNourriture = inputGrammageNourriture.value.trim();
  const datePassage = inputDatePassage.value;
  const heurePassage = inputHeurePassage.value;

  // Construire l'objet de passage employé
  const passageEmploye = {
    "animal": animal,
    "Nourriture_apportee": nourritureApportee,
    "Grammage_de_la_nourriture": grammageNourriture,
    "Date_de_passage": datePassage,
    "Heure_de_passage": heurePassage
  };

  // Effectuer la requête POST avec fetch
  fetch("http://127.0.0.1:8000/api/passage-employe", {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify(passageEmploye)
  })
  .then(response => response.json())
  .then(result => {
    console.log(result);
    alert("Passage employé enregistré avec succès!");
    // Réinitialiser le formulaire après l'envoi réussi
    passageForm.reset();
    // Mettre à jour la liste des passages
    updatePassagesTable();
  })
  .catch(error => {
    console.error('Erreur lors de l\'envoi du passage employé:', error);
    alert("Erreur lors de l'envoi du passage employé. Veuillez réessayer.");
  });
}

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


function updateAvisTable() {
  // Récupérer la liste des avis depuis l'API
  fetch("http://127.0.0.1:8000/api/avis")
    .then(response => response.json())
    .then(avisList => {
      // Effacer le contenu actuel du corps du tableau des avis
      const tbody = document.getElementById('tableAvisBody');
      tbody.innerHTML = "";

      // Remplir le tableau avec les données des avis
      avisList.forEach(avis => {
        const row = tbody.insertRow(); // Insérer une nouvelle ligne dans le corps du tableau

        // Créer chaque cellule du tableau
        const cellAvisId = row.insertCell(); // Cellule pour l'ID de l'avis
        const cellPseudo = row.insertCell(); // Cellule pour le pseudo
        const cellAvis = row.insertCell(); // Cellule pour l'avis
        const cellValidation = row.insertCell(); // Cellule pour la validation

        // Remplir les cellules avec les données de l'avis
        cellAvisId.textContent = avis.avisId; // Ajout de l'ID de l'avis
        cellPseudo.textContent = avis.Pseudo; // Ajout du pseudo
        cellAvis.textContent = avis.Avis; // Ajout de l'avis
        cellValidation.textContent = avis.validation ? "Validé" : "Non validé"; // Ajout de la validation

        // Appliquer les styles si nécessaire
        // Par exemple, pour changer la couleur du texte en noir :
        cellAvisId.style.color = "black";
        cellPseudo.style.color = "black";
        cellAvis.style.color = "black";
        cellValidation.style.color = "black";
      });
    })
    .catch(error => {
      console.error('Erreur lors de la récupération des avis:', error);
      alert("Erreur lors de la récupération des avis. Veuillez réessayer.");
    });
}

// Appel de la fonction pour mettre à jour le tableau des avis lors du chargement de la page
updateAvisTable();


// Ajouter un gestionnaire d'événement pour le formulaire de modification des avis
document.getElementById("updateAvisForm").addEventListener("submit", function(event) {
  event.preventDefault(); // Empêcher le rechargement de la page par défaut

  // Récupérer l'ID de l'avis à mettre à jour
  const avisIdToUpdate = document.getElementById("avisId").value.trim();

  // Vérifier si l'ID de l'avis est valide
  if (!avisIdToUpdate) {
    alert("Veuillez saisir l'ID de l'avis à modifier.");
    return;
  }

  // Récupérer les valeurs du formulaire
  const updatedPseudo = document.getElementById("updatedPseudo").value.trim();
  const updatedAvis = document.getElementById("updatedAvis").value.trim();
  const updateValidation = document.getElementById("updateValidation").checked;

  // Construire l'URL pour mettre à jour l'avis
  const updateAvisURL = `http://127.0.0.1:8000/api/avis/${avisIdToUpdate}`;

  // Données à envoyer dans la requête PUT
  const updatedAvisData = {
    Pseudo: updatedPseudo,
    Avis: updatedAvis,
    validation: updateValidation
  };

  // Effectuer la requête de mise à jour
  fetch(updateAvisURL, {
    method: "PUT",
    headers: {
      "Content-Type": "application/json"
    },
    body: JSON.stringify(updatedAvisData)
  })
  .then(response => response.text())
  .then(result => {
    console.log(result);
    alert("Avis mis à jour avec succès!");
    // Recharger la page après la mise à jour de l'avis
    location.reload();
  })
  .catch(error => {
    console.error("Erreur lors de la mise à jour de l'avis:", error);
    alert("Erreur lors de la mise à jour de l'avis. Veuillez réessayer.");
  });
});

// Ajouter un gestionnaire d'événement pour le bouton de suppression d'avis
document.getElementById("deleteAvisButton").addEventListener("click", function() {
  // Récupérer l'ID de l'avis à supprimer
  const avisIdToDelete = prompt("Veuillez saisir l'ID de l'avis à supprimer:");

  // Vérifier si l'ID de l'avis est valide
  if (!avisIdToDelete) {
    alert("L'ID de l'avis est requis pour la suppression.");
    return;
  }

  // Confirmer la suppression
  if (confirm("Êtes-vous sûr de vouloir supprimer cet avis?")) {
    // Construire l'URL pour supprimer l'avis
    const deleteAvisURL = `http://127.0.0.1:8000/api/avis/${avisIdToDelete}`;

    // Effectuer la requête de suppression
    fetch(deleteAvisURL, {
      method: "DELETE"
    })
    .then(response => response.text())
    .then(result => {
      console.log(result);
      alert("Avis supprimé avec succès!");
      // Recharger la page après la suppression de l'avis
      location.reload();
    })
    .catch(error => {
      console.error("Erreur lors de la suppression de l'avis:", error);
      alert("Erreur lors de la suppression de l'avis. Veuillez réessayer.");
    });
  }
});

// Fonction pour supprimer un message
function deleteMessage(messageId) {
  const requestOptions = {
    method: "DELETE",
    redirect: "follow"
  };

  fetch(`http://127.0.0.1:8000/api/pagecontacts/${messageId}`, requestOptions)
    .then(response => {
      if (!response.ok) {
        throw new Error('Erreur de réponse du serveur');
      }
      return response.text();
    })
    .then(result => {
      console.log(result);
      alert("Message supprimé avec succès!");
      // Mettre à jour la table des messages après la suppression
      updateMessagesTable();
    })
    .catch(error => {
      console.error('Erreur lors de la suppression du message:', error);
      alert("Erreur lors de la suppression du message. Veuillez réessayer.");
    });
}

// Fonction pour créer un bouton "Marquer comme Répondu" pour chaque message
function createReplyButton(messageId) {
  const button = document.createElement("button");
  button.textContent = "Marquer (j'ai répondu)";
  button.classList.add("btn", "btn-primary");
  // Ajouter un gestionnaire d'événements pour supprimer le message lorsque le bouton est cliqué
  button.addEventListener("click", () => {
    if (confirm("Êtes-vous sûr de vouloir supprimer ce message?")) {
      deleteMessage(messageId);
    }
  });
  return button;
}

// Fonction pour mettre à jour la table des messages
function updateMessagesTable() {
  fetch("http://127.0.0.1:8000/api/pagecontacts")
    .then(response => {
      if (!response.ok) {
        throw new Error('Erreur de réponse du serveur');
      }
      return response.json();
    })
    .then(data => {
      const tbody = document.getElementById('messagesBody');
      tbody.innerHTML = ""; // Effacer le contenu actuel du tableau

      data.forEach(contact => {
        const row = tbody.insertRow(); // Insérer une nouvelle ligne dans le tableau

        const cellNom = row.insertCell(); // Créer la cellule pour le nom du contact
        const cellEmail = row.insertCell(); // Créer la cellule pour l'email du contact
        const cellMessage = row.insertCell(); // Créer la cellule pour le message du contact
        const cellAction = row.insertCell(); // Créer la cellule pour le bouton d'action

        // Remplir les cellules avec les données du contact
        cellNom.textContent = contact.Nom;
        cellNom.classList.add("black-text");
        cellEmail.textContent = contact.Email;
        cellEmail.classList.add("black-text");
        cellMessage.textContent = contact.Message;
        cellMessage.classList.add("black-text");

        // Ajouter le bouton "Marquer comme Répondu" à la cellule d'action
        const replyButton = createReplyButton(contact.id);
        cellAction.appendChild(replyButton);
      });
    })
    .catch(error => {
      console.error('Erreur lors de la récupération des messages:', error);
      alert("Erreur lors de la récupération des messages. Veuillez réessayer.");
    });
}

// Appelez simplement cette fonction au chargement de la page ou à tout autre moment où vous souhaitez mettre à jour le tableau des messages
updateMessagesTable();
