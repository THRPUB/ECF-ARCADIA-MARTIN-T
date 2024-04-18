function toggleListGroup(animalListId) {
    var animalList = document.getElementById(animalListId);
    if (animalList.style.display === "none") {
        animalList.style.display = "block";
    } else {
        animalList.style.display = "none";
    }
}


function afficherDerniereVisiteVeterinaire() {
    const animalId = 19; // ID de l'animal pour lequel vous souhaitez récupérer les visites vétérinaires

    // Envoi de la requête pour incrémenter le compteur de consultation
    fetch(`http://localhost:4000/increment/${animalId}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Réponse du serveur non valide');
            }
            return response.json();
        })
        .then(data => {
            console.log(data.message); // Afficher le message de la réponse si nécessaire
        })
        .catch(error => {
            console.error('Erreur lors de l\'incrémentation du compteur de consultation:', error);
            // Gérer l'erreur en conséquence
        });

    // Récupérer les données de toutes les visites vétérinaires depuis l'API
    fetch("http://127.0.0.1:8000/api/visite-veterinaire")
        .then(response => {
            if (!response.ok) {
                throw new Error('Réponse du serveur non valide');
            }
            return response.json();
        })
        .then(visites => {
            // Filtrer les visites pour ne garder que celles de l'animal avec l'ID spécifié
            const visitesAnimal = visites.filter(visite => visite.animal.animalId === animalId);

            // Si aucune visite pour cet animal n'est trouvée, afficher un message approprié
            if (visitesAnimal.length === 0) {
                const ulElement = document.getElementById("animalList");
                ulElement.innerHTML = "Aucune visite vétérinaire trouvée pour cet animal.";
                ulElement.style.display = "block";
                return;
            }

            // Trier les visites par date de passage (du plus récent au plus ancien)
            visitesAnimal.sort((a, b) => new Date(b.datePassage) - new Date(a.datePassage));

            // Sélectionner l'élément <ul> où les données seront affichées
            const ulElement = document.getElementById("animalList");

            // Effacer le contenu actuel de la liste
            ulElement.innerHTML = "";

            // Récupérer la dernière visite vétérinaire
            const derniereVisite = visitesAnimal[0];

            // Créer un élément <li> pour afficher la date de la visite vétérinaire
            const dateElement = document.createElement("li");
            dateElement.className = "list-group-item";
            const datePassage = new Date(derniereVisite.datePassage);
            const formattedDate = datePassage.toISOString().split('T')[0];
            dateElement.innerHTML = `<strong>Date de dernier passage:</strong> ${formattedDate}`;
            ulElement.appendChild(dateElement);

            // Créer un élément <li> pour afficher l'état de l'animal
            const etatAnimalElement = document.createElement("li");
            etatAnimalElement.className = "list-group-item";
            etatAnimalElement.innerHTML = `<strong>Etat de l'animal:</strong> ${derniereVisite.etatAnimal}`;
            ulElement.appendChild(etatAnimalElement);

            // Créer un élément <li> pour afficher la dernière nourriture proposée
            const nourritureProposeeElement = document.createElement("li");
            nourritureProposeeElement.className = "list-group-item";
            nourritureProposeeElement.innerHTML = `<strong>Nourriture proposée:</strong> ${derniereVisite.nourritureProposee}`;
            ulElement.appendChild(nourritureProposeeElement);

            // Afficher l'élément <ul>
            ulElement.style.display = "block";
        })
        .catch(error => {
            console.error('Erreur lors de la récupération de la visite vétérinaire:', error);
            alert("Erreur lors de la récupération de la visite vétérinaire. Veuillez réessayer.");
        });
}


