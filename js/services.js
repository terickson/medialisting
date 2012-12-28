app.service('myMediaService', function() {
    this.setActive = function(path) 
    {
         $(".navLink").removeClass("active");
         $("#"+path.substring(1)+"Nav").addClass("active");
    };

    this.checkAllService = function(checkAllName, checkArrayName) 
    {
     	if($("input[name="+checkAllName+"]").attr("checked") == "checked")
	    {
	    	$("input[name='"+checkArrayName+"[]']").attr("checked", "checked");
	    } 
	    else 
	    {
	    	$("input[name='"+checkArrayName+"[]']").removeAttr("checked");  
	    }
    };

    this.downloadService = function(checkArrayName, fileName, errorMessage)
  	{
      	selected = $("input[name='"+checkArrayName+"[]']:checked").map(function () {
        	return escape(this.value);
    	}).get();
      
      	if(selected.length > 0)
      	{
        	zipLocation="api/getZip.php?fileName="+escape(fileName)+"&files="+ JSON.stringify(selected);
        	window.document.location.href = zipLocation;
      	}
      	else
      	{
        	alert(errorMessage);
      	}
  	};
   });