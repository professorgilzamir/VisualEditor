/*!
 * VisualEditor ContentEditable GeneratedContentNode class.
 *
 * @copyright 2011-2017 VisualEditor Team and others; see http://ve.mit-license.org
 */

/**
 * ContentEditable generated content node.
 *
 * @class
 * @abstract
 *
 * @constructor
 */
ve.ce.GeneratedContentNode = function VeCeGeneratedContentNode() {
	// Properties
	this.generatingPromise = null;
	this.generatedContentsInvalid = null;

	// Events
	this.model.connect( this, { update: 'onGeneratedContentNodeUpdate' } );
	this.connect( this, { teardown: 'abortGenerating' } );

	// Initialization
	this.update();
};

/* Inheritance */

OO.initClass( ve.ce.GeneratedContentNode );

/* Events */

/**
 * @event setup
 */

/**
 * @event teardown
 */

/**
 * @event rerender
 */

/* Static members */

// We handle rendering ourselves, no need to render attributes from originalDomElements
ve.ce.GeneratedContentNode.static.renderHtmlAttributes = false;

/* Abstract methods */

/**
 * Start a deferred process to generate the contents of the node.
 *
 * If successful, the returned promise must be resolved with the generated DOM elements passed
 * in as the first parameter, i.e. promise.resolve( domElements ); . Any other parameters to
 * .resolve() are ignored.
 *
 * If the returned promise object is abortable (has an .abort() method), .abort() will be called if
 * a newer update is started before the current update has finished. When a promise is aborted, it
 * should cease its work and shouldn't be resolved or rejected. If an outdated update's promise
 * is resolved or rejected anyway (which may happen if an aborted promise misbehaves, or if the
 * promise wasn't abortable), this is ignored and doneGenerating()/failGenerating() is not called.
 *
 * Additional data may be passed in the config object to instruct this function to render something
 * different than what's in the model. This data is implementation-specific and is passed through
 * by forceUpdate().
 *
 * @abstract
 * @method
 * @param {Object} [config] Optional additional data
 * @return {jQuery.Promise} Promise object, may be abortable
 */
ve.ce.GeneratedContentNode.prototype.generateContents = null;

/* Methods */

/**
 * Handler for the update event
 *
 * @param {boolean} staged Update happened in staging mode
 */
ve.ce.GeneratedContentNode.prototype.onGeneratedContentNodeUpdate = function ( staged ) {
	this.update( undefined, staged );
};

/**
 * Make an array of DOM elements suitable for rendering.
 *
 * Subclasses can override this to provide their own cleanup steps. This function takes an
 * array of DOM elements cloned within the source document and returns an array of DOM elements
 * cloned into the target document. If it's important that the DOM elements still be associated
 * with the original document, you should modify domElements before calling the parent
 * implementation, otherwise you should call the parent implementation first and modify its
 * return value.
 *
 * @param {HTMLElement[]} domElements Clones of the DOM elements from the store
 * @return {HTMLElement[]} Clones of the DOM elements in the right document, with modifications
 */
ve.ce.GeneratedContentNode.prototype.getRenderedDomElements = function ( domElements ) {
	var i, len, $rendering,
		doc = this.getElementDocument();

	// Clone the elements into the target document
	$rendering = $( ve.copyDomElements( domElements, doc ) );

	// Filter out link and style tags for bug 50043
	// Previously filtered out meta tags, but restore these as they
	// can be made visible.
	$rendering = $rendering.not( 'link, style' );
	// Also remove link and style tags nested inside other tags
	$rendering.find( 'link, style' ).remove();

	if ( $rendering.length ) {
		// Span wrap root text nodes so they can be measured
		for ( i = 0, len = $rendering.length; i < len; i++ ) {
			if ( $rendering[ i ].nodeType === Node.TEXT_NODE ) {
				$rendering[ i ] = $( '<span>' ).append( $rendering[ i ] )[ 0 ];
			}
		}
	} else {
		$rendering = $( '<span>' );
	}

	// Render the computed values of some attributes
	ve.resolveAttributes(
		$rendering.toArray(),
		domElements[ 0 ].ownerDocument,
		ve.dm.Converter.static.computedAttributes
	);

	return $rendering.toArray();
};

/**
 * Rerender the contents of this node.
 *
 * @param {Object|string|Array} generatedContents Generated contents, in the default case an HTMLElement array
 * @param {boolean} [staged] Update happened in staging mode
 * @fires setup
 * @fires teardown
 */
ve.ce.GeneratedContentNode.prototype.render = function ( generatedContents, staged ) {
	var $newElements;
	if ( this.live ) {
		this.emit( 'teardown' );
	}
	$newElements = $( this.getRenderedDomElements( ve.copyDomElements( generatedContents ) ) );
	this.generatedContentsInvalid = !this.validateGeneratedContents( $( generatedContents ) );
	if ( !staged || !this.generatedContentsInvalid ) {
		if ( !this.$element[ 0 ].parentNode ) {
			// this.$element hasn't been attached yet, so just overwrite it
			this.$element = $newElements;
		} else {
			// Switch out this.$element (which can contain multiple siblings) in place
			this.$element.first().replaceWith( $newElements );
			this.$element.remove();
			this.$element = $newElements;
		}
	} else {
		this.generatedContentsValid = false;
		this.model.emit( 'generatedContentsError', $newElements );
	}

	// Update focusable and resizable elements if necessary
	if ( this.$focusable ) {
		this.$focusable = this.getFocusableElement();
	}
	if ( this.$resizable ) {
		this.$resizable = this.getResizableElement();
	}

	if ( this.live ) {
		this.emit( 'setup' );
	}

	this.afterRender();
};

