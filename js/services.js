const inputNomService = document.getElementById("ServiceInput");
const inputDescriptionService = document.getElementById("DescriptionInput");
const btnEnvois = document.getElementById("btnEnvois");

inputNomService.addEventListener("input", validateForm);
inputDescriptionService.addEventListener("input", validateForm);

btnEnvois.addEventListener("click", envoyerService);

// Appeler la fonction pour mettre à jour la table des passages dès l'ouverture de la page
updateServicesTable();

function validateForm() {
  const nomServiceOk = validateRequired(inputNomService);
  const descriptionOk = validateRequired(inputDescriptionService);

  if (nomServiceOk && descriptionOk) {
    btnEnvois.disabled = false;
  } else {
    btnEnvois.disabled = true;
  }
}

function envoyerService() {
  const nomService = inputNomService.value.trim();
  const descriptionService = inputDescriptionService.value.trim();

  const nouveauService = {
    "nom": nomService,
    "Description": descriptionService
  };

  fetch("http://127.0.0.1:8000/api/services", {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify(nouveauService)
  })
  .then(response => response.json())
  .then(result => {
    console.log(result);
    alert("Nouveau service ajouté avec succès!");
    // Réinitialiser le formulaire après l'envoi réussi
    document.getElementById("ServiceForm").reset();
    // Recharger la page
    location.reload();
  })
  .catch(error => {
    console.error('Erreur lors de l\'envoi du nouveau service:', error);
    alert("Erreur lors de l'envoi du nouveau service. Veuillez réessayer.");
  });
}


function updateServicesTable() {
    fetch("http://127.0.0.1:8000/api/services")
      .then(response => response.json())
      .then(services => {
        const tbody = document.getElementById('tableService').querySelector('tbody');
        tbody.innerHTML = ""; // Effacer le contenu actuel du tableau
        
        services.forEach(service => {
          const row = tbody.insertRow(); // Insérer une nouvelle ligne dans le tableau
          
          const cellNomService = row.insertCell(); // Créer la cellule pour le nom du service
          const cellDescriptionService = row.insertCell(); // Créer la cellule pour la description du service
          
          // Remplir les cellules avec les données du service
          cellNomService.textContent = service.nom;
          cellDescriptionService.textContent = service.Description;
          
          // Appliquer les styles si nécessaire
          cellNomService.style.color = "black";
          cellDescriptionService.style.color = "black";
        });
      })
      .catch(error => {
        console.error('Erreur lors de la récupération des services:', error);
        alert("Erreur lors de la récupération des services. Veuillez réessayer.");
      });
  }
  
  // Appelez simplement cette fonction au chargement de la page ou à tout autre moment où vous souhaitez mettre à jour le tableau des services
  updateServicesTable();
  

  // Récupérer la liste des services depuis l'API
fetch("http://127.0.0.1:8000/api/services")
.then(response => response.json())
.then(services => {
  // Sélectionner la liste déroulante
  const selectService = document.getElementById("selectService");

  // Ajouter chaque service comme une option dans la liste déroulante
  services.forEach(service => {
    const option = document.createElement("option");
    option.value = service.id; // Assurez-vous que votre service a une propriété id
    option.textContent = service.nom;
    selectService.appendChild(option);
  });
})
.catch(error => console.error('Erreur lors de la récupération des services:', error));



// Récupérer la liste des services depuis l'API et remplir la liste déroulante
fetch("http://127.0.0.1:8000/api/services")
  .then(response => response.json())
  .then(services => {
    const selectServiceToUpdate = document.getElementById("selectServiceToUpdate");

    services.forEach(service => {
      const option = document.createElement("option");
      option.value = service.id; // Assurez-vous que votre service a une propriété id
      option.textContent = service.nom;
      selectServiceToUpdate.appendChild(option);
    });
  })
  .catch(error => console.error('Erreur lors de la récupération des services:', error));

// Ajouter un gestionnaire d'événement pour le formulaire de modification
document.getElementById("updateServiceForm").addEventListener("submit", function(event) {
  event.preventDefault(); // Empêcher le rechargement de la page par défaut

  // Récupérer les valeurs du formulaire
  const selectedServiceId = document.getElementById("selectServiceToUpdate").value;
  const updatedServiceName = document.getElementById("updatedServiceName").value;
  const updatedServiceDescription = document.getElementById("updatedServiceDescription").value;

  // Construire l'URL pour mettre à jour le service
  const updateServiceURL = `http://127.0.0.1:8000/api/services/${selectedServiceId}`;

  // Données à envoyer dans la requête PUT
  const updatedServiceData = {
    nom: updatedServiceName,
    Description: updatedServiceDescription
  };

  // Effectuer la requête de mise à jour
  fetch(updateServiceURL, {
    method: "PUT",
    headers: {
      "Content-Type": "application/json"
    },
    body: JSON.stringify(updatedServiceData)
  })
  .then(response => response.text())
  .then(result => {
    console.log(result);
    alert("Service mis à jour avec succès!");
    location.reload(); // Recharger la page après la mise à jour du service
  })
  .catch(error => {
    console.error("Erreur lors de la mise à jour du service:", error);
    alert("Erreur lors de la mise à jour du service. Veuillez réessayer.");
  });
});
