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

<form id="form_592a1c627b7e0" action="?">
 <div class="widget field_592a1c628652c" style="display:block">
   <input id="field_592a1c628652c" name="email" value="" />
   <div style="color:yellow;background:red" class="error">
   </div>
 </div>
 <div>
   <button id="field_592a1c628945f" name="submit" style="display:block" value="field_592a1c628945f">Submit
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

<form id="form_592a1c62920c4" action="?">
 <div class="widget field_592a1c629215a" style="display:block">
   <label style="display:block" for="field_592a1c629215a">E-mail: </label>
   <input id="field_592a1c629215a" name="email" value="" />
   <div style="color:yellow;background:red" class="error">
   </div>
 </div>
 <div>
   <button id="field_592a1c629221a" name="submit" style="display:block" value="field_592a1c629221a">Submit
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

<form id="form_592a1c62929d0" action="?">
 <div class="widget field_592a1c6292a50" style="display:block">
   <label style="display:inline-block;margin-right:10px" for="field_592a1c6292a50">E-mail:</label>
   <input id="field_592a1c6292a50" name="email" value="" />
   <div style="color:yellow;background:red" class="error">
   </div>
 </div>
 <div>
   <button id="field_592a1c6292b14" name="submit" style="display:block" value="field_592a1c6292b14">Submit
   </button>
 </div>
</form>

```

### Defining Placeholders

Use can use the `placeholder` setter which is really just a shortcut for setting the field's 'placeholder' attribute:

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

<form id="form_592a1c629328c" action="?">
 <div class="widget field_592a1c629332f" style="display:block">
   <input id="field_592a1c629332f" name="email" value="" />
   <div style="color:yellow;background:red" class="error">
   </div>
 </div>
 <div>
   <button id="field_592a1c62933d8" name="submit" style="display:block" value="field_592a1c62933d8">Submit
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

echo $form;
```

Outputs:

```html

<form id="my_form" action="some_script.php" method="post" class="some_class">
 <div class="widget field_592a1c6293c46" style="display:block">
   <label style="display:block" for="field_592a1c6293c46">Email:</label>
   <input id="field_592a1c6293c46" name="email" size="50" class="email" value="" />
   <div style="color:yellow;background:red" class="error">
   </div>
 </div>
 <div class="widget field_592a1c6297113" style="display:block">
   <label style="display:block" for="field_592a1c6297113">Comment:</label>
   <textarea id="field_592a1c6297113" name="comment" cols="50" rows="10"></textarea>
   <div style="color:yellow;background:red" class="error">
   </div>
 </div>
 <div class="widget field_592a1c62974a1" style="display:block">
   <label style="display:block" for="field_592a1c62974a1">
   <input id="field_592a1c62974a1" name="newsletter" type="checkbox" value="1" checked="checked" /> Receive Newsletter?</label>
   <input type="hidden" name="newsletter_submit" value="1" />
 </div>
 <div>
   <input id="field_592a1c629ace0" name="key" type="hidden" value="value" />
   <div class="widget field_592a1c629b19e" style="display:block">
     <select id="field_592a1c629b19e" name="gender">
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
   <button id="field_592a1c629b253" name="submit" style="display:block" value="field_592a1c629b253">Submit
   </button>
   <button id="field_592a1c629b312" name="Cancel" style="display:block" value="field_592a1c629b312">Cancel
   </button>
 </div>
</form>

```

Each field type is defined in its own class. These classes have a repostory of its own too.
For more info on the fields API, take a look in the following repositories:

