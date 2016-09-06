//var baseurl='http://128.199.129.172:8181/adminforallbrand/';
var baseurl='';
var listApp = angular.module('listpp', ['ui.bootstrap', 'ngRoute']);    

listApp.filter('rawHtml', ['$sce', function($sce){
	  return function(val) {
		return $sce.trustAsHtml(val);
	  };
}]);
	
//$.ajaxSetup({async:true});

listApp.config(function($routeProvider, $locationProvider) {
	$routeProvider
	.when('/', {
		templateUrl : baseurl+'Home/homecontent',
		controller  : 'homecontroller'
	})

	.when('/brands', {
		templateUrl : baseurl+'Brands/',
		controller  : 'brandscontroller'
	})
	
	.when('/language', {
		templateUrl : baseurl+'Language/',
		controller  : 'languagecontroller'
	})
	
	.when('/user', {
		templateUrl : baseurl+'User/',
		controller  : 'usercontroller'
	})
	
	.when('/supplier', {
		templateUrl : baseurl+'Supplier/',
		controller  : 'suppliercontroller'
	})
	
	.when('/supplier/:brand_id', {
		templateUrl : baseurl+'supplier/',
		controller  : 'suppliercontroller'
	})
	
	.when('/news', {
		templateUrl : baseurl+'News/',
		controller  : 'newscontroller'
	})
	
	.when('/news/:brand_id', {
		templateUrl : baseurl+'News/',
		controller  : 'newscontroller'
	})
	
	.when('/category', {
		templateUrl : baseurl+'Category/',
		controller  : 'categorycontroller'
	})
	
	.when('/category/:brand_id', {
		templateUrl : baseurl+'Category/',
		controller  : 'categorycontroller'
	})
	
	.when('/post', {
		templateUrl : baseurl+'Post/',
		controller  : 'postcontroller'
	})
	
	.when('/post/:brand_id', {
		templateUrl : baseurl+'Post/',
		controller  : 'postcontroller'
	})
	
	.otherwise({
        redirectTo: '/'
    });
});
	
listApp.filter('startFrom', function() {
return function(input, start) {
	if(input) {
		start = +start; //parse to int
		return input.slice(start);
	}
	return [];
}
});

listApp.factory('Scopes', function ($rootScope) {
	var mem = {};
 
	return {
		store: function (key, value) {
			$rootScope.$emit('scope.stored', key);
			mem[key] = value;
		},
		get: function (key) {
			return mem[key];
		}
	};
});

listApp.run(function ($rootScope, $timeout, $http, filterFilter, $location, $routeParams) {
	$rootScope.isViewLoading = true;
	$rootScope.babylayout=false;
	$rootScope.hostbrand_name="";
	$rootScope.hostbrand_id="";
	
	$rootScope.$on('scope.stored', function (event, data) {
		console.log("scope.stored", data);
	});
	
	$rootScope.$on('$routeChangeStart', function() {
		$rootScope.startFade = false;
		$rootScope.isViewLoading = true;
		$rootScope.babylayout = false;
	});
	$rootScope.$on('$routeChangeSuccess', function() {
		
		
	});
	$rootScope.$on('$routeChangeError', function() {
		$rootScope.isViewLoading = false;
	});
	
	
	$rootScope.checkurl = function(){
		if(!$routeParams.brand_id){
			b=$rootScope.hostbrand_name;
			h=$rootScope.hostbrand_id;
	
			if(b!=""){
				var url=$location.path();
				if(url!="/language" && url!="/"){
					var changeurl=url+'/'+h;
					$location.path( changeurl );
				}
				if(url=="/user"){
					$location.path( '/' );
				}
				if(url=="/brands"){
					$location.path( '/' );
				}
			}
		}
	}
	/****************** get datas *******************/
	$rootScope.filteredItems =  [];
	$rootScope.pagedItems    =  [];
	$rootScope.currentPage   =  1;
	
	$rootScope.setPage = function(pageNo) {
		$rootScope.currentPage = pageNo;
	};
	
	
	$rootScope.getdatas = function(tablename){
		var getdatasurl=baseurl+"Crud/getdatas";
		if(tablename!="tbl_brand" && tablename!="tbl_language"){
			if($rootScope.hostbrand_id!=""){
				getdatasurl=baseurl+"Crud/getdatasbybrand/"+$rootScope.hostbrand_id;
			}
		}
		$http.post(getdatasurl, 
			{
				'table'		: tablename
			}
		).success(function (data, status, headers, config) { 
			$rootScope.isViewLoading = false;
			$rootScope.babylayout = true;
			$rootScope.startFade = true;
			$('.bodylayout').show();
			$rootScope.datas = data;   
			$rootScope.pagedItems = data;    
			$rootScope.currentPage = 1; 
			$rootScope.entryLimit = 10; 
			$rootScope.filteredItems = $rootScope.pagedItems.length;
			$rootScope.totalItems = $rootScope.pagedItems.length;
		});
	}
	
	$rootScope.$watch('search', function(term) {
		$rootScope.filtered = filterFilter($rootScope.pagedItems, term);
		$rootScope.filteredItems = $rootScope.filtered.length;
	});
	
	$rootScope.reverse=true;
	
	
	$rootScope.deletedata = function(id, table, idname) {  	
		var x = confirm("Are you sure to delete?");
		if(x){
			$('#loadingbox').fadeIn();
			$http.post(baseurl+"Crud/delete", { 'id':id, 'table':table, 'idname':idname }).success(function (data, status, headers, config) {               
				$('#loadingbox').delay(100).fadeOut( "fast" );
				$( "#removebox" ).fadeIn();
				$( "#removebox" ).delay(1000).fadeOut( "slow" );
				$rootScope.getdatas(table);
			})
			.error(function(data, status, headers, config){
			   alert(data);
			});
		}
	}
	
});


