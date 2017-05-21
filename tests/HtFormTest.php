<?php

#mdx:h require
require 'vendor/autoload.php';

#mdx:h use
use FlSouto\HtForm;

/* 
# HtForm

## Overview

Forget about everything you've seen so far regarding form building tools and libraries. The approach you are going to see here is something totally new and straightforward: 

- No need to instantiate and/or configure tons of objects. 
- No need to define and connect the form to a model. 
- No need to have xml or yml files defining how the form is supposed to behave.
- No need to define your own form and field classes. 
- No need to setup a "renderer engine" before the form can be rendered. 
- No need to get the form builder from a DIC (Dependency Injection Container)

## Usage

All you have to do is this: create a form object, add some fields and echo it:

#mdx:Basic

Outputs:

#mdx:Basic -o httidy

That is pretty easy, huh?

*/


class HtFormTest extends PHPUnit\Framework\TestCase{

    function testBasic(){
        #mdx:Basic
        $form = new HtForm();
        $form->textin('email');
        $form->button('Submit');
        #/mdx echo $form
        $this->assertContains("form","$form");
        $this->assertContains("input","$form");
        $this->assertContains("button","$form");
    }

/*

### Adding labels to fields

#mdx:FieldWithLabel

Outputs:

#mdx:FieldWithLabel -o httidy
*/
    function testFieldWithLabel(){
        #mdx:FieldWithLabel
        $form = new HtForm();
        $form->textin('email')->label('E-mail: ');
        $form->button('Submit');
        #/mdx echo $form
        $this->assertContains("form","$form");
        $this->assertContains("input","$form");
        $this->assertContains("email","$form");
        $this->assertContains("button","$form");
        $this->assertContains("E-mail:","$form");
    }

/*
### Making field labels inline

#mdx:FieldWithLabelInline

Outputs:

#mdx:FieldWithLabelInline -o httidy
*/
    function testFieldWithLabelInline(){
        #mdx:FieldWithLabelInline
        $form = new HtForm();
        $form->textin('email')->label(['text'=>'E-mail:','inline'=>true]);
        $form->button('Submit');
        #/mdx echo $form
        $this->assertContains("E-mail:","$form");
        $this->assertContains("inline-block","$form");
    }

/*
### Defining Placeholders

#mdx:FieldWithPlaceholder

Outputs:

#mdx:FieldWithPlaceholder -o httidy
*/
    function testFieldWithPlaceholder(){
        #mdx:FieldWithPlaceholder
        $form = new HtForm();
        $form->textin('email')->placeholder('user@domain.com');
        $form->button('Submit');
        #/mdx echo $form
        $this->assertContains("placeholder","$form");
        $this->assertContains("user@domain.com", "$form");
    }

/*
### Specifying Field Attributes

#mdx:Attrs

Outputs:

#mdx:Attrs -o httidy
*/
    function testAttrs(){
        #mdx:Attrs
        $form = new HtForm();
        $form->method('POST')
             ->action('some_script.php')
             ->attrs(['class'=>'some_class','id'=>'my_form']);

        $form->textin('email');
        $form->button('Submit');
        #/mdx echo $form
        $this->assertContains("POST","$form");
        $this->assertContains("some_script.php","$form");
        $this->assertContains("some_class","$form");
        $this->assertContains("my_form","$form");

    }

/*
### Adding different types of fields

#mdx:DifferentFieldTypes

Outputs:

#mdx:DifferentFieldTypes -o httidy
*/
    function testDifferentFieldTypes(){
        #mdx:DifferentFieldTypes
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
        #/mdx echo $form
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

/*
### Make all fields inline at once

#mdx:Inline

Outputs:

#mdx:Inline -o httidy
*/
    function testInline(){

        #mdx:Inline
        $form = new HtForm();
        $form->inline(true);
        $form->textin('fst_name')->label('First Name');
        $form->textin('lst_name')->label('Last Name');
        $form->button('Submit');
        #/mdx echo $form
        $this->assertGreaterThanOrEqual(2, substr_count("$form","display:inline-block"));

    }

/*
### Make all fields readonly at once

#mdx:Readonly

Outputs:

#mdx:Readonly -o httidy
*/
    function testReadonly(){

        #mdx:Readonly
        $form = new HtForm();
        $form->readonly(true);
        $form->textin('fst_name')->label('First Name');
        $form->textin('lst_name')->label('Last Name');
        $form->button('Submit');
        #/mdx echo $form
        $this->assertGreaterThanOrEqual(2, substr_count("$form","readonly"));

    }

/*
### Prepopulate form with data

#mdx:Populate

Outputs:

#mdx:Populate -o httidy
*/
    function testPopulate(){

        #mdx:Populate
        $form = new HtForm();
        $form->textin('name')->label('Name');
        $form->textin('email')->label('Email');
        $form->select('job')->caption("Job:")->options([1=>'Secretary',2=>'Manager',3=>'Programmer']);
        $form->button('Submit');

        $form->context([
            'name' => 'Mary',
            'email' => 'dontmaryme@doman.com',
            'job' => 1
        ]);
        #/mdx echo $form
        $this->assertContains("Mary","$form");
        $this->assertContains("dontmaryme@doman.com", "$form");
        $this->assertContains('value="1" selected', "$form");

    }

/*
### Processing form submission

#mdx:ProcessWithoutError

Outputs:

#mdx:ProcessWithoutError -o
*/
    function testProcessWithoutError(){

        #mdx:ProcessWithoutError
        // Simulate form submition
        $_REQUEST = [
            'name' => 'Mary',
            'email' => 'dontmaryme@doman.com',
            '_submit' => 1
        ];

        $form = new HtForm();
        $form->textin('name')->label('Name');
        $form->textin('email')->label('Email');
        $form->button('_submit','Submit');

        $form->context($_REQUEST);

        // Use "value" method to extract value of a field
        if($form->value('_submit')){

            // Extract all fields, except those prefixed with underscore
            $result = $form->process();

        }
        #/mdx print_r($result)
        $this->assertArraySubset($result->data, $_REQUEST);

    }

/*
### Validate form submission

#mdx:ProcessWithError

Outputs:

#mdx:ProcessWithError -o
*/
    function testProcessWithError(){

        #mdx:ProcessWithError
        // Simulate INVALID form data
        $_REQUEST = [
            'name' => '',
            'email' => 'dontmaryme__doman.com',
            '_submit' => 1
        ];

        $form = new HtForm();
        $form->textin('name')->label('Name')->required();
        $form->textin('email')->label('Email')
            ->required()
            ->filters()->ifnot('@', "Invalid email address");

        $form->button('_submit','Submit');

        $form->context($_REQUEST);

        // Use "value" method to extract value of a field
        if($form->value('_submit')){

            // Extract all fields, except those prefixed with underscore
            $result = $form->process();

        }
        #/mdx print_r($result)
        $this->assertNotEmpty($result->errors['name']);
        $this->assertNotEmpty($result->errors['email']);

        $this->assertContains($result->errors['name'], "$form");
        $this->assertContains($result->errors['email'], "$form");

    }

/*
### Namespacing form fields

#mdx:Namespacing

Outputs:

#mdx:Namespacing -o
*/
    function testNamespacing(){

        #mdx:Namespacing
        // The data is sent by the form in the following structure:
        $_REQUEST = [
            'user' => [
                'name' => 'Mary',
                'email' => '' // this should result in an error
            ],
            'person' => [
                'number' => 666,
                'city' => 'Nowhereland'
            ],
            '_submit' => 1 // this field is in the "root"
        ];

        $form = new HtForm();
        // Namespacing is achieved using square brackets:
        $form->textin('user[name]')->label('Username');
        $form->textin('user[email]')->label('E-mail')->required("Email is required!");
        $form->textin('person[number]')->label('Number');
        $form->textin('person[city]')->label('City');
        $form->button('_submit','Submit');

        $form->context($_REQUEST);

        // Use "value" method to extract value of a field
        if($form->value('_submit')){

            // Extract all fields, except those prefixed with underscore
            $result = $form->process();

        }
        #/mdx print_r($result)
        $this->assertEquals('Mary', $result->data['user[name]']);
        $this->assertEquals('Email is required!', $result->errors['user[email]']);

    }

/*
### Unfold form data

#mdx:Unfold

Outputs:

#mdx:Unfold -o
*/
    function testUnfold(){

        #mdx:Unfold
        $_REQUEST = [
            'user' => [
                'name' => 'Mary',
                'email' => ''
            ],
            '_submit' => 1
        ];

        $form = new HtForm();
        $form->textin('user[name]')->label('Username');
        $form->textin('user[email]')->label('E-mail')->required("Email is required!");
        $form->button('_submit','Submit');

        $form->context($_REQUEST);

        if($form->value('_submit')){
            $result = $form->process()->unfold();
        }
        #/mdx print_r($result)
        $this->assertEquals('Mary', $result->data['user']['name']);
        $this->assertEquals('Email is required!', $result->errors['user']['email']);
    }


}