( function( api, $ ) {
	api.controlConstructor.psu = api.Control.extend( {
		ready: function() {
			control = this;

			$psuBox = control.container.find('.psu-box');
			$psuBox.post_selection_ui();
			control.container.on('updated-psu-box', function(){
				val = $(this).find('input:hidden').val();
				control.setting.set(val);
			});

		}
	} );
} )( wp.customize, jQuery );