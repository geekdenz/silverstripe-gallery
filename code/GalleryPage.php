<?php

class GalleryPage extends Page {
	static $db = array(
		'PreviewMax' => 'Int',
	);
	static $defaults = array(
		'PreviewMax' => 12,
	);
	public function getCMSFields() {
		$fields = parent::getCMSFields();
		$fields->addFieldToTab('Root.Main', TextField::create('PreviewMax'), 'Content');
		return $fields;
	}
	public function OrderedImagesLimited() {
		//$limit = $this->PreviewMax;
		//print_r($this->OrderedImages());
		return $this->OrderedImages()->limit($this->PreviewMax);
	}
}

class GalleryPage_Controller extends Page_Controller {
	
	public function init() {
		parent::init();
	}
}

class GalleryPage_Images extends DataObject {
	
	private static $db = array (
		'PageID' => 'Int',
		'ImageID' => 'Int',
		'Caption' => 'Text',
		'SortOrder' => 'Int'
	);
}
