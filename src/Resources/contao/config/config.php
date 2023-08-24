<?php

/* 
 * @package   [timelineloader-bundle]
 * @author    Taheri Create Core Team
 * @license   GNU/LGPL
 * @copyright Taheri Create 2023 - 2026
 */

 $GLOBALS['BE_MOD']['timelineloader_bundle'] = array(
	'timeline_yearevents' => array(
		'tables' => array('tl_timelineloader_year', 'tl_timelineloader_event'),
	),
);

/**
 * CONTENT ELEMENTS
 */

 $GLOBALS['TL_CTE']['timelineloader_bundle'] = array(
	'timeline_yearevents' 	=> 'Tahericreate\TimelineloaderBundle\FeCte\TimelineYearEvents',
);