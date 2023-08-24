<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2014 Leo Feyer
 *
 * @package   [timelineloader-bundle]
 * @author    Taheri Create Core Team
 * @license   GNU/LGPL
 * @copyright Taheri Create 2023 - 2026
 */

/**
 * Namespace
 */

namespace Tahericreate\TimelineloaderBundle\FeCte;


/**
 * Class TimelineYearEvents
 *
 * @copyright  Taheri Create 2023 - 2026
 * @author     Taheri Create Core Team
 * @package    Devtools
 */
class TimelineYearEvents extends \ContentElement
{
    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'timeline_yearevents';

    /**
     * Display a wildcard in the back end
     *
     * @return string
     */
    public function generate()
    {
        if (TL_MODE == 'BE') {
            $objTemplate = new \BackendTemplate('be_wildcard');

            $objTemplate->wildcard = '### Tahericreate TIMELINE EVENTS ###';
            $objTemplate->title = $this->headline;
            $objTemplate->id = $this->id;
            $objTemplate->link = $this->name;
            $objTemplate->href = 'contao/main.php?do=themes&table=tl_module&act=edit&id=' . $this->id;

            return $objTemplate->parse();
        }

		// Get Event Details by selected year
		if($this->Input->post('mode') == 'ajax'){
			die($this->getEventsHTML($this->Input->post('selYear')));
		} 

        return parent::generate();
    }

    /**
     * Generate the content
     */
    protected function compile(){

		// Add public assets to global list
		$GLOBALS['TL_CSS'][] = 'bundles/timelineloader/css/font-awesome.css';
		$GLOBALS['TL_CSS'][] = 'bundles/timelineloader/css/slick.css';
		$GLOBALS['TL_CSS'][] = 'bundles/timelineloader/css/slick-theme.css';
		$GLOBALS['TL_CSS'][] = 'bundles/timelineloader/css/style.css';
		
		$GLOBALS['TL_JAVASCRIPT'][] = 'bundles/timelineloader/js/zustom.js';
		$GLOBALS['TL_JAVASCRIPT'][] = 'bundles/timelineloader/js/slick.js';
		
		// Initialize local vars
		$yearCollection = array();
		$selectedYearId = 0;		
		
		// Assorting years
		$dbYearsObj = \Database::getInstance()->prepare("SELECT id, event_year, highlight FROM tl_timelineloader_year")->execute();
		if($dbYearsObj->numRows){
			while($dbYearsObj->next()){
				$yearCollection[$dbYearsObj->id] = array(
					'year'		=> $dbYearsObj->event_year,
					'highlight'	=> $dbYearsObj->highlight
				);
				if($dbYearsObj->highlight){
					$selectedYearId = $dbYearsObj->id;
				}
			}
		}		
		
        // Send values to view
		$this->Template->yearCollection = $yearCollection;
		
		// Assorting events
		$this->Template->selectedYearEventsHTML = $this->getEventsHTML($selectedYearId);
    }

    /**
     * Get all event details
     */
    protected function getEventsHTML($selectedYearId){
		// Initialize local vars
		$eventCollection = array();
		global $objPage;
		
		$dbEventsObj = \Database::getInstance()->prepare("SELECT id, headline_" . $objPage->language . " AS headline, image, description_" . $objPage->language . " AS description FROM tl_timelineloader_event WHERE pid=? AND published=? ORDER BY id")->execute($selectedYearId, '1');
		if($dbEventsObj->numRows){
			while($dbEventsObj->next()){
				$imgModel = \FilesModel::findByUuid($dbEventsObj->image);
				$eventCollection[$dbEventsObj->id] = array(
					'headline'		=> $dbEventsObj->headline,
					'image'			=> $imgModel->path,
					'description'	=> $dbEventsObj->description
				);
			}
		}
		
		// Obtain partial template
		$objYearEventsTemplate = new \FrontendTemplate('partial_timeline_yearevents');
		$objYearEventsTemplate->eventCollection = $eventCollection;
				
		// Return assorted HTML from partial template
		return $objYearEventsTemplate->parse();
	}
}
class_alias(TimelineYearEvents::class, 'TimelineYearEvents');
