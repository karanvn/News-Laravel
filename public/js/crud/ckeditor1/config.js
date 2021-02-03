/**
 * @license Copyright (c) 2003-2020, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
    // config.uiColor = '#AADC6E';
    config.skin= 'moono-lisa';
    config.height = '250px';
    config.enterMode = CKEDITOR.ENTER_P;
    config.shiftEnterMode = CKEDITOR.ENTER_BR
    config.autoParagraph = false;
    config.font_defaultLabel = "Arial";
    config.fontSize_defaultLabel = "15";
    config.fontSize_sizes = '8/8px;9/9px;10/10px;11/11px;12/12px;13/13px;14/14px;15/15px;16/16px;17/17px;18/18px;19/19px;20/20px;';

    config.extraPlugins = 'youtube';
    config.youtube_width = '640';
    config.youtube_height = '480';
    config.youtube_responsive = true;
    config.youtube_controls = true;

    /*config.skin= 'bootstrapck';
    config.height = '200px';
    config.enterMode = CKEDITOR.ENTER_P;
    config.shiftEnterMode = CKEDITOR.ENTER_BR
    config.autoParagraph = false;
    config.font_defaultLabel = "Arial";
    config.fontSize_defaultLabel = "15";
    config.fontSize_sizes = '8/8px;9/9px;10/10px;11/11px;12/12px;13/13px;14/14px;15/15px;16/16px;17/17px;18/18px;19/19px;20/20px;';

    config.extraPlugins = 'youtube';
    config.youtube_width = '640';
    config.youtube_height = '480';
    config.youtube_responsive = true;*/
};
