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
  