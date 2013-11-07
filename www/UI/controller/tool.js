var Tool = portal.controller('ToolCtrl', ['$scope', 'ui',  'Item', '$rootScope', '$modal', '$log', function($scope, $ui, $item, $root, $modal, $log) {

	$scope.item = $item.data;
	
	//Will change
	if($scope.item.descriptions.description[0]) {
		$scope.item.desc = $scope.item.descriptions.description[0];
	}
	$scope.ui = {
		quickLinking : {
			status : {
				show : false,
				message : false
			},
			applied : {
			},
			show : false,
			facets : {
				facets : [],
				facet : null
			},
			link : function(facet, label, callback) {
				input = {facets : [{"facet" : facet, "element" : label}], tool: $scope.item.identifier.id}
				
				$item.resolver.tools.link(input, function(data) {
					if(data.status == "error") {
						$scope.ui.quickLinking.status.show = true;
						$scope.ui.quickLinking.status.message = data.message;
					} else {
						if(callback) {
							callback(data);
						} else {
							if(!$scope.ui.quickLinking.applied[facet]) {
								$scope.ui.quickLinking.applied[facet] = {};
							}
							$scope.ui.quickLinking.applied[facet][label] = true;
						}
					}
				});
			},
			get : function() {
				this.show = !this.show;
				if(this.show) {
					$item.resolver.facets.list({"all" : true}, function(data) {
						x = []
						angular.forEach(data, function(val) {
							val["option"] = { case_insensitivity : true };
							x.push(val);
						});
						$scope.ui.quickLinking.facets.facets = x;
					});
				}
			},
			search : {
				model : null,
				get : function(facet) {
					if(facet) {
						$scope.ui.quickLinking.method = "link";
					}
				},
				search : function(facet) {
					option = { request : $scope.ui.quickLinking.search.model, limit : 5 };
					
					$item.resolver.facets.facet.search(facet, option, function(data) {
						$scope.ui.quickLinking.search.items = data.facets;
					});
				},
				items : []
			},
			new : {
				get : function (facet) {
					if(facet) {
						$scope.ui.quickLinking.method = "new";
						
						$item.resolver.facets.facet.options(facet, function(data) {
							if(data.status && data.status == "error") {
								$scope.ui.quickLinking.new.nofield = true;
							} else {
								$scope.ui.quickLinking.new.nofield = false;
								$scope.ui.quickLinking.new.fields = {}
								angular.forEach(data, function(value, k) {
									
									$scope.ui.quickLinking.new.fields[k] = value;
									$scope.ui.quickLinking.new.fields[k]["val"] = null;
								});
								$scope.ui.quickLinking.new.active = {};
								$scope.ui.quickLinking.new.active[facet] = true;
							}
						});
					}
				},
				fields : {},
				submit : function (facet) {
					input = {}
					angular.forEach($scope.ui.quickLinking.new.fields, function(value, k) {
						input[k] = value.val;
					});
					$item.resolver.facets.facet.insert(facet, input, function(insert) {
						if(insert.status == "success") {
							$scope.ui.quickLinking.link($scope.ui.quickLinking.facets.facet, insert.identifier.id, function(data) {
								$scope.ui.quickLinking.new.error = false;
								$scope.ui.quickLinking.method = "";
							});
						} else {
							$scope.ui.quickLinking.new.error = true;
							$scope.ui.quickLinking.new.message = insert.message;
						}
					});
					
				}
			}
		},
		description : {
			edit : {
				show : false,
				data : {
					name : $scope.item.descriptions.title,
					version : $scope.item.descriptions.version,
					homepage : $scope.item.descriptions.homepage,
					available_from : $scope.item.descriptions.available_from,
				},
				submit : function() {
					input = this.data;
					$item.resolver.tools.edit.description($scope.item.identifier.id, input, function(data) {
						$scope.ui.description.edit.response = data;
					});
				},
				response : {
					Success : false,
					Error : false
				}
			}
		},
		page : "Details",
		sections : {
			list : {},
			active : 0,
			toggle : function(name) {
				if(this.list[name]) {
					this.list[name] = false;
				} else {
					this.list[name] = name;
				}
				console.log(this.list);
				$scope.ui.sections.active = 0;
				angular.forEach($scope.ui.sections.list, function(val) {
					if(val) { 
						$scope.ui.sections.active = $scope.ui.sections.active + 1;
					}
				});
			}
		},
		user : {
			data : false,
			signedin : function () { 
				if($root.user) {
					if($root.user.signedin) {
						$scope.ui.user.data = $root.user;
					}
				}
			}
		},
		//UI TOOLS
		changeDesc : function(provider) {
			if(typeof provider == "string") {
			} else {
				$scope.item.desc = provider;
			}
		},
		features : {
			show : true,
			filter : {
				input : null,
				show : false
			}
		},
		standards : {
			show : true,
			filter : {
				input : null,
				show : false
			}
		},
		projects : {
			show : true,
			filter : {
				input : null,
				show : false
			}
		},
		videos : {
			show : true,
			filter : {
				input : null,
				show : false
			}
		},
		publications : {
			show : true,
			filter : {
				input : null,
				show : false
			}
		},
		keywords : {
			provider : {
				selected : null,
				selected : null
			},
			taxonomy : {
				show : false,
				selected : null
			},
			show : true
		},
		comments : {
			form : {
				submit : function() {
					$item.resolver.tools.comments.post($scope.item.identifier.id, $scope.ui.comments.form.data, function(data) {
						if(data.Error) {
							$scope.ui.comments.form.error = data.Error;
						} else {
							$scope.ui.comments.form.error = false;
							$scope.ui.comments.get();
							$scope.ui.comments.form.active = false;
						}
					});
				},
				data : {},
				error : false
			},
			get : function() {
				$item.resolver.tools.comments.get($scope.item.identifier.id, function(data) {
					$scope.ui.comments.list = data.comments;
				});
			},
			list : {},
			active : false,
			activate : function() {
				this.active = !this.active;
				if(this.active == true) {
					$scope.ui.forum.active = false;
					this.get();
				}
			}	
		},
		forum : {
			form : {
				submit : function() {
					$item.resolver.tools.forum.post($scope.item.identifier.id, $scope.ui.forum.form.data, function(data) {
						if(data.Error) {
							$scope.ui.forum.form.error = data.Error;
						} else {
							$scope.ui.forum.form.error = false;
							$scope.ui.forum.get();
							$scope.ui.forum.form.active = false;
						}
					});
				},
				data : {},
				error : false
			},
			get : function() {
				$item.resolver.tools.forum.get($scope.item.identifier.id, function(data) {
					$scope.ui.forum.list = data.comments;
				});
			},
			list : {},
			active : false,
			activate : function() {
				this.active = !this.active;
				if(this.active == true) {
					$scope.ui.comments.active = false;
					this.get();
				}
			},
			topic : {
				form : {
					submit : function() {
						$item.resolver.tools.forum.topic.post($scope.item.identifier.id, $scope.ui.forum.topic.id, $scope.ui.forum.topic.form.data, function(data) {
							if(data.Error) {
								$scope.ui.forum.topic.form.error = data.Error;
							} else {
								$scope.ui.forum.topic.form.error = false;
								$scope.ui.forum.topic.read($scope.ui.forum.topic.id);
								$scope.ui.forum.topic.form.active = false;
							}
						});
					},
					data : {},
					error : false,
					active : false
				},
				read : function(id) {
					$item.resolver.tools.forum.topic.get(id, function(data) {
						$scope.ui.forum.topic.id = id;
						$scope.ui.forum.topic.list = data.topic;
						$scope.ui.forum.topic.active = true;
					});
					
				},
				new : function() {
					return true;
					$item.resolver.tools.forum.topic.post($scope.item.identifier.id, $scope.ui.forum.topic.id, $scope.ui.forum.form.data, function(data) {
						if(data.Error) {
							$scope.ui.forum.topic.form.error = data.Error;
						} else {
							$scope.ui.forum.topic.form.error = false;
							$scope.ui.forum.topic.read($scope.ui.forum.topic.id);
							$scope.ui.forum.topic.form.active = false;
						}
					});
				},
				list : {},
				data : {},
				id : false,
				active : false
			}
		}
	};
	//
	$ui.title("Tool | " + $scope.item.descriptions.title);
	$scope.ui.user.signedin();
	
	//exec
}]);
Tool.resolveTool = {
	itemData: function($route, Item) {
		this.data = Item.resolver.tools.one($route.current.params.toolId);
		return Item.data;
	},
	delay: function($q, $timeout) {
		var delay = $q.defer();
		$timeout(delay.resolve, 1000);
		return delay.promise;
	}
}