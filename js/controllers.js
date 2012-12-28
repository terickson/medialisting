function MovieListCtrl($scope, $routeParams, $http, $location, myMediaService) 
{
	myMediaService.setActive($location.$$path);  
}

function MusicListCtrl($scope, $routeParams, $http, $location, myMediaService) 
{
  myMediaService.setActive($location.$$path); 

  $scope.clickCheckAll = function()
  {
      myMediaService.checkAllService("checkAll", "songCh");
  };

  $scope.downloadSelected = function()
  {
    myMediaService.downloadService('songCh', 'songs.tar.gz', 'No Songs were Selected');
  };
}

function BookListCtrl($scope, $routeParams, $http, $location, myMediaService)  
{
	myMediaService.setActive($location.$$path);

	$scope.clickCheckAll = function()
	{
  		myMediaService.checkAllService("checkAll", "bookCh");
	};

	$scope.downloadSelected = function()
	{
      myMediaService.downloadService('bookCh', 'books.tar.gz', 'No Books were Selected');
	};

	$scope.getBookInfo = function()
	{
		eleId = $("#infoRequest").val()
		bookObj=$("#"+eleId);
		dtObj = $("#books").dataTable();
		rowIndex=dtObj.fnGetPosition(bookObj.parent().parent()[0]);
		if(dtObj.fnGetData(rowIndex,6) != ""){
        	$scope.getCalibeInfo(rowIndex);
        }else{
        	$scope.getGoogleInfo(rowIndex);
        }
	};

	$scope.getGoogleInfo = function(rowIndex)
	{
        dtObj = $("#books").dataTable();
        $( "#modalHeader" ).html('');
        $( "#modalBody" ).html('');
        $( "#modalHeader" ).html(dtObj.fnGetData(rowIndex,2));
        $( "#modalBody" ).load("api/getBookInfo.php?isbn="+escape(dtObj.fnGetData(rowIndex,6))+"&title="+escape(dtObj.fnGetData(rowIndex,2))+"&author="+escape(dtObj.fnGetData(rowIndex,1))+"");
        
        $( "#bookInfoModal" ).modal("show");
	};

	$scope.getCalibeInfo = function(rowIndex)
	{
        dtObj = $("#books").dataTable();
        $( "#modalHeader" ).html('');
        $( "#modalBody" ).html('');
        dialogHtml="<ul>";

        dialogHtml=dialogHtml+"<li> ISBN: " + dtObj.fnGetData(rowIndex,6) + " </li>";
        dialogHtml=dialogHtml+"<li> Pub Date: " + dtObj.fnGetData(rowIndex,8) + " </li>";
        dialogHtml=dialogHtml+"<li> Description: " + dtObj.fnGetData(rowIndex,7) + " </li>";
        dialogHtml=dialogHtml+"<li> Genre: " + dtObj.fnGetData(rowIndex,3) + " </li>";
        dialogHtml=dialogHtml+"<li><button class=\"btn btn-small\" onClick=\"$('#googleRequest').val("+rowIndex+");$('#googleRequest').click();\">Google Info</button></li>";

        dialogHtml=dialogHtml+"</ul>";
        
        $( "#modalHeader" ).html(dtObj.fnGetData(rowIndex,2));
        $( "#modalBody" ).html(dialogHtml);

        $( "#bookInfoModal" ).modal("show");
	};

	$scope.requestGoogleInfo = function()
	{
        $scope.getGoogleInfo($("#googleRequest").val());
	};
}