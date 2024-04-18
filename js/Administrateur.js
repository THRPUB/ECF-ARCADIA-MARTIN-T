const tablePassages = document.getElementById("tablePassages");
const tableVisites = document.getElementById("tableVisites");
const tableAnimalBody = document.getElementById("tableAnimalBody");
const tablehabitatBody = document.getElementById("tablehabitatBody");
const tableAvisBody = document.getElementById("tableAvisBody");

updatePassagesTable();
updateAnimalTable();
updateVisiteTable();
updateHabitatTable();
updateAvisTable();
updateAnimalMongoTable();

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


function updatePassagesTable() {
    // Récupérer la liste des passages depuis l'API
    fetch("http://127.0.0.1:8000/api/passage-employe")
        .then(response => response.json())
        .then(passages => {
            // Trier les passages du plus récent au plus vieux en utilisant la date de passage
            passages.sort((a, b) => new Date(b.dateDePassage) - new Date(a.dateDePassage));

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
          const cellActions = row.insertCell(); // Cellule pour les actions (bouton de mise à jour)
  
          // Remplir les cellules avec les données de l'animal
          cellAnimalId.innerHTML = `<strong>${animal.animal_id}</strong>`;
          cellAnimalId.style.color = "black"; // Ajout de l'ID de l'animal en gras
          cellPrenomAnimal.innerHTML = `<input type="text" value="${animal.prenom}" data-animal-id="${animal.animal_id}" data-field="prenom" class="edit-input">`;
          cellRace.innerHTML = `<input type="text" value="${animal.race}" data-animal-id="${animal.animal_id}" data-field="race" class="edit-input">`;
          cellHabitat.innerHTML = `<input type="text" value="${animal.habitat}" data-animal-id="${animal.animal_id}" data-field="habitat" class="edit-input">`;
          cellActions.innerHTML = `<button onclick="updateAnimal(${animal.animal_id})">Modifier</button>`; // Modifier le texte du bouton à "Modifier"
        });
      })
      .catch(error => {
        console.error('Erreur lors de la récupération des animaux:', error);
        alert("Erreur lors de la récupération des animaux. Veuillez réessayer.");
      });
}

function updateAnimal(animalId) {
    const prenomInput = document.querySelector(`input[data-animal-id="${animalId}"][data-field="prenom"]`);
    const raceInput = document.querySelector(`input[data-animal-id="${animalId}"][data-field="race"]`);
    const habitatInput = document.querySelector(`input[data-animal-id="${animalId}"][data-field="habitat"]`);
  
    const updatedAnimal = {
      prenom: prenomInput.value,
      race: raceInput.value,
      habitat: habitatInput.value
    };
  
    const requestOptions = {
      method: "PUT",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(updatedAnimal)
    };
  
    fetch(`http://127.0.0.1:8000/api/animals/${animalId}`, requestOptions)
      .then(response => response.json())
      .then(result => {
        console.log("Animal mis à jour avec succès:", result);
        // Mettre à jour le tableau après la modification
        updateAnimalTable();
      })
      .catch(error => console.error("Erreur lors de la mise à jour de l'animal:", error));
}

// Appel initial pour remplir le tableau au chargement de la page
updateAnimalTable();


