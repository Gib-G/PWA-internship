// Script d'initialisation et de configuration de l'application.

// Enregistrement du service worker (indépendant d'AngularJS).
if ("serviceWorker" in navigator) {

   navigator.serviceWorker.register('/service-worker.js')

      .then((serviceWorker) => {
         console.log("Service worker registered: ", serviceWorker);
      })
      .catch(error => {
         console.error("Error registering the service worker: ", error);
      });

}

// Instancie l'application AngularJS (à ne pas répéter : la varibale "app" est disponible globalement).
// L'application entière n'a qu'une unique dépendance : ui.router, le routeur utilisé (/js/libraries/angular-ui-router.min.js).
var app = angular.module('App', ['ui.router']);

// Configuration de l'application.

// Configuration du routeur ici.
// Lister les routes de l'application.
// Chaque route possède un nom et une template HTML.
// À NOTER : les routes sont par défaut préfixée par "#".
app.config(function ($stateProvider, $urlRouterProvider) {

   // Définition des routes de l'application.
   $stateProvider
      // La route '/' est associée au nom 'home'.
      // Le fichier (template) HTML de la page associée à cette route est pages/home/home.html.
      .state('home', {
         url: '/home',
         templateUrl: 'pages/home/home.html'
      })

      .state('about', {
         url: '/about',
         templateUrl: 'pages/about/about.html'
      })

      .state('iphone-11-pro-x-27', {
         url: '/iphone-11-pro-x-27',
         templateUrl: 'pages/iphone-11-pro-x-27/iphone-11-pro-x-27.html'
      })

      .state('iphone-11-pro-x-26', {
         url: '/iphone-11-pro-x-26',
         templateUrl: 'pages/iphone-11-pro-x-26/iphone-11-pro-x-26.html'
      })

      .state('iphone-11-pro-x-13', {
         url: '/iphone-11-pro-x-13',
         templateUrl: 'pages/iphone-11-pro-x-13/iphone-11-pro-x-13.html'
      })
      
      .state('iphone-11-pro-x-4', {
         url: '/iphone-11-pro-x-4',
         templateUrl: 'pages/iphone-11-pro-x-4/iphone-11-pro-x-4.html'
      })

      .state('iphone-11-pro-x-20', {
         url: '/iphone-11-pro-x-20',
         templateUrl: 'pages/iphone-11-pro-x-20/iphone-11-pro-x-20.html'
      })

      .state('iphone-11-pro-x-41', {
         url: '/iphone-11-pro-x-41',
         templateUrl: 'pages/iphone-11-pro-x-41/iphone-11-pro-x-41.html'
      })
      
      .state('iphone-11-pro-x-16a', {
         url: '/iphone-11-pro-x-16a',
         templateUrl: 'pages/iphone-11-pro-x-16/iphone-11-pro-x-16a/iphone-11-pro-x-16a.html'
      })

      .state('iphone-11-pro-x-14', {
         url: '/iphone-11-pro-x-14',
         templateUrl: 'pages/iphone-11-pro-x-14/iphone-11-pro-x-14.html'
      })

      .state('iphone-11-pro-x-9', {
         url: '/iphone-11-pro-x-9',
         templateUrl: 'pages/iphone-11-pro-x-9/iphone-11-pro-x-9.html'
      })
      
      .state('iphone-11-pro-x-10', {
         url: '/iphone-11-pro-x-10',
         templateUrl: 'pages/iphone-11-pro-x-10/iphone-11-pro-x-10.html'
      })
      
      .state('iphone-11-pro-x-42', {
         url: '/iphone-11-pro-x-42',
         templateUrl: 'pages/iphone-11-pro-x-42/iphone-11-pro-x-42.html'
      })
      
      .state('iphone-11-pro-x-43', {
         url: '/iphone-11-pro-x-43',
         templateUrl: 'pages/iphone-11-pro-x-43/iphone-11-pro-x-43.html'
      })
      
      .state('iphone-11-pro-x-45', {
         url: '/iphone-11-pro-x-45',
         templateUrl: 'pages/iphone-11-pro-x-45/iphone-11-pro-x-45.html'
      })
      
      .state('iphone-11-pro-x-1', {
         url: '/iphone-11-pro-x-1',
         templateUrl: 'pages/iphone-11-pro-x-1/iphone-11-pro-x-1.html'
      })
      
      .state('iphone-11-pro-x-5', {
         url: '/iphone-11-pro-x-5',
         templateUrl: 'pages/iphone-11-pro-x-5/iphone-11-pro-x-5.html'
      })
      
      .state('iphone-11-pro-x-7', {
         url: '/iphone-11-pro-x-7',
         templateUrl: 'pages/iphone-11-pro-x-7/iphone-11-pro-x-7.html'
      })

      .state('iphone-11-pro-x-16b', {
         url: '/iphone-11-pro-x-16b',
         templateUrl: 'pages/iphone-11-pro-x-16/iphone-11-pro-x-16b/iphone-11-pro-x-16b.html'
      })
      
      .state('iphone-11-pro-x-11', {
         url: '/iphone-11-pro-x-11',
         templateUrl: 'pages/iphone-11-pro-x-11/iphone-11-pro-x-11.html'
      })
      
      .state('iphone-11-pro-x-12', {
         url: '/iphone-11-pro-x-12',
         templateUrl: 'pages/iphone-11-pro-x-12/iphone-11-pro-x-12.html'
      })
      
      .state('iphone-11-pro-x-5-burger', {
         url: '/iphone-11-pro-x-5/burger',
         templateUrl: 'pages/iphone-11-pro-x-5/burger/iphone-11-pro-x-5-burger.html'
      })
      
      .state('iphone-11-pro-x-5-kebab', {
         url: '/iphone-11-pro-x-5/kebab',
         templateUrl: 'pages/iphone-11-pro-x-5/kebab/iphone-11-pro-x-5-kebab.html'
      })
      
      .state('iphone-11-pro-x-5-pasta', {
         url: '/iphone-11-pro-x-5/pasta',
         templateUrl: 'pages/iphone-11-pro-x-5/pasta/iphone-11-pro-x-5-pasta.html'
      })
      
      .state('iphone-11-pro-x-5-pizza', {
         url: '/iphone-11-pro-x-5/pizza',
         templateUrl: 'pages/iphone-11-pro-x-5/pizza/iphone-11-pro-x-5-pizza.html'
      })
      
      .state('iphone-11-pro-x-5-sushi', {
         url: '/iphone-11-pro-x-5/sushi',
         templateUrl: 'pages/iphone-11-pro-x-5/sushi/iphone-11-pro-x-5-sushi.html'
      })
      
      .state('iphone-11-pro-x-5-vegan', {
         url: '/iphone-11-pro-x-5/vegan',
         templateUrl: 'pages/iphone-11-pro-x-5/vegan/iphone-11-pro-x-5-vegan.html'
      })
      
      .state('iphone-11-pro-x-5-filters', {
         url: '/iphone-11-pro-x-5/filters',
         templateUrl: 'pages/iphone-11-pro-x-5/filters/iphone-11-pro-x-5-filters.html'
      });

   // La route nommée 'home' (définie plus haut) est définie comme la route par défaut :
   // Si l'utilisateur essaie de naviguer sur une route non-définie, il sera redirigé vers 
   // la route 'home'.
   $urlRouterProvider.otherwise('home');
});
