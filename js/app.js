var app  = angular.module('myMedia', []);
app.config(['$routeProvider', function($routeProvider) {
    $routeProvider.
    when('/movies', {templateUrl: 'partials/movieList.html', controller: MovieListCtrl}).
    when('/books', {templateUrl: 'partials/bookList.html', controller: BookListCtrl}).
    otherwise({redirectTo: '/movies'});
    }]);