function updateHabitatTable() {
    // Récupérer la liste des habitats depuis l'API
    fetch("http://127.0.0.1:8000/api/habitat")
        .then(response => response.json())
        .then(habitats => {
            // Effacer le contenu actuel du corps du tableau des habitats
            tablehabitatBody.innerHTML = "";

            // Remplir le tableau avec les données des habitats
            habitats.forEach(habitat => {
                const row = tablehabitatBody.insertRow(); // Insérer une nouvelle ligne dans le corps du tableau

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


document.getElementById("animalForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent the form from submitting normally
  
    // Gather form data
    const formData = new FormData(this);
    const json = {};
    formData.forEach((value, key) => {
        json[key] = value;
    });
  
    // Create request options
    const myHeaders = new Headers();
    myHeaders.append("Content-Type", "application/json");
  
    const raw = JSON.stringify(json);
  
    const requestOptions = {
        method: "POST",
        headers: myHeaders,
        body: raw,
        redirect: "follow"
    };
  
    // Send the fetch request
    fetch("http://127.0.0.1:8000/api/animals", requestOptions)
    .then(response => {
        if (response.ok) {
            document.getElementById('deleteConfirmationMessage').innerText = "";
            // Recharge la page après un court délai (par exemple, 1 seconde)
            setTimeout(function() {
                window.location.reload();
            }, 1000); // 1000 millisecondes = 1 seconde
        } else {
            document.getElementById('deleteConfirmationMessage').innerText = "Erreur lors de l'ajout'.";
        }
    })
    .catch(error => {
        console.error("Erreur lors de l'ajout:", error);
        document.getElementById('deleteConfirmationMessage').innerText = "Erreur lors de l'ajout.";
    });
});



document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
    const animalIdInput = document.getElementById('animalId');
    const animalId = animalIdInput.value;

    const requestOptions = {
        method: "DELETE",
        headers: {
            "Content-Type": "application/json"
        },
        redirect: "follow"
    };

    fetch(`http://127.0.0.1:8000/api/animals/${animalId}`, requestOptions)
        .then(response => {
            if (response.ok) {
                document.getElementById('deleteConfirmationMessage').innerText = "L'animal a été supprimé avec succès.";
                // Recharge la page après un court délai (par exemple, 1 seconde)
                setTimeout(function() {
                    window.location.reload();
                }, 1000); // 1000 millisecondes = 1 seconde
            } else {
                document.getElementById('deleteConfirmationMessage').innerText = "Erreur lors de la suppression de l'animal.";
            }
        })
        .catch(error => {
            console.error("Erreur lors de la suppression de l'animal:", error);
            document.getElementById('deleteConfirmationMessage').innerText = "Erreur lors de la suppression de l'animal.";
        });
});



document.getElementById('habitatForm').addEventListener('submit', function(event) {
    event.preventDefault();
    const myHeaders = new Headers();
    myHeaders.append("Content-Type", "application/json");
  
    const formData = new FormData(event.target);
    const jsonData = {};
    formData.forEach((value, key) => {jsonData[key] = value});
  
    const requestOptions = {
      method: "POST",
      headers: myHeaders,
      body: JSON.stringify(jsonData),
      redirect: "follow"
    };
  
    fetch("http://127.0.0.1:8000/api/habitat", requestOptions)
    .then(response => {
        if (response.ok) {
            document.getElementById('deleteConfirmationMessage').innerText = "";
            // Recharge la page après un court délai (par exemple, 1 seconde)
            setTimeout(function() {
                window.location.reload();
            }, 1000); // 1000 millisecondes = 1 seconde
        } else {
            document.getElementById('deleteConfirmationMessage').innerText = "Erreur lors de l'ajout'.";
        }
    })
    .catch(error => {
        console.error("Erreur lors de l'ajout:", error);
        document.getElementById('deleteConfirmationMessage').innerText = "Erreur lors de l'ajout.";
    });
});


document.getElementById('confirmDeleteHabitatBtn').addEventListener('click', function() {
    const habitatIdInput = document.getElementById('habitatId');
    const habitatId = habitatIdInput.value;

    const requestOptions = {
        method: "DELETE",
        headers: {
            "Content-Type": "application/json"
        },
        redirect: "follow"
    };

    fetch(`http://127.0.0.1:8000/api/habitat/${habitatId}`, requestOptions)
        .then(response => {
            if (response.ok) {
                document.getElementById('deleteHabitatConfirmationMessage').innerText = "L'habitat a été supprimé avec succès.";
                // Recharge la page après un court délai (par exemple, 1 seconde)
                setTimeout(function() {
                    window.location.reload();
                }, 1000); // 1000 millisecondes = 1 seconde
            } else {
                document.getElementById('deleteHabitatConfirmationMessage').innerText = "Erreur lors de la suppression de l'habitat.";
            }
        })
        .catch(error => {
            console.error("Erreur lors de la suppression de l'habitat:", error);
            document.getElementById('deleteHabitatConfirmationMessage').innerText = "Erreur lors de la suppression de l'habitat.";
        });
});

function updateHorairesTable() {
    fetch("http://127.0.0.1:8000/api/horraires")
      .then(response => response.json())
      .then(horraires => {
        const tableBody = document.querySelector('#horairesTable tbody');
        tableBody.innerHTML = "";

        horraires.forEach(horaire => {
          const row = document.createElement('tr');

          const cellJour = document.createElement('td');
          const cellHeureOuverture = document.createElement('td');
          const cellHeureFermeture = document.createElement('td');
          const cellActions = document.createElement('td');

          cellJour.textContent = horaire.jour;
          cellHeureOuverture.innerHTML = `<input type="text" value="${horaire.heureOuverture}" data-horaire-id="${horaire.id}" data-field="heureOuverture" class="edit-input">`;
          cellHeureFermeture.innerHTML = `<input type="text" value="${horaire.heureFermeture}" data-horaire-id="${horaire.id}" data-field="heureFermeture" class="edit-input">`;
          cellActions.innerHTML = `<button onclick="updateHoraire(${horaire.id})">Modifier</button>`;

          row.appendChild(cellJour);
          row.appendChild(cellHeureOuverture);
          row.appendChild(cellHeureFermeture);
          row.appendChild(cellActions);

          tableBody.appendChild(row);
        });
      })
      .catch(error => {
        console.error('Erreur lors de la récupération des horaires:', error);
        alert("Erreur lors de la récupération des horaires. Veuillez réessayer.");
      });
}

function updateHoraire(horaireId) {
    const heureOuvertureInput = document.querySelector(`input[data-horaire-id="${horaireId}"][data-field="heureOuverture"]`);
    const heureFermetureInput = document.querySelector(`input[data-horaire-id="${horaireId}"][data-field="heureFermeture"]`);

    const updatedHoraire = {
      heureOuverture: heureOuvertureInput.value,
      heureFermeture: heureFermetureInput.value
    };

    const requestOptions = {
      method: "PUT",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(updatedHoraire)
    };

    fetch(`http://127.0.0.1:8000/api/horraires/${horaireId}`, requestOptions)
      .then(response => response.json())
      .then(result => {
        console.log("Horaire mis à jour avec succès:", result);
        updateHorairesTable();
      })
      .catch(error => console.error("Erreur lors de la mise à jour de l'horaire:", error));
}

updateHorairesTable();

// Fonction pour mettre à jour la table des animaux
function updateAnimalMongoTable() {
    fetch("http://localhost:4000/animals")
        .then(response => response.json())
        .then(animals => {
            const tableBody = document.getElementById('animalMongoBody');
            tableBody.innerHTML = ""; // Effacer le contenu actuel du corps du tableau

            animals.forEach(animal => {
                const row = tableBody.insertRow(); // Insérer une nouvelle ligne dans le corps du tableau

                // Créer chaque cellule du tableau
                const cellId = row.insertCell();
                const cellNom = row.insertCell();
                const cellRace = row.insertCell();
                const cellConsultations = row.insertCell();

                // Remplir les cellules avec les données
                cellId.textContent = animal.animal_id;
                cellNom.textContent = animal.nom;
                cellRace.textContent = animal.race;
                cellConsultations.textContent = animal.consultation_count;

                // Appliquer les styles pour écrire en noir
                cellId.style.color = "black";
                cellNom.style.color = "black";
                cellRace.style.color = "black";
                cellConsultations.style.color = "black";
            });
        })
        .catch(error => {
            console.error('Erreur lors de la récupération des animaux:', error);
            alert("Erreur lors de la récupération des animaux. Veuillez réessayer.");
        });
}

// Appel de la fonction pour mettre à jour la table des animaux au chargement de la page

