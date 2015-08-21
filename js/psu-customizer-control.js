( function( api, $ ) {
	api.controlConstructor.psu = api.Control.extend( {
		ready: function() {
			var control = this,
			$psuBox = control.container.find('.psu-box');

			$psuBox.post_selection_ui();

			control.container.on('updated-psu-box', function(){
				var $field = $(this).find('input[type="hidden"]'),
				name = $field.attr('name'),
				val = $field.val();

				api(name).set(val);
			});

		}
	} );
} )( wp.customize, jQuery );