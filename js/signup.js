// Implémenter le JS de ma page

const inputMail = document.getElementById("EmailInput");
const inputPassword = document.getElementById("PasswordInput");
const inputValidationPassword = document.getElementById("ValidatePasswordInput");
const roleSelect = document.getElementById("RoleSelect"); // Nouveau champ pour le rôle
const btnValidation = document.getElementById("btn-validation-inscription");
const formInscription = document.getElementById("formulaireInscription");

// Appeler validateForm une fois au début pour désactiver le bouton si nécessaire
validateForm();

inputMail.addEventListener("input", validateForm);
inputPassword.addEventListener("input", validateForm);
inputValidationPassword.addEventListener("input", validateForm);
roleSelect.addEventListener("change", validateForm); // Ajouter cet écouteur d'événements pour le champ de rôle

btnValidation.addEventListener("click", InscrireUtilisateur);

// Function permettant de valider tout le formulaire
function validateForm() {
  const mailOk = validateMail(inputMail);
  const passwordOk = validatePassword(inputPassword);
  const passwordConfirmOk = validateConfirmationPassword(inputPassword, inputValidationPassword);
  const roleOk = validateRequired(roleSelect); // Ajouter la validation pour le champ de rôle

  if (mailOk && passwordOk && passwordConfirmOk && roleOk) {
    btnValidation.disabled = false;
  } else {
    btnValidation.disabled = true;
  }
}

// Function de validation d'email
function validateMail(input) {
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  const mailUser = input.value.trim(); // Trim pour supprimer les espaces blancs au début et à la fin

  if (mailUser.match(emailRegex)) {
    input.classList.add("is-valid");
    input.classList.remove("is-invalid");
    return true;
  } else {
    input.classList.remove("is-valid");
    input.classList.add("is-invalid");
    return false;
  }
}

// Function de validation de champ requis (adaptée pour le champ de rôle)
function validateRequired(input) {
  if (input.value !== '' && input.value !== '0') { // Assurez-vous que la valeur sélectionnée n'est pas vide ou la première option (0)
    input.classList.add("is-valid");
    input.classList.remove("is-invalid");
    return true;
  } else {
    input.classList.remove("is-valid");
    input.classList.add("is-invalid");
    return false;
  }
}

// Function de validation de mot de passe
function validatePassword(input) {
  const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_])[A-Za-z\d\W_]{8,}$/;
  const passwordUser = input.value;

  if (passwordUser.match(passwordRegex)) {
    input.classList.add("is-valid");
    input.classList.remove("is-invalid");
    return true;
  } else {
    input.classList.remove("is-valid");
    input.classList.add("is-invalid");
    return false;
  }
}

// Function de validation de confirmation de mot de passe
function validateConfirmationPassword(inputPwd, inputConfirmPwd) {
  if (inputPwd.value === inputConfirmPwd.value) {
    inputConfirmPwd.classList.add("is-valid");
    inputConfirmPwd.classList.remove("is-invalid");
    return true;
  } else {
    inputConfirmPwd.classList.add("is-invalid");
    inputConfirmPwd.classList.remove("is-valid");
    return false;
  }
}

// Function appelée lors du clic sur le bouton d'inscription

 // Function pour inscrire un utilisateur
function InscrireUtilisateur() {
  // Récupérer les valeurs du formulaire
  const role = roleSelect.value;
  const email = inputMail.value;
  const password = inputPassword.value;
  const confirmPassword = inputValidationPassword.value;

  // Valider le formulaire côté client (ajoutez vos propres validations si nécessaire)
  if (!validateRequired(roleSelect) || !validateMail(inputMail) || !validatePassword(inputPassword) || !validateConfirmationPassword(inputPassword, inputValidationPassword)) {
    alert("Veuillez remplir correctement tous les champs.");
    return;
  }

  // Construire l'objet utilisateur
  const newUser = {
    "email": email,
    "password": password,
    "role": role
  };

  // Effectuer la requête POST avec fetch
  fetch("http://127.0.0.1:8000/api/registration", {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify(newUser)
  })
  .then(response => response.json())
  .then(result => {
    console.log(result);
    alert("Utilisateur inscrit avec succès!");

    // Recharger la page après l'inscription réussie
    window.location.reload();
  })
  .catch(error => {
    console.error('Erreur lors de l\'inscription:', error);
    alert("Erreur lors de l'inscription. Veuillez réessayer.");
  });
}