// JavaScript pour la deuxième carte (girafe)
function afficherDerniereVisiteVeterinaire2() {
    const animalId = 20; // ID de l'animal pour lequel vous souhaitez récupérer les visites vétérinaires (pour la girafe)

// Envoi de la requête pour incrémenter le compteur de consultation
fetch(`http://localhost:4000/increment/${animalId}`)
.then(response => {
    if (!response.ok) {
        throw new Error('Réponse du serveur non valide');
    }
    return response.json();
})
.then(data => {
    console.log(data.message); // Afficher le message de la réponse si nécessaire
})
.catch(error => {
    console.error('Erreur lors de l\'incrémentation du compteur de consultation:', error);
    // Gérer l'erreur en conséquence
});


    fetch("http://127.0.0.1:8000/api/visite-veterinaire")
        .then(response => {
            if (!response.ok) {
                throw new Error('Réponse du serveur non valide');
            }
            return response.json();
        })
        .then(visites => {
            const visitesAnimal = visites.filter(visite => visite.animal.animalId === animalId);

            if (visitesAnimal.length === 0) {
                const ulElement = document.getElementById("animalList2");
                ulElement.innerHTML = "Aucune visite vétérinaire trouvée pour cet animal.";
                ulElement.style.display = "block";
                return;
            }

            visitesAnimal.sort((a, b) => new Date(b.datePassage) - new Date(a.datePassage));

            const ulElement = document.getElementById("animalList2");
            ulElement.innerHTML = "";

            const derniereVisite = visitesAnimal[0];

            const dateElement = document.createElement("li");
            dateElement.className = "list-group-item";
            const datePassage = new Date(derniereVisite.datePassage);
            const formattedDate = datePassage.toISOString().split('T')[0];
            dateElement.innerHTML = `<strong>Date de dernier passage:</strong> ${formattedDate}`;
            ulElement.appendChild(dateElement);

            const etatAnimalElement = document.createElement("li");
            etatAnimalElement.className = "list-group-item";
            etatAnimalElement.innerHTML = `<strong>Etat de l'animal:</strong> ${derniereVisite.etatAnimal}`;
            ulElement.appendChild(etatAnimalElement);

            const nourritureProposeeElement = document.createElement("li");
            nourritureProposeeElement.className = "list-group-item";
            nourritureProposeeElement.innerHTML = `<strong>Nourriture proposée:</strong> ${derniereVisite.nourritureProposee}`;
            ulElement.appendChild(nourritureProposeeElement);

            ulElement.style.display = "block";
        })
        .catch(error => {
            console.error('Erreur lors de la récupération de la visite vétérinaire:', error);
            alert("Erreur lors de la récupération de la visite vétérinaire. Veuillez réessayer.");
        });
}

// JavaScript pour la troisième carte (lion)
function afficherDerniereVisiteVeterinaire3() {
    const animalId = 21; // ID de l'animal pour lequel vous souhaitez récupérer les visites vétérinaires (pour le lion)

    // Envoi de la requête pour incrémenter le compteur de consultation
    fetch(`http://localhost:4000/increment/${animalId}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Réponse du serveur non valide');
            }
            return response.json();
        })
        .then(data => {
            console.log(data.message); // Afficher le message de la réponse si nécessaire
        })
        .catch(error => {
            console.error('Erreur lors de l\'incrémentation du compteur de consultation:', error);
            // Gérer l'erreur en conséquence
        });


    fetch("http://127.0.0.1:8000/api/visite-veterinaire")
        .then(response => {
            if (!response.ok) {
                throw new Error('Réponse du serveur non valide');
            }
            return response.json();
        })
        .then(visites => {
            const visitesAnimal = visites.filter(visite => visite.animal.animalId === animalId);

            if (visitesAnimal.length === 0) {
                const ulElement = document.getElementById("animalList3");
                ulElement.innerHTML = "Aucune visite vétérinaire trouvée pour cet animal.";
                ulElement.style.display = "block";
                return;
            }

            visitesAnimal.sort((a, b) => new Date(b.datePassage) - new Date(a.datePassage));

            const ulElement = document.getElementById("animalList3");
            ulElement.innerHTML = "";

            const derniereVisite = visitesAnimal[0];

            const dateElement = document.createElement("li");
            dateElement.className = "list-group-item";
            const datePassage = new Date(derniereVisite.datePassage);
            const formattedDate = datePassage.toISOString().split('T')[0];
            dateElement.innerHTML = `<strong>Date de dernier passage:</strong> ${formattedDate}`;
            ulElement.appendChild(dateElement);

            const etatAnimalElement = document.createElement("li");
            etatAnimalElement.className = "list-group-item";
            etatAnimalElement.innerHTML = `<strong>Etat de l'animal:</strong> ${derniereVisite.etatAnimal}`;
            ulElement.appendChild(etatAnimalElement);

            const nourritureProposeeElement = document.createElement("li");
            nourritureProposeeElement.className = "list-group-item";
            nourritureProposeeElement.innerHTML = `<strong>Nourriture proposée:</strong> ${derniereVisite.nourritureProposee}`;
            ulElement.appendChild(nourritureProposeeElement);

            ulElement.style.display = "block";
        })
        .catch(error => {
            console.error('Erreur lors de la récupération de la visite vétérinaire:', error);
            alert("Erreur lors de la récupération de la visite vétérinaire. Veuillez réessayer.");
        });
}

