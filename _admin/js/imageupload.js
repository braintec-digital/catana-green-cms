(function($) {
    $.fn.imageUpload = function(url, options) {
        if (url) {
            var settings = $.extend({
//		uploadButtonText: 'Загрузить изображения',
//		previewImageSize: 60,
                onSuccess: function(response) {
                }
            }, options);

            return this.each(function() {
                var fileInput = $('#file-field');
                var imgList = $('ul#img-list');
                var dropBox = $('#img-container');
                var uploadButton = $('#upload-images');
                var uploadStatus = $('#upload-status');

                fileInput.bind({change: function() {displayFiles(this.files);}});

                dropBox.bind({
                    dragenter: function() {$(this).addClass('highlighted');return false;},
                    dragover: function() {return false;},
                    dragleave: function() {$(this).removeClass('highlighted');return false;},
                    drop: function(e) {var dt = e.originalEvent.dataTransfer; displayFiles(dt.files);return false;}
                });

                function displayFiles(files) 
                {
                    $.each(files, function(i, file) {if (!file.type.match(/image.*/)) return true;
                        var li = $('<li/>').appendTo(imgList);
                        var img = $('<img/>').appendTo(li);
                        var reader = new FileReader();

                        li.get(0).file = file; reader.onload = (function(aImg) {
                            return function(e) {
                                aImg.attr('src', e.target.result);
                                aImg.attr('height', settings.previewImageSize);
                            };
                        })(img);
                        reader.readAsDataURL(file);
                    });
                }

                uploadButton.click(function () {
                    $('listimg').append('<upload><i class="mdi mdi-loading mdi-spin"></i>upload</upload>');
                    var formdata = new FormData;

                    if (settings)
                        for(var key in settings) {
                            formdata.append(key, settings[key]);
                        }

                    imgList.children("li").each(function(indx) {
                        formdata.append("file[]", $(this).get(0).file);
                    });

                    xhr = new XMLHttpRequest();
                    xhr.open("POST", url);
                    xhr.send(formdata);
                    xhr.onreadystatechange = function () {
                        if (xhr.readyState == 4) {
                            if (xhr.status == 200) {
                                settings.onSuccess(xhr.responseText);
                            }
                        }	
                    };
                });
            });	
        }
        else {console.log("Please enter valid URL for the upload.php file.");return false;}
    };
})(jQuery);