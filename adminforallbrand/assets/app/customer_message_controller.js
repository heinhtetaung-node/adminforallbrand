var baseurl2='http://128.199.129.172:8181/adminforallbrand/';
var listApp = angular.module('myApp', ['ui.bootstrap']); 
listApp.controller('customer_message_controller', function ($scope, $http) {
	
	$scope.savedata = function() {	
		var arr={ 
			'country'  		: $scope.country,
			'message'  		: $scope.message,
			'name'  		: $scope.name,
			'email'  			: $scope.email
		};
		
		var para={'arr':arr, 'table':'customer_message'};
		/* ajax code not working
		$.ajax({
			type: 'POST',
			crossDomain: true,
			data: para,
			url: "http://128.199.129.172:8181/adminforallbrand/Crud/savedata",
			success: function (responseData, textStatus, jqXHR) {
			   console.log("Yay!!!");
			},
			error: function (responseData, textStatus, errorThrown) {
				console.log("something went wrong!! Error: "+textStatus);
			}
		});
		
		
		$http({
			   url:baseurl2+'Crud/savedata/',
			   method:"POST",
			   headers: {
						  'Authorization': 'Basic dGVzdDp0ZXN0',
						  'Content-Type': 'application/x-www-form-urlencoded'
			   },
			   data: {
					  para
			   }
		  }).success(function (data, status, headers, config) { 
			alert("Your message has been sent!");
		  });
		  
		  */
		  var url=baseurl2+'Crud/savedata/';
		  
		$http({
			method  : "POST",
			url     : url,
			data    : para,
			headers : { 'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8' }
			
		})
		alert("Your message has been sent!");
		$scope.country="";
		$scope.message="";
		$scope.name="";
		$scope.email="";
	
	}
	
	
});