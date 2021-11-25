app.controller('Iphone11ProX7Controller', ['$scope', '$location', '$anchorScroll', function($scope, $location, $anchorScroll) {
    $scope.menus = [
        {name:"Menu Big Mac", price:"9,10 €", menuComposition:"1 Burger Big Mac", image:"../../assets/menu-bigmac.svg", page:"/#/iphone-11-pro-x-10"},
        {name:"Menu Big Tasty", price:"10,40 €", menuComposition:"1 Burger Big Tasty", image:"../../assets/menu-big-tasty.svg", page:""},
        {name:"Menu Chicken Big Tasty", price:"10,40 €", menuComposition:"1 Burger Chicken Big Tasty", image:"../../assets/menu-chicken-big-tasty.svg", page:""},
        {name:"Menu 280", price:"10,50 €", menuComposition:"1 Burger 280", image:"../../assets/menu-280.svg", page:""},
        {name:"Menu Filet-o-Fish", price:"9,50 €", menuComposition:"1 Burger Filet-o-Fish", image:"../../assets/menu-filet-o-fish.svg", page:""},
        {name:"Menu CBO", price:"10,40 €", menuComposition:"1 Burger CBO", image:"../../assets/menu-cbo.svg", page:""},
    ];
    $scope.burgers = [
        {name:"Big Mac", price:"5,65 €", menuComposition:"1 Burger Big Mac", image:"../../assets/big-mac.svg", page:""},
        {name:"280", price:"7,50 €", menuComposition:"1 Burger 280", image:"../../assets/280.svg", page:""},
        {name:"CBO", price:"7,50 €", menuComposition:"1 Burger CBO", image:"../../assets/cbo.svg", page:""},
        {name:"Big Tasty", price:"7,50 €", menuComposition:"1 Burger Big Tasty", image:"../../assets/big-tasty.svg", page:""}
    ];
    $scope.salads = [
        {name:"Salade César", price:"10,10 €", menuComposition:"1 Salade César", image:"../../assets/caesar-salad.svg", page:""}
    ];

    $scope.goToFunction = function(title) {
        $location.hash(title);
        $anchorScroll();
    };
}]);