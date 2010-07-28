<?php
/**
 * @package akeebainstaller
 * @copyright Copyright (C) 2009-2010 Nicholas K. Dionysopoulos. All rights reserved.
 * @author Nicholas K. Dionysopoulos - http://www.dionysopoulos.me
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL v3 or later
 *
 * Akeeba Backup Installer Output: Finish up
 */

defined('_ABI') or die('Direct access is not allowed');

global $view;
extract($view);

if($confwritten):?>
<h2><?php echo ABIText::_('CONF_WRITTEN')?></h2>
<?php else: ?>
<h2><?php echo ABIText::_('CONF_NOTWRITTEN')?></h2>
<p><?php echo ABIText::_('CONF_NOTWRITTEN_PARA')?></p>
<div id="dialog" title="<?php echo ABIText::_('DLG_NOTWRITTEN_TITLE')?>">
	<p><?php echo ABIText::_('DLG_NOTWRITTEN_BODY1') ?></p>
	<p><?php echo ABIText::_('DLG_NOTWRITTEN_BODY2') ?></p>
</div>
<pre class="scrollable"><?php echo htmlentities($confdata); ?></pre>
<script type="text/javascript" language="javascript">
	$(function() {
		$("#dialog").dialog({
			autoOpen: true,
			closeOnEscape: true,
			height: 200,
			width: 400,
			hide: 'slide',
			modal: true,
			position: 'center',
			show: 'slide'
		});
	});
</script>
<?php endif; ?>
<div id="dialog2" title="<?php echo ABIText::_('MESSAGE_DELETEDSELF_TITLE')?>">
	<div id="waittext"><?php echo ABIText::_('PLEASE_WAIT') ?></div>
	<div id="errortext"><?php echo ABIText::_('MESSAGE_NOTDELETEDSELF') ?></div>
	<div id="oktext"><?php echo ABIText::_('MESSAGE_DELETEDSELF') ?></div>
</div>
<script type="text/javascript" language="javascript">
	$(function() {
		$("#dialog2").dialog({
			autoOpen: false,
			closeOnEscape: false,
			height: 300,
			width: 450,
			hide: 'slide',
			modal: true,
			position: 'center',
			show: 'slide'
		});

		$('#deleteself').bind('click', deleteself_click);
	});
</script>


<p><?php echo ABIText::_('MESSAGE_FINISH1')?></p>
<p><?php echo ABIText::_('MESSAGE_FINISH2')?></p>
<p><?php echo ABIText::_('MESSAGE_FINISH3')?></p>