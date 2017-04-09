<?php

require_once(__DIR__.'/vendor/autoload.php');
use FlSouto\HtForm;

$form = new HtForm();

$form->context($_REQUEST)->inline(false)->action('?test')->method('POST');

$form->textin('user[name]')->placeholder('Your Name')
	->size(10)
	->error(['inline'=>true])
	->filters()->required()->ifmatch('/\d/','Your name must not contain any numbers!');

$form->textin('user[email]')->placeholder('Your E-mail')
	->size(15)
	->required()
	->filters()
		->ifnot('@','Invalid e-mail address!');


$form->textin('user[age]')->placeholder('Your Age')
	->size(5)
	->error(['inline'=>true])
	->filters()
		->required()
		->trim()
		->ifnot('/^\d+$/','Your age must be a numeric value!')
		->minval(1)
		->maxval(200);

$form->select('user[id_category]')
	->caption('Choose Category',"")
	->options([
		1 => 'Editor',
		2 => 'Moderator',
		3 => 'Manager',
		4 => 'Guest'
	])
	->fallback(3)
	->required();

$form->checkb('newsletter');



$form->button('_save','Save')->inline(true);
$form->button('_rm','Delete')->inline(true);

if($form->value('_save')){
	$result = $form->process();
	print_r($result->data);
} else if($form->value('_rm')){
	echo 'Deleting row...';
}


echo $form;