var Verify = portal.controller('VerifyCtrl', ['$scope', 'ui', 'Item', '$rootScope', function($scope, $ui, $item, $root) {


        $ui.title("Profile");
    }]);

Verify.resolveToken = {
    itemData: function(ui) {
        this.data = ui.user.signedin();
        return this.data;
    },
    delay: function($q, $timeout) {
        var delay = $q.defer();
        $timeout(delay.resolve, 1000);
        return delay.promise;
    }
};
