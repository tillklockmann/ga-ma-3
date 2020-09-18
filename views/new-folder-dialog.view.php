<!-- new folder dialog -->
<div id="new-folder" class="w3-modal">
  <div class="w3-modal-content">
    <div class="w3-container">
      <span class="w3-button w3-display-topright js-close-modal">&times;</span>
      <form id="js-new-folder-form" action="/new-folder" method="post" class=" w3-padding" >
        <div class="w3-container w3-margin-top w3-margin-bottom w3-padding w3-border">
          <label for="">Create new Folder</label>
          <input type="text" name="new-folder-name" class="w3-input w3-border" value="">
        </div>
        <input class="w3-btn w3-lime w3-margin-bottom" type="submit" value="create folder" name="submit">
      </form>
    </div>
  </div>
</div>