// JavaScript pour la quatrième carte (rhinocéros)
function afficherDerniereVisiteVeterinaire4() {
    const animalId = 22; // ID de l'animal pour lequel vous souhaitez récupérer les visites vétérinaires (pour le rhinocéros)

    // Envoi de la requête pour incrémenter le compteur de consultation
    fetch(`http://localhost:4000/increment/${animalId}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Réponse du serveur non valide');
            }
            return response.json();
        })
        .then(data => {
            console.log(data.message); // Afficher le message de la réponse si nécessaire
        })
        .catch(error => {
            console.error('Erreur lors de l\'incrémentation du compteur de consultation:', error);
            // Gérer l'erreur en conséquence
        });


    fetch("http://127.0.0.1:8000/api/visite-veterinaire")
        .then(response => {
            if (!response.ok) {
                throw new Error('Réponse du serveur non valide');
            }
            return response.json();
        })
        .then(visites => {
            const visitesAnimal = visites.filter(visite => visite.animal.animalId === animalId);

            if (visitesAnimal.length === 0) {
                const ulElement = document.getElementById("animalList4");
                ulElement.innerHTML = "Aucune visite vétérinaire trouvée pour cet animal.";
                ulElement.style.display = "block";
                return;
            }

            visitesAnimal.sort((a, b) => new Date(b.datePassage) - new Date(a.datePassage));

            const ulElement = document.getElementById("animalList4");
            ulElement.innerHTML = "";

            const derniereVisite = visitesAnimal[0];

            const dateElement = document.createElement("li");
            dateElement.className = "list-group-item";
            const datePassage = new Date(derniereVisite.datePassage);
            const formattedDate = datePassage.toISOString().split('T')[0];
            dateElement.innerHTML = `<strong>Date de dernier passage:</strong> ${formattedDate}`;
            ulElement.appendChild(dateElement);

            const etatAnimalElement = document.createElement("li");
            etatAnimalElement.className = "list-group-item";
            etatAnimalElement.innerHTML = `<strong>Etat de l'animal:</strong> ${derniereVisite.etatAnimal}`;
            ulElement.appendChild(etatAnimalElement);

            const nourritureProposeeElement = document.createElement("li");
            nourritureProposeeElement.className = "list-group-item";
            nourritureProposeeElement.innerHTML = `<strong>Nourriture proposée:</strong> ${derniereVisite.nourritureProposee}`;
            ulElement.appendChild(nourritureProposeeElement);

            ulElement.style.display = "block";
        })
        .catch(error => {
            console.error('Erreur lors de la récupération de la visite vétérinaire:', error);
            alert("Erreur lors de la récupération de la visite vétérinaire. Veuillez réessayer.");
        });
}


