app.controller('Iphone11ProX12Controller', function($scope) {
    $scope.restaurants = [
        {name:"McDonald (Porte De Bagnolet)", address:"49 Rue Belgrand, 75020 Paris", color:"#004413", logo:"../../assets/mcdonalds-logo.svg", page:"/#/iphone-11-pro-x-7"},
        {name:"Burger King (Nation)", address:"4 Avenue du Trône, 75020 Paris", color:"#FFE1BC", logo:"../../assets/burger-king-logo.svg", page:""},
        {name:"Subway (Bastille)", address:"22 Rue de la Roquette, 75011 Paris", color:"#005543", logo:"../../assets/subway-logo.png", page:""},
        {name:"KFC (Les Halles)", address:"31-35 Boulevard de Sébastopol, 75001 Paris", color:"#A3080C", logo:"../../assets/kfc-logo.png", page:""},
        {name:"Quick (Blanche)", address:"82 Boulevard de Clichy, 75018 Paris", color:"#ED1429", logo:"../../assets/quick-logo.png", page:""},
        {name:"Pizza Hut (Jean Jaurès)", address:"191 Avenue Jean Jaurès, 75019 Paris", color:"#EE3A43", logo:"../../assets/pizza-hut-logo.jpg", page:""},

        {name:"McDonald (Orsel)", address:"2 Rue d'Orsel, 75018 Paris", color:"#004413", logo:"../../assets/mcdonalds-logo.svg", page:""},
        {name:"Burger King (Gare du Nord)", address:"25 Rue de Dunkerque, 75010 Paris", color:"#FFE1BC", logo:"../../assets/burger-king-logo.svg", page:""},
        {name:"Subway (Madeleine)", address:"3 Rue de Castellane Paris, 75008 Paris", color:"#005543", logo:"../../assets/subway-logo.png", page:""},
        {name:"KFC (Convention)", address:"349 Rue de Vaugirard, 75015 Paris", color:"#A3080C", logo:"../../assets/kfc-logo.png", page:""},
        {name:"Quick (Sébastopol)", address:"25 Bd de Sébastopol, 75001 Paris", color:"#ED1429", logo:"../../assets/quick-logo.png", page:""},
        {name:"Pizza Hut (Opéra)", address:"29 boulevard des Italiens, 75002 Paris", color:"#EE3A43", logo:"../../assets/pizza-hut-logo.jpg", page:""},

        {name:"McDonald (Porte de Vincennes)", address:"111 Cours de Vincennes, 75020 Paris", color:"#004413", logo:"../../assets/mcdonalds-logo.svg", page:""},
        {name:"Burger King (Bastille)", address:"20 Rue de la Roquette, 75011 Paris", color:"#FFE1BC", logo:"../../assets/burger-king-logo.svg", page:""},
        {name:"Subway (Gare de Lyon)", address:"7 rue Michel Chasles, 75012 Paris", color:"#005543", logo:"../../assets/subway-logo.png", page:""},
        {name:"KFC (République)", address:" 21 Place de la République, 75003 Paris", color:"#A3080C", logo:"../../assets/kfc-logo.png", page:""},
        {name:"Quick (Montreuil)", address:"55 Boulevard Rouget De L'isle, 93100 Montreuil", color:"#ED1429", logo:"../../assets/quick-logo.png", page:""},
        {name:"Pizza Hut (Blanqui)", address:"41 Bd Auguste Blanqui, 75013 Paris", color:"#EE3A43", logo:"../../assets/pizza-hut-logo.jpg", page:""}
    ];

    $scope.purchases = [
        {restaurant: $scope.restaurants[0], date: "30/08", purchaseContent: "Menu Big Mac, McFlurry", price: "8,60 €"},
        {restaurant: $scope.restaurants[1], date: "30/08", purchaseContent: "Menu Big Fish, Creamy Shake Salted Caramel", price: "10,60 €"}
    ];
});