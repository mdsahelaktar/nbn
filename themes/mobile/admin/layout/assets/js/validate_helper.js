/* ===================================================
 * validate-helper.js
 * A jquery plugin that Helps to validate the form with 
 * validate.js and bootstrap
 * ===================================================
 */
; !function( $ ){
$.fn.extend({
validate: function( callback ) {

        // Checks if instance is already created 
        if ( this.data("instance") ) {
          return;
        }

        var $this = this
        var temp=[]

        $this.find(".validate").each(function (i, el) {
          	var $el = $(el)
			temp.push({name: $el.attr("id"), 
					rules: $el.attr("data-rules"),
					display: $el.attr("data-display")
			})
        })
        // Create FormValidator object
        var validator = new FormValidator( $this.attr('name'), temp, function(errors, event){
			$this.find(".input_error").removeClass("input_error");
			$this.find(".error_msg").remove();
			if (errors.length > 0) {    
				for (var i = 0, errorLength = errors.length; i < errorLength; i++) {
					$('#'+errors[i].id).addClass('input_error').after('<p class="error_msg">'+errors[i].message+'</p>');
				}            
			}
			if (typeof callback === "function") {
              return callback ($this, errors, event ); //execute callback on form success
            }
			else
			{
				alert("This validator need a callback function to continue");
				return false;
			}
		} );
        this.data("instance", validator);
      }

      })

} ( window.jQuery )
