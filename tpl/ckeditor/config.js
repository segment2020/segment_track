/**
 * @license Copyright (c) 2003-2017, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	
	
	config.removePlugins = 'image';
	config.extraPlugins = 'lineutils';
	config.extraPlugins = 'dialog';
	config.extraPlugins = 'widget';
	config.extraPlugins = 'widgetselection';
	config.extraPlugins = 'image2';
	config.image2_alignClasses = [ 'image-left', 'image-center', 'image-right' ];
	// config.extraPlugins = 'youtube';
};
