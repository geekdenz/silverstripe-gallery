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
	public function OrderedImagesSizedDefaults() {
		$config = GalleryConfig::First();
		$width = $config->DefaultWidth;
		$limit = $config->DefaultNumberOfItems;
		return $this->OrderedImagesSized($width, $limit);
	}
	/*
	public function OrderedImagesIndividualSizes() {
		$config = SiteConfig::current_site_config();
		$width = $config->DefaultWidth;
		$limit = $config->DefaultNumberOfItems;
		$images = new ArrayList();
		foreach ($this->OrderedImages() as $image) {
			$w = !empty($image->DisplayWidth) ? $image->DisplayWidth : $width;
			$images->add($image);
		}
		return $images;
	}
	public function OrderedImagesSized($width = 1800, $limit = PHP_INT_MAX) {
		$images = new ArrayList();
		foreach ($this->OrderedImagesLimit($limit) as $image) {
			$images->add($image->setWidth($width));
		}
		return $images;
	}
	 * 
	 */
	public function OrderedImagesLimit($limit) {
		return $this->OrderedImages()->limit($limit);
	}
	public function OrderedImagesLimited() {
		return $this->OrderedImagesLimit($this->PreviewMax);
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
