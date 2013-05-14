/*!
 * VisualEditor ContentEditable MWEntityNode class.
 *
 * @copyright 2011-2013 VisualEditor Team and others; see AUTHORS.txt
 * @license The MIT License (MIT); see LICENSE.txt
 */

/**
 * ContentEditable MediaWiki image node.
 *
 * @class
 * @extends ve.ce.ImageNode
 *
 * @constructor
 * @param {ve.dm.MWInlineImageNode} model Model to observe
 * @param {Object} [config] Config options
 */
 ve.ce.MWInlineImageNode = function VeCeMWInlineImageNode( model, config ) {
	// Parent constructor
	ve.ce.ImageNode.call( this, model, config );

	// Properties
	this.$ = $( '<' + ( model.getAttribute( 'isLinked' ) ? 'a' : 'span' ) + '>' );

	// Initialization
	this.$
		.attr( 'contenteditable', false )
		.addClass( 've-ce-mwInlineImageNode' )
		.append( this.$image )
		.data( 'view', this.$image.data( 'view' ) );
	this.onUpdate();
};

/* Inheritance */

ve.inheritClass( ve.ce.MWInlineImageNode, ve.ce.ImageNode );

/* Static Properties */

ve.ce.MWInlineImageNode.static.name = 'MWinlineimage';

ve.ce.MWInlineImageNode.static.tagName = 'span';

/* Registration */

ve.ce.nodeFactory.register( ve.ce.MWInlineImageNode );
