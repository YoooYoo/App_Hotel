/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
  var baseHref = document.getElementsByTagName('base')[0].href

	 config.language = 'en';
	 config.uiColor = '#E8E8E8';
     config.toolbar = [
    [ 'Source', '-', 'Bold', 'Italic', 'Underline', 'Strike', 'Format', 'Styles' ],
    ['NumberedList', 'BulletedList', 'Outdent', 'Indent', 'Blockquote'],
    ['Image', 'Link', 'Unlink', 'Anchor', 'Table', 'HorizontalRule', 'SpecialChar', 'Maximize'],
    ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo', 'Find', 'Replace', '-', 'SelectAll', '-', 'SpellChecker', 'Scayt']
];
    config.filebrowserBrowseUrl = baseHref+'assets/include/kcfinder/browse.php?type=files';
    config.filebrowserImageBrowseUrl = baseHref+'assets/include/kcfinder/browse.php?type=images';

};
