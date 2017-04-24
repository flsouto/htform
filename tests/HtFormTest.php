<?php

require 'vendor/autoload.php';

use FlSouto\HtForm;

class HtFormTest extends PHPUnit\Framework\TestCase{

	function testBasic(){
		$form = new HtForm();
		$form->textin('email');
		$form->button('Submit');
		$this->assertContains("form","$form");
		$this->assertContains("input","$form");
		$this->assertContains("button","$form");
	}

	function testFieldWithLabel(){
		$form = new HtForm();
		$form->textin('email')->label('E-mail: ');
		$form->button('Submit');
		$this->assertContains("form","$form");
		$this->assertContains("input","$form");
		$this->assertContains("email","$form");
		$this->assertContains("button","$form");
		$this->assertContains("E-mail:","$form");
	}

	function testFieldWithLabelInline(){
		$form = new HtForm();
		$form->textin('email')->label(['text'=>'E-mail:','inline'=>true]);
		$form->button('Submit');
		$this->assertContains("E-mail:","$form");
		$this->assertContains("inline-block","$form");
	}

	function testFieldWithPlaceholder(){
		$form = new HtForm();
		$form->textin('email')->placeholder('user@domain.com');
		$form->button('Submit');
		$this->assertContains("placeholder","$form");
		$this->assertContains("user@domain.com", "$form");
	}

	function testAttrs(){
		$form = new HtForm();
		$form->method('POST')
			 ->action('some_script.php')
			 ->attrs(['class'=>'some_class','id'=>'my_form']);

		$form->textin('email');
		$form->button('Submit');

		$this->assertContains("POST","$form");
		$this->assertContains("some_script.php","$form");
		$this->assertContains("some_class","$form");
		$this->assertContains("my_form","$form");

	}

	function testDifferentFieldTypes(){
		$form = new HtForm();
		$form->method('POST')
			 ->action('some_script.php')
			 ->attrs(['class'=>'some_class','id'=>'my_form']);

		$form->textin('email')->label('Email:')->size(50)->attrs(['class'=>'email']);
		$form->textar('comment')->label('Comment:')->cols(50)->rows(10);
		$form->checkb('newsletter','Receive Newsletter?')->fallback(1); // checked by default
		$form->hidden('key','value');
		$form->select('gender')->options(['M'=>'Male','F'=>'Female'])->caption('Choose Gender: ');
		$form->button('Submit');
		$form->button('Cancel'); // more than one button can be added

		$this->assertContains("textarea","$form");
		$this->assertContains("comment","$form");
		$this->assertContains("checkbox","$form");
		$this->assertContains("newsletter","$form");
		$this->assertContains("Receive Newsletter?","$form");
		$this->assertContains("hidden","$form");
		$this->assertContains("key","$form");
		$this->assertContains("value","$form");
		$this->assertContains("select","$form");
		$this->assertContains("gender","$form");
		$this->assertContains("Male","$form");
		$this->assertContains("Female","$form");
		$this->assertContains("Submit","$form");
		$this->assertContains("Cancel","$form");

	}


}

// TODO: 

//test inline

//test readonly 

//test populate data with context

//test processing without error

//test processing with error

//test namespacing fields

//test unfold data