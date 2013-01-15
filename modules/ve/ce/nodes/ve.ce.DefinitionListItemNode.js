/*!
 * VisualEditor ContentEditable DefinitionListItemNode class.
 *
 * @copyright 2011-2012 VisualEditor Team and others; see AUTHORS.txt
 * @license The MIT License (MIT); see LICENSE.txt
 */

/**
 * ContentEditable definition list item node.
 *
 * @class
 * @extends ve.ce.BranchNode
 * @constructor
 * @param {ve.dm.DefinitionListItemNode} model Model to observe
 */
ve.ce.DefinitionListItemNode = function VeCeDefinitionListItemNode( model ) {
	// Parent constructor
	ve.ce.BranchNode.call(
		this, 'definitionListItem', model, ve.ce.BranchNode.getDomWrapper( model, 'style' )
	);

	// Events
	this.model.addListenerMethod( this, 'update', 'onUpdate' );
};

/* Inheritance */

ve.inheritClass( ve.ce.DefinitionListItemNode, ve.ce.BranchNode );

/* Static Properties */

/**
 * Node rules.
 *
 * @see ve.ce.NodeFactory
 * @static
 * @property
 */
ve.ce.DefinitionListItemNode.rules = {
	'canBeSplit': false
};

/**
 * Mapping of list item style values and DOM wrapper element types.
 *
 * @static
 * @property
 */
ve.ce.DefinitionListItemNode.domWrapperElementTypes = {
	'definition': 'dd',
	'term': 'dt'
};

/* Methods */

/**
 * Handle model update events.
 *
 * If the style changed since last update the DOM wrapper will be replaced with an appropriate one.
 *
 * @method
 */
ve.ce.DefinitionListItemNode.prototype.onUpdate = function () {
	this.updateDomWrapper( 'style' );
};

/* Registration */

ve.ce.nodeFactory.register( 'definitionListItem', ve.ce.DefinitionListItemNode );
