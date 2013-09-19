portal.factory("ui", function($window, $rootScope) {
	var ui = {
		title : function(title) { $window.document.title = "DASISH Tool Registry | " + title; },
		bookmark : {
			//Inspired by http://www.quirksmode.org/js/cookies.html
			create : function(name,value, days) {
			
				//console.log("Array");
				if(!days) { var days = 365; }
				var date = new Date();
				date.setTime(date.getTime()+(days*24*60*60*1000));
				var expires = "; expires="+date.toGMTString();
				
				if(value[0].length > 1)	{
					console.log(value);
					angular.forEach(value, function(v,k) {
						//console.log(v);
						value[k] = v.join(",");
					});
					value = value.join("|");
					console.log("Cookie array spotted");
				}
				
				document.cookie = name+"="+value+expires+"; path=/";
				
				$rootScope.$broadcast('ui.bookmark.update.'+name);
				
				
				//console.log(value);
			},
			read : function(name) {
				var nameEQ = name + "=";
				var ca = document.cookie.split(';');
				for(var i=0;i < ca.length;i++) {
					var c = ca[i];
					while (c.charAt(0)==' ') c = c.substring(1,c.length);
					if (c.indexOf(nameEQ) == 0) return this.format(c.substring(nameEQ.length,c.length));
				}
				return null;
			},
			format: function(str) {
				var array = str.split("|");
				angular.forEach(array, function(v,k) {
					//console.log(k);
					array[k] = v.split(",");
				});
				return array;
			},
			erase : function(name) {
				this.create(name,"",-1);
			},
			object : function (name) {
				var array = this.read(name);
				console.log(array);
				var object = {
					data : {},
					children : 0,
				};
				angular.forEach(array, function(value) {
					console.log(value);
					object.data[value[1]] = {href : value[2], name : value[1], type: value[0]}
					object.children = object.children + 1;
				});
				return object;
			}
		}
	};
	return ui;
}).factory('Item', function($resource){
	
	var Item = {
		//Serialize function
		serialize : function(opt) {
				str = [];
				angular.forEach(opt, function(value, key){
					str.push(key+"="+value);
				});
				return str.join("&");
				},
		//Ressource part
		resrce : $resource("http://"+document.domain+"\\:8080/tool/:itemID?keyword&platform", {itemID : "@itemID"}, { query:  {method: 'GET'} }),
		all : $resource("http://"+document.domain+"\\:8080/search/all?:options", {options : "@options"}, { query:  {method: 'GET'} }),
		fct : $resource("http://"+document.domain+"\\:8080/search/facetList", { query : {method: 'GET'}}),
		fctSearch : $resource("http://"+document.domain+"\\:8080/search/facet/:field?:options", {field : "@field", options : "@options"}, { query : {method: 'GET',
            params: {field : "@field", options : "@options"}}}),
		//Return Part
		query : function(item) {
			this.resrce.query({itemID : item}, function(u) { Item.data = u; return u; }); 
		},
		facets : function(key, option) {
			if(key) {
				console.log(key);
				console.log(option);
				if(option) {
					console.log("Got option");
					str = this.serialize(option);
					return this.fctSearch.query({field : key, options : str}, function (u) { Item.data = u; return u;});
				} else {
					console.log("Got key");
					return this.fctSearch.query({field : key}, function(u) {  Item.data = u; return u; }); 
				}
			} else {
				console.log("Got nothing");
				return this.fct.query(function(u) { Item.data = u; return u; }); 
			}
		},
		search : function(opt) {
			opt = {}
			if(opt.page) {
				opt.start = opt.page * 20 - 20;
			}
			str = this.serialize(opt);
			return this.all.query({options : str}, function(u) { Item.data = u; return u; });
		}
	}
	
	return Item;
});