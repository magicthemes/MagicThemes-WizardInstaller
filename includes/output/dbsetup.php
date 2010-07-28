<?php
/**
 * @package akeebainstaller
 * @copyright Copyright (C) 2009-2010 Nicholas K. Dionysopoulos. All rights reserved.
 * @author Nicholas K. Dionysopoulos - http://www.dionysopoulos.me
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL v3 or later
 *
 * Akeeba Backup Installer Output: Database restoration setup
 */

defined('_ABI') or die('Direct access is not allowed');

global $view;
extract($view);

if($existing == 'backup')
{
	$sel1 = '';
	$sel2 = 'checked="checked"';
}
else
{
	$sel2 = '';
	$sel1 = 'checked="checked"';
}

$automation =& ABIAutomation::getInstance();

?>
<script type="text/javascript">//<![CDATA[
	$(function() {
		// Add the database restoration behaviour
		hijackDBNext();
<?php if($automation->hasAutomation()): ?>
		hasAutomation = true;
		$('#nextButton').trigger('click');
<?php endif; ?>
	});
//]]></script>

<div id="dialog" title="<?php echo ABIText::_('RESTORATIONPROGRESS') ?>">
	<div id="progressbar"></div>
	<p id="progresstext"></p>
</div>

<h2><?php echo ABIText::_('TITLE_DBSETUP') ?> - <?php echo $friendlyName ?></h2>

<div id="accordion">

<h3><?php echo ABIText::_('DBBASIC') ?></h3>
<div class="categoryitems">
<table>
	<thead>
		<tr>
			<th><?php echo ABIText::_('ITEM'); ?></th>
			<th><?php echo ABIText::_('VALUE'); ?></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td><?php echo ABIText::_('DBTYPE') ?></td>
			<td>
				<select name="dbtype" id="dbtype">
					<option value="mysql" <?php if($dbtype=="mysql") echo 'selected="selected"' ?>>mysql</option>
					<option value="mysqli" <?php if($dbtype=="mysqli") echo 'selected="selected"' ?>>mysqli</option>
				</select>
			</td>
		</tr>
		<tr>
			<td><?php echo ABIText::_('DBHOST') ?></td>
			<td><input type="text" name="dbhost" id="dbhost" value="<?php echo $dbhost ?>" size="30" /></td>
		</tr>
		<tr>
			<td><?php echo ABIText::_('DBUSER') ?></td>
			<td><input type="text" name="dbuser" id="dbuser" value="<?php echo $dbuser ?>" size="30" /></td>
		</tr>
		<tr>
			<td><?php echo ABIText::_('DBPASS') ?></td>
			<td><input type="password" name="dbpass" id="dbpass" value="<?php echo $dbpass ?>" size="30" /></td>
		</tr>
		<tr>
			<td><?php echo ABIText::_('DBDATABASE') ?></td>
			<td><input type="text" name="dbname" id="dbname" value="<?php echo $dbname ?>" size="30" /></td>
		</tr>
	</tbody>
</table>
</div>

<h3><?php echo ABIText::_('DBADVANCED') ?></h3>
<div class="categoryitems">
<table>
	<thead>
		<tr>
			<th><?php echo ABIText::_('ITEM'); ?></th>
			<th><?php echo ABIText::_('VALUE'); ?></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td><?php echo ABIText::_('EXISTINGTABLES') ?></td>
			<td><p>
				<input type="radio" name="existing" value="drop" <?php echo $sel1 ?> /><?php echo ABIText::_('DROPTABLES') ?><br/>
				<input type="radio" name="existing" value="backup" <?php echo $sel2 ?> /><?php echo ABIText::_('BACKUPTABLES') ?>
			</p></td>
		</tr>
		<tr>
			<td><?php echo ABIText::_('PREFIX') ?></td>
			<td><input type="text" name="prefix" id="prefix" value="<?php echo $prefix ?>" size="30" /></td>
		</tr>
	</tbody>
</table>
</div>

<h3><?php echo ABIText::_('DBFINETUNE') ?></h3>
<div class="categoryitems">
<table>
	<thead>
		<tr>
			<th><?php echo ABIText::_('ITEM'); ?></th>
			<th><?php echo ABIText::_('VALUE'); ?></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td><?php echo ABIText::_('SUPPRESFK') ?></td>
			<td><input type="checkbox" name="suppressfk" id="suppressfk" <?php if($suppressfk) echo 'checked="checked"' ?> /></td>
		</tr>
		<tr>
			<td><?php echo ABIText::_('MAXCHUNK') ?></td>
			<td><input type="text" name="maxchunk" id="maxchunk" value="<?php echo $maxchunk ?>" /></td>
		</tr>
		<tr>
			<td><?php echo ABIText::_('MAXSQLQUERIES') ?></td>
			<td><input type="text" name="maxqueries" id="maxqueries" value="<?php echo $maxqueries ?>" /></td>
		</tr>
	</tbody>
</table>
</div>

</div>