angular.module('toolRegistry') // attach to your app or create a new with ('filters', [])
.filter('newline', function(){
		return function(text) {
			return text.replace(/\n/g, '<br/>');
		}
	}
);