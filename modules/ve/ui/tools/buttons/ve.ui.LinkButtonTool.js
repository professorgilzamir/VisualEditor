/*!
 * VisualEditor UserInterface LinkButtonTool class.
 *
 * @copyright 2011-2012 VisualEditor Team and others; see AUTHORS.txt
 * @license The MIT License (MIT); see LICENSE.txt
 */

/**
 * UserInterface link button tool.
 *
 * @class
 * @extends ve.ui.InspectorButtonTool
 * @constructor
 * @param {ve.ui.Toolbar} toolbar
 */
ve.ui.LinkButtonTool = function VeUiLinkButtonTool( toolbar ) {
	// Parent constructor
	ve.ui.InspectorButtonTool.call( this, toolbar );
};

/* Inheritance */

ve.inheritClass( ve.ui.LinkButtonTool, ve.ui.InspectorButtonTool );

/* Static Properties */

ve.ui.LinkButtonTool.static.name = 'link';

ve.ui.LinkButtonTool.static.titleMessage = 'visualeditor-annotationbutton-link-tooltip';

ve.ui.LinkButtonTool.static.inspector = 'link';

/* Registration */

ve.ui.toolFactory.register( 'link', ve.ui.LinkButtonTool );
