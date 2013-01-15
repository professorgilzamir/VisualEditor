/*!
 * VisualEditor ContentEditable TextNode class.
 *
 * @copyright 2011-2012 VisualEditor Team and others; see AUTHORS.txt
 * @license The MIT License (MIT); see LICENSE.txt
 */

/**
 * ContentEditable text node.
 *
 * @class
 * @extends ve.ce.LeafNode
 * @constructor
 * @param {ve.dm.TextNode} model Model to observe
 */
ve.ce.TextNode = function VeCeTextNode( model ) {
	// Parent constructor
	ve.ce.LeafNode.call( this, 'text', model ); // not using this.$
};

/* Inheritance */

ve.inheritClass( ve.ce.TextNode, ve.ce.LeafNode );

/* Static Properties */

/**
 * Node rules.
 *
 * @see ve.ce.NodeFactory
 * @static
 * @property
 */
ve.ce.TextNode.rules = {
	'canBeSplit': true
};

/**
 * Mapping of character and HTML entities or renderings.
 *
 * @static
 * @property
 */
ve.ce.TextNode.htmlCharacters = {
	'&': '&amp;',
	'<': '&lt;',
	'>': '&gt;',
	'\'': '&#039;',
	'"': '&quot;'
};

ve.ce.TextNode.whitespaceHtmlCharacters = {
	'\n': '&crarr;',
	'\t': '&#10142;'
};

/* Methods */

/**
 * Get an HTML rendering of the text.
 *
 * @method
 * @returns {Array} Array of rendered HTML fragments with annotations
 */
ve.ce.TextNode.prototype.getAnnotatedHtml = function () {
	var data = this.model.getDocument().getDataFromNode( this.model ),
		htmlChars = ve.ce.TextNode.htmlCharacters,
		whitespaceHtmlChars = ve.ce.TextNode.whitespaceHtmlCharacters,
		significantWhitespace = this.getModel().getParent().hasSignificantWhitespace(),
		i, chr, character, nextCharacter;

	function setChar( chr, index, data ) {
		if ( ve.isArray( data[index] ) ) {
			// Don't modify the original array, clone it first
			data[index] = data[index].slice( 0 );
			data[index][0] = chr;
		} else {
			data[index] = chr;
		}
	}

	if ( !significantWhitespace ) {
		// Replace spaces with &nbsp; where needed
		if ( data.length > 0 ) {
			// Leading space
			character = data[0];
			if ( ve.isArray( character ) ? character[0] === ' ' : character === ' ' ) {
				setChar( '&nbsp;', 0, data );
			}
		}
		if ( data.length > 1 ) {
			// Trailing space
			character = data[data.length - 1];
			if ( ve.isArray( character ) ? character[0] === ' ' : character === ' ' ) {
				setChar( '&nbsp;', data.length - 1, data );
			}
		}
		if ( data.length > 2 ) {
			// Replace any sequence of 2+ spaces with an alternating pattern
			// (space-nbsp-space-nbsp-...)
			for ( i = 1; i < data.length - 1; i++ ) { // TODO fold into loop below
				character = data[i];
				nextCharacter = data[i + 1];
				if (
					( ve.isArray( character ) ? character[0] === ' ' : character === ' ' ) &&
					( ve.isArray( nextCharacter ) ? nextCharacter[0] === ' ' : nextCharacter === ' ' )
				) {
					setChar( '&nbsp;', i + 1, data );
					i++;
				}
			}
		}
	}

	for ( i = 0; i < data.length; i++ ) {
		chr = typeof data[i] === 'string' ? data[i] : data[i][0];
		if ( !significantWhitespace && chr in whitespaceHtmlChars ) {
			chr = whitespaceHtmlChars[chr];
		}
		if ( chr in htmlChars ) {
			chr = htmlChars[chr];
		}
		setChar( chr, i, data );
	}
	return data;
};

/* Registration */

ve.ce.nodeFactory.register( 'text', ve.ce.TextNode );
