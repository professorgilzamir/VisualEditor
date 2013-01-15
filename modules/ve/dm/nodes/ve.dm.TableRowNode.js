/*!
 * VisualEditor DataModel TableRowNode class.
 *
 * @copyright 2011-2012 VisualEditor Team and others; see AUTHORS.txt
 * @license The MIT License (MIT); see LICENSE.txt
 */

/**
 * DataModel table row node.
 *
 * @class
 * @extends ve.dm.BranchNode
 * @constructor
 * @param {ve.dm.BranchNode[]} [children] Child nodes to attach
 * @param {Object} [element] Reference to element in linear model
 */
ve.dm.TableRowNode = function VeDmTableRowNode( children, element ) {
	// Parent constructor
	ve.dm.BranchNode.call( this, 'tableRow', children, element );
};

/* Inheritance */

ve.inheritClass( ve.dm.TableRowNode, ve.dm.BranchNode );

/* Static Properties */

/**
 * Node rules.
 *
 * @see ve.dm.NodeFactory
 * @static
 * @property
 */
ve.dm.TableRowNode.rules = {
	'isWrapped': true,
	'isContent': false,
	'canContainContent': false,
	'hasSignificantWhitespace': false,
	'childNodeTypes': ['tableCell'],
	'parentNodeTypes': ['tableSection']
};

/**
 * Node converters.
 *
 * @see ve.dm.Converter
 * @static
 * @property
 */
ve.dm.TableRowNode.converters = {
	'domElementTypes': ['tr'],
	'toDomElement': function () {
		return document.createElement( 'tr' );
	},
	'toDataElement': function () {
		return {
			'type': 'tableRow'
		};
	}
};

/* Registration */

ve.dm.nodeFactory.register( 'tableRow', ve.dm.TableRowNode );