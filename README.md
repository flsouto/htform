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

```php
<?php
require 'vendor/autoload.php';
use FlSouto\HtForm;

$form = new HtForm();
$form->textin('email');
$form->button('Submit');

echo $form;
```

Outputs:

```html

<form id="form_60116ef75c0f3" action="?">
 <div class="widget field_60116ef75c373" style="display:block">
   <input id="field_60116ef75c373" name="email" value="" />
   <div style="color:yellow;background:red" class="error">
   </div>
 </div>
 <div>
   <button id="field_60116ef75c3dd" name="submit" style="display:block" value="field_60116ef75c3dd">Submit
   </button>
 </div>
</form>

```

That is pretty easy, huh?



### Adding labels to fields

By default fields don't have a label but you can add one by calling the `label` setter on a field instance:

```php
<?php
require 'vendor/autoload.php';
use FlSouto\HtForm;

$form = new HtForm();
$form->textin('email')->label('E-mail: ');
$form->button('Submit');

echo $form;
```

Outputs:

```html

<form id="form_60116ef75d523" action="?">
 <div class="widget field_60116ef75d52e" style="display:block">
   <label style="display:block" for="field_60116ef75d52e">E-mail: </label>
   <input id="field_60116ef75d52e" name="email" value="" />
   <div style="color:yellow;background:red" class="error">
   </div>
 </div>
 <div>
   <button id="field_60116ef75d53b" name="submit" style="display:block" value="field_60116ef75d53b">Submit
   </button>
 </div>
</form>

```

### Making field labels inline

By default a field's label is a block level element. You can change that by passing the `inline => true` flag:

```php
<?php
require 'vendor/autoload.php';
use FlSouto\HtForm;

$form = new HtForm();
$form->textin('email')->label(['text'=>'E-mail:','inline'=>true]);
$form->button('Submit');

echo $form;
```

Outputs:

```html

<form id="form_60116ef75d6ae" action="?">
 <div class="widget field_60116ef75d6b6" style="display:block">
   <label style="display:inline-block;margin-right:10px" for="field_60116ef75d6b6">E-mail:</label>
   <input id="field_60116ef75d6b6" name="email" value="" />
   <div style="color:yellow;background:red" class="error">
   </div>
 </div>
 <div>
   <button id="field_60116ef75d6c2" name="submit" style="display:block" value="field_60116ef75d6c2">Submit
   </button>
 </div>
</form>

```

### Defining Placeholders

You can use the `placeholder` setter which is really just a shortcut for setting the field's 'placeholder' attribute:

```php
<?php
require 'vendor/autoload.php';
use FlSouto\HtForm;

$form = new HtForm();
$form->textin('email')->placeholder('user@domain.com');
$form->button('Submit');

echo $form;
```

Outputs:

```html

<form id="form_60116ef75d81f" action="?">
 <div class="widget field_60116ef75d828" style="display:block">
   <input id="field_60116ef75d828" name="email" value="" />
   <div style="color:yellow;background:red" class="error">
   </div>
 </div>
 <div>
   <button id="field_60116ef75d834" name="submit" style="display:block" value="field_60116ef75d834">Submit
   </button>
 </div>
</form>

```

Other attributes can be set by passing an associative array to the field's `attrs` method.


### Adding different types of fields

A form is all about attaching a bunch of fields for taking user input. Different field types are available in this library:

```php
<?php
require 'vendor/autoload.php';
use FlSouto\HtForm;

$form = new HtForm();

$form->textin('email')->label('Email:')->size(50)->attrs(['class'=>'email']);
$form->textar('comment')->label('Comment:')->cols(50)->rows(10);
$form->checkb('newsletter','Receive Newsletter?')->fallback(1); // checked by default
$form->hidden('key','value');
$form->select('gender')->options(['M'=>'Male','F'=>'Female'])->caption('Choose Gender: ');
$form->upload('portfolio',__DIR__)->label('Choose a pdf file')->required('Please provide a portfolio')->accept(['application/pdf']);
$form->button('Submit');
$form->button('Cancel'); // more than one button can be added

echo $form;
```

Outputs:

