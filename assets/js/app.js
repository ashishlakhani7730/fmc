function show_page_loader(){
	$(".page-loader-wrapper").show();
}

function hide_page_loader(){
	$(".page-loader-wrapper").hide();
}

function start_client_login(client,url,redirect_url){

	if (client.value != "") {
        show_page_loader();
        $.ajax({
            url: url,
            type: 'post',
            data: {'id': client.value},
            success: function (data) {
            	data = JSON.parse(data);
            	hide_page_loader();
            	if(data.success){
                    window.location = redirect_url;            		
            	}
            },
            error: function () {    
                hide_page_loader();
            }
        });    
    }

}

function getFontAwesomeIconFromMIME(mimeType) {
    // List of official MIME Types: http://www.iana.org/assignments/media-types/media-types.xhtml
    var icon_classes = {
        // Media
        image: "fa-file-image-o",
        audio: "fa-file-audio-o",
        video: "fa-file-video-o",
        // Documents
        "application/pdf": "fa-file-pdf-o",
        "application/msword": "fa-file-word-o",
        "application/vnd.ms-word": "fa-file-word-o",
        "application/vnd.oasis.opendocument.text": "fa-file-word-o",
        "application/vnd.openxmlformats-officedocument.wordprocessingml":
          "fa-file-word-o",
        "application/vnd.ms-excel": "fa-file-excel-o",
        "application/vnd.openxmlformats-officedocument.spreadsheetml":
          "fa-file-excel-o",
        "application/vnd.oasis.opendocument.spreadsheet": "fa-file-excel-o",
        "application/vnd.ms-powerpoint": "fa-file-powerpoint-o",
        "application/vnd.openxmlformats-officedocument.presentationml":
          "fa-file-powerpoint-o",
        "application/vnd.oasis.opendocument.presentation": "fa-file-powerpoint-o",
        "text/plain": "fa-file-text-o",
        "text/html": "fa-file-code-o",
        "application/json": "fa-file-code-o",
        // Archives
        "application/gzip": "fa-file-archive-o",
        "application/zip": "fa-file-archive-o"
    };

    for (var key in icon_classes) {
        if (icon_classes.hasOwnProperty(key)) {
          if (mimeType.search(key) === 0) {
            // Found it
            return icon_classes[key];
          }
        } else {
          return "fa-file-o";
        }
    }
}

$(function() {      
	//For all searchable dropdown
	$('.select2').select2();
});