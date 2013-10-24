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
filter('vProviders', function() {
	return function(input) {
		data = [];
		angular.forEach(input, function(item) {
			dom = item.informations.provider;
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
}).
filter('videoFormater', function() {
	return function(input) {
		function vF(url) {
			url = url;
			
			services = {
			  dailymotion: {
				pattern: /^((http:\/\/)?(www\.)?dailymotion\.com\/video\/)([a-z0-9]+)(_(.*)?)$/,
				replace: '//www.dailymotion.com/embed/video/$4'
			  },
			  vimeo: {
				pattern: /^((http:\/\/)?(www\.)?vimeo\.com\/)(\d+)(.*)?$/,
				replace: '//player.vimeo.com/video/$4'
			  },
			  youtube: {
				pattern: /^((http:\/\/)?(www\.)?youtube\.com\/watch\?v=)([a-zA-Z0-9-]+)(.*)?$/,
				replace: '//www.youtube.com/embed/$4'
			  }
			};
			
			for (var serviceName in services) {
				var service = services[serviceName];
				var movieUrl = url.replace(service.pattern, service.replace);
				if (url != movieUrl) {
					return movieUrl;
				}
			}
		}
		data = [];
		angular.forEach(input, function(video) {
			video.embed = vF(video.uri)
			data.push(video)
		});
		console.log(data);
		return data;
	}
});