// JavaScript pour la première carte (gorille)
function afficherDerniereVisiteVeterinaire5() {
    const animalId = 23; // ID de l'animal pour lequel vous souhaitez récupérer les visites vétérinaires (pour le gorille)

    // Envoi de la requête pour incrémenter le compteur de consultation
    fetch(`http://localhost:4000/increment/${animalId}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Réponse du serveur non valide');
            }
            return response.json();
        })
        .then(data => {
            console.log(data.message); // Afficher le message de la réponse si nécessaire
        })
        .catch(error => {
            console.error('Erreur lors de l\'incrémentation du compteur de consultation:', error);
            // Gérer l'erreur en conséquence
        });


    fetch("http://127.0.0.1:8000/api/visite-veterinaire")
        .then(response => {
            if (!response.ok) {
                throw new Error('Réponse du serveur non valide');
            }
            return response.json();
        })
        .then(visites => {
            const visitesAnimal = visites.filter(visite => visite.animal.animalId === animalId);

            if (visitesAnimal.length === 0) {
                const ulElement = document.getElementById("animalList5");
                ulElement.innerHTML = "Aucune visite vétérinaire trouvée pour cet animal.";
                ulElement.style.display = "block";
                return;
            }

            visitesAnimal.sort((a, b) => new Date(b.datePassage) - new Date(a.datePassage));

            const ulElement = document.getElementById("animalList5");
            ulElement.innerHTML = "";

            const derniereVisite = visitesAnimal[0];

            const dateElement = document.createElement("li");
            dateElement.className = "list-group-item";
            const datePassage = new Date(derniereVisite.datePassage);
            const formattedDate = datePassage.toISOString().split('T')[0];
            dateElement.innerHTML = `<strong>Date de dernier passage:</strong> ${formattedDate}`;
            ulElement.appendChild(dateElement);

            const etatAnimalElement = document.createElement("li");
            etatAnimalElement.className = "list-group-item";
            etatAnimalElement.innerHTML = `<strong>Etat de l'animal:</strong> ${derniereVisite.etatAnimal}`;
            ulElement.appendChild(etatAnimalElement);

            const nourritureProposeeElement = document.createElement("li");
            nourritureProposeeElement.className = "list-group-item";
            nourritureProposeeElement.innerHTML = `<strong>Nourriture proposée:</strong> ${derniereVisite.nourritureProposee}`;
            ulElement.appendChild(nourritureProposeeElement);

            ulElement.style.display = "block";
        })
        .catch(error => {
            console.error('Erreur lors de la récupération de la visite vétérinaire:', error);
            alert("Erreur lors de la récupération de la visite vétérinaire. Veuillez réessayer.");
        });
}

// JavaScript pour la sixième carte (léopard)
function afficherDerniereVisiteVeterinaire6() {
    const animalId = 24; // ID de l'animal pour lequel vous souhaitez récupérer les visites vétérinaires (pour le léopard)

    // Envoi de la requête pour incrémenter le compteur de consultation
    fetch(`http://localhost:4000/increment/${animalId}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Réponse du serveur non valide');
            }
            return response.json();
        })
        .then(data => {
            console.log(data.message); // Afficher le message de la réponse si nécessaire
        })
        .catch(error => {
            console.error('Erreur lors de l\'incrémentation du compteur de consultation:', error);
            // Gérer l'erreur en conséquence
        });


    fetch("http://127.0.0.1:8000/api/visite-veterinaire")
        .then(response => {
            if (!response.ok) {
                throw new Error('Réponse du serveur non valide');
            }
            return response.json();
        })
        .then(visites => {
            const visitesAnimal = visites.filter(visite => visite.animal.animalId === animalId);

            if (visitesAnimal.length === 0) {
                const ulElement = document.getElementById("animalList6");
                ulElement.innerHTML = "Aucune visite vétérinaire trouvée pour cet animal.";
                ulElement.style.display = "block";
                return;
            }

            visitesAnimal.sort((a, b) => new Date(b.datePassage) - new Date(a.datePassage));

            const ulElement = document.getElementById("animalList6");
            ulElement.innerHTML = "";

            const derniereVisite = visitesAnimal[0];

            const dateElement = document.createElement("li");
            dateElement.className = "list-group-item";
            const datePassage = new Date(derniereVisite.datePassage);
            const formattedDate = datePassage.toISOString().split('T')[0];
            dateElement.innerHTML = `<strong>Date de dernier passage:</strong> ${formattedDate}`;
            ulElement.appendChild(dateElement);

            const etatAnimalElement = document.createElement("li");
            etatAnimalElement.className = "list-group-item";
            etatAnimalElement.innerHTML = `<strong>Etat de l'animal:</strong> ${derniereVisite.etatAnimal}`;
            ulElement.appendChild(etatAnimalElement);

            const nourritureProposeeElement = document.createElement("li");
            nourritureProposeeElement.className = "list-group-item";
            nourritureProposeeElement.innerHTML = `<strong>Nourriture proposée:</strong> ${derniereVisite.nourritureProposee}`;
            ulElement.appendChild(nourritureProposeeElement);

            ulElement.style.display = "block";
        })
        .catch(error => {
            console.error('Erreur lors de la récupération de la visite vétérinaire:', error);
            alert("Erreur lors de la récupération de la visite vétérinaire. Veuillez réessayer.");
        });
}