- [HtField](http://github.com/flsouto/htfield) - Abstract base class for all fields
    - [HtButton](http://github.com/flsouto/htbutton) - Non-widget field
    - [HtHidden](http://github.com/flsouto/hthidden) - Non-widget field

- [HtWidget](http://github.com/flsouto/htwidget) - Base class for all widget types (extends HtField)
    - [HtTextin](http://github.com/flsouto/httextin) - Widget for single-line text input
    - [HtTextar](http://github.com/flsouto/httextar) - Widget for multi-line text input
    - [HtCheckb](http://github.com/flsouto/htcheckb) - Widget for boolean input (checkbox)
    - [HtSelect](http://github.com/flsouto/htselect) - Widget for choosing an option from a list


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

<form id="form_592a1c629c655" action="?">
 <div class="widget field_592a1c629c6ee" style="display:inline-block;vertical-align:text-top">
   <label style="display:block" for="field_592a1c629c6ee">First Name</label>
   <input id="field_592a1c629c6ee" name="fst_name" value="" />
   <div style="color:yellow;background:red" class="error">
   </div>
 </div>
 <div class="widget field_592a1c629c78b" style="display:inline-block;vertical-align:text-top">
   <label style="display:block" for="field_592a1c629c78b">Last Name</label>
   <input id="field_592a1c629c78b" name="lst_name" value="" />
   <div style="color:yellow;background:red" class="error">
   </div>
 </div>
 <div>
   <button id="field_592a1c629c81e" name="submit" style="display:inline-block;vertical-align:text-top" value="field_592a1c629c81e">Submit
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

<form id="form_592a1c629d24f" action="?">
 <div class="widget field_592a1c629d2eb" style="display:block">
   <label style="display:block" for="field_592a1c629d2eb">First Name</label>
   <input id="field_592a1c629d2eb" name="fst_name" value="" readonly="readonly" />
   <div style="color:yellow;background:red" class="error">
   </div>
 </div>
 <div class="widget field_592a1c629d389" style="display:block">
   <label style="display:block" for="field_592a1c629d389">Last Name</label>
   <input id="field_592a1c629d389" name="lst_name" value="" readonly="readonly" />
   <div style="color:yellow;background:red" class="error">
   </div>
 </div>
 <div>
   <button id="field_592a1c629d41b" name="submit" style="display:block" value="field_592a1c629d41b">Submit
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

<form action="some_script.php" method="post" class="some_class">
 <div class="widget field_592a1c629dedc" style="display:block">
   <input id="field_592a1c629dedc" name="email" value="" />
   <div style="color:yellow;background:red" class="error">
   </div>
 </div>
 <div>
   <button id="field_592a1c629df79" name="submit" style="display:block" value="field_592a1c629df79">Submit
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

<form id="form_592a1c629e70c" action="?">
 <div class="widget field_592a1c629e79f" style="display:block">
   <label style="display:block" for="field_592a1c629e79f">Name</label>
   <input id="field_592a1c629e79f" name="name" value="Mary" />
   <div style="color:yellow;background:red" class="error">
   </div>
 </div>
 <div class="widget field_592a1c629e83e" style="display:block">
   <label style="display:block" for="field_592a1c629e83e">Email</label>
   <input id="field_592a1c629e83e" name="email" value="dontmaryme@doman.com" />
   <div style="color:yellow;background:red" class="error">
   </div>
 </div>
 <div class="widget field_592a1c629e8cc" style="display:block">
   <select id="field_592a1c629e8cc" name="job">
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
   <button id="field_592a1c629e965" name="submit" style="display:block" value="field_592a1c629e965">Submit
   </button>
 </div>
</form>

```

### Processing form submission
Processing a form is all about populating the form with data sent over a request and calling the `process` method
in case there is a flag indicating that the form has been sent. Check out the following example:

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

// Use the "value" method to extract value of a field
if($form->value('_submit')){

    // Extract all fields, except those prefixed with underscore
    $result = $form->process();

}

print_r($result);
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

// Use "value" method to extract value of a field
if($form->value('_submit')){

    // Extract all fields, except those prefixed with underscore
    $result = $form->process();

}

print_r($result);
```

Outputs:

```
FlSouto\HtFormResult Object
(
    [data] => Array
        (
            [name] => 
            [email] => 
        )

    [errors] => Array
        (
            [name] => This field is required
            [email] => Invalid email address
        )

)

```

### Namespacing form fields

```php
<?php
require 'vendor/autoload.php';
use FlSouto\HtForm;

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

print_r($result);
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
}

print_r($result);
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