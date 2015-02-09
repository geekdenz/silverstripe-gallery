<?php

class Gallery_PageExtension extends DataExtension {

	private static $many_many = array(
		'Images' => 'Image'	
	);
	
	public function updateCMSFields(FieldList $fields) {

		$fields->addFieldToTab('Root.Gallery', GalleryUploadField::create(
			'Images',
			'',
			$this->owner->OrderedImages()
		));
	}
	
	public function OrderedImages() {

		list($parentClass, $componentClass, $parentField, $componentField, $table) = $this->owner->many_many('Images');

		return $this->owner->getManyManyComponents(
			'Images',
			'',
			"\"{$table}\".\"SortOrder\" ASC"
		);
	}
}

class Gallery_ImageExtension extends DataExtension {

	static $db = array(
		'DisplayWidth' => 'Int',
		'PreviewWidth' => 'Int',
		'PreviewHeight' => 'Int',
	);
	static $defaults = array(
		'DisplayWidth' => -1,
		'PreviewWidth' => 250,
		'PreviewHeight' => 250,
	);
	private static $belongs_many_many = array(
		'Pages' => 'Page',
	);
	
	public function getUploadFields() {

		$fields = $this->owner->getCMSFields();

		$fileAttributes = $fields->fieldByName('Root.Main.FilePreview')->fieldByName('FilePreviewData');
		$fileAttributes->push(TextareaField::create('Caption', 'Caption:')->setRows(4));
		$fileAttributes->push(TextField::create('DisplayWidth', 'Display Width:'));
		$fileAttributes->push(TextField::create('PreviewWidth', 'Preview Width:'));
		$fileAttributes->push(TextField::create('PreviewHeight', 'Preview Height:'));

		$fields->removeFieldsFromTab('Root.Main', array(
			'Title',
			'Name',
			'OwnerID',
			'ParentID',
			'Created',
			'LastEdited',
			'BackLinkCount',
			//'Dimensions'
		));
		return $fields;
	}
	
	public function Caption() {

		//TODO: Refactor so doesn't query database each time
		$controller = Controller::curr();
		$page = $controller->data();
		list($parentClass, $componentClass, $parentField, $componentField, $table) = $page->many_many('Images');

                // check if page return many_many Images when not $table is not a object
                if(is_object($table)) {
                    $joinObj = $table::get()
                            ->where("\"{$parentField}\" = '{$page->ID}' AND \"ImageID\" = '{$this->owner->ID}'")
                            ->first();

                    return $joinObj->Caption;
                }
                
                return false;
	}
	public function ResizedFilename() {
		if (empty($this->owner->DisplayWidth) || $this->owner->DisplayWidth == -1) {
			$config = SiteConfig::current_site_config();
			$width = $config->DefaultWidth;
		} else {
			$width = $this->owner->DisplayWidth;
		}
		return $this->owner->SetWidth($width)->Filename;
	}
	public function PreviewImage() {
		$width = $this->owner->PreviewWidth;
		$height = $this->owner->PreviewHeight;
		return $this->owner->SetSize($width, $height);
	}
	public function Half() {
		$width = $this->owner->PreviewWidth;
		$height = $this->owner->PreviewHeight;
		if (empty($width)) {
			$width = 250;
		}
		if (empty($height)) {
			$height = 250;
		}
		$tag = $this->owner->SetSize($width*2, $height*2)->getTag();
		return substr($tag, 0, -2) .'style="width:'. $width .
				'px;height:'. $height .'px" '. substr($tag, -2);
	}
}