// JavaScript pour la septième carte (pangolin)
function afficherDerniereVisiteVeterinaire7() {
    const animalId = 25; // ID de l'animal pour lequel vous souhaitez récupérer les visites vétérinaires (pour le pangolin)

    // Envoi de la requête pour incrémenter le compteur de consultation
    fetch(`http://localhost:4000/increment/${animalId}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Réponse du serveur non valide');
            }
            return response.json();
        })
        .then(data => {
            console.log(data.message); // Afficher le message de la réponse si nécessaire
        })
        .catch(error => {
            console.error('Erreur lors de l\'incrémentation du compteur de consultation:', error);
            // Gérer l'erreur en conséquence
        });


    fetch("http://127.0.0.1:8000/api/visite-veterinaire")
        .then(response => {
            if (!response.ok) {
                throw new Error('Réponse du serveur non valide');
            }
            return response.json();
        })
        .then(visites => {
            const visitesAnimal = visites.filter(visite => visite.animal.animalId === animalId);

            if (visitesAnimal.length === 0) {
                const ulElement = document.getElementById("animalList7");
                ulElement.innerHTML = "Aucune visite vétérinaire trouvée pour cet animal.";
                ulElement.style.display = "block";
                return;
            }

            visitesAnimal.sort((a, b) => new Date(b.datePassage) - new Date(a.datePassage));

            const ulElement = document.getElementById("animalList7");
            ulElement.innerHTML = "";

            const derniereVisite = visitesAnimal[0];

            const dateElement = document.createElement("li");
            dateElement.className = "list-group-item";
            const datePassage = new Date(derniereVisite.datePassage);
            const formattedDate = datePassage.toISOString().split('T')[0];
            dateElement.innerHTML = `<strong>Date de dernier passage:</strong> ${formattedDate}`;
            ulElement.appendChild(dateElement);

            const etatAnimalElement = document.createElement("li");
            etatAnimalElement.className = "list-group-item";
            etatAnimalElement.innerHTML = `<strong>Etat de l'animal:</strong> ${derniereVisite.etatAnimal}`;
            ulElement.appendChild(etatAnimalElement);

            const nourritureProposeeElement = document.createElement("li");
            nourritureProposeeElement.className = "list-group-item";
            nourritureProposeeElement.innerHTML = `<strong>Nourriture proposée:</strong> ${derniereVisite.nourritureProposee}`;
            ulElement.appendChild(nourritureProposeeElement);

            ulElement.style.display = "block";
        })
        .catch(error => {
            console.error('Erreur lors de la récupération de la visite vétérinaire:', error);
            alert("Erreur lors de la récupération de la visite vétérinaire. Veuillez réessayer.");
        });
}


