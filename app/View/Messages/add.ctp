<?php
	$options 		= ['class' => 'form-control', 'div' => 'field', 'label' => false];
	$addToOptions 	= function($moreOptions=[]) use ($options)
	{
		return array_merge($options, $moreOptions);
	};
?>

<p style="font-size: 24px;text-align: center;"><b>Contact Us</b></p>
<br /><br />
<span style="font-size: 14px;"><b>NB:</b> Aseteriked(*) fields are required</span>
<br /><br />
<?= $this->Form->create('Message', ['type' => 'file']); ?>
	<?= $this->Form->input('name', $addToOptions(['placeholder' => '*Name:'])); ?>
	<?= $this->Form->input('email', $addToOptions(['placeholder' => '*Email:'])); ?>
	<?= $this->Form->input('message', $addToOptions(['placeholder' => '*Message:'])); ?>
	<?= $this->Form->input('file', $addToOptions([
		'type' 			=> 'file',
		'accept' 		=> 'application/pdf,.csv,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel',
		'required' 		=> false
	])); ?>
	<?=  $this->Form->button(
		'Send Message',
		[
			'type' => 'submit',
			'class' => 'btn btn-contact'
		]
	); ?>
<?= $this->Form->end(); ?>
