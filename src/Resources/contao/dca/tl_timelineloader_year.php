<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

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
 * Table tl_timelineloader_year
 */
$GLOBALS['TL_DCA']['tl_timelineloader_year'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
		'ctable'                      => array('tl_timelineloader_event'),
		'switchToEdit'                => true,
		'enableVersioning'            => false,
		'sql' => array
		(
			'keys' => array
			(
				'id' => 'primary'
			)
		),
	),

	// List
	'list' => array
	(
		'sorting' => array
		(
			'mode'                    => 1,
			'fields'                  => array('id'),
			'flag'                    => 1,
			'panelLayout'             => 'search,limit',			
			'disableGrouping'		  => true,
		),
		'label' => array
		(
			'fields'                  => array('event_year'),
			'format'                  => '%s'
		),
		'global_operations' => array
		(
			'all' => array
			(
				'href'                => 'act=select',
				'class'               => 'header_edit_all',
				'attributes'          => 'onclick="Backend.getScrollOffset();" accesskey="e"'
			)	
		),
		'operations' => array
		(
			'edit' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_timelineloader_year']['edit'],
				'href'                => 'table=tl_timelineloader_event',
				'icon'                => 'edit.gif',
				'attributes'          => 'class="contextmenu"'
			),
			'editheader' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_timelineloader_year']['editheader'],
				'href'                => 'act=edit',
				'icon'                => 'header.gif',
				'button_callback'     => array('TlTimelineLoaderYearDca', 'editHeader'),
				'attributes'          => 'class="edit-header"'
			),
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_timelineloader_year']['copy'],
				'href'                => 'act=copy',
				'icon'                => 'copy.gif'
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_timelineloader_year']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif'
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_timelineloader_year']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			)
		)
	),

	// Palettes
	'palettes' => array
	(
		'default'                     => '{Year settings},event_year,highlight;'
	),

	// Fields
	'fields' => array
	(
		'id' => array
		(
			'sql'					=> "int(10) unsigned NOT NULL auto_increment"
		),
		'tstamp' => array
		(
			'sql'                   => "int(10) unsigned NOT NULL default 0"
		),
		'event_year' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_timelineloader_year']['event_year'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>10, 'tl_class'=>'clr w50'),
			'sql'                     => "INT(10) NOT NULL DEFAULT 0"
		),		
		'highlight' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_timelineloader_year']['highlight'],
			'exclude'                 => true,
			'inputType'               => 'radio',
			'options'				  => array('0' => 'nein', '1' => 'ja'),
			'eval'                    => array('isAssociative'=>true, 'tl_class'=>'w50'),
			'sql'                     => "INT(10) NOT NULL DEFAULT 0"
		)
		
	)
);


/**
 * Class TlTimelineLoaderYearDca
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 * @copyright  Leo Feyer 2005-2010
 * @author     Leo Feyer <http://www.contao.org>
 * @package    Controller
 */
class TlTimelineLoaderYearDca extends Backend
{

	/**
	 * Import the back end user object
	 */
	public function __construct()
	{
		parent::__construct();
		$this->import('BackendUser', 'User');
	}


	/**
	 * Check permissions to edit table vi_timelineloader_year
	 */
	public function checkPermission()
	{
		// HOOK: comments extension required
		if (!in_array('comments', $this->Config->getActiveModules()))
		{
			unset($GLOBALS['TL_DCA']['vi_timelineloader_year']['fields']['allowComments']);
		}
	}


	/**
	 * Return the edit header button
	 * @param array
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @return string
	 */
	public function editHeader($row, $href, $label, $title, $icon, $attributes)
	{
		return ($this->User->isAdmin || count(preg_grep('/^tl_timelineloader_year::/', $this->User->alexf)) > 0) ? '<a href="'.$this->addToUrl($href.'&amp;id='.$row['id']).'" title="'.specialchars($title).'"'.$attributes.'>'.$this->generateImage($icon, $label).'</a> ' : '';
	}
	
	
}

?>