// JavaScript pour la huitième carte (tigre)
function afficherDerniereVisiteVeterinaire8() {
    const animalId = 26; // ID de l'animal pour lequel vous souhaitez récupérer les visites vétérinaires (pour le tigre)

    // Envoi de la requête pour incrémenter le compteur de consultation
    fetch(`http://localhost:4000/increment/${animalId}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Réponse du serveur non valide');
            }
            return response.json();
        })
        .then(data => {
            console.log(data.message); // Afficher le message de la réponse si nécessaire
        })
        .catch(error => {
            console.error('Erreur lors de l\'incrémentation du compteur de consultation:', error);
            // Gérer l'erreur en conséquence
        });


    fetch("http://127.0.0.1:8000/api/visite-veterinaire")
        .then(response => {
            if (!response.ok) {
                throw new Error('Réponse du serveur non valide');
            }
            return response.json();
        })
        .then(visites => {
            const visitesAnimal = visites.filter(visite => visite.animal.animalId === animalId);

            if (visitesAnimal.length === 0) {
                const ulElement = document.getElementById("animalList8");
                ulElement.innerHTML = "Aucune visite vétérinaire trouvée pour cet animal.";
                ulElement.style.display = "block";
                return;
            }

            visitesAnimal.sort((a, b) => new Date(b.datePassage) - new Date(a.datePassage));

            const ulElement = document.getElementById("animalList8");
            ulElement.innerHTML = "";

            const derniereVisite = visitesAnimal[0];

            const dateElement = document.createElement("li");
            dateElement.className = "list-group-item";
            const datePassage = new Date(derniereVisite.datePassage);
            const formattedDate = datePassage.toISOString().split('T')[0];
            dateElement.innerHTML = `<strong>Date de dernier passage:</strong> ${formattedDate}`;
            ulElement.appendChild(dateElement);

            const etatAnimalElement = document.createElement("li");
            etatAnimalElement.className = "list-group-item";
            etatAnimalElement.innerHTML = `<strong>Etat de l'animal:</strong> ${derniereVisite.etatAnimal}`;
            ulElement.appendChild(etatAnimalElement);

            const nourritureProposeeElement = document.createElement("li");
            nourritureProposeeElement.className = "list-group-item";
            nourritureProposeeElement.innerHTML = `<strong>Nourriture proposée:</strong> ${derniereVisite.nourritureProposee}`;
            ulElement.appendChild(nourritureProposeeElement);

            ulElement.style.display = "block";
        })
        .catch(error => {
            console.error('Erreur lors de la récupération de la visite vétérinaire:', error);
            alert("Erreur lors de la récupération de la visite vétérinaire. Veuillez réessayer.");
        });
}


// JavaScript pour la première carte (Alligator)
function afficherDerniereVisiteVeterinaire9() {
    const animalId = 27; // ID de l'animal pour lequel vous souhaitez récupérer les visites vétérinaires (pour l'Alligator)

    // Envoi de la requête pour incrémenter le compteur de consultation
    fetch(`http://localhost:4000/increment/${animalId}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Réponse du serveur non valide');
            }
            return response.json();
        })
        .then(data => {
            console.log(data.message); // Afficher le message de la réponse si nécessaire
        })
        .catch(error => {
            console.error('Erreur lors de l\'incrémentation du compteur de consultation:', error);
            // Gérer l'erreur en conséquence
        });


    fetch("http://127.0.0.1:8000/api/visite-veterinaire")
        .then(response => {
            if (!response.ok) {
                throw new Error('Réponse du serveur non valide');
            }
            return response.json();
        })
        .then(visites => {
            const visitesAnimal = visites.filter(visite => visite.animal.animalId === animalId);

            if (visitesAnimal.length === 0) {
                const ulElement = document.getElementById("animalList9");
                ulElement.innerHTML = "Aucune visite vétérinaire trouvée pour cet animal.";
                ulElement.style.display = "block";
                return;
            }

            visitesAnimal.sort((a, b) => new Date(b.datePassage) - new Date(a.datePassage));

            const ulElement = document.getElementById("animalList9");
            ulElement.innerHTML = "";

            const derniereVisite = visitesAnimal[0];

            const dateElement = document.createElement("li");
            dateElement.className = "list-group-item";
            const datePassage = new Date(derniereVisite.datePassage);
            const formattedDate = datePassage.toISOString().split('T')[0];
            dateElement.innerHTML = `<strong>Date de dernier passage:</strong> ${formattedDate}`;
            ulElement.appendChild(dateElement);

            const etatAnimalElement = document.createElement("li");
            etatAnimalElement.className = "list-group-item";
            etatAnimalElement.innerHTML = `<strong>Etat de l'animal:</strong> ${derniereVisite.etatAnimal}`;
            ulElement.appendChild(etatAnimalElement);

            const nourritureProposeeElement = document.createElement("li");
            nourritureProposeeElement.className = "list-group-item";
            nourritureProposeeElement.innerHTML = `<strong>Nourriture proposée:</strong> ${derniereVisite.nourritureProposee}`;
            ulElement.appendChild(nourritureProposeeElement);

            ulElement.style.display = "block";
        })
        .catch(error => {
            console.error('Erreur lors de la récupération de la visite vétérinaire:', error);
            alert("Erreur lors de la récupération de la visite vétérinaire. Veuillez réessayer.");
        });
}

