import Route from "./Route.js";

//Définir ici vos routes
export const allRoutes = [
    new Route("/", "Accueil", "/pages/home.html", [], "/js/home.js"),
    new Route("/Habitats", "Habitats", "/pages/habitats.html", [], "/js/habitats.js", ),
    new Route("/Services", "Services", "/pages/services.html", [], "/js/services.js"),
    new Route("/Contact", "Contact", "/pages/contact.html", [], "/js/contact.js"),
    new Route("/signin", "Connexion", "/pages/signin.html", ["disconnected"], "/js/signin.js"),
    new Route("/signup", "Inscription", "/pages/signup.html", ["ROLE_ADMIN"], "/js/signup.js"),
    new Route("/Veterinaire", "Accés Vétérinaire", "/pages/veterinaire.html", ["ROLE_ADMIN", "ROLE_VETERINAIRE"], "/js/veterinaire.js"),
    new Route("/Messages", "Messages", "/pages/Messages.html", ["ROLE_ADMIN", "ROLE_VETERINAIRE"], "/js/Messages.js"),
    new Route("/Employe", "Accés Employé", "/pages/Employe.html", ["ROLE_ADMIN", "ROLE_EMPLOYE"], "/js/Employe.js"),
    new Route("/Admin", "Dashboard", "/pages/Administrateur.html", ["ROLE_ADMIN"], "/js/Administrateur.js"),

];
    

//Le titre s'affiche comme ceci : Route.titre - websitename
export const websiteName = "ZOO ARCADIA";