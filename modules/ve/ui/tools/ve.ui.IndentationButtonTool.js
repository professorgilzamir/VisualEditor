/*!
 * VisualEditor UserInterface IndentationButtonTool class.
 *
 * @copyright 2011-2012 VisualEditor Team and others; see AUTHORS.txt
 * @license The MIT License (MIT); see LICENSE.txt
 */

/**
 * UserInterface intentation button tool.
 *
 * @abstract
 * @class
 * @extends ve.ui.ButtonTool
 * @constructor
 * @param {ve.ui.Toolbar} toolbar
 */
ve.ui.IndentationButtonTool = function VeUiIndentationButtonTool( toolbar ) {
	// Parent constructor
	ve.ui.ButtonTool.call( this, toolbar );
};

/* Inheritance */

ve.inheritClass( ve.ui.IndentationButtonTool, ve.ui.ButtonTool );

/* Static Properties */

/**
 * Indentation method the button applies.
 *
 * @abstract
 * @static
 * @property
 * @type {string}
 */
ve.ui.IndentationButtonTool.static.method = '';

/* Methods */

/**
 * Handle the button being clicked.
 *
 * @method
 */
ve.ui.IndentationButtonTool.prototype.onClick = function () {
	this.toolbar.getSurface().execute( 'indentation', this.constructor.static.method );
};

/**
 * Handle the toolbar state being updated.
 *
 * @method
 * @param {ve.dm.Node[]} nodes List of nodes covered by the current selection
 * @param {ve.AnnotationSet} full Annotations that cover all of the current selection
 * @param {ve.AnnotationSet} partial Annotations that cover some or all of the current selection
 */
ve.ui.IndentationButtonTool.prototype.onUpdateState = function ( nodes ) {
	var i, len,
		any = false;
	for ( i = 0, len = nodes.length; i < len; i++ ) {
		if ( nodes[i].hasMatchingAncestor( 'listItem' ) ) {
			any = true;
			break;
		}
	}
	this.setDisabled( !any );
};
