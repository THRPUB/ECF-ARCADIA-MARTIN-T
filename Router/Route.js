export default class Route {
  constructor(url, title, pathHtml, authorize, pathJS = "") {
    this.url = url;
    this.title = title;
    this.pathHtml = pathHtml;
    this.pathJS = pathJS;
    this.authorize = authorize;
  }
}

/*
[] -> Tout le monde peut y accéder
["disconnected"] -> Réserver aux utilisateurs déconnecté 
["ROLE_EMPLOYE"] -> Réserver aux utilisateurs avec le rôle client
["ROLE_VETERINAIRE"] -> Réserver aux utilisateurs avec le rôle vétérinaire 
["ROLE_ADMIN"] -> Réserver aux utilisateurs avec le rôle admin 
["ROLE_EMPLOYE", "ROLE_ADMIN"] -> Réserver aux utilisateurs avec le rôle employé OU admin
*/