<!-- upload dialog -->
<div id="add-images" class="w3-modal">
    <div class="w3-modal-content w3-padding">
        <form id="img-upload" action="/upload/<?= $name ?>" method="post" enctype="multipart/form-data" autocomplete="off">
            <div class="w3-bar">
                <span class="w3-bar-item w3-xxlarge w3-button w3-right js-close-modal">&times;</span>
                <label class="w3-bar-item " for="fileToUpload"><b>Add images</b> </label>
                <input class="w3-bar-item " type="file" name="upload[]"  multiple="multiple"  id="fileToUpload" autofocus >
            </div>
            <div id="preview"></div>
            <input class="w3-margin-top w3-btn w3-lime" type="submit" value="Upload" name="submit">
            <span class="js-spinner w3-btn w3-grey">uploading</span>
        </form>
  </div>
</div>