var NewFolder = {
    init: function(wrap) {
        this.$wrap = wrap
        this.$form = $('#js-new-folder-form')
        this.$form.on('submit', this.createFolder)

        this.$dialog = $('.w3-modal')
        this.$moduleOpener = $('.js-add-folder')
        this.$moduleOpener.on('click', this.showModal)
        this.$dialog.find('.js-close-modal').on('click', this.hideModal)
    },

    createFolder: function(e) {
        e.preventDefault();
        $.ajax({
            url: NewFolder.$form.attr('action'),
            method: 'POST',
            data: NewFolder.$form.serialize(),
        }).then(function(r){
            console.log(r.responseText)
            console.log(r)
        }).catch(function(error){
            console.log(error)
        }).then(function(){
            NewFolder.hideModal()
        })
    },

    hideModal: () => {
        NewFolder.$dialog.hide()
    },
    
    showModal: () => {
        NewFolder.$dialog.show()
    },

}