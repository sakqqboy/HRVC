/**
 * @license Copyright (c) 2003-2021, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function(config) {
    // Define changes to default configuration here. For example:
    // config.language = 'fr';
    // config.uiColor = '#AADC6E';
    //config.extraPlugins = 'image2';
    config.image2_alignClasses = ['image-left', 'image-center', 'image-right'];
    config.image2_captionedClass = 'image-captioned';
    // config.image2_altRequired = true;
    // config.image2_captionedClass = 'captionedImage';
    // config.image2_disableResizer = false;
    //config.filebrowserBrowseUrl = '/browser/browse.php';
    //config.filebrowserImageUploadUrl = '/uploader/upload.php?type=Images';
    config.tabSpaces = 4;
    config.extraPlugins = 'image2';
    //config.filebrowserUploadUrl = 'http://localhost/wikiinvestment/frontend/web/news-update/default/upload-image';
    //config.imageUploadUrl = 'http://localhost/wikiinvestment/frontend/web/news-update/default/upload-image?type=Images';
    config.filebrowserUploadMethod = 'form';



};