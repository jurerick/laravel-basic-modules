$(document).ready(function(){


	/**
	* Delete a record 
	*/
	$.fn.deleteModel = function(model){

		var o = $(this[0]);

		if (!confirm('Are you sure you want to delete '+ model +' ?')) {
		    return;
		} 

		/*The DELETE verb is not supported by normal http. 
		  We have to create the delete request via jquery, 
		  this will render by our destroy method in resource controller*/

		$.ajax({
		  	invokedata	: {obj: o},
		    type    	: 'DELETE', 
		    url     	: o.attr('href'),
		    success 	: function(result) {
		      if(result == 'true'){

		      	var obj = this.invokedata.obj;
		      	obj.closest('tr').fadeOut();

		      }else{

		      	alert('Couldn\'t delete '+ model +'. Please try again.');
		      }
		    }
		  });

	};
	

});