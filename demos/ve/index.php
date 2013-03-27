<?php
/**
 * VisualEditor standalone demo
 *
 * @file
 * @ingroup Extensions
 * @copyright 2011-2013 VisualEditor Team and others; see AUTHORS.txt
 * @license The MIT License (MIT); see LICENSE.txt
 */

$path = __DIR__ . '/pages';
$pages = glob( $path . '/*.html' );
$page = current( $pages );
if ( isset( $_GET['page'] ) && in_array( $path . '/' . $_GET['page'] . '.html', $pages ) ) {
	$page =  $path . '/' . $_GET['page'] . '.html';
}
$html = file_get_contents( $page );

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>VisualEditor Standalone Demo</title>

		<!-- Generated by makeStaticLoader.php -->
		<!-- Standalone Init -->
		<link rel=stylesheet href="../../modules/ve/init/sa/styles/ve.init.sa.css">
		<script>
			if ( window.devicePixelRatio > 1 ) {
				document.write( '<link rel="stylesheet" href="../../modules/ve/ui/styles/ve.ui.Icons-vector.css">' );
			} else {
				document.write( '<link rel="stylesheet" href="../../modules/ve/ui/styles/ve.ui.Icons-raster.css">' );
			}
		</script>
		<!-- ext.visualEditor.core -->
		<link rel=stylesheet href="../../modules/ve/styles/ve.Surface.css">
		<link rel=stylesheet href="../../modules/ve/ce/styles/ve.ce.DocumentNode.css">
		<link rel=stylesheet href="../../modules/ve/ce/styles/ve.ce.Node.css">
		<link rel=stylesheet href="../../modules/ve/ce/styles/ve.ce.Surface.css">
		<link rel=stylesheet href="../../modules/ve/ui/styles/ve.ui.Context.css">
		<link rel=stylesheet href="../../modules/ve/ui/styles/ve.ui.Frame.css">
		<link rel=stylesheet href="../../modules/ve/ui/styles/ve.ui.Window.css">
		<link rel=stylesheet href="../../modules/ve/ui/styles/ve.ui.Dialog.css">
		<link rel=stylesheet href="../../modules/ve/ui/styles/ve.ui.Inspector.css">
		<link rel=stylesheet href="../../modules/ve/ui/styles/ve.ui.Toolbar.css">
		<link rel=stylesheet href="../../modules/ve/ui/styles/ve.ui.Tool.css">
		<link rel=stylesheet href="../../modules/ve/ui/styles/ve.ui.Layout.css">
		<link rel=stylesheet href="../../modules/ve/ui/styles/ve.ui.Widget.css">

		<!-- demo -->
		<link rel="stylesheet" href="demo.css">
	</head>
	<body>
		<ul class="ve-demo-docs">
			<?php foreach( $pages as $page ): ?>
				<li>
					<a href="./?page=<?php echo basename( $page, '.html' ); ?>">
						<?php echo basename( $page, '.html' ); ?>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
		<div class="ve-demo-editor"></div>

		<!-- Generated by makeStaticLoader.php -->
		<!-- Dependencies -->
		<script src="../../modules/jquery/jquery.js"></script>
		<script src="../../modules/rangy/rangy-core.js"></script>
		<script src="../../modules/rangy/rangy-position.js"></script>
		<script src="../../modules/unicodejs/unicodejs.js"></script>
		<script src="../../modules/unicodejs/unicodejs.textstring.js"></script>
		<script src="../../modules/unicodejs/unicodejs.wordbreak.groups.js"></script>
		<script src="../../modules/unicodejs/unicodejs.wordbreak.js"></script>
		<!-- ext.visualEditor.base -->
		<script src="../../modules/ve/ve.js"></script>
		<script src="../../modules/ve/ve.EventEmitter.js"></script>
		<script src="../../modules/ve/init/ve.init.js"></script>
		<script src="../../modules/ve/init/ve.init.Platform.js"></script>
		<script src="../../modules/ve/init/ve.init.Target.js"></script>
		<script src="../../modules/ve/ve.debug.js"></script>
		<!-- Standalone Init -->
		<script src="../../modules/ve/init/sa/ve.init.sa.js"></script>
		<script src="../../modules/ve/init/sa/ve.init.sa.Platform.js"></script>
		<script src="../../modules/ve/init/sa/ve.init.sa.Target.js"></script>
		<script>
			<?php
				require( '../../modules/../VisualEditor.i18n.php' );
				echo 've.init.platform.addMessages( ' . json_encode( $messages['en'] ) . ');' . "\n";
			?>
			ve.init.platform.setModulesUrl( '../../modules/' );
		</script>
		<!-- ext.visualEditor.core -->
		<script src="../../modules/ve/ve.Registry.js"></script>
		<script src="../../modules/ve/ve.Factory.js"></script>
		<script src="../../modules/ve/ve.Trigger.js"></script>
		<script src="../../modules/ve/ve.CommandRegistry.js"></script>
		<script src="../../modules/ve/ve.TriggerRegistry.js"></script>
		<script src="../../modules/ve/ve.Range.js"></script>
		<script src="../../modules/ve/ve.Node.js"></script>
		<script src="../../modules/ve/ve.NodeFactory.js"></script>
		<script src="../../modules/ve/ve.BranchNode.js"></script>
		<script src="../../modules/ve/ve.LeafNode.js"></script>
		<script src="../../modules/ve/ve.Surface.js"></script>
		<script src="../../modules/ve/ve.Document.js"></script>
		<script src="../../modules/ve/ve.OrderedHashSet.js"></script>
		<script src="../../modules/ve/ve.AnnotationSet.js"></script>
		<script src="../../modules/ve/ve.Action.js"></script>
		<script src="../../modules/ve/ve.ActionFactory.js"></script>
		<script src="../../modules/ve/actions/ve.AnnotationAction.js"></script>
		<script src="../../modules/ve/actions/ve.ContentAction.js"></script>
		<script src="../../modules/ve/actions/ve.FormatAction.js"></script>
		<script src="../../modules/ve/actions/ve.HistoryAction.js"></script>
		<script src="../../modules/ve/actions/ve.IndentationAction.js"></script>
		<script src="../../modules/ve/actions/ve.InspectorAction.js"></script>
		<script src="../../modules/ve/actions/ve.ListAction.js"></script>
		<script src="../../modules/ve/dm/ve.dm.js"></script>
		<script src="../../modules/ve/dm/ve.dm.ModelRegistry.js"></script>
		<script src="../../modules/ve/dm/ve.dm.NodeFactory.js"></script>
		<script src="../../modules/ve/dm/ve.dm.AnnotationFactory.js"></script>
		<script src="../../modules/ve/dm/ve.dm.MetaItemFactory.js"></script>
		<script src="../../modules/ve/dm/ve.dm.Node.js"></script>
		<script src="../../modules/ve/dm/ve.dm.BranchNode.js"></script>
		<script src="../../modules/ve/dm/ve.dm.LeafNode.js"></script>
		<script src="../../modules/ve/dm/ve.dm.Annotation.js"></script>
		<script src="../../modules/ve/dm/ve.dm.MetaItem.js"></script>
		<script src="../../modules/ve/dm/ve.dm.MetaList.js"></script>
		<script src="../../modules/ve/dm/ve.dm.TransactionProcessor.js"></script>
		<script src="../../modules/ve/dm/ve.dm.Transaction.js"></script>
		<script src="../../modules/ve/dm/ve.dm.Surface.js"></script>
		<script src="../../modules/ve/dm/ve.dm.SurfaceFragment.js"></script>
		<script src="../../modules/ve/dm/ve.dm.DataString.js"></script>
		<script src="../../modules/ve/dm/ve.dm.Document.js"></script>
		<script src="../../modules/ve/dm/ve.dm.DocumentSlice.js"></script>
		<script src="../../modules/ve/dm/ve.dm.DocumentSynchronizer.js"></script>
		<script src="../../modules/ve/dm/ve.dm.Converter.js"></script>
		<script src="../../modules/ve/dm/nodes/ve.dm.AlienNode.js"></script>
		<script src="../../modules/ve/dm/nodes/ve.dm.BreakNode.js"></script>
		<script src="../../modules/ve/dm/nodes/ve.dm.CenterNode.js"></script>
		<script src="../../modules/ve/dm/nodes/ve.dm.DefinitionListItemNode.js"></script>
		<script src="../../modules/ve/dm/nodes/ve.dm.DefinitionListNode.js"></script>
		<script src="../../modules/ve/dm/nodes/ve.dm.DocumentNode.js"></script>
		<script src="../../modules/ve/dm/nodes/ve.dm.HeadingNode.js"></script>
		<script src="../../modules/ve/dm/nodes/ve.dm.ImageNode.js"></script>
		<script src="../../modules/ve/dm/nodes/ve.dm.ListItemNode.js"></script>
		<script src="../../modules/ve/dm/nodes/ve.dm.ListNode.js"></script>
		<script src="../../modules/ve/dm/nodes/ve.dm.ParagraphNode.js"></script>
		<script src="../../modules/ve/dm/nodes/ve.dm.PreformattedNode.js"></script>
		<script src="../../modules/ve/dm/nodes/ve.dm.TableCellNode.js"></script>
		<script src="../../modules/ve/dm/nodes/ve.dm.TableNode.js"></script>
		<script src="../../modules/ve/dm/nodes/ve.dm.TableRowNode.js"></script>
		<script src="../../modules/ve/dm/nodes/ve.dm.TableSectionNode.js"></script>
		<script src="../../modules/ve/dm/nodes/ve.dm.TextNode.js"></script>
		<script src="../../modules/ve/dm/nodes/ve.dm.MWEntityNode.js"></script>
		<script src="../../modules/ve/dm/nodes/ve.dm.MWHeadingNode.js"></script>
		<script src="../../modules/ve/dm/nodes/ve.dm.MWPreformattedNode.js"></script>
		<script src="../../modules/ve/dm/nodes/ve.dm.MWImageNode.js"></script>
		<script src="../../modules/ve/dm/annotations/ve.dm.LinkAnnotation.js"></script>
		<script src="../../modules/ve/dm/annotations/ve.dm.MWExternalLinkAnnotation.js"></script>
		<script src="../../modules/ve/dm/annotations/ve.dm.MWInternalLinkAnnotation.js"></script>
		<script src="../../modules/ve/dm/annotations/ve.dm.TextStyleAnnotation.js"></script>
		<script src="../../modules/ve/dm/metaitems/ve.dm.AlienMetaItem.js"></script>
		<script src="../../modules/ve/dm/metaitems/ve.dm.MWAlienMetaItem.js"></script>
		<script src="../../modules/ve/dm/metaitems/ve.dm.MWCategoryMetaItem.js"></script>
		<script src="../../modules/ve/dm/metaitems/ve.dm.MWLanguageMetaItem.js"></script>
		<script src="../../modules/ve/ce/ve.ce.js"></script>
		<script src="../../modules/ve/ce/ve.ce.DomRange.js"></script>
		<script src="../../modules/ve/ce/ve.ce.NodeFactory.js"></script>
		<script src="../../modules/ve/ce/ve.ce.Document.js"></script>
		<script src="../../modules/ve/ce/ve.ce.Node.js"></script>
		<script src="../../modules/ve/ce/ve.ce.BranchNode.js"></script>
		<script src="../../modules/ve/ce/ve.ce.ContentBranchNode.js"></script>
		<script src="../../modules/ve/ce/ve.ce.LeafNode.js"></script>
		<script src="../../modules/ve/ce/ve.ce.Surface.js"></script>
		<script src="../../modules/ve/ce/ve.ce.SurfaceObserver.js"></script>
		<script src="../../modules/ve/ce/nodes/ve.ce.AlienNode.js"></script>
		<script src="../../modules/ve/ce/nodes/ve.ce.AlienInlineNode.js"></script>
		<script src="../../modules/ve/ce/nodes/ve.ce.AlienBlockNode.js"></script>
		<script src="../../modules/ve/ce/nodes/ve.ce.BreakNode.js"></script>
		<script src="../../modules/ve/ce/nodes/ve.ce.CenterNode.js"></script>
		<script src="../../modules/ve/ce/nodes/ve.ce.DefinitionListItemNode.js"></script>
		<script src="../../modules/ve/ce/nodes/ve.ce.DefinitionListNode.js"></script>
		<script src="../../modules/ve/ce/nodes/ve.ce.DocumentNode.js"></script>
		<script src="../../modules/ve/ce/nodes/ve.ce.HeadingNode.js"></script>
		<script src="../../modules/ve/ce/nodes/ve.ce.ImageNode.js"></script>
		<script src="../../modules/ve/ce/nodes/ve.ce.ListItemNode.js"></script>
		<script src="../../modules/ve/ce/nodes/ve.ce.ListNode.js"></script>
		<script src="../../modules/ve/ce/nodes/ve.ce.ParagraphNode.js"></script>
		<script src="../../modules/ve/ce/nodes/ve.ce.PreformattedNode.js"></script>
		<script src="../../modules/ve/ce/nodes/ve.ce.TableCellNode.js"></script>
		<script src="../../modules/ve/ce/nodes/ve.ce.TableNode.js"></script>
		<script src="../../modules/ve/ce/nodes/ve.ce.TableRowNode.js"></script>
		<script src="../../modules/ve/ce/nodes/ve.ce.TableSectionNode.js"></script>
		<script src="../../modules/ve/ce/nodes/ve.ce.TextNode.js"></script>
		<script src="../../modules/ve/ce/nodes/ve.ce.MWEntityNode.js"></script>
		<script src="../../modules/ve/ce/nodes/ve.ce.MWHeadingNode.js"></script>
		<script src="../../modules/ve/ce/nodes/ve.ce.MWPreformattedNode.js"></script>
		<script src="../../modules/ve/ce/nodes/ve.ce.MWImageNode.js"></script>
		<script src="../../modules/ve/ui/ve.ui.js"></script>
		<script src="../../modules/ve/ui/ve.ui.Context.js"></script>
		<script src="../../modules/ve/ui/ve.ui.Frame.js"></script>
		<script src="../../modules/ve/ui/ve.ui.Window.js"></script>
		<script src="../../modules/ve/ui/ve.ui.WindowSet.js"></script>
		<script src="../../modules/ve/ui/ve.ui.Inspector.js"></script>
		<script src="../../modules/ve/ui/ve.ui.InspectorFactory.js"></script>
		<script src="../../modules/ve/ui/ve.ui.Dialog.js"></script>
		<script src="../../modules/ve/ui/ve.ui.DialogFactory.js"></script>
		<script src="../../modules/ve/ui/ve.ui.Element.js"></script>
		<script src="../../modules/ve/ui/ve.ui.Layout.js"></script>
		<script src="../../modules/ve/ui/ve.ui.Widget.js"></script>
		<script src="../../modules/ve/ui/ve.ui.Tool.js"></script>
		<script src="../../modules/ve/ui/ve.ui.Toolbar.js"></script>
		<script src="../../modules/ve/ui/ve.ui.ToolFactory.js"></script>
		<script src="../../modules/ve/ui/widgets/ve.ui.LabeledWidget.js"></script>
		<script src="../../modules/ve/ui/widgets/ve.ui.FlaggableWidget.js"></script>
		<script src="../../modules/ve/ui/widgets/ve.ui.PopupWidget.js"></script>
		<script src="../../modules/ve/ui/widgets/ve.ui.GroupWidget.js"></script>
		<script src="../../modules/ve/ui/widgets/ve.ui.SelectWidget.js"></script>
		<script src="../../modules/ve/ui/widgets/ve.ui.OptionWidget.js"></script>
		<script src="../../modules/ve/ui/widgets/ve.ui.ButtonWidget.js"></script>
		<script src="../../modules/ve/ui/widgets/ve.ui.IconButtonWidget.js"></script>
		<script src="../../modules/ve/ui/widgets/ve.ui.InputWidget.js"></script>
		<script src="../../modules/ve/ui/widgets/ve.ui.InputLabelWidget.js"></script>
		<script src="../../modules/ve/ui/widgets/ve.ui.TextInputWidget.js"></script>
		<script src="../../modules/ve/ui/widgets/ve.ui.OutlineItemWidget.js"></script>
		<script src="../../modules/ve/ui/widgets/ve.ui.OutlineWidget.js"></script>
		<script src="../../modules/ve/ui/widgets/ve.ui.MenuItemWidget.js"></script>
		<script src="../../modules/ve/ui/widgets/ve.ui.MenuSectionItemWidget.js"></script>
		<script src="../../modules/ve/ui/widgets/ve.ui.MenuWidget.js"></script>
		<script src="../../modules/ve/ui/widgets/ve.ui.TextInputMenuWidget.js"></script>
		<script src="../../modules/ve/ui/widgets/ve.ui.LinkTargetInputWidget.js"></script>
		<script src="../../modules/ve/ui/widgets/ve.ui.MWLinkTargetInputWidget.js"></script>
		<script src="../../modules/ve/ui/layouts/ve.ui.GridLayout.js"></script>
		<script src="../../modules/ve/ui/layouts/ve.ui.PanelLayout.js"></script>
		<script src="../../modules/ve/ui/layouts/panels/ve.ui.TitledPanelLayout.js"></script>
		<script src="../../modules/ve/ui/layouts/panels/ve.ui.EditorPanelLayout.js"></script>
		<script src="../../modules/ve/ui/dialogs/ve.ui.ContentDialog.js"></script>
		<script src="../../modules/ve/ui/dialogs/ve.ui.MetaDialog.js"></script>
		<script src="../../modules/ve/ui/tools/ve.ui.ButtonTool.js"></script>
		<script src="../../modules/ve/ui/tools/ve.ui.AnnotationButtonTool.js"></script>
		<script src="../../modules/ve/ui/tools/ve.ui.InspectorButtonTool.js"></script>
		<script src="../../modules/ve/ui/tools/ve.ui.IndentationButtonTool.js"></script>
		<script src="../../modules/ve/ui/tools/ve.ui.ListButtonTool.js"></script>
		<script src="../../modules/ve/ui/tools/ve.ui.DropdownTool.js"></script>
		<script src="../../modules/ve/ui/tools/buttons/ve.ui.BoldButtonTool.js"></script>
		<script src="../../modules/ve/ui/tools/buttons/ve.ui.ItalicButtonTool.js"></script>
		<script src="../../modules/ve/ui/tools/buttons/ve.ui.ClearButtonTool.js"></script>
		<script src="../../modules/ve/ui/tools/buttons/ve.ui.LinkButtonTool.js"></script>
		<script src="../../modules/ve/ui/tools/buttons/ve.ui.MWLinkButtonTool.js"></script>
		<script src="../../modules/ve/ui/tools/buttons/ve.ui.BulletButtonTool.js"></script>
		<script src="../../modules/ve/ui/tools/buttons/ve.ui.NumberButtonTool.js"></script>
		<script src="../../modules/ve/ui/tools/buttons/ve.ui.IndentButtonTool.js"></script>
		<script src="../../modules/ve/ui/tools/buttons/ve.ui.OutdentButtonTool.js"></script>
		<script src="../../modules/ve/ui/tools/buttons/ve.ui.RedoButtonTool.js"></script>
		<script src="../../modules/ve/ui/tools/buttons/ve.ui.UndoButtonTool.js"></script>
		<script src="../../modules/ve/ui/tools/dropdowns/ve.ui.FormatDropdownTool.js"></script>
		<script src="../../modules/ve/ui/tools/dropdowns/ve.ui.MWFormatDropdownTool.js"></script>
		<script src="../../modules/ve/ui/inspectors/ve.ui.LinkInspector.js"></script>
		<script src="../../modules/ve/ui/inspectors/ve.ui.MWLinkInspector.js"></script>

		<!-- demo -->
		<script>
			$( document ).ready( function () {
				new ve.Surface(
					new ve.init.sa.Target( $( '.ve-demo-editor' ) ),
					ve.createDocumentFromHTML( <?php echo json_encode( $html ) ?> )
				);
				$( '.ve-ce-documentNode' ).focus();
				ve.instances[0].dialogs.open( 'meta' );
			} );
		</script>

		<div class="ve-demo-utilities">
			<p>
				<div class="ve-demo-utilities-commands"></div>
			</p>
			<table id="ve-dump" class="ve-demo-dump">
				<thead>
					<th>Linear model</th>
					<th>View tree</th>
					<th>Model tree</th>
				</thead>
				<tbody>
					<tr>
						<td width="30%" id="ve-linear-model-dump"></td>
						<td id="ve-view-tree-dump" style="vertical-align: top;"></td>
						<td id="ve-model-tree-dump" style="vertical-align: top;"></td>
					</tr>
				</tbody>
			</table>
		</div>

		<script>
		$( function () {

			// Widgets
			var startTextInput = new ve.ui.TextInputWidget( { 'readOnly': true } ),
				endTextInput = new ve.ui.TextInputWidget( { 'readOnly': true } ),
				startTextInputLabel = new ve.ui.InputLabelWidget(
					{ 'label': 'Start', 'input': startTextInput }
				),
				endTextInputLabel = new ve.ui.InputLabelWidget(
					{ 'label': 'End', 'input': endTextInput }
				),
				getRangeButton = new ve.ui.ButtonWidget( { 'label': 'Get selected range' } ),
				logRangeButton = new ve.ui.ButtonWidget(
					{ 'label': 'Log to console', 'disabled': true }
				),
				dumpModelButton = new ve.ui.ButtonWidget( { 'label': 'Dump model' } ),
				validateButton = new ve.ui.ButtonWidget( { 'label': 'Validate view and model' } );

			// Initialization
			$( '.ve-demo-utilities-commands' ).append(
				getRangeButton.$,
				startTextInputLabel.$,
				startTextInput.$,
				endTextInputLabel.$,
				endTextInput.$,
				logRangeButton.$,
				$( '<span class="ve-demo-utilities-commands-divider">&nbsp;</span>' ),
				dumpModelButton.$,
				validateButton.$
			);

			// Events
			getRangeButton.on( 'click', function () {
				var range = ve.instances[0].view.model.getSelection();
				startTextInput.setValue( range.start );
				endTextInput.setValue( range.end );
				logRangeButton.setDisabled( false );
			} );
			logRangeButton.on( 'click', function () {
				var	start = startTextInput.getValue(),
					end = endTextInput.getValue();
				// TODO: Validate input
				console.dir( ve.instances[0].view.documentView.model.data.slice( start, end ) );
			} );
			dumpModelButton.on( 'click', function () {
				// linear model dump
				var $ol = $('<ol start="0"></ol>'),
					$li,
					element,
					html,
					annotations;

				for ( var i = 0; i < ve.instances[0].documentModel.data.length; i++ ) {
					$li = $('<li>');
					$label = $( '<span>' );
					element = ve.instances[0].documentModel.data[i];
					if ( element.type ) {
						$label.addClass( 've-demo-dump-element' );
						text = element.type;
						annotations = element.annotations;
					} else if ( element.length > 1 ){
						$label.addClass( 've-demo-dump-achar' );
						text = element[0];
						annotations = element[1];
					} else {
						$label.addClass( 've-demo-dump-char' );
						text = element;
						annotations = undefined;
					}
					$label.html( ( text.match( /\S/ ) ? text : '&nbsp;' ) + ' ' );
					if ( annotations ) {
						$label.append(
							$( '<span>' ).text(
								'[' + annotations.get().map( function( ann ) {
									return ann.name;
								} ).join(', ') + ']'
							)
						);
					}

					$li.append( $label );
					$ol.append( $li );
				}
				$('#ve-linear-model-dump').html($ol);

				// tree dump
				var getKids = function ( obj ) {
					var $ol = $('<ol start="0"></ol>'),
						$li;
					for( var i = 0; i < obj.children.length; i++ ) {
						$li = $('<li>');
						$label = $( '<span>' ).addClass( 've-demo-dump-element' );
						if ( obj.children[i].length !== undefined ) {
							$li.append(
								$label
									.text( obj.children[i].type )
									.append(
										$( '<span>' ).text( ' (' + obj.children[i].length + ')' )
									)
							);
						} else {
							$li.append( $label.text( obj.children[i].type ) );
						}

						if ( obj.children[i].children ) {
							$li.append(getKids(obj.children[i]));
						}


						$ol.append($li);
					}
					return $ol;
				}
				$('#ve-model-tree-dump').html(getKids(ve.instances[0].documentModel.documentNode));
				$('#ve-view-tree-dump').html(getKids(ve.instances[0].view.documentView.documentNode));
				$('#ve-dump').show();
			} );
			validateButton.on( 'click', function () {
				var failed = false;
				$('.ve-ce-branchNode').each( function ( index, element ) {
					var	$element = $( element ),
						view = $element.data( 'node' );
					if ( view.canContainContent() ) {
						var nodeRange = view.model.getRange();
						var textModel = ve.instances[0].view.model.getDocument().getText( nodeRange );
						var textDom = ve.ce.getDomText( view.$[0] );
						if ( textModel !== textDom ) {
							failed = true;
							console.log('Inconsistent data', {
								'textModel' : textModel,
								'textDom' : textDom,
								'element' : element
							} );
						}
					}
				});
				if ( failed ) {
					alert( 'Not valid - check JS console for details' );
				} else {
					alert( 'Valid' );
				}
			} );
		} );
		</script>
	</body>
</html>
