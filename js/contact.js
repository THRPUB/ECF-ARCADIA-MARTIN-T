document.addEventListener("DOMContentLoaded", function () {
    // Ajoutez ici votre logique JavaScript pour gérer le formulaire de contact
    document.getElementById("contactForm").addEventListener("submit", function (event) {
        event.preventDefault();
        // Ajoutez ici le code pour gérer l'envoi du formulaire (par exemple, via AJAX)
        alert("Formulaire soumis avec succès!");
    });
});

const requestOptions = {
    method: "GET",
    redirect: "follow"
  };
  
  fetch("http://127.0.0.1:8000/api/horraires", requestOptions)
    .then(response => response.json())
    .then(result => {
      const tableBody = document.querySelector('#horairesTable tbody');
      result.forEach(horaire => {
        const row = document.createElement('tr');
        row.innerHTML = `
          <td>${horaire.jour}</td>
          <td>${horaire.heureOuverture}</td>
          <td>${horaire.heureFermeture}</td>
        `;
        // Appliquer les couleurs directement aux cellules
        row.querySelectorAll('td').forEach(cell => {
          cell.style.color = "black";
        });
        tableBody.appendChild(row);
      });
    })
    .catch(error => console.error(error));
  
    const nameInput = document.getElementById("name");
const emailInput = document.getElementById("email");
const messageInput = document.getElementById("message");
const sendButton = document.querySelector("#contactForm button");

// Appeler validateForm une fois au début pour désactiver le bouton si nécessaire
validateForm();

nameInput.addEventListener("input", validateForm);
emailInput.addEventListener("input", validateForm);
messageInput.addEventListener("input", validateForm);

sendButton.addEventListener("click", sendMessage);

// Function permettant de valider tout le formulaire
function validateForm() {
  const nameOk = validateRequired(nameInput);
  const emailOk = validateRequired(emailInput);
  const messageOk = validateRequired(messageInput);

  if (nameOk && emailOk && messageOk) {
    sendButton.disabled = false;
  } else {
    sendButton.disabled = true;
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

// Function appelée lors du clic sur le bouton d'envoi du message
function sendMessage() {
  // Récupérer les valeurs du formulaire
  const name = nameInput.value.trim();
  const email = emailInput.value.trim();
  const message = messageInput.value.trim();

  // Construire l'objet de message
  const messageData = {
    "Nom": name,
    "Email": email,
    "Message": message
  };

  // Effectuer la requête POST avec fetch
  fetch("http://127.0.0.1:8000/api/pagecontacts", {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify(messageData)
  })
  .then(response => response.json())
  .then(result => {
    console.log(result);
    alert("Message envoyé avec succès!");
    // Réinitialiser le formulaire après l'envoi réussi
    document.getElementById("contactForm").reset();
  })
  .catch(error => {
    console.error('Erreur lors de l\'envoi du message:', error);
    alert("Erreur lors de l'envoi du message. Veuillez réessayer.");
  });
}
