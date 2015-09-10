/*global jQuery, document */
jQuery(document).ready(function(){
  "use strict";
  jQuery('.voce-theme-image-lib').each(function(){
    var $this = jQuery(this);
    new MediaModal(
      {
        calling_selector : '#' + $this.attr('id'),
        cb : function(attachments){
          var attachment = attachments[0],
              controller = wp.customize.control.instance($this.data('controller'));

          $this.data('attachment_ids', attachment.id);
          $this.parents('.customize-image-picker').find('.preview-thumbnail img').attr('src', attachment.sizes.full.url);

          switch ($this.data('output_format')) {
            case 'id':
              controller.setting.set(attachment.id);
              break;
            case 'src':
            default:
              controller.setting.set(attachment.url);
              break;
          }

          controller.thumbnailSrc(attachment.url);
        }
      },
      {
        title : $this.data('uploader_title'),
        button : {
          text : 'Select Image'
        },
        library : {
          type : "image"
        }
      }
    );
  });
});
