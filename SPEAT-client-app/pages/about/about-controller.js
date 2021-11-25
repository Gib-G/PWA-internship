app.controller('AboutController', ["$scope", "$state", "SampleFactory",

  function($scope, $state, SampleFactory) {

    console.log('Message from about-controller!');

    SampleFactory.sampleFunction();

    $scope.goToHome = function() {

      $state.go("home");

    }

  }

]);
