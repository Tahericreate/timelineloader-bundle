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
 * Table tl_timelineloader_event
 */

$GLOBALS['TL_DCA']['tl_timelineloader_event'] = array(

	// Config
	'config' => array(
		'dataContainer'               => 'Table',
		'ptable'                      => 'tl_timelineloader_year',
		'enableVersioning'            => false,
		'sql' => array(
			'keys' => array(
				'id' => 'primary'
			)
		)
	),

	// List
	'list' => array(
		'sorting' => array(
			'mode'                    => 4,
			'fields'                  => array('headline_de', 'headline_en'),
			'panelLayout'             => 'filter,sort,search,limit',
			'headerFields'            => array('event_year', 'headline_de'),
			'disableGrouping'		  => true,
			'child_record_callback'   => array('TlTimelineloaderEventDca', 'listItems')
		),
		'label' => array(
			'fields'                  => array('headline_de'),
			'format'                  => '%s',
		),
		'global_operations' => array(
			'all' => array(
				'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'                => 'act=select',
				'class'               => 'header_edit_all',
				'attributes'          => 'onclick="Backend.getScrollOffset();" accesskey="e"'
			)
		),
		'operations' => array(
			'edit' => array(
				'label'               => &$GLOBALS['TL_LANG']['tl_timelineloader_event']['edit'],
				'href'                => 'act=edit',
				'icon'                => 'edit.gif'
			),
			'copy' => array(
				'label'               => &$GLOBALS['TL_LANG']['tl_timelineloader_event']['copy'],
				'href'                => 'act=paste&amp;mode=copy',
				'icon'                => 'copy.gif'
			),
			'cut' => array(
				'label'               => &$GLOBALS['TL_LANG']['tl_timelineloader_event']['cut'],
				'href'                => 'act=paste&amp;mode=cut',
				'icon'                => 'cut.gif'
			),
			'delete' => array(
				'label'               => &$GLOBALS['TL_LANG']['tl_timelineloader_event']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
			),
			'toggle' => array(
				'label'               => &$GLOBALS['TL_LANG']['tl_timelineloader_event']['toggle'],
				'icon'                => 'visible.gif',
				'attributes'          => 'onclick="Backend.getScrollOffset(); return AjaxRequest.toggleVisibility(this, %s);"',
				'button_callback'     => array('TlTimelineloaderEventDca', 'toggleIcon')
			),
			'show' => array(
				'label'               => &$GLOBALS['TL_LANG']['tl_timelineloader_event']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			)
		)
	),

	// Palettes
	'palettes' => array(
		'default'                     => '{event_legend_german_text}, headline_de, description_de; {event_legend_english_text}, headline_en, description_en; {common_legend}, image; {publish_legend}, published;'
	),

	// Fields
	'fields' => array(
		'id' => array(
			'sql'					=> "int(10) unsigned NOT NULL auto_increment"
		),
		'pid' => array(
			'label'                   => &$GLOBALS['TL_LANG']['tl_timelineloader_event']['pid'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'foreignKey'			  => 'tl_timelineloader_year.id',
			'eval'                    => array('tl_class' => 'w50'),
			'sql'                     => "INT(10) unsigned NOT NULL default 0"
		),
		'tstamp' => array(
			'sql'                   => "int(10) unsigned NOT NULL default 0"
		),
		'headline_de' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_timelineloader_event']['headline_de'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>255),
			'sql'                     => "VARCHAR(255) NOT NULL DEFAULT ''"
		),
		'headline_en' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_timelineloader_event']['headline_en'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>false, 'maxlength'=>255),
			'sql'                     => "VARCHAR(255) NOT NULL DEFAULT ''"
		),		
		'image' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_timelineloader_event']['image'],
			'exclude'                 => true,
			'inputType'               => 'fileTree',
			'eval'                    => array('fieldType'=>'radio', 'files'=>true, 'filesOnly'=>true, 'mandatory'=>false),
			'sql'					  => "Binary(16) NULL"
		),
		'description_de' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_timelineloader_event']['description_de'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'textarea',
			'eval'                    => array('mandatory'=>false, 'rte'=>'tinyMCE', 'helpwizard'=>true),
			'sql'                     => "TEXT NULL"
		),
		'description_en' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_timelineloader_event']['description_en'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'textarea',
			'eval'                    => array('mandatory'=>false, 'rte'=>'tinyMCE', 'helpwizard'=>true),
			'sql'                     => "TEXT NULL"
		),
		'published' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_timelineloader_event']['published'],
			'exclude'                 => true,
			'filter'                  => true,
			'flag'                    => 2,
			'inputType'               => 'checkbox',
			'eval'                    => array('doNotCopy'=>true),
			'sql'                     => "INT(1) NOT NULL DEFAULT 1"
		)
	)
);


