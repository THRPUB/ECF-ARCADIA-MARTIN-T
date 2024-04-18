const express = require('express');
const mongoose = require('mongoose');
const cors = require('cors');

const app = express();

// Middleware CORS pour autoriser les requêtes depuis tous les domaines
app.use(cors());

// Connexion à la base de données MongoDB
mongoose.connect('mongodb://localhost:27017/animalDB', {
    useNewUrlParser: true,
    useUnifiedTopology: true
});

// Définition du schéma pour la collection 'animal'
const AnimalSchema = new mongoose.Schema({
    animal_id: Number,
    nom: String,
    race: String,
    consultation_count: Number
});

// Définition du modèle basé sur le schéma
const Animal = mongoose.model('animal', AnimalSchema);

// Route pour incrémenter le compteur de consultation d'un animal
app.get('/increment/:animalId', async (req, res) => {
    const animalId = req.params.animalId;
    try {
        // Trouver l'animal par son ID
        const animal = await Animal.findOne({ animal_id: animalId });
        if (!animal) {
            return res.status(404).json({ message: "Animal non trouvé." });
        }

        // Incrémenter le compteur de consultation
        animal.consultation_count++;

        // Sauvegarder les modifications dans la base de données
        await animal.save();
        return res.status(200).json({ message: `Le compteur de consultation pour l'animal ${animalId} a été incrémenté.` });
    } catch (error) {
        console.error("Une erreur s'est produite :", error);
        return res.status(500).json({ message: "Une erreur s'est produite." });
    }
});

// Route pour afficher toutes les données de la collection 'animal'
app.get('/animals', async (req, res) => {
    try {
        // Récupérer toutes les entrées de la collection 'animal'
        const animals = await Animal.find({});
        return res.status(200).json(animals);
    } catch (error) {
        console.error("Une erreur s'est produite :", error);
        return res.status(500).json({ message: "Une erreur s'est produite lors de la récupération des données." });
    }
});

// Lancer le serveur
const PORT = process.env.PORT || 4000;
app.listen(PORT, () => {
    console.log(`Serveur en cours d'exécution sur le port ${PORT}`);
});
