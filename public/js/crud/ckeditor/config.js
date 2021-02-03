/**
 * @license Copyright (c) 2003-2014, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */
CKEDITOR.editorConfig = function( config ) {

	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	//config.uiColor = '#AADC6E';
    config.skin= 'bootstrapck';
    config.height = '200px';
    config.toolbarCanCollapse = true;
    config.enterMode = CKEDITOR.ENTER_P;
    config.shiftEnterMode = CKEDITOR.ENTER_BR;
    config.autoParagraph = false;
    config.font_defaultLabel = "Arial";
    config.fontSize_defaultLabel = "15";
    config.fontSize_sizes = '8/8px;9/9px;10/10px;11/11px;12/12px;13/13px;14/14px;15/15px;16/16px;17/17px;18/18px;19/19px;20/20px;';

    config.extraPlugins="youtube";
    config.youtube_width = '640';
    config.youtube_height = '480';
    config.youtube_responsive = true;

    

};
