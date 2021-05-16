<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<?= $this->Html->charset(); ?>
	<title><?= $this->fetch('title'); ?></title>
	<?php
		echo $this->Html->css('style');
		echo $this->Html->css('custom');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
<section class="w3l-simple-contact-form1">
    <div class="contact-form section-gap">
        <div class="wrapper">
            <div class="contact-form" style="max-width: 450px; margin: 0 auto;">
                <div class="form-mid form-secure">
					<?= $this->Flash->render(); ?>
					<?= $this->fetch('content'); ?>
                </div>
            </div>
        </div>
    </div>
</section>
</body>
</html>