// JavaScript pour la deuxième carte (Pélican)
function afficherDerniereVisiteVeterinaire10() {
    const animalId = 28; // ID de l'animal pour lequel vous souhaitez récupérer les visites vétérinaires (pour le Pélican)

    // Envoi de la requête pour incrémenter le compteur de consultation
    fetch(`http://localhost:4000/increment/${animalId}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Réponse du serveur non valide');
            }
            return response.json();
        })
        .then(data => {
            console.log(data.message); // Afficher le message de la réponse si nécessaire
        })
        .catch(error => {
            console.error('Erreur lors de l\'incrémentation du compteur de consultation:', error);
            // Gérer l'erreur en conséquence
        });


    fetch("http://127.0.0.1:8000/api/visite-veterinaire")
        .then(response => {
            if (!response.ok) {
                throw new Error('Réponse du serveur non valide');
            }
            return response.json();
        })
        .then(visites => {
            const visitesAnimal = visites.filter(visite => visite.animal.animalId === animalId);

            if (visitesAnimal.length === 0) {
                const ulElement = document.getElementById("animalList10");
                ulElement.innerHTML = "Aucune visite vétérinaire trouvée pour cet animal.";
                ulElement.style.display = "block";
                return;
            }

            visitesAnimal.sort((a, b) => new Date(b.datePassage) - new Date(a.datePassage));

            const ulElement = document.getElementById("animalList10");
            ulElement.innerHTML = "";

            const derniereVisite = visitesAnimal[0];

            const dateElement = document.createElement("li");
            dateElement.className = "list-group-item";
            const datePassage = new Date(derniereVisite.datePassage);
            const formattedDate = datePassage.toISOString().split('T')[0];
            dateElement.innerHTML = `<strong>Date de dernier passage:</strong> ${formattedDate}`;
            ulElement.appendChild(dateElement);

            const etatAnimalElement = document.createElement("li");
            etatAnimalElement.className = "list-group-item";
            etatAnimalElement.innerHTML = `<strong>Etat de l'animal:</strong> ${derniereVisite.etatAnimal}`;
            ulElement.appendChild(etatAnimalElement);

            const nourritureProposeeElement = document.createElement("li");
            nourritureProposeeElement.className = "list-group-item";
            nourritureProposeeElement.innerHTML = `<strong>Nourriture proposée:</strong> ${derniereVisite.nourritureProposee}`;
            ulElement.appendChild(nourritureProposeeElement);

            ulElement.style.display = "block";
        })
        .catch(error => {
            console.error('Erreur lors de la récupération de la visite vétérinaire:', error);
            alert("Erreur lors de la récupération de la visite vétérinaire. Veuillez réessayer.");
        });
}


