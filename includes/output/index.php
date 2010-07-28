<?php
/**
 * @package akeebainstaller
 * @copyright Copyright (C) 2009-2010 Nicholas K. Dionysopoulos. All rights reserved.
 * @author Nicholas K. Dionysopoulos - http://www.dionysopoulos.me
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL v3 or later
 *
 * Akeeba Backup Installer Output: The first page to load
 */

defined('_ABI') or die('Direct access is not allowed');

global $view;
extract($view);

?>
<h2><?php echo ABIText::_('TITLE_SERVERSETUP') ?></h2>

<div id="accordion">

<h3><?php echo ABIText::_('REQUIREMENTS') ?></h3>
<div class="categoryitems">
<table>
	<thead>
		<tr>
			<th><?php echo ABIText::_('ITEM'); ?></th>
			<th><?php echo ABIText::_('REALSET'); ?></th>
		</tr>
	</thead>
	<tbody>
	<?php foreach($phpOptions as $option): ?>
		<tr>
			<td><?php echo $option['label'] ?></td>
			<td><?php echo $option['state'] ? '<span class="green">'.ABIText::_('Yes').'</span>' : '<span class="red">'.ABIText::_('No').'</span>'  ?>
				<?php if(isset($option['notice'])): ?>
				<br/><?php echo $option['notice'] ?>
				<?php endif; ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>
</div>

<h3><?php echo ABIText::_('OPTIONAL_SETTINGS') ?></h3>
<div class="categoryitems">
<table>
	<thead>
		<tr>
			<th><?php echo ABIText::_('ITEM'); ?></th>
			<th><?php echo ABIText::_('RECSET'); ?></th>
			<th><?php echo ABIText::_('REALSET'); ?></th>
		</tr>
	</thead>
	<tbody>
	<?php foreach($phpSettings as $option): ?>
		<tr>
			<td><?php echo $option['label'] ?></td>
			<td><?php echo $option['setting'] ? ABIText::_('Yes') : ABIText::_('No') ?></td>
			<td><?php echo $option['state'] ? '<span class="green">' : '<span class="red">';
				echo $option['actual'] ? ABIText::_('Yes') : ABIText::_('No'); ?></span>
				<?php if(isset($option['notice'])): ?>
				<br/><?php echo $option['notice'] ?>
				<?php endif; ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>
</div>

<h3><?php echo ABIText::_('DIRECTORIES') ?></h3>
<div class="categoryitems">
<table>
	<thead>
		<tr>
			<th><?php echo ABIText::_('ITEM'); ?></th>
			<th><?php echo ABIText::_('REALSET'); ?></th>
		</tr>
	</thead>
	<tbody>
	<?php foreach($directories as $option): ?>
		<tr>
			<td><?php echo $option['label'] ?><br/><tt><?php echo $option['directory'] ?></tt></td>
			<td><?php echo $option['writable'] ? '<span class="green">' : '<span class="red">';
				echo $option['writable'] ? ABIText::_('Yes') : ABIText::_('No'); ?></span>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>
</div>

</div>