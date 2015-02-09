<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GalleryConfig
 *
 * @author denz
 */
class GalleryConfig extends DataExtension {
	static $db = array(
		'DefaultNumberOfItems' => 'Int',
		'DefaultWidth' => 'Int',
	);
	static $defaults = array(
		'DefaultNumberOfItems' => 12,
		'DefaultWidth' => 1600,
	);
	public function updateCMSFields(\FieldList $fields) {
		//$fields->addFieldToTab('Root', new Tab('Gallery'));
		$fields->addFieldToTab('Root.Gallery', 
				new TextField('DefaultNumberOfItems'));
		$fields->addFieldToTab('Root.Gallery', 
				new TextField('DefaultWidth'));
		parent::updateCMSFields($fields);
	}
}