// JavaScript pour la troisième carte (Tortue de Floride)
function afficherDerniereVisiteVeterinaire11() {
    const animalId = 29; // ID de l'animal pour lequel vous souhaitez récupérer les visites vétérinaires (pour la Tortue de Floride)

    // Envoi de la requête pour incrémenter le compteur de consultation
    fetch(`http://localhost:4000/increment/${animalId}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Réponse du serveur non valide');
            }
            return response.json();
        })
        .then(data => {
            console.log(data.message); // Afficher le message de la réponse si nécessaire
        })
        .catch(error => {
            console.error('Erreur lors de l\'incrémentation du compteur de consultation:', error);
            // Gérer l'erreur en conséquence
        });


    fetch("http://127.0.0.1:8000/api/visite-veterinaire")
        .then(response => {
            if (!response.ok) {
                throw new Error('Réponse du serveur non valide');
            }
            return response.json();
        })
        .then(visites => {
            const visitesAnimal = visites.filter(visite => visite.animal.animalId === animalId);

            if (visitesAnimal.length === 0) {
                const ulElement = document.getElementById("animalList11");
                ulElement.innerHTML = "Aucune visite vétérinaire trouvée pour cet animal.";
                ulElement.style.display = "block";
                return;
            }

            visitesAnimal.sort((a, b) => new Date(b.datePassage) - new Date(a.datePassage));

            const ulElement = document.getElementById("animalList11");
            ulElement.innerHTML = "";

            const derniereVisite = visitesAnimal[0];

            const dateElement = document.createElement("li");
            dateElement.className = "list-group-item";
            const datePassage = new Date(derniereVisite.datePassage);
            const formattedDate = datePassage.toISOString().split('T')[0];
            dateElement.innerHTML = `<strong>Date de dernier passage:</strong> ${formattedDate}`;
            ulElement.appendChild(dateElement);

            const etatAnimalElement = document.createElement("li");
            etatAnimalElement.className = "list-group-item";
            etatAnimalElement.innerHTML = `<strong>Etat de l'animal:</strong> ${derniereVisite.etatAnimal}`;
            ulElement.appendChild(etatAnimalElement);

            const nourritureProposeeElement = document.createElement("li");
            nourritureProposeeElement.className = "list-group-item";
            nourritureProposeeElement.innerHTML = `<strong>Nourriture proposée:</strong> ${derniereVisite.nourritureProposee}`;
            ulElement.appendChild(nourritureProposeeElement);

            ulElement.style.display = "block";
        })
        .catch(error => {
            console.error('Erreur lors de la récupération de la visite vétérinaire:', error);
            alert("Erreur lors de la récupération de la visite vétérinaire. Veuillez réessayer.");
        });
}


// JavaScript pour la quatrième carte (Tortue Peinte)
function afficherDerniereVisiteVeterinaire12() {
    const animalId = 30; // ID de l'animal pour lequel vous souhaitez récupérer les visites vétérinaires (pour la Tortue Peinte)

    // Envoi de la requête pour incrémenter le compteur de consultation
    fetch(`http://localhost:4000/increment/${animalId}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Réponse du serveur non valide');
            }
            return response.json();
        })
        .then(data => {
            console.log(data.message); // Afficher le message de la réponse si nécessaire
        })
        .catch(error => {
            console.error('Erreur lors de l\'incrémentation du compteur de consultation:', error);
            // Gérer l'erreur en conséquence
        });


    fetch("http://127.0.0.1:8000/api/visite-veterinaire")
        .then(response => {
            if (!response.ok) {
                throw new Error('Réponse du serveur non valide');
            }
            return response.json();
        })
        .then(visites => {
            const visitesAnimal = visites.filter(visite => visite.animal.animalId === animalId);

            if (visitesAnimal.length === 0) {
                const ulElement = document.getElementById("animalList12");
                ulElement.innerHTML = "Aucune visite vétérinaire trouvée pour cet animal.";
                ulElement.style.display = "block";
                return;
            }

            visitesAnimal.sort((a, b) => new Date(b.datePassage) - new Date(a.datePassage));

            const ulElement = document.getElementById("animalList12");
            ulElement.innerHTML = "";

            const derniereVisite = visitesAnimal[0];

            const dateElement = document.createElement("li");
            dateElement.className = "list-group-item";
            const datePassage = new Date(derniereVisite.datePassage);
            const formattedDate = datePassage.toISOString().split('T')[0];
            dateElement.innerHTML = `<strong>Date de dernier passage:</strong> ${formattedDate}`;
            ulElement.appendChild(dateElement);

            const etatAnimalElement = document.createElement("li");
            etatAnimalElement.className = "list-group-item";
            etatAnimalElement.innerHTML = `<strong>Etat de l'animal:</strong> ${derniereVisite.etatAnimal}`;
            ulElement.appendChild(etatAnimalElement);

            const nourritureProposeeElement = document.createElement("li");
            nourritureProposeeElement.className = "list-group-item";
            nourritureProposeeElement.innerHTML = `<strong>Nourriture proposée:</strong> ${derniereVisite.nourritureProposee}`;
            ulElement.appendChild(nourritureProposeeElement);

            ulElement.style.display = "block";
        })
        .catch(error => {
            console.error('Erreur lors de la récupération de la visite vétérinaire:', error);
            alert("Erreur lors de la récupération de la visite vétérinaire. Veuillez réessayer.");
        });
}