listApp.factory('commonfunctions', function($http, $rootScope){
	
	function factoryposttest(paras, callback) {
		$http({
			url: baseurl + 'User/factoryposttest',
			method: "POST",
			data: paras
		}).success(function (data, status, headers, config) {
            callback(data); 
        });
    }
	
	function getdatasforselect(paras, callback) {
		$http({
			url: baseurl + 'Crud/getdatasforselect',
			method: "POST",
			data: paras
		}).success(function (data, status, headers, config) {
            callback(data); 
        });
    }
			
	return {
		factoryposttest : factoryposttest,
		getdatasforselect : getdatasforselect
	};
});

listApp.controller('mainController', function ($scope, $controller, $http, filterFilter, commonfunctions, Scopes, $rootScope) {
	
	Scopes.store('mainController', $scope);
	$scope.sethost = function(name,id){
		$rootScope.hostbrand_name=name;
		$rootScope.hostbrand_id=id;
	}
	//alert("ei");
	
});


listApp.controller('homecontroller', function ($scope, $controller, $http, filterFilter, commonfunctions, Scopes, $rootScope) {
	$rootScope.isViewLoading = false;
	$rootScope.startFade = true;
	$rootScope.babylayout = true;
	Scopes.get('mainController').activetab='Dashboard';
	Scopes.get('mainController').ribbontitle="<li>Home</li><li>Dashboard</li>";
	//alert("home");
	
});


listApp.controller('languagecontroller', function ($scope, $controller, $http, filterFilter, commonfunctions, Scopes, $rootScope) {
	$rootScope.isViewLoading = true;
	Scopes.get('mainController').activetab='Language';
	Scopes.get('mainController').ribbontitle="<li>Home</li><li>Language</li>";
	
	$scope.sortField="language_id";
	$scope.reverse=true;
	$scope.savedata = function() {	
		
		var $error=false;
		if(!$scope.language_name){$('#language_name').addClass("errorfield");$('#language_name').attr('placeholder','Language Name (Required)');$error=true;}else{$('#language_name').removeClass("errorfield");$('#language_name').attr('placeholder','Language Name');} 
		
		if(!$scope.language_code){$('#language_code').addClass("errorfield");$('#language_code').attr('placeholder','language Code (Required)');$error=true;}else{$('#language_code').removeClass("errorfield");$('#language_code').attr('placeholder','Language Code');} 
		
		if($error==true){ return false; }
		$('#loadingbox').fadeIn();
		var arr={ 'language_name'  : $scope.language_name, 'language_code'  : $scope.language_code };
		
		$http.post(baseurl+"Crud/savedata", { 'arr':arr, 'table':'tbl_language' }).success(function (data, status, headers, config) {
			$( "#loadingbox" ).delay(100).fadeOut( "fast" );
			$rootScope.getdatas('tbl_language');
			$scope.language_name  =  "";
			$scope.language_code  =  "";
			$( "#successbox" ).fadeIn();
			$( "#successbox" ).delay(1000).fadeOut( "slow" );
		})
		.error(function(data, status, headers, config){
			alert(data);
		});
	}
	
	$scope.checkenter = function(e){
		if(e.keyCode==13){
			$scope.savedata();
		}
	}
	
	$('#tbl').delegate('a.fa-save','click',function(e){
		var $tr = $(this).closest('tr');
		var language_id=$tr.attr('tr-id');
		var language_name=$tr.find('.language_name').val();
		var language_code=$tr.find('.language_code').val();
		var language_status=document.getElementById("st"+language_id).checked;
		
		var $error=false;
		if(!language_name){$tr.find('.language_name').addClass("errorfield");$tr.find('.language_name').attr('placeholder','Language Name (Required)');$error=true;} 
		if(!language_code){$tr.find('.language_code').addClass("errorfield");$tr.find('.language_code').attr('placeholder','Language Code (Required)');$error=true;} 
		if($error==true){ return false; }
		$('#loadingbox').fadeIn();
		var arr={
			'language_id'	      : language_id,
			'language_name'  	  : language_name,
			'language_code'		  : language_code,
			'language_status'	  : language_status	
		};
		
		$http.post(baseurl+"Crud/savedata", 
			{ 
				'id'		: language_id,
				'idname'	: 'language_id',
				'arr'		: arr, 
				'table'		: 'tbl_language' 
			}
		).success(function (data, status, headers, config) {
			$( "#loadingbox" ).delay(100).fadeOut( "fast" );
			$( "#successbox" ).fadeIn();
			$( "#successbox" ).delay(1000).fadeOut( "slow" );
			$rootScope.getdatas('tbl_language');
		});
		
	});
	
});

