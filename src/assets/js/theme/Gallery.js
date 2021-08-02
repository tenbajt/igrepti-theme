class Gallery
{
    /**
     * The gallery's preview element.
     * 
     * @var {Element}
     */
    preview;

    /**
     * An array of gallery's thumbnails.
     * 
     * @var {Array} 
     */
    thumbnails;

    /**
     * Create a new gallery instance.
     * 
     * @param  {Element}  gallery
     * @return void
     */
    constructor(gallery)
    {
        this.preview = gallery.querySelector('[data-type="preview"');
        this.thumbnails = Array.from(gallery.querySelector('[data-type="thumbnails"').getElementsByTagName('img'));

        this.thumbnails.forEach(function (thumbnail) {
            thumbnail.addEventListener('click', this.replacePreviewImage.bind(this));
        }.bind(this));
    }

    /**
     * Replace the gallery preview with the given event's target.
     * 
     * @param  {Event}  event
     * @return void
     */
    replacePreviewImage(event)
    {
        // Clear all thumbnails selected state.
        this.thumbnails.forEach((thumbnail) => {
            thumbnail.parentNode.removeAttribute('data-state');
        });

        // Set selected state to the clicked thumbnail.
        event.target.parentNode.dataset.state = 'selected';

        this.preview.src = event.target.src;
    }
}

document.querySelectorAll('[data-type="gallery"').forEach((gallery) => {
    new Gallery(gallery);
});