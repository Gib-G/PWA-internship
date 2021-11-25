// Un factory qui expose une fonction "sampleFunction".
// Juste pour la démo.
app.factory('SampleFactory', [function() {

  let sampleFunction = function() {

    console.log('Message from a sample function!');
    
    // Do stuff here !

  }

  return {

    sampleFunction : sampleFunction

  };

}]);
