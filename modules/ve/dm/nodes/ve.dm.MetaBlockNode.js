/*!
 * VisualEditor DataModel MetaBlockNode class.
 *
 * @copyright 2011-2012 VisualEditor Team and others; see AUTHORS.txt
 * @license The MIT License (MIT); see LICENSE.txt
 */

/**
 * DataModel meta block node.
 *
 * @class
 * @extends ve.dm.BranchNode
 * @constructor
 * @param {number} [length] Length of content data in document
 * @param {Object} [element] Reference to element in linear model
 */
ve.dm.MetaBlockNode = function VeDmMetaBlockNode( length, element ) {
	// Parent constructor
	ve.dm.BranchNode.call( this, 'metaBlock', 0, element );
};

/* Inheritance */

ve.inheritClass( ve.dm.MetaBlockNode, ve.dm.LeafNode );

/* Static Properties */

/**
 * Node rules.
 *
 * @see ve.dm.NodeFactory
 * @static
 * @property
 */
ve.dm.MetaBlockNode.rules = {
	'isWrapped': true,
	'isContent': false,
	'canContainContent': false,
	'hasSignificantWhitespace': false,
	'childNodeTypes': [],
	'parentNodeTypes': null
};

/**
 * Node converters.
 *
 * @see ve.dm.Converter
 * @static
 * @property
 */
ve.dm.MetaBlockNode.converters = {
	'domElementTypes': ['meta', 'link'],
	'toDomElement': function ( type, element ) {
		var isLink, domElement;
		if ( element.attributes.style === 'comment' ) {
			domElement = document.createComment( element.attributes.text );
		} else {
			isLink = element.attributes.style === 'link';
			domElement = document.createElement( isLink ? 'link' : 'meta' );
			if ( element.attributes.key !== null ) {
				domElement.setAttribute( isLink ? 'rel' : 'property', element.attributes.key );
			}
			if ( element.attributes.value ) {
				domElement.setAttribute( isLink ? 'href' : 'content', element.attributes.value );
			}
		}
		return domElement;
	},
	'toDataElement': null // Special handling in ve.dm.Converter
};

/* Registration */

ve.dm.nodeFactory.register( 'metaBlock', ve.dm.MetaBlockNode );
