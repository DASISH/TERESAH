angular.module('toolRegistry') // attach to your app or create a new with ('filters', [])
.filter('newline', function(){
		return function(text) {
			return text.replace(/\n/g, '<br/>');
		}
	}
).
filter('kProviders', function() {
	return function(input) {
		data = [];
		angular.forEach(input, function(item) {
			dom = item.provider.domain;
			if(data.indexOf(dom) == -1) {
				data.push(dom)
				return item;
			} else {
				return false;
			}
		});
		return data;
	}
}).
filter('kTaxonomies', function() {
	return function(input) {
		data = [];
		angular.forEach(input, function(item) {
			dom = item.provider.taxonomy;
			if(data.indexOf(dom) == -1) {
				data.push(dom)
				return item;
			} else {
				return false;
			}
		});
		return data;
	}
});