listApp.controller('usercontroller', function ($scope, $controller, $http, filterFilter, commonfunctions, Scopes, $rootScope, $timeout) {
	$rootScope.isViewLoading = true;
	Scopes.get('mainController').activetab='User';
	Scopes.get('mainController').ribbontitle="<li>Home</li><li>User</li>";
	$scope.brand_ids=[];
	$scope.sortField="user_id";  
	$scope.reverse=true;
	
	$scope.savedata = function() {	
		var $error=false;
		if(!$scope.user_name){$('#user_name').addClass("errorfield");$('#user_name').attr('placeholder','Username (Required)');$error=true;}else{$('#user_name').removeClass("errorfield");$('#user_name').attr('placeholder','Username');} 
		
		if(!$scope.password){$('#password').addClass("errorfield");$('#password').attr('placeholder','Password (Required)');$error=true;}else{$('#password').removeClass("errorfield");$('#password').attr('placeholder','Password');} 
		
		if($scope.brand_ids.length==0){
			$('#brand_ids').addClass("errorfield");
			$('#brand_ids').attr('placeholder','Select Brand (Required)');$error=true;
			$("#brand_ids").select2({
				allowClear: true
			});
		}else{
			$('#brand_ids').removeClass("errorfield");$('#brand_ids').attr('placeholder','Select Brand');
		}
		
		if($error==true){ return false; }
		$('#loadingbox').fadeIn();
		
		var arr={ 'user_name'  : $scope.user_name, 'password'  : $scope.password , 'brand_ids' : $scope.brand_ids };
		
		$http.post(baseurl+"Crud/savedata", { 'arr':arr, 'table':'tbl_user' }).success(function (data, status, headers, config) {
			$('#loadingbox').delay(100).fadeOut( "fast" );
			$rootScope.getdatas('tbl_user');
			$scope.user_name  =  "";
			$scope.password  =  "";
			$scope.brand_ids = [];
			
			$timeout(function() {
				$('#brand_ids').val([]).trigger("change");
			}, 0);
			
			
			$( "#successbox" ).fadeIn();
			$( "#successbox" ).delay(1000).fadeOut( "slow" );
		})
		.error(function(data, status, headers, config){
			alert(data);
		}); 
		
		return false;
	}
	//to begin 123
	$scope.checkenter = function(e){
		if(e.keyCode==13){
			$scope.savedata();
		}
	}
	
	$('#tbl').delegate('a.fa-save','click',function(e){
		var $tr = $(this).closest('tr');
		var user_id=$tr.attr('tr-id');
		var user_name=$tr.find('.user_name').val();
		var u_password=$tr.find('.password').val();
		var u_status=document.getElementById("st"+user_id).checked;
		var brand_ids=[];
		var brand_ids=$('#brand_ids'+user_id).val();
		
		var $error=false;
		
		if(!user_name){$tr.find('.user_name').addClass("errorfield");$tr.find('.user_name').attr('placeholder','Username (Required)');$error=true;}  
		
		if(!brand_ids){
			$('#brand_ids'+user_id).addClass("errorfield");
			$('#brand_ids'+user_id).attr('placeholder','Select Brand (Required)');$error=true;
			$("#brand_ids"+user_id).select2({
				allowClear: true
			});
			$error=true;
		}else{
			$('#brand_ids'+user_id).removeClass("errorfield");$('#brand_ids'+user_id).attr('placeholder','Select Brand');
		}
		if($error==true){ return false; }
		$('#loadingbox').fadeIn();
		var uniquebrand_ids = [];
		$.each(brand_ids, function(i, el){
			if($.inArray(el, uniquebrand_ids) === -1) uniquebrand_ids.push(el);
		});
		
		if(!u_password){
			var arr={
				'user_id'	      : user_id,
				'user_name' 	  : user_name,
				'status'		  : u_status,
				'brand_ids'		  : uniquebrand_ids
			};
		}else{
			var arr={
				'user_id'	      : user_id,
				'user_name' 	  : user_name,
				'password'	  	  : u_password,
				'status'		  : u_status,
				'brand_ids'		  : uniquebrand_ids
			};
		}
		
		$http.post(baseurl+"Crud/savedata", 
			{ 
				'id'		: user_id,
				'idname'	: 'user_id',
				'arr'		: arr, 
				'table'		: 'tbl_user' 
			}
		).success(function (data, status, headers, config) {
			$('#loadingbox').delay(100).fadeOut( "fast" );
			$( "#successbox" ).fadeIn();
			$( "#successbox" ).delay(1000).fadeOut( "slow" );
			$rootScope.getdatas('tbl_user');
		});
		
	});
	
	$scope.hide_dup = function(brand_id, brands){
		for(i=0; i < brands.length; i++){
			if(brands[i].brand_id==brand_id){
				return false;
			}
		}
		return true;
	}
	
	$('#tbl').delegate('a.fa-edit','click',function(e){
		var $tr = $(this).closest('tr');
		$tr.find('.hasinput').show();
		$tr.find('.editable').hide();
		
		var user_id=$tr.attr('tr-id');
		$('#brand_ids'+user_id).select2();
		
		$tr.find('.fa-save').show();
		$tr.find('.fa-edit').hide();
		
		$tr.find('.fa-undo').show();
		$tr.find('.fa-times-circle').hide();
	});
	
	$scope.getselect = function(bs, brand_id){
		console.log(bs);
		console.log(brand_id);
		return "selected";
	}
	
	$scope.getdatasforselect = function(table) {
		var paras={ 'table':table };
		commonfunctions.getdatasforselect(paras, function(data) { //note the tmpl argument
			$scope.brands = data;
		});
	}
	
	$scope.getbs = function(brand_ids){
		if(brand_ids){
			var str = brand_ids;
			var jsonObj = JSON.parse(str);
			var returnstr="";
			return jsonObj;
		}
		return "";
	}
	
});