```html

<form id="form_60116ef75d988" action="?" enctype="multipart/form-data" method="post">
 <div class="widget field_60116ef75d990" style="display:block">
   <label style="display:block" for="field_60116ef75d990">Email:</label>
   <input id="field_60116ef75d990" name="email" size="50" class="email" value="" />
   <div style="color:yellow;background:red" class="error">
   </div>
 </div>
 <div class="widget field_60116ef75da1d" style="display:block">
   <label style="display:block" for="field_60116ef75da1d">Comment:</label>
   <textarea id="field_60116ef75da1d" name="comment" cols="50" rows="10"></textarea>
   <div style="color:yellow;background:red" class="error">
   </div>
 </div>
 <div class="widget field_60116ef75dada" style="display:block">
   <label style="display:block" for="field_60116ef75dada">
   <input id="field_60116ef75dada" name="newsletter" type="checkbox" value="1" checked="checked" /> Receive Newsletter?</label>
   <input type="hidden" name="newsletter_submit" value="1" />
 </div>
 <div>
   <input id="field_60116ef75dc38" name="key" type="hidden" value="value" />
   <div class="widget field_60116ef75dd23" style="display:block">
     <select id="field_60116ef75dd23" name="gender">
       <option value="0">Choose Gender:
       </option>
       <option value="M">Male
       </option>
       <option value="F">Female
       </option>
     </select>
     <div style="color:yellow;background:red" class="error">
     </div>
   </div>
   <div class="widget field_60116ef75de16" style="display:block">
     <input id="field_60116ef75de16" name="portfolio_submit" type="file" style="display:none" />
     <label style="display:block;cursor:pointer" for="field_60116ef75de16">Choose a pdf file</label>
     <input type="hidden" name="portfolio" value="" />
     <div style="color:yellow;background:red" class="error">
     </div>
   </div>
   <button id="field_60116ef75de26" name="submit" style="display:block" value="field_60116ef75de26">Submit
   </button>
   <button id="field_60116ef75de31" name="Cancel" style="display:block" value="field_60116ef75de31">Cancel
   </button>
 </div>
</form>

```

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


### Make all fields inline at once

Sometimes you need to build "quick search" type of forms in which all fields are rendered
in a single line. For this you can use the `inline` method on the form instance:

```php
<?php
require 'vendor/autoload.php';
use FlSouto\HtForm;

$form = new HtForm();
$form->inline(true);
$form->textin('fst_name')->label('First Name');
$form->textin('lst_name')->label('Last Name');
$form->button('Submit');

echo $form;
```

Outputs:

```html

<form id="form_60116ef75e211" action="?">
 <div class="widget field_60116ef75e21b" style="display:inline-block;vertical-align:text-top">
   <label style="display:block" for="field_60116ef75e21b">First Name</label>
   <input id="field_60116ef75e21b" name="fst_name" value="" />
   <div style="color:yellow;background:red" class="error">
   </div>
 </div>
 <div class="widget field_60116ef75e225" style="display:inline-block;vertical-align:text-top">
   <label style="display:block" for="field_60116ef75e225">Last Name</label>
   <input id="field_60116ef75e225" name="lst_name" value="" />
   <div style="color:yellow;background:red" class="error">
   </div>
 </div>
 <div>
   <button id="field_60116ef75e22d" name="submit" style="display:inline-block;vertical-align:text-top" value="field_60116ef75e22d">Submit
   </button>
 </div>
</form>

```

### Make all fields readonly at once
Sometimes you want to reuse the same form layout/structure but in readonly mode. In this case
you can call the `readonly` method of the form object in order to disable editing on all fields:

```php
<?php
require 'vendor/autoload.php';
use FlSouto\HtForm;

$form = new HtForm();
$form->readonly(true);
$form->textin('fst_name')->label('First Name');
$form->textin('lst_name')->label('Last Name');
$form->button('Submit');

echo $form;
```

Outputs:

```html

<form id="form_60116ef75e413" action="?">
 <div class="widget field_60116ef75e41c" style="display:block">
   <label style="display:block" for="field_60116ef75e41c">First Name</label>
   <input id="field_60116ef75e41c" name="fst_name" value="" readonly="readonly" />
   <div style="color:yellow;background:red" class="error">
   </div>
 </div>
 <div class="widget field_60116ef75e425" style="display:block">
   <label style="display:block" for="field_60116ef75e425">Last Name</label>
   <input id="field_60116ef75e425" name="lst_name" value="" readonly="readonly" />
   <div style="color:yellow;background:red" class="error">
   </div>
 </div>
 <div>
   <button id="field_60116ef75e42d" name="submit" style="display:block" value="field_60116ef75e42d">Submit
   </button>
 </div>
</form>

```

### Changing Form Attributes

By default, the form is rendered with the following attributes:

- method: GET
- action: ?
- id: random id

But these can be changed easily by calling the corresponding setters on the form instance:

