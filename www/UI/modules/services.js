portal.factory("ui", function($window, $rootScope, $cookies, Restangular) {
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
		},
		user : {
			data : false,
			signedin : function(callback) {
				if(ui.user.data == false) {
					if($cookies.logged) {
						Restangular.one("cookie/").get().then( function(data) {
							console.log(data);
							console.log("ui");
							data = {name : data.name, id : data.id, mail : data.mail }
							ui.user.data = data;
							console.log(ui.user.data);
							if(callback) {
								return callback(ui.user.data);
							}
						});
					} else {
						ui.user.data = false;
						if(callback) {
							return false;
						}
					}
				}
			},
			signout : function(callback) {
				if($cookies.logged) {
					Restangular.one("signout").get().then(function(data) {
					
						if(callback) {
							return callback(data);
						}
						
						if(data.signedout == true) {
							return true;
						} else {
							return false;
						}
					});
				}
			}
		}
	};
	return ui;
}).factory('Item', function(Restangular){
	
	var Item = {
		//Serialize function
		serialize : function(opt) {
				str = [];
				angular.forEach(opt, function(value, key){
					str.push(key+"="+value);
				});
				return str.join("&");
				},
		//
		//Ressource part
		//
		routes : {
			tools : {
				all : Restangular.one("search/all/"),
				one : Restangular.all("tool"),
				topic : Restangular.all("topic")
			},
			facets : {
				list : Restangular.all("search/facetList/"),
				search : Restangular.all("search/facet")
			},
			search : {
				normal : Restangular.one("search/general/"),
				faceted : Restangular.all("search/faceted/")
			},
			user : {
				signin : Restangular.all("login/"),
				signup : Restangular.all("signup/")
			},
			oAuth : Restangular.all("oAuth")
		},
		
		//Return Part
		resolver : {
			oAuth : function(provider, url, callback) {
				
					if(typeof(callback)==='undefined') callback = false;
					
					return Item.routes.oAuth.one(provider).get({callback : url}).then(function (data) {
						if(callback) {	callback(data);	}
						Item.data = data;
						return data;
					});
				},
			tools : {
				all : function(opt, callback) {
				
					if(typeof(opt)==='undefined') opt =  {};
					if(typeof(callback)==='undefined') callback = false;
					
					if(opt.page) {
						opt.start = opt.page * 20 - 20;
					}
					return Item.routes.tools.all.get(opt).then(function (data) {
						if(callback) {	callback(data);	}
						Item.data = data;
						return data;
					});
				},
				one : function(item, options, callback) {
				
					if(typeof(options)==='undefined') options =  {keyword:true, platform:true, developer : true, type:true};
					if(typeof(callback)==='undefined') callback = false;
					
					return Item.routes.tools.one.one(item).get(options).then(function (data) {
						Item.data = data;
						if(callback) {	callback(data);	}
						return data;
					});
				},
				comments : {
					get : function(item, callback) {
					
						if(typeof(callback)==='undefined') callback = false;
					
						return Item.routes.tools.one.one(item).one("comments").get().then(function (data) {
							Item.data = data;
							if(callback) {	callback(data);	}
							return data;
						});
					},
					post : function(item, options, callback) {
					
						if(typeof(callback)==='undefined') callback = false;
					
						return Item.routes.tools.one.one(item).all("comments").post(options).then(function (data) {
							Item.data = data;
							if(callback) {	callback(data);	}
							return data;
						});
					}
				},
				forum : {
					get : function(item, callback) {
					
						if(typeof(callback)==='undefined') callback = false;
					
						return Item.routes.tools.one.one(item).one("forum").get().then(function (data) {
							Item.data = data;
							if(callback) {	callback(data);	}
							return data;
						});
					},
					post : function(item, options, callback) {
					
						if(typeof(callback)==='undefined') callback = false;
					
						return Item.routes.tools.one.one(item).all("forum").post(options).then(function (data) {
							Item.data = data;
							if(callback) {	callback(data);	}
							return data;
						});
					},
					topic : {
						get : function(item, callback) {
						
							if(typeof(callback)==='undefined') callback = false;
						
							return Item.routes.tools.topic.one(item).get().then(function (data) {
								Item.data = data;
								if(callback) {	callback(data);	}
								return data;
							});
						},
						post : function(itemID, topicId, options, callback) {
						
							if(typeof(callback)==='undefined') callback = false;
						
							return Item.routes.tools.topic.all(itemID).all(topicId).post(options).then(function (data) {
								Item.data = data;
								if(callback) {	callback(data);	}
								return data;
							});
						}
					}
				}
			},
			facets : function(key, option, callback) {
					
						if(typeof(callback)==='undefined') callback = false;
					
				if(key) {
					if(option) {
						return Item.routes.facets.search.one(key).get(option).then(function (data) {
							Item.data = data;
							if(callback) {	callback(data);	}
							return data;
						});
					} else {
						return Item.routes.facets.search.one(key).getList().then(function (data) {
							Item.data = data;
							if(callback) {	callback(data);	}
							return data;
						});
					}
				} else {
					return Item.routes.facets.list.getList().then(function (data) {
						Item.data = data;
						if(callback) {	callback(data);	}
						return data;
					});
				}
			},
			search : {
				normal : function(options, callback) {
					
						if(typeof(callback)==='undefined') callback = false;
					
					return Item.routes.search.normal.get(options).then(function(data) {
						Item.data = data;
						if(callback) { callback(data); }
						return data;
					});
				},
				faceted : function(options, callback) {
					
						if(typeof(callback)==='undefined') callback = false;
					
					return Item.routes.search.faceted.post(options).then(function(data) {
						Item.data = data;
						if(callback) { callback(data); }
						return data;
					});
				}
			},
			user : {
				signin : function(obj, callback) {
					
						if(typeof(callback)==='undefined') callback = false;
					
					return Item.routes.user.signin.post(obj).then(function(data) {
						if(callback) { callback(data); }
						return data;
					});
					
				},
				signup : function(obj, callback) {
					
						if(typeof(callback)==='undefined') callback = false;
					
					return Item.routes.user.signup.post(obj).then(function(data) {
						if(callback) { callback(data); }
						return data;
					});
					
				}
			}
		}
	}
	
	return Item;
});