/*!
 * VisualEditor DataModel block image caption node class.
 *
 * @copyright 2011-2014 VisualEditor Team and others; see AUTHORS.txt
 * @license The MIT License (MIT); see LICENSE.txt
 */

/**
 * DataModel block image caption node.
 *
 * @class
 * @extends ve.dm.BranchNode
 *
 * @constructor
 * @param {Object} [element] Reference to element in linear model
 * @param {ve.dm.Node[]} [children]
 */
ve.dm.BlockImageCaptionNode = function VeDmBlockImageCaptionNode() {
	// Parent constructor
	ve.dm.BranchNode.apply( this, arguments );
};

OO.inheritClass( ve.dm.BlockImageCaptionNode, ve.dm.BranchNode );

ve.dm.BlockImageCaptionNode.static.name = 'imageCaption';

ve.dm.BlockImageCaptionNode.static.matchTagNames = [];

ve.dm.BlockImageCaptionNode.static.parentNodeTypes = [ 'blockImage' ];

ve.dm.BlockImageCaptionNode.static.toDomElements = function ( dataElement, doc ) {
	return [ doc.createElement( 'figcaption' ) ];
};

/* Registration */

ve.dm.modelRegistry.register( ve.dm.BlockImageCaptionNode );