listApp.controller('suppliercontroller', function ($scope, $controller, $http, filterFilter, commonfunctions, Scopes, $rootScope, $routeParams, $location) {
	
	
	
	$scope.para_brand_id = $routeParams.brand_id; //alert($scope.brand_id);
	
	if(!$scope.para_brand_id){
		$scope.para_brand_id="";
	}else{
		$scope.brand_id=$scope.para_brand_id;
	}
	
	$rootScope.isViewLoading = true;
	Scopes.get('mainController').activetab='Supplier';
	Scopes.get('mainController').ribbontitle="<li>Home</li><li>Supplier</li>";
	
	$scope.sortField="supplier_id";
	$scope.reverse=true;
	$scope.savedata = function() {	
		var $error=false;
		if(!$scope.supplier_user_name){$('#supplier_user_name').addClass("errorfield");$('#supplier_user_name').attr('placeholder','Username (Required)');$error=true;}else{$('#supplier_user_name').removeClass("errorfield");$('#supplier_user_name').attr('placeholder','Username');} 
		
		if(!$scope.supplier_password){$('#supplier_password').addClass("errorfield");$('#supplier_password').attr('placeholder','Password (Required)');$error=true;}else{$('#supplier_password').removeClass("errorfield");$('#supplier_password').attr('placeholder','Password');} 
		
		if(!$scope.brand_id || $scope.brand_id=="Select Brand"){ $('#brand_id').addClass("errorfield"); $error=true;}else{$('#brand_id').removeClass("errorfield");}
		
		if($error==true){ return false; }
		$('#loadingbox').fadeIn();
		var arr={ 'supplier_user_name'  : $scope.supplier_user_name, 'supplier_password'  : $scope.supplier_password, 'brand_id' : $scope.brand_id };
		
		$http.post(baseurl+"Crud/savedata", { 'arr':arr, 'table':'tbl_supplier' }).success(function (data, status, headers, config) {
			$('#loadingbox').delay(100).fadeOut( "fast" );
			$rootScope.getdatas('tbl_supplier');
			$scope.supplier_user_name  =  "";
			$scope.supplier_password  =  "";
			$scope.brand_id="";
			$( "#successbox" ).fadeIn();
			$( "#successbox" ).delay(1000).fadeOut( "slow" );
		})
		.error(function(data, status, headers, config){
			alert(data);
		});
	}
	//to begin 123
	$scope.checkenter = function(e){
		if(e.keyCode==13){
			$scope.savedata();
		}
	}
	
	$('#tbl').delegate('a.fa-save','click',function(e){
		var $tr = $(this).closest('tr');
		var supplier_id=$tr.attr('tr-id');
		var supplier_user_name=$tr.find('.supplier_user_name').val();
		var supplier_password=$tr.find('.supplier_password').val();
		var brand_id=$tr.find('.brand_idsel').val();
		var active=document.getElementById("st"+supplier_id).checked;
		
		var $error=false;
		if(!supplier_user_name){$tr.find('.supplier_user_name').addClass("errorfield");$tr.find('.supplier_user_name').attr('placeholder','Username (Required)');$error=true;} 

		if($error==true){ return false; }
		$('#loadingbox').fadeIn();
		if(!supplier_password){
			var arr={
				'supplier_id'	      : supplier_id,
				'supplier_user_name'  : supplier_user_name,
				'brand_id'			  : brand_id,
				'active'			  : active
			};
		}else{	
			var arr={
				'supplier_id'	      : supplier_id,
				'supplier_user_name'  : supplier_user_name,
				'supplier_password'	  : supplier_password,
				'brand_id'			  : brand_id,
				'active'			  : active
			};
		}
		
		$http.post(baseurl+"Crud/savedata", 
			{ 
				'id'		: supplier_id,
				'idname'	: 'supplier_id',
				'arr'		: arr, 
				'table'		: 'tbl_supplier' 
			}
		).success(function (data, status, headers, config) {
			$('#loadingbox').delay(100).fadeOut( "fast" );
			$( "#successbox" ).fadeIn();
			$( "#successbox" ).delay(1000).fadeOut( "slow" );
			$rootScope.getdatas('tbl_supplier');
		});
		
	});
	
});



