(function() {

  var app = angular.module('myStateApp', [
    'ngRoute'
  ]);

  app.config(function($routeProvider) {
    $routeProvider.when('/page', {
      templateUrl: 'http://localhost/adminforallbrand/Brands/',
      controller: 'PageCtrl'
    });
  });
  
  app.controller('PageCtrl', function($scope) {
    console.log('PageCtrl');
  });

})();