/**
 * Trigger rerender events after rendering the contents of the node.
 *
 * Nodes may override this method if the rerender event needs to be deferred (e.g. until images have loaded)
 *
 * @fires rerender
 */
ve.ce.GeneratedContentNode.prototype.afterRender = function () {
	this.emit( 'rerender' );
};

/**
 * Check whether the response HTML contains an error.
 *
 * The default implementation always returns true.
 *
 * @param {jQuery} $element The generated element
 * @return {boolean} There is no error
 */
ve.ce.GeneratedContentNode.prototype.validateGeneratedContents = function () {
	return true;
};

/**
 * Update the contents of this node based on the model and config data. If this combination of
 * model and config data has been rendered before, the cached rendering in the store will be used.
 *
 * @param {Object} [config] Optional additional data to pass to generateContents()
 * @param {boolean} [staged] Update happened in staging mode
 */
ve.ce.GeneratedContentNode.prototype.update = function ( config, staged ) {
	var store = this.model.doc.getStore(),
		contents = store.value( store.indexOfValue( null, OO.getHash( [ this.model.getHashObjectForRendering(), config ] ) ) );
	if ( contents ) {
		this.render( contents, staged );
	} else {
		this.forceUpdate( config, staged );
	}
};

/**
 * Force the contents to be updated. Like update(), but bypasses the store.
 *
 * @param {Object} [config] Optional additional data to pass to generateContents()
 * @param {boolean} [staged] Update happened in staging mode
 */
ve.ce.GeneratedContentNode.prototype.forceUpdate = function ( config, staged ) {
	var promise, node = this;

	if ( this.generatingPromise ) {
		// Abort the currently pending generation process if possible
		this.abortGenerating();
	} else {
		// Only call startGenerating if we weren't generating before
		this.startGenerating();
	}

	// Create a new promise
	promise = this.generatingPromise = this.generateContents( config );
	promise
		// If this promise is no longer the currently pending one, ignore it completely
		.done( function ( generatedContents ) {
			if ( node.generatingPromise === promise ) {
				node.doneGenerating( generatedContents, config, staged );
			}
		} )
		.fail( function () {
			if ( node.generatingPromise === promise ) {
				node.failGenerating();
			}
		} );
};

/**
 * Called when the node starts generating new content.
 *
 * This function is only called when the node wasn't already generating content. If a second update
 * comes in, this function will only be called if the first update has already finished (i.e.
 * doneGenerating or failGenerating has already been called).
 *
 * @method
 */
ve.ce.GeneratedContentNode.prototype.startGenerating = function () {
	this.$element.addClass( 've-ce-generatedContentNode-generating' );
};

/**
 * Abort the currently pending generation, if any, and remove the generating CSS class.
 *
 * This invokes .abort() on the pending promise if the promise has that method. It also ensures
 * that if the promise does get resolved or rejected later, this is ignored.
 */
ve.ce.GeneratedContentNode.prototype.abortGenerating = function () {
	var promise = this.generatingPromise;
	if ( promise ) {
		// Unset this.generatingPromise first so that if the promise is resolved or rejected
		// from within .abort(), this is ignored as it should be
		this.generatingPromise = null;
		if ( $.isFunction( promise.abort ) ) {
			promise.abort();
		}
	}
	this.$element.removeClass( 've-ce-generatedContentNode-generating' );
};

/**
 * Called when the node successfully finishes generating new content.
 *
 * @method
 * @param {Object|string|Array} generatedContents Generated contents
 * @param {Object} [config] Config object passed to forceUpdate()
 * @param {boolean} [staged] Update happened in staging mode
 */
ve.ce.GeneratedContentNode.prototype.doneGenerating = function ( generatedContents, config, staged ) {
	var store, hash;

	// Because doneGenerating is invoked asynchronously, the model node may have become detached
	// in the meantime. Handle this gracefully.
	if ( this.model && this.model.doc ) {
		store = this.model.doc.getStore();
		hash = OO.getHash( [ this.model.getHashObjectForRendering(), config ] );
		store.index( generatedContents, hash );
	}

	this.$element.removeClass( 've-ce-generatedContentNode-generating' );
	this.generatingPromise = null;
	this.render( generatedContents, staged );
};

/**
 * Called when the GeneratedContentNode has failed to generate new content.
 *
 * @method
 */
ve.ce.GeneratedContentNode.prototype.failGenerating = function () {
	this.$element.removeClass( 've-ce-generatedContentNode-generating' );
	this.generatingPromise = null;
};

/**
 * Check whether this GeneratedContentNode is currently generating new content.
 *
 * @return {boolean} Whether we're generating
 */
ve.ce.GeneratedContentNode.prototype.isGenerating = function () {
	return !!this.generatingPromise;
};

/**
 * Get the focusable element
 *
 * @return {jQuery} Focusable element
 */
ve.ce.GeneratedContentNode.prototype.getFocusableElement = function () {
	return this.$element;
};

/**
 * Get the resizable element
 *
 * @return {jQuery} Resizable element
 */
ve.ce.GeneratedContentNode.prototype.getResizableElement = function () {
	return this.$element;
};