listApp.controller('brandscontroller', function ($scope, $controller, $http, filterFilter, commonfunctions, Scopes, $rootScope, $timeout) {
	$rootScope.isViewLoading = true;
	Scopes.get('mainController').activetab='Brands';
	Scopes.get('mainController').ribbontitle="<li>Home</li><li>Brands</li>";
	
	$scope.sortField="brand_id";
	$scope.reverse=true;
	$scope.savedata = function() {	
	
		if(!$scope.brand_name){$('#brand').addClass("errorfield");$('#brand').attr('placeholder','Brand Name (Required)');return false;}else{$('#brand').removeClass("errorfield");$('#brand').attr('placeholder','Brand Name');} //validation
		$('#loadingbox').fadeIn();
		var arr={ 'brand_name'  : $scope.brand_name };
		
		$http.post(baseurl+"Crud/savedata", { 'arr':arr, 'table':'tbl_brand' }).success(function (data, status, headers, config) {
			$('#loadingbox').delay(100).fadeOut( "fast" );
			$rootScope.getdatas('tbl_brand');
			$scope.brand_name  =  "";
			$( "#successbox" ).fadeIn();
			$( "#successbox" ).delay(1000).fadeOut( "slow" );
		})
		.error(function(data, status, headers, config){
			alert(data);
		});
	}
	
	$scope.checkenter = function(e){
		if(e.keyCode==13){
			$scope.savedata();
		}
	}
	
	$('#tbl').delegate('a.fa-save','click',function(e){
		var $tr = $(this).closest('tr');
		var brand_id=$tr.attr('tr-id');
		var brand_name=$tr.find('.brand_name').val();
		var brandstatus=document.getElementById("st"+brand_id).checked;
		
		var $error=false;
		if(!brand_name){$tr.find('.brand_name').addClass("errorfield");$tr.find('.brand_name').attr('placeholder','Brand Name (Required)');$error=true;} 
		if($error==true){ return false; }
		$('#loadingbox').fadeIn();
		var arr={
			'brand_id'	  : brand_id,
			'brand_name'  : brand_name,
			'status'	  : brandstatus	
		};
		
		$http.post(baseurl+"Crud/savedata", 
			{ 
				'id'		: brand_id,
				'idname'	: 'brand_id',
				'arr'		: arr, 
				'table'		: 'tbl_brand' 
			}
		).success(function (data, status, headers, config) {
			$('#loadingbox').delay(100).fadeOut( "fast" );
			$( "#successbox" ).fadeIn();
			$( "#successbox" ).delay(1000).fadeOut( "slow" );
			$rootScope.getdatas('tbl_brand');
		});
		
	});
	
});



