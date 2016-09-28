$(document).ready(function(){
	$("#btnUpload").click(function(){
		$("#winUpload").modal();
	});
	
	$("#winUpload").find("#fileupload").fileupload({
		dataType: 'json',
		add: function (e, data) {
            //data.context = $('<p/>').text('Uploading...').appendTo(document.body);
            data.submit();
        },
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
                //$('<p/>').text(file.name).appendTo(document.body);
                alert("listisimo");
            });
        }
	});
});