/**
 * Class TlTimelineloaderEventDca
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 * @copyright  Leo Feyer 2008-2010
 * @author     Leo Feyer <http://www.contao.org>
 * @package    Controller
 */
class TlTimelineloaderEventDca extends Backend
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
	 * Add the type of input field
	 * @param array
	 * @return string
	 */
	public function listItems($arrRow)
	{
		$key = $arrRow['published'] ? 'published' : 'unpublished';
		$date = $this->parseDate($GLOBALS['TL_CONFIG']['datimFormat'], $arrRow['tstamp']);

		return '
<div class="block">
'.$arrRow['headline_de'].'
</div>';
	}

	/**
	 * Check permissions to edit table vi_timelineloader_event
	 */
	public function checkPermission()
	{
		// HOOK: comments extension required
		if (!in_array('comments', $this->Config->getActiveModules()))
		{
			$key = array_search('allowComments', $GLOBALS['TL_DCA']['vi_timelineloader_event']['list']['sorting']['headerFields']);
			unset($GLOBALS['TL_DCA']['vi_timelineloader_event']['list']['sorting']['headerFields'][$key]);
		}
	}


	/**
	 * Autogenerate a news alias if it has not been set yet
	 * @param mixed
	 * @param object
	 * @return string
	 */
	public function generateAlias($varValue, DataContainer $dc)
	{
		$autoAlias = false;

		// Generate alias if there is none
		if (!strlen($varValue))
		{
			$autoAlias = true;
			$varValue = standardize($dc->activeRecord->question);
		}

		$objAlias = $this->Database->prepare("SELECT id FROM vi_timelineloader_event WHERE alias=?")
								   ->execute($varValue);

		// Check whether the news alias exists
		if ($objAlias->numRows > 1 && !$autoAlias)
		{
			throw new Exception(sprintf($GLOBALS['TL_LANG']['ERR']['aliasExists'], $varValue));
		}

		// Add ID to alias
		if ($objAlias->numRows && $autoAlias)
		{
			$varValue .= '-' . $dc->id;
		}

		return $varValue;
	}


	/**
	 * Return the "toggle visibility" button
	 * @param array
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @return string
	 */
	public function toggleIcon($row, $href, $label, $title, $icon, $attributes)
	{
		if (strlen($this->Input->get('tid')))
		{
			$this->toggleVisibility($this->Input->get('tid'), ($this->Input->get('state') == 1));
			$this->redirect($this->getReferer());
		}

		// Check permissions AFTER checking the tid, so hacking attempts are logged
		if (!$this->User->isAdmin && !$this->User->hasAccess('vi_timelineloader_event::published', 'alexf'))
		{
			return '';
		}

		$href .= '&amp;tid='.$row['id'].'&amp;state='.($row['published'] ? '' : 1);

		if (!$row['published'])
		{
			$icon = 'invisible.gif';
		}		

		return '<a href="'.$this->addToUrl($href).'" title="'.specialchars($title).'"'.$attributes.'>'.$this->generateImage($icon, $label).'</a> ';
	}


	/**
	 * Disable/enable a user group
	 * @param integer
	 * @param boolean
	 */
	public function toggleVisibility($intId, $blnVisible)
	{
		// Check permissions to publish
		if (!$this->User->isAdmin && !$this->User->hasAccess('vi_timelineloader_event::published', 'alexf'))
		{
			$this->log('Not enough permissions to publish/unpublish item with ID "'.$intId.'"', 'vi_timelineloader_event toggleVisibility', TL_ERROR);
			$this->redirect('contao/main.php?act=error');
		}

		// Update the database
		$this->Database->prepare("UPDATE vi_timelineloader_event SET tstamp=". time() .", published='" . ($blnVisible ? 1 : '') . "' WHERE id=?")
					   ->execute($intId);
	}

}