listApp.controller('newscontroller', function ($scope, $controller, $http, filterFilter, commonfunctions, Scopes, $rootScope, $timeout, $routeParams) {
	
	$scope.para_brand_id = $routeParams.brand_id; //alert($scope.brand_id);
	
	if(!$scope.para_brand_id){
		$scope.para_brand_id="";
	}else{
		$scope.brand_id=$scope.para_brand_id;
	}
	
	$rootScope.isViewLoading = true;
	Scopes.get('mainController').activetab='News';
	Scopes.get('mainController').ribbontitle="<li>Home</li><li>News</li>";
	
	$scope.sortField="new_id";
	$scope.reverse=true;
	$scope.getdatasforselect = function(table) {
		var paras={ 'table':table };
		commonfunctions.getdatasforselect(paras, function(data) { //note the tmpl argument
			$scope.brands = data;
		});
	}
	
	$scope.getlanguages = function(table) {
		var paras={ 'table':table };
		commonfunctions.getdatasforselect(paras, function(data) { //note the tmpl argument
			$scope.languages = data;
		});
	}
	$scope.new_id="";
	$scope.new_status = { selectvalue: '1' };
	
	$scope.savedata = function() {	
		if(!$scope.brand_id){ $('#brand_id').addClass('errorselect');  return false; }else{ $('#brand_id').removeClass('errorselect'); }
		if(!$scope.language_id){ $('#language_id').addClass('errorselect'); return false; }else{ $('#language_id').removeClass('errorselect'); }
		
		$('#loadingbox').fadeIn();
		
		var arr={ 
			'brand_id'  		: $scope.brand_id,
			'language_id'  		: $scope.language_id,
			'status'  			: $scope.new_status.selectvalue,
			'new_title'  		: $scope.new_title,
			'new_description'   : CKEDITOR.instances.editor1.getData(),
			'post_img'			: $('#photoname').val()
		};
		
		var para={'arr':arr, 'table':'tbl_new', 'brand':$('#brand_id option:selected').text() };
		
		if($scope.new_id!=""){
			para={
				'arr'		:arr, 
				'table'		:'tbl_new', 
				'id'		: $scope.new_id,
				'idname'	:'new_id',
				'brand'		:$('#brand_id option:selected').text()
			};
		}
		
		$http.post(baseurl+"Crud/savedata", para ).success(function (data, status, headers, config) {
			$('#loadingbox').delay(100).fadeOut( "fast" );
			$rootScope.getdatas('tbl_new');
			$scope.brand_name  =  "";
			$( "#successbox" ).fadeIn();
			$( "#successbox" ).delay(1000).fadeOut( "slow" );
			$scope.canceldata();
		})
		.error(function(data, status, headers, config){
			alert(data);
		
		});
	}
	
	$scope.prepareedit = function(new_id){
		var filteritem = $rootScope.datas.filter(function(entry){
			return entry.new_id == new_id;	
		})[0];
		
		$scope.brand_id=filteritem.brand_id;
		$scope.language_id=filteritem.language_id;
		$scope.new_status = { selectvalue: filteritem.status };
		$scope.new_title=filteritem.new_title;
		CKEDITOR.instances['editor1'].setData(filteritem.new_description);
		$scope.post_img=filteritem.post_img;
		$scope.new_id=new_id;
		
		post_img=filteritem.post_img;
		if(post_img==""){
			post_img="default.png";
		}
		
		$("#imgid").attr("src", baseurl+"userupload/"+post_img);
	}
	
	$scope.canceldata = function(){
		$scope.brand_id="";
		$scope.language_id="";
		$scope.new_status = { selectvalue: '1' };
		$scope.new_title="";
		CKEDITOR.instances['editor1'].setData("");
		$scope.post_img="";
		$("#imgid").attr("src", baseurl+"userupload/default.png");
		$scope.new_id="";
	}
	
	//today edit 19 Jan
	$scope.$watch('search1', function(term) {	
		$rootScope.filtered = filterFilter( $rootScope.pagedItems, {brand_id:$scope.search2, new_title:$scope.search1, new_description:$scope.search1});
		$rootScope.filteredItems = $rootScope.filtered.length;
	});
	$scope.$watch('search2', function(term) {
		$rootScope.filtered = filterFilter( $rootScope.pagedItems, {brand_id:$scope.search2, new_title:$scope.search1, new_description:$scope.search1});
		$rootScope.filteredItems = $rootScope.filtered.length;
	});
});


