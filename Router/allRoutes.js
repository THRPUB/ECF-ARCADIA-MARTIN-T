import Route from "./Route.js";

//Définir ici vos routes
export const allRoutes = [
    new Route("/", "Accueil", "/pages/home.html", [], "/js/home.js"),
    new Route("/Habitats", "Habitats", "/Pages/habitats.html", [], "/js/habitats.js", ),
    new Route("/Services", "Services", "/Pages/services.html", [], "/js/services.js"),
    new Route("/Contact", "Contact", "/Pages/contact.html", [], "/js/contact.js"),
    new Route("/signin", "Connexion", "/Pages/signin.html", ["disconnected"], "/js/signin.js"),
    new Route("/signup", "Inscription", "/Pages/signup.html", ["ROLE_ADMIN"], "/js/signup.js"),
    new Route("/Veterinaire", "Accés Vétérinaire", "/Pages/veterinaire.html", ["ROLE_ADMIN", "ROLE_VETERINAIRE"], "/js/veterinaire.js"),
    new Route("/Messages", "Messages", "/Pages/Messages.html", ["ROLE_ADMIN", "ROLE_VETERINAIRE"], "/js/Messages.js"),
    new Route("/Employe", "Accés Employé", "/Pages/Employe.html", ["ROLE_ADMIN", "ROLE_EMPLOYE"], "/js/Employe.js"),
    new Route("/Admin", "Dashboard", "/Pages/Administrateur.html", ["ROLE_ADMIN"], "/js/Administrateur.js"),

];
    

//Le titre s'affiche comme ceci : Route.titre - websitename
export const websiteName = "ZOO ARCADIA";