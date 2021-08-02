class ImageSwapper {

    constructor( element )
    {
        this.element = element;
        this.target  = document.getElementById( element.dataset.target );

        this.clickListener  = this.clickListener.bind( this );

        this.element.addEventListener( 'click', this.clickListener );
    }

    clickListener()
    {
        this.target.src = this.element.src;

        var parent = this.element.parentNode;
        var siblings = parent.children;

        for ( var i = 0; i < siblings.length; i++ )
        {
            var element = siblings[i];

            element.removeAttribute( 'data-state' );
        }

        this.element.dataset.state = 'selected';
    }
}

document.querySelectorAll( '[data-action="swap-image"' ).forEach( function( element ) {
    new ImageSwapper( element );
});