listApp.controller('categorycontroller', function ($scope, $controller, $http, filterFilter, commonfunctions, Scopes, $rootScope, $routeParams) {
	$scope.para_brand_id = $routeParams.brand_id; //alert($scope.brand_id);
	
	if(!$scope.para_brand_id){
		$scope.para_brand_id="";
	}else{
		$scope.brand_id=$scope.para_brand_id;
	}

	$scope.getlanguages = function(table) {
		var paras={ 'table':table };
		commonfunctions.getdatasforselect(paras, function(data) { //note the tmpl argument
			$scope.languages = data;
		});
	}
	
	$rootScope.isViewLoading = true;
	Scopes.get('mainController').activetab='Category';
	Scopes.get('mainController').ribbontitle="<li>Home</li><li>Category</li>";
	
	$scope.sortField="category_id";
	$scope.reverse=true;
	$scope.savedata = function() {	
		var $error=false;
		if(!$scope.category_name){$('#category_name').addClass("errorfield");$('#category_name').attr('placeholder','Category (Required)');$error=true;}else{$('#category_name').removeClass("errorfield");$('#category_name').attr('placeholder','Category');} 
		
		if(!$scope.brand_id || $scope.brand_id=="Select Brand"){ $('#brand_id').addClass("errorfield"); $error=true;}else{$('#brand_id').removeClass("errorfield");}

		if(!$scope.language_id || $scope.language_id=="Select Language"){ $('#language_id').addClass("errorfield"); $error=true;}else{$('#language_id').removeClass("errorfield");}		
		
		if($error==true){ return false; }
		$('#loadingbox').fadeIn();
		
		var arr={ 'language_id'  : $scope.language_id, 'brand_id'  : $scope.brand_id, 'category_name'  : $scope.category_name };
		
		$http.post(baseurl+"Crud/savedata", { 'arr':arr, 'table':'tbl_category' }).success(function (data, status, headers, config) {
			$('#loadingbox').delay(100).fadeOut( "fast" );
			$rootScope.getdatas('tbl_category');
			$scope.brand_id  =  "Select Brand";
			$scope.language_id  =  "Select Language";
			$scope.category_name  =  "";
			$( "#successbox" ).fadeIn();
			$( "#successbox" ).delay(1000).fadeOut( "slow" );
		})
		.error(function(data, status, headers, config){
			alert(data);
		});
	}
	//to begin 123
	$scope.checkenter = function(e){
		if(e.keyCode==13){
			$scope.savedata();
		}
	}
	
	$('#tbl').delegate('a.fa-save','click',function(e){
		var $tr = $(this).closest('tr');
		var category_id=$tr.attr('tr-id');
		var category_name=$tr.find('.category_nametxt').val();
		var brand_id=$tr.find('.brand_idsel').val(); //to this
		var language_id=$tr.find('.language_idsel').val();
		var status=document.getElementById("st"+category_id).checked;
		
		var $error=false;
		if(!category_name){$tr.find('.category_nametxt').addClass("errorfield");$tr.find('.category_nametxt').attr('placeholder','Category (Required)');$error=true;} 

		if($error==true){ return false; }
		$('#loadingbox').fadeIn();
		
		var arr={
			'category_id'	      : category_id,
			'category_name'  : category_name,
			'brand_id'	  : brand_id,
			'language_id'	  : language_id,
			'status'			  : status
		};
	
		
		$http.post(baseurl+"Crud/savedata", 
			{ 
				'id'		: category_id,
				'idname'	: 'category_id',
				'arr'		: arr, 
				'table'		: 'tbl_category' 
			}
		).success(function (data, status, headers, config) {
			$('#loadingbox').delay(100).fadeOut( "fast" );
			$( "#successbox" ).fadeIn();
			$( "#successbox" ).delay(1000).fadeOut( "slow" );
			$rootScope.getdatas('tbl_category');
		});
		
	});
	
});



