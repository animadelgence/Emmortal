/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
*/



/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here.
	// For complete reference see:
	// http://docs.ckeditor.com/#!/api/CKEDITOR.config

	// The toolbar groups arrangement, optimized for a single toolbar row.
	/*config.toolbarGroups = [
	   { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{name: "paragraph", items: [ "JustifyLeft", "JustifyCenter", "JustifyRight", "JustifyBlock"] },
		{ name: 'styles' },
		{ name: 'colors' },
		{ name: 'tools' },
		
	];
*/
	config.extraPlugins = "justify";
	config.toolbar_Basic =
        [
            ['Bold', 'Underline','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock', '-', 'Link', 'Unlink','-','Font','FontSize','TextColor','BGColor']
        ];
	
	config.removeButtons = 'Cut,Copy,Paste,Undo,Redo,Anchor,Strike,Subscript,Superscript,JustifyLeft,JustifyCenter,JustifyRight,JustifyBlock,Format';
	//config.extraPlugins = 'justify';
	// Dialog windows are also simplified.
	config.removeDialogTabs = 'link:advanced';
	config.format_tags = 'p;h1;h2;h3;pre';
	config.autoParagraph = false;
	//config.removePlugins = 'elementspath' ;
	config.allowedContent = true;
	
    config.fillEmptyBlocks = false;
	//CKEDITOR.disableAutoInline = true;
	//CKEDITOR.config.extraPlugins = 'justify';
	//CKEDITOR.inlineAll;

	/*config.extraAllowedContent = '*{*}';
    config.extraPlugins = 'uicolor';*/
	 //CKEDITOR.instances.ckeedit.destroy();//destroy the existing editor
	// CKEDITOR.inline('cke_toolbar', config);
	
};
