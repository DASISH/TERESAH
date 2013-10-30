portal.factory("ui", function($window, $rootScope, $cookies, Restangular, $location) {
	var ui = {
		title : function(title) { $window.document.title = "DASISH Tool Registry | " + title; },
		url : {
			set : function(obj) {
				$location.search(obj);
			},
			get : function() {
				return $location.search();;
			}
		},
		user : {
			data : false,
			signedin : function(callback) {
				if(ui.user.data == false) {
					if($cookies.logged) {
						Restangular.one("cookie/").get().then( function(data) {
							data = {name : data.name, id : data.id, mail : data.mail }
							ui.user.data = data;
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
				one : Restangular.one("tool/"),
				link : Restangular.all("tool/facet"),
				all : Restangular.all("tool"),
				topic : Restangular.all("topic")
			},
			facets : {
				list : Restangular.all("facet/"),
				search : Restangular.all("facet")
			},
			browse : {
				facet : Restangular.all("facet")
			},
			search : {
				normal : Restangular.one("search/general/"),
				faceted : Restangular.all("search/faceted/")
			},
			user : {
				signin : Restangular.all("login/"),
				signup : Restangular.all("signup/")
			},
			oAuth : Restangular.all("oAuth"),
			faq : Restangular.all("faq")
		},
		
		//Return Part
		resolver : {
			browse : {
				element : function(facet, facetID, opt, callback) {
				
					if(typeof(callback)==='undefined') callback = false;
					if(typeof(opt)==='undefined') opt = {};
					
					if(opt.page) {
						opt.start = opt.page * 20 - 20;
					}
					
					return Item.routes.browse.facet.all(facet).one(facetID).get(opt).then(function (data) {
						if(callback) {	callback(data.original);	}
						Item.data = data.original;
						return data.original;
					});
				},
				facet : function(facet, opt, callback) {
				
					if(typeof(callback)==='undefined') callback = false;
					if(typeof(opt)==='undefined') opt = {};
					
					if(opt.page) {
						opt.start = opt.page * 20 - 20;
					}
					
					return Item.routes.browse.facet.one(facet).get(opt).then(function (data) {
						if(callback) {	callback(data.original);	}
						Item.data = data.original;
						return data.original;
					});
				}
			},
			oAuth : function(provider, url, callback) {
				
					if(typeof(callback)==='undefined') callback = false;
					
					return Item.routes.oAuth.one(provider).get({callback : url}).then(function (data) {
						if(callback) {	callback(data.original);	}
						Item.data = data.original;
						return data.original;
					});
				},
			tools : {
				edit : {
					description : function(toolId, opt, callback) {
						if(typeof(callback)==='undefined') callback = false;
						if(typeof(opt)==='undefined') {
							x = { Error : "No input given" };
							if(callback == false) { return x; }
							else { return x; }
						} else {
							return Item.routes.tools.all.all(toolId).all("edit").post(opt).then(function(data) {
								if(callback) { return callback(data); }
								Item.data = data.original;
								return data.original;
							});
						}
					}
				},
				insert : function(opt, callback) {
				
					if(typeof(opt)==='undefined') opt =  {};
					if(typeof(callback)==='undefined') callback = false;
					
					return Item.routes.tools.all.post(opt).then(function (data) {
						if(callback) {	callback(data.original);	}
						Item.data = data.original;
						return data.original;
					});
					
				},
				link : function(opt, callback) {
				
					if(typeof(opt)==='undefined') opt =  {};
					if(typeof(callback)==='undefined') callback = false;
					
					return Item.routes.tools.link.post(opt).then(function (data) {
						if(callback) {	callback(data.original);	}
						Item.data = data.original;
						return data.original;
					});
					
				},
				all : function(opt, callback) {
				
					if(typeof(opt)==='undefined') opt =  {};
					if(typeof(callback)==='undefined') callback = false;
					
					if(opt.page) {
						opt.start = opt.page * 20 - 20;
					}
					return Item.routes.tools.one.get(opt).then(function (data) {
						if(callback) {	callback(data.original);	}
						Item.data = data.original;
						return data.original;
					});
				},
				one : function(item, options, callback) {
				
					if(typeof(options)==='undefined') options =  {keyword:true, platform:true, developer : true, type:true, applicationType: true, licence : true, publications: true,projects: true,suite:true, standards:true, features:true, video:true};
					if(typeof(callback)==='undefined') callback = false;
					
					return Item.routes.tools.all.one(item).get(options).then(function (data) {
						Item.data = data.original;
						if(callback) {	callback(data.original);	}
						return data.original;
					});
				},
				comments : {
					get : function(item, callback) {
					
						if(typeof(callback)==='undefined') callback = false;
					
						return Item.routes.tools.all.one(item).one("comments").get().then(function (data) {
							Item.data = data.original;
							if(callback) {	callback(data.original);	}
							return data.original;
						});
					},
					post : function(item, options, callback) {
					
						if(typeof(callback)==='undefined') callback = false;
					
						return Item.routes.tools.all.one(item).all("comments").post(options).then(function (data) {
							Item.data = data.original;
							if(callback) {	callback(data.original);	}
							return data.original;
						});
					}
				},
				forum : {
					get : function(item, callback) {
					
						if(typeof(callback)==='undefined') callback = false;
					
						return Item.routes.tools.all.one(item).one("forum").get().then(function (data) {
							Item.data = data.original;
							if(callback) {	callback(data.original);	}
							return data.original;
						});
					},
					post : function(item, options, callback) {
					
						if(typeof(callback)==='undefined') callback = false;
					
						return Item.routes.tools.all.one(item).all("forum").post(options).then(function (data) {
							Item.data = data.original;
							if(callback) {	callback(data.original);	}
							return data.original;
						});
					},
					topic : {
						get : function(item, callback) {
						
							if(typeof(callback)==='undefined') callback = false;
						
							return Item.routes.tools.topic.one(item).get().then(function (data) {
								Item.data = data.original;
								if(callback) {	callback(data.original);	}
								return data.original;
							});
						},
						post : function(itemID, topicId, options, callback) {
						
							if(typeof(callback)==='undefined') callback = false;
						
							return Item.routes.tools.topic.all(itemID).all(topicId).post(options).then(function (data) {
								Item.data = data.original;
								if(callback) {	callback(data.original);	}
								return data.original;
							});
						}
					}
				}
			},
			facets : {
				list : function(option, callback) {
					if(typeof(option)==='undefined') option = {};
					if(typeof(callback)==='undefined') callback = false;
					if(option.all) {
						fn = Item.routes.facets.list.options();
					} else {
						fn = Item.routes.facets.list.getList();
					}
					return fn.then(function (data) {
						Item.data = data.original;
						if(callback) {	callback(data.original);	}
						return data.original;
					});
				},
				search : {
				},
				facet : {
					list : function (key, callback) {
						if(typeof(callback)==='undefined') callback = false;
						return Item.routes.facets.search.one(key).getList().then(function (data) {
							Item.data = data.original;
							if(callback) {	callback(data.original);	}
							return data.original;
						});
					},
					search : function (key, option, callback) {
						if(typeof(callback)==='undefined') callback = false;
						return Item.routes.facets.search.one(key).getList().then(function (data) {
							Item.data = data.original;
							if(callback) {	callback(data.original);	}
							return data.original;
						});
					},
					options : function (key, callback) {
						if(typeof(callback)==='undefined') callback = false;
						return Item.routes.facets.search.one(key).options().then(function (data) {
							Item.data = data.original;
							if(callback) {	callback(data.original);	}
							return data.original;
						});
					},
					insert : function (key, input, callback) {
						
						if(typeof(callback)==='undefined') callback = false;
						return Item.routes.facets.search.all(key).post(input).then(function (data) {
							Item.data = data.original;
							if(callback) {	callback(data.original);	}
							return data.original;
						});
					}
				}
			},
			/*facets : function(key, option, callback) {
					
						if(typeof(callback)==='undefined') callback = false;
					
				if(key) {
					if(option) {
						return Item.routes.facets.search.one(key).get(option).then(function (data) {
							Item.data = data.original;
							if(callback) {	callback(data.original);	}
							return data.original;
						});
					} else {
						return Item.routes.facets.search.one(key).getList().then(function (data) {
							Item.data = data.original;
							if(callback) {	callback(data.original);	}
							return data.original;
						});
					}
				} else {
					return Item.routes.facets.list.getList().then(function (data) {
						Item.data = data.original;
						if(callback) {	callback(data.original);	}
						return data.original;
					});
				}
			},*/
			search : {
				normal : function(options, callback) {
					
						if(typeof(callback)==='undefined') callback = false;
					
					return Item.routes.search.normal.get(options).then(function(data) {
						Item.data = data.original;
						if(callback) { callback(data); }
						return data.original;
					});
				},
				faceted : function(options, callback) {
					
						if(typeof(callback)==='undefined') callback = false;
					
					return Item.routes.search.faceted.post(options).then(function(data) {
						Item.data = data.original;
						if(callback) { callback(data); }
						return data.original;
					});
				},
				facetedGet :  function(options, callback) {
					
					if(typeof(callback)==='undefined') callback = false;
					
					return Restangular.one('search/faceted/?'+options).get().then(function(data) {
						Item.data = data.original;
						if(callback) { callback(data); }
						return data.original;
					});
				}
			},
			user : {
				signin : function(obj, callback) {
					
						if(typeof(callback)==='undefined') callback = false;
					
					return Item.routes.user.signin.post(obj).then(function(data) {
						if(callback) { callback(data); }
						return data.original;
					});
					
				},
				signup : function(obj, callback) {
					
						if(typeof(callback)==='undefined') callback = false;
					
					return Item.routes.user.signup.post(obj).then(function(data) {
						if(callback) { callback(data); }
						return data.original;
					});
					
				}
			},
			faq : function(callback) {
				if(typeof(callback)==='undefined') callback = false;
				
				return Item.routes.faq.getList().then(function(data) {
					if(callback) { callback(data); }
					return data.original;
				});
				
			}
		}
	}
	
	return Item;
});