app.service('myMediaService', function() {
    this.setActive = function(path) {
         $(".navLink").removeClass("active");
         $("#"+path.substring(1)+"Nav").addClass("active");
      };
   });