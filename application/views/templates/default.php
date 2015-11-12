<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $title ?></title>
        <?php echo is_string($css) ? $css : '' ; ?>
        <?php echo is_string($js) ? $js : ''; ?>
    </head>
    <body>
		<?php $this->load->view('templates/header'); ?>
		<?php echo $body; ?>
		<?php $this->load->view('templates/footer'); ?>
    </body>
</html>