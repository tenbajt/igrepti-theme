class Toggler {

    constructor( element )
    {
        this.element = element;
        this.target  = document.getElementById( element.dataset.target );

        this.togglerClickListener  = this.togglerClickListener.bind( this );
        this.documentClickListener = this.documentClickListener.bind( this );

        this.element.addEventListener( 'click', this.togglerClickListener );
    }

    show()
    {
        this.element.dataset.state = 'toggled';
        this.target.dataset.state  = 'toggled';
        document.addEventListener( 'click', this.documentClickListener );
    }

    hide()
    {
        this.element.removeAttribute( 'data-state' );
        this.target.removeAttribute( 'data-state' );
        document.removeEventListener( 'click', this.documentClickListener );
    }

    toggle()
    {
        if ( this.element.dataset.state == 'toggled' )
        {
            this.hide();
        }
        else
        {
            this.show();
        }
    }

    togglerClickListener() {
        this.toggle();
    }

    documentClickListener( event ) {
        if ( this.element !== event.target && ! this.element.contains( event.target ) && this.target !== event.target && ! this.target.contains( event.target ) )
        {
            this.hide();
        }
    }
}

document.querySelectorAll( '[data-action="toggle"' ).forEach( function( element ) {
    new Toggler( element );
});

