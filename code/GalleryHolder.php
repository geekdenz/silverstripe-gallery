<?php

class GalleryHolder extends Page {
	static $allowed_children = array(
		'GalleryPage',
	);
}

class GalleryHolder_Controller extends Page_Controller {
	public function init() {
		parent::init();
		Requirements::javascript(THIRDPARTY_DIR . '/jquery/jquery.js'); 

		Requirements::combine_files('fancebox2.js', array(
			'gallery/javascript/fancybox2/jquery.fancybox.js',
			'gallery/javascript/fancybox2/GalleryPage.js',
		));
		Requirements::css('gallery/css/fancybox2/jquery.fancybox.css');
	}
}
