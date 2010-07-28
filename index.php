<?php
/**
 * @package akeebainstaller
 * @copyright Copyright (C) 2009-2010 Nicholas K. Dionysopoulos. All rights reserved.
 * @author Nicholas K. Dionysopoulos - http://www.dionysopoulos.me
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL v3 or later
 *
 * Akeeba Backup Installer main page
 */

// Flag this as a parent file
define('_ABI', '1.0');

// Minimum script execution time: 2 seconds
define('MINEXECTIME', 2000);

// Remove error reporting
@error_reporting(E_NONE);

// Setup some useful constants
$abspath = dirname(__FILE__);
if(empty($abspath)) $abspath = '.';
define('DS', DIRECTORY_SEPARATOR);
// Try to determine the absolute dir to the site
$siteroot = @realpath($abspath.DS.'..');
if(strlen($siteroot) == 0) $siteroot = '';
define('JPATH_SITE', $siteroot );
define('JPATH_INSTALLATION', $abspath );

// Output buffering begins before we start doing anything at all
@ob_start();

// Load base files
require_once(JPATH_INSTALLATION.DS.'includes'.DS.'utils.php'); // Utilities
require_once(JPATH_INSTALLATION.DS.'includes'.DS.'translate.php'); // Translation
require_once(JPATH_INSTALLATION.DS.'includes'.DS.'storage.php'); // Temporary Storage
require_once(JPATH_INSTALLATION.DS.'includes'.DS.'output.php'); // Output class
require_once(JPATH_INSTALLATION.DS.'includes'.DS.'automation.php'); // Automation class
require_once(JPATH_INSTALLATION.DS.'includes'.DS.'antidos.php'); // Protection from anti-DoS solutions (no more 403's!)

// Initialize the global $view array
global $view;
unset($view); // Destroy any variable trickily passed to this script...
$view = array(); // Initialize to an empty array

// Enforce minimum script execution time (start-up)
enforce_minexectime(true);

// Run the logic depending on the task
$task = getParam('task','index');
switch($task)
{
	case "index": // Requirements check
		require_once(JPATH_INSTALLATION.DS.'includes'.DS.'logic'.DS.'index.php'); // Run the logic
		require_once(JPATH_INSTALLATION.DS.'includes'.DS.'output'.DS.'index.php'); // Run the view
		break;

	case "dbnext": // Iterate to the next database
	case "dbprev": // Iterate to the previous database
		require_once(JPATH_INSTALLATION.DS.'includes'.DS.'logic'.DS.'dbsetup.php'); // Run the logic
		require_once(JPATH_INSTALLATION.DS.'includes'.DS.'output'.DS.'dbsetup.php'); // Run the view
		break;

	case "restore": // Restores the current database (called by AJAX)
		require_once(JPATH_INSTALLATION.DS.'includes'.DS.'logic'.DS.'restore.php'); // Run the logic
		// There is no "view" for this page. The logic produces the AJAX output.
		break;

	case "setup": // Site setup
		require_once(JPATH_INSTALLATION.DS.'includes'.DS.'logic'.DS.'setup.php'); // Run the logic
		require_once(JPATH_INSTALLATION.DS.'includes'.DS.'output'.DS.'setup.php'); // Run the view
		break;

	case "ajax": // AJAX power for site setup, e.g. FTP check
		require_once(JPATH_INSTALLATION.DS.'includes'.DS.'logic'.DS.'ajax.php'); // Run the logic
		// There is no "view" for this page. The logic produces the AJAX output.
		break;

	case "finish": // We just finished!
		require_once(JPATH_INSTALLATION.DS.'includes'.DS.'logic'.DS.'finish.php'); // Run the logic
		require_once(JPATH_INSTALLATION.DS.'includes'.DS.'output'.DS.'finish.php'); // Run the view
		break;

	default:
		// This is something not allowed. Die.
		die('Invalid task');
		break;
}

// Get the page's output
$content = ob_get_clean();

// Send the page data
$output =& ABIOutput::getInstance();
$output->setContent($content);
$output->output();

// Finally, save the Storage
$storage =& ABIStorage::getInstance();
$storage->saveData();

// Enforce minimum script execution time (finalization)
enforce_minexectime(false);