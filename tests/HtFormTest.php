<?php

#mdx:h require
require 'vendor/autoload.php';

#mdx:h use
use FlSouto\HtForm;

/*
# HtForm

## Installation

To install this package use composer:

```
composer require flsouto/htform
```

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

By default fields don't have a label but you can add one by calling the `label` setter on a field instance:

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

By default a field's label is a block level element. You can change that by passing the `inline => true` flag:

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

You can use the `placeholder` setter which is really just a shortcut for setting the field's 'placeholder' attribute:

#mdx:FieldWithPlaceholder

Outputs:

#mdx:FieldWithPlaceholder -o httidy

Other attributes can be set by passing an associative array to the field's `attrs` method.

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
### Adding different types of fields

A form is all about attaching a bunch of fields for taking user input. Different field types are available in this library:

#mdx:DifferentFieldTypes

Outputs:

#mdx:DifferentFieldTypes -o httidy

Each field type is defined in its own class. These classes have a repostory of their own too.
For more info on the fields API, take a look in the following repositories:

- [HtField](http://github.com/flsouto/htfield) - Abstract base class for all fields
    - [HtButton](http://github.com/flsouto/htbutton) - Non-widget field
    - [HtHidden](http://github.com/flsouto/hthidden) - Non-widget field

- [HtWidget](http://github.com/flsouto/htwidget) - Base class for all widget types (extends HtField)
    - [HtTextin](http://github.com/flsouto/httextin) - Widget for single-line text input
    - [HtTextar](http://github.com/flsouto/httextar) - Widget for multi-line text input
    - [HtCheckb](http://github.com/flsouto/htcheckb) - Widget for boolean input (checkbox)
    - [HtSelect](http://github.com/flsouto/htselect) - Widget for choosing an option from a list
    - [HtUpload](http://github.com/flsouto/htupload) - Widget for uploading a file

Notice: when adding the "upload" field the form will automatically have enctype=multipart/form-data and method=POST

*/
    function testDifferentFieldTypes(){
        #mdx:DifferentFieldTypes
        $form = new HtForm();

        $form->textin('email')->label('Email:')->size(50)->attrs(['class'=>'email']);
        $form->textar('comment')->label('Comment:')->cols(50)->rows(10);
        $form->checkb('newsletter','Receive Newsletter?')->fallback(1); // checked by default
        $form->hidden('key','value');
        $form->select('gender')->options(['M'=>'Male','F'=>'Female'])->caption('Choose Gender: ');
        $form->upload('portfolio',__DIR__)->label('Choose a pdf file')->required('Please provide a portfolio')->accept(['application/pdf']);
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
        $this->assertContains("Choose a pdf file","$form");

    }

/*
### Make all fields inline at once

Sometimes you need to build "quick search" type of forms in which all fields are rendered
in a single line. For this you can use the `inline` method on the form instance:

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
Sometimes you want to reuse the same form layout/structure but in readonly mode. In this case
you can call the `readonly` method of the form object in order to disable editing on all fields:

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
### Changing Form Attributes

By default, the form is rendered with the following attributes:

- method: GET
- action: ?
- id: random id

But these can be changed easily by calling the corresponding setters on the form instance:

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
### Populate form with data

In order to populate the form with data you have to call the `context` method on the form object and pass an associative array to it.
The keys of the associative array must match the names of the fields you added to the form:

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
Processing a form is all about populating it with incoming data and calling the `process` method.
It is also good practice to check if a flag is present indicating that the form has been sent. Check this out:

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

        // Populate form with data sent from request
        $form->context($_REQUEST);

        // Check if there is a flag
        if($form->value('_submit')){

            // Extract all fields, except those prefixed with underscore
            $result = $form->process();

            #mdx:o print_r($result)

        }
        #/mdx
        $this->assertArraySubset($result->data, $_REQUEST);

    }

/*
### Validate form submission
You can add validation rules to be checked upon form submission. Validation rules are added on a per-field basis
and yield error messages when something is wrong. These errors are available in the result object returned
by the process method. Take a look:

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

        if($form->value('_submit')){

            // Extract data and check for errors
            $result = $form->process();
            #mdx:o print_r($result)
        }
        #/mdx
        $this->assertNotEmpty($result->errors['name']);
        $this->assertNotEmpty($result->errors['email']);

        $this->assertContains($result->errors['name'], "$form");
        $this->assertContains($result->errors['email'], "$form");

    }

/*
### Namespacing form fields
The data structure behind your form doesn't have to be flat. You can group fields into logical sections, see example below:
#mdx:Namespacing

Outputs:

#mdx:Namespacing -o
*/
    function testNamespacing(){

        #mdx:Namespacing
        // The data is sent by the form in the following structure:
        $_REQUEST = [
            'user' => [ // these fields are in the "user" section
                'name' => 'Mary',
                'email' => '' // this should result in an error
            ],
            'person' => [ // these fields are in the "person" section
                'number' => 666,
                'city' => 'Nowhereland'
            ],
            '_submit' => 1 // this field is in the "root" section
        ];

        $form = new HtForm();
        // Namespacing is achieved using square brackets:
        $form->textin('user[name]')->label('Username');
        $form->textin('user[email]')->label('E-mail')->required("Email is required!");
        $form->textin('person[number]')->label('Number');
        $form->textin('person[city]')->label('City');
        $form->button('_submit','Submit');

        $form->context($_REQUEST);

        if($form->value('_submit')){

            $result = $form->process();

            #mdx:o print_r($result)

        }
        #/mdx
        $this->assertEquals('Mary', $result->data['user[name]']);
        $this->assertEquals('Email is required!', $result->errors['user[email]']);

    }

/*
### Unfold form data

As you may have seen in the last example, even though we can process complex data structures sent over a request,
the data is extracted in a flat format. Luckily, the result object provides a method called `unfold` which can be used to reconstruct
the data into a multidimensional array:

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
            #mdx:o print_r($result)
        }
        #/mdx
        $this->assertEquals('Mary', $result->data['user']['name']);
        $this->assertEquals('Email is required!', $result->errors['user']['email']);
    }


}