```php
<?php
require 'vendor/autoload.php';
use FlSouto\HtForm;

$form = new HtForm();
$form->method('POST')
    ->action('some_script.php')
    ->attrs(['class'=>'some_class','id'=>'my_form']);

$form->textin('email');
$form->button('Submit');

echo $form;
```

Outputs:

```html

<form id="my_form" action="some_script.php" method="post" class="some_class">
 <div class="widget field_60116ef75e604" style="display:block">
   <input id="field_60116ef75e604" name="email" value="" />
   <div style="color:yellow;background:red" class="error">
   </div>
 </div>
 <div>
   <button id="field_60116ef75e60d" name="submit" style="display:block" value="field_60116ef75e60d">Submit
   </button>
 </div>
</form>

```

### Populate form with data

In order to populate the form with data you have to call the `context` method on the form object and pass an associative array to it.
The keys of the associative array must match the names of the fields you added to the form:

```php
<?php
require 'vendor/autoload.php';
use FlSouto\HtForm;

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

echo $form;
```

Outputs:

```html

<form id="form_60116ef75e78b" action="?">
 <div class="widget field_60116ef75e793" style="display:block">
   <label style="display:block" for="field_60116ef75e793">Name</label>
   <input id="field_60116ef75e793" name="name" value="Mary" />
   <div style="color:yellow;background:red" class="error">
   </div>
 </div>
 <div class="widget field_60116ef75e79d" style="display:block">
   <label style="display:block" for="field_60116ef75e79d">Email</label>
   <input id="field_60116ef75e79d" name="email" value="dontmaryme@doman.com" />
   <div style="color:yellow;background:red" class="error">
   </div>
 </div>
 <div class="widget field_60116ef75e7a3" style="display:block">
   <select id="field_60116ef75e7a3" name="job">
     <option value="0">Job:
     </option>
     <option value="1" selected="selected">Secretary
     </option>
     <option value="2">Manager
     </option>
     <option value="3">Programmer
     </option>
   </select>
   <div style="color:yellow;background:red" class="error">
   </div>
 </div>
 <div>
   <button id="field_60116ef75e7ac" name="submit" style="display:block" value="field_60116ef75e7ac">Submit
   </button>
 </div>
</form>

```

### Processing form submission
Processing a form is all about populating it with incoming data and calling the `process` method.
It is also good practice to check if a flag is present indicating that the form has been sent. Check this out:

```php
<?php
require 'vendor/autoload.php';
use FlSouto\HtForm;

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

    print_r($result);

}

```

Outputs:

```
FlSouto\HtFormResult Object
(
    [data] => Array
        (
            [name] => Mary
            [email] => dontmaryme@doman.com
        )

    [errors] => Array
        (
        )

)

```

### Validate form submission
You can add validation rules to be checked upon form submission. Validation rules are added on a per-field basis
and yield error messages when something is wrong. These errors are available in the result object returned
by the process method. Take a look:

```php
<?php
require 'vendor/autoload.php';
use FlSouto\HtForm;

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
    print_r($result);
}

```

Outputs:

```
FlSouto\HtFormResult Object
(
    [data] => Array
        (
            [name] => 
            [email] => dontmaryme__doman.com
        )

    [errors] => Array
        (
            [name] => This field is required
            [email] => Invalid email address
        )

)

```

### Namespacing form fields
The data structure behind your form doesn't have to be flat. You can group fields into logical sections, see example below:
```php
<?php
require 'vendor/autoload.php';
use FlSouto\HtForm;

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

    print_r($result);

}

```

Outputs:

```
FlSouto\HtFormResult Object
(
    [data] => Array
        (
            [user[name]] => Mary
            [user[email]] => 
            [person[number]] => 666
            [person[city]] => Nowhereland
        )

    [errors] => Array
        (
            [user[email]] => Email is required!
        )

)

```

### Unfold form data

As you may have seen in the last example, even though we can process complex data structures sent over a request,
the data is extracted in a flat format. Luckily, the result object provides a method called `unfold` which can be used to reconstruct
the data into a multidimensional array:

```php
<?php
require 'vendor/autoload.php';
use FlSouto\HtForm;

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
    print_r($result);
}

```

Outputs:

```
FlSouto\HtFormResult Object
(
    [data] => Array
        (
            [user] => Array
                (
                    [name] => Mary
                    [email] => 
                )

        )

    [errors] => Array
        (
            [user] => Array
                (
                    [email] => Email is required!
                )

        )

)

```