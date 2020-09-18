// (function ($) {
    var Upload = {

        init: function($wrap, folder) {
            this.$dialog = $('.w3-modal')
            this.$form = $('#img-upload')
            this.$chooser = $('#fileToUpload')
            this.folder = folder
            this.$addImgsBtn = $('.js-add-images')
            this.$previewBox = $('#preview');
            $('input[name="selectedFolder"]').val(folder)
            
            this.$submitBtn = $('input[type="submit"]')
            this.$spinner = $('.js-spinner')

            this.$chooser.on('change', this.previewUploads)
            this.$addImgsBtn.on('click', this.showModal)
            this.$form.on('submit', this.formUpload)
            this.$dialog.find('.js-close-modal').on('click', this.hideModal)
        },

        previewUploads: function(event){
            var files = event.target.files; //FileList object
            Upload.$previewBox.empty()
            
            for(var i = 0; i< files.length; i++) {
                var file = files[i];
                //Only pics
                if(!file.type.match('image'))
                continue;
                var picReader = new FileReader();
               
                picReader.addEventListener('load',function(event){
                    var picFile = event.target;
                    let img = "<img class='thumbnail' src='" + picFile.result + "'" +
                    "title='" + picFile.name + "'/>";
                    Upload.$previewBox.append(img)
                });
               
                //Read the image
                picReader.readAsDataURL(file);
            }
        },

        hideModal: () => {
            Upload.$dialog.hide()
        },
        
        showModal: () => {
            Upload.$submitBtn.show()
            Upload.$spinner.hide()
            Upload.$dialog.show()
        },
        
        formUpload: function (e) {
            e.preventDefault();
            Upload.$chooser.focus()
            Upload.$submitBtn.hide()
            Upload.$spinner.show()
            let url = Upload.$form.attr('action')
           
            $.ajax({
                url: url,
                method: 'POST',
                data: new FormData(this),
                contentType:false,
                processData:false,
            }).then(function(r){
                console.log(r)
                console.log(r.responseText)
                
            }).catch(function(error){
                console.log(error)
            }).then(function(){
                Upload.hideModal()
            })
            // sendXHRequestUpload(formData, action);
        },

        sendXHRequestUpload: function(formData, uri) {
            // Get an XMLHttpRequest instance
            var xhr = new XMLHttpRequest();

            xhr.addEventListener('readystatechange', onreadystatechangeHandler, false);
            // Set up request
            xhr.open('POST', uri, true);
            // Fire!
            xhr.send(formData);
            document.getElementById('add-images').style.display = 'none'
        },

        onreadystatechangeHandler: function(evt) {
            var status, text, readyState;

            text = 'something went wrong....'

            try {
                readyState = evt.target.readyState;
                text = evt.target.responseText;
                status = evt.target.status;
            }
            catch (e) {
                return;
            }

            if (readyState == 4 && status == '200') {
                mssg.innerHTML = '<p>' + evt.target.response + '</p>';
                chooser.value = ''
                // showImgs(folder.substr(4))
                showImgs(folder)

                getGalleryNav('gallery_links.php')
                document.querySelector('#add-image-btn').focus()
            }
        },

    }
// })(jQuery)
