// Lighbox text
$('.popup-text').magnificPopup({
    removalDelay: 500,
    closeBtnInside: true,
    callbacks: {
        beforeOpen: function() {
            this.st.mainClass = this.st.el.attr('data-effect');
        }
    },
    midClick: true
});

$('.popup-ajax').magnificPopup({
    removalDelay: 500,
    closeBtnInside: true,
    callbacks: {
        beforeOpen: function() {
            this.st.mainClass = this.st.el.attr('data-effect');
        },
        open: function(){
            var popup = this;
            var content=this.content;

            var ajax_url = this.st.el.attr('data-src');
            var target = this.st.el.attr('href');
            
            if ( content.data( 'ajax_url' ) === ajax_url ){
                content.addClass( 'ajax-loaded' );
                return;
            }
            
            content.children( '.row, hr, a.btn-primary' ).remove();
            content.html( "<i class=\"fa fa-refresh fa-spin\"><\/i>" );
            
            //*
            $.get( ajax_url, {
                target:target
            }, function( response ){
            	//alert(response);
            	//content.children( '.fa' ).remove();
                //content.prepend( response );
                content.html(response);
                //popup.content.html( $.trim(response) );
                popup.content.data( 'ajax_url', ajax_url ).addClass( 'ajax-loaded' );
            });
            //*/
            /*
            $.ajax({
            	url: ajax_url,
            	target:target,
            	method:'get',
            	success: function(result){
        			popup.content.html(result);
    			}
    		});
    		*/
            
        },
        close: function(){
            this.content.removeClass( 'ajax-loaded' );
        }
    },
    midClick: true
});


$('.ajax-popup-link').magnificPopup({
  	type: 'ajax',
  	removalDelay: 500,
    closeBtnInside: true,
  	callbacks: {
  		beforeOpen: function() {
            this.st.mainClass = this.st.el.attr('data-effect');
        },
    	open: function() {
        	$('.new-ajax-popup-link').on('click', function(e) {
        		alert('cli');
          		e.preventDefault();
				// close current popup
          		$.magnificPopup.close();
          		return false;
        	});
      	},
      	afterClose: function() {
        	// new popup instance
        	var newAjaxPopupLink = $('.new-ajax-popup-link').magnificPopup({
          		type: 'ajax'
      		});
    		// open it
        	$('.new-ajax-popup-link').magnificPopup('open');
      	}
	},
	midClick: true
});



