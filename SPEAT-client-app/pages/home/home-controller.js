// Ce contrôleur utilise $state d'ui-router pour effectuer des redirections.
app.controller('HomeController', ["$scope", "$state",

    function ($scope, $state) {

        // Un log inutile...
        console.log('Message from home-controller!');

        // Une variable définie dans le scope du contrôleur.
        $scope.message = "Hello World!";

        // Un fonction qui redirige vers la page nommée "about" (voir /js/app.js pour consulter la liste des pages de l'application).
        $scope.goToAbout = function () {

            // La redirection en elle-même grâce à la fonction "go" de $state.
            $state.go("about");

        };

        $scope.goToIphone11ProX26 = function() { $state.go("iphone-11-pro-x-26"); };
        $scope.goToIphone11ProX27 = function() { $state.go("iphone-11-pro-x-27"); };
        $scope.goToIphone11ProX13 = function() { $state.go("iphone-11-pro-x-13"); };
        $scope.goToIphone11ProX4 = function() { $state.go("iphone-11-pro-x-4"); };
        $scope.goToIphone11ProX20 = function() { $state.go("iphone-11-pro-x-20"); };
        $scope.goToIphone11ProX41 = function() { $state.go("iphone-11-pro-x-41"); };
        $scope.goToIphone11ProX16a = function() { $state.go("iphone-11-pro-x-16a"); };
        $scope.goToIphone11ProX14 = function() { $state.go("iphone-11-pro-x-14"); };
        $scope.goToIphone11ProX9 = function() { $state.go("iphone-11-pro-x-9"); };
        $scope.goToIphone11ProX10 = function() { $state.go("iphone-11-pro-x-10"); };
        $scope.goToIphone11ProX42 = function() { $state.go("iphone-11-pro-x-42"); };
        $scope.goToIphone11ProX43 = function() { $state.go("iphone-11-pro-x-43"); };
        $scope.goToIphone11ProX45 = function() { $state.go("iphone-11-pro-x-45"); };
        $scope.goToIphone11ProX1 = function() { $state.go("iphone-11-pro-x-1"); };
        $scope.goToIphone11ProX5 = function() { $state.go("iphone-11-pro-x-5"); };
        $scope.goToIphone11ProX7 = function() { $state.go("iphone-11-pro-x-7"); };        
        $scope.goToIphone11ProX16b = function() { $state.go("iphone-11-pro-x-16b"); };
        $scope.goToIphone11ProX11 = function() { $state.go("iphone-11-pro-x-11"); };
        $scope.goToIphone11ProX12 = function() { $state.go("iphone-11-pro-x-12"); };
        $scope.goToIphone11ProX5Filters = function() { $state.go("iphone-11-pro-x-5-filters"); };
    }

]);