listApp.controller('postcontroller', function ($scope, $controller, $http, filterFilter, commonfunctions, Scopes, $rootScope, $routeParams) {
	
	$scope.para_brand_id = $routeParams.brand_id; //alert($scope.brand_id);
	$scope.brandidsjson=[];
	$scope.para_brand_name="";
	
	if(!$scope.para_brand_id){
		$scope.para_brand_id="";
	}else{
		$scope.brand_id=$scope.para_brand_id;
	}
	
	$scope.changecat = function(){
		$scope.category_id="";
	}

	$scope.getlanguages = function(table) {
		var paras={ 'table':table };
		commonfunctions.getdatasforselect(paras, function(data) { //note the tmpl argument
			$scope.languages = data;
		});
	}
	
	$rootScope.isViewLoading = true;
	Scopes.get('mainController').activetab='Post';
	Scopes.get('mainController').ribbontitle="<li>Home</li><li>Post</li>";
	
	$scope.sortField="post_id";
	$scope.reverse=true;
	
	$scope.getdatasforselect = function(table) {
		var paras={ 'table':table };
		commonfunctions.getdatasforselect(paras, function(data) { //note the tmpl argument
			if(table=='tbl_brand'){
				$scope.brands = data;	
			}
			if(table=='tbl_language'){
				$scope.languages = data;	
			}
			if(table=='tbl_category'){
				$scope.categories = data;	
			}
		});
	}
	
	$scope.post_id="";
	$scope.post_status = { selectvalue: '1' };
	
	$scope.savedata = function() {	
		if(!$scope.brand_id){ $('#brand_id').addClass('errorselect');  return false; }else{ $('#brand_id').removeClass('errorselect'); }
		if(!$scope.language_id){ $('#language_id').addClass('errorselect'); return false; }else{ $('#language_id').removeClass('errorselect'); }
		if(!$scope.category_id){ $('#category_id').addClass('errorselect'); return false; }else{ $('#category_id').removeClass('errorselect'); }
		
		$('#loadingbox').fadeIn();
		
		var arr={ 
			'brand_id'  		: $scope.brand_id,
			'language_id'  		: $scope.language_id,
			'category_id'  		: $scope.category_id,
			'status'  			: $scope.post_status.selectvalue,
			'post_title'  		: $scope.post_title,
			'post_description'  : CKEDITOR.instances.editor1.getData(),
			'post_img'			: $('#photoname').val()
		};
		
		var para={'arr':arr, 'table':'tbl_post', 'brand':$('#brand_id option:selected').text()};
		
		if($scope.post_id!=""){
			para={
				'arr'		:arr, 
				'table'		:'tbl_post', 
				'id'		: $scope.post_id,
				'idname'	:'post_id',
				'brand'		:$('#brand_id option:selected').text()
			};
		}
		
		$http.post(baseurl+"Crud/savedata", para ).success(function (data, status, headers, config) {
			$('#loadingbox').delay(100).fadeOut( "fast" );
			$rootScope.getdatas('tbl_post');
			$( "#successbox" ).fadeIn();
			$( "#successbox" ).delay(1000).fadeOut( "slow" );
			$scope.canceldata();
		})
		.error(function(data, status, headers, config){
			alert(data);
		
		});
	}
	
	$scope.prepareedit = function(post_id){
		var filteritem = $rootScope.datas.filter(function(entry){
			return entry.post_id == post_id;	
		})[0];
		
		$scope.brand_id=filteritem.brand_id;
		$scope.language_id=filteritem.language_id;
		$scope.category_id=filteritem.category_id;
		$scope.post_status = { selectvalue: filteritem.status };
		$scope.post_title=filteritem.post_title;
		CKEDITOR.instances['editor1'].setData(filteritem.post_description);
		$scope.post_img=filteritem.post_img;
		$scope.post_id=post_id;
		
		post_img=filteritem.post_img;
		if(post_img==""){
			post_img="default.png";
			$("#imgid").attr("src", baseurl+"userupload/"+post_img);
		}
		if(post_img!="default.png"){
			$("#imgid").attr("src", baseurl+"userupload/"+filteritem.brand_name+"/"+post_img);
		}
	}
	
	$scope.canceldata = function(){
		$scope.brand_id="";
		$scope.language_id="";
		$scope.category_id="";
		$scope.post_status = { selectvalue: '1' };
		$scope.post_title="";
		CKEDITOR.instances['editor1'].setData("");
		$scope.post_img="";
		$("#imgid").attr("src", baseurl+"userupload/default.png");
		$scope.post_id="";
	}
	
	
	//today edit 19 Jan
	$scope.$watch('search1', function(term) {	
		$rootScope.filtered = filterFilter( $rootScope.pagedItems, {brand_id:$scope.search2, post_title:$scope.search1, post_description:$scope.search1});
		$rootScope.filteredItems = $rootScope.filtered.length;
	});
	$scope.$watch('search2', function(term) {
		$rootScope.filtered = filterFilter( $rootScope.pagedItems, {brand_id:$scope.search2, post_title:$scope.search1, post_description:$scope.search1});
		$rootScope.filteredItems = $rootScope.filtered.length;
	});
	
	
});