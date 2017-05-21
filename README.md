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

<form id="form_5921f46e92b5f" action="?">
 <div class="widget field_5921f46e93157" style="display:block">
   <input id="field_5921f46e93157" name="email" value="" />
   <div style="color:yellow;background:red" class="error">
   </div>
 </div>
 <div>
   <button id="field_5921f46e932e3" name="submit" style="display:block" value="field_5921f46e932e3">Submit
   </button>
 </div>
</form>

```

That is pretty easy, huh?



### Adding labels to fields

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

<form id="form_5921f46e94f85" action="?">
 <div class="widget field_5921f46e9500c" style="display:block">
   <label style="display:block" for="field_5921f46e9500c">E-mail: </label>
   <input id="field_5921f46e9500c" name="email" value="" />
   <div style="color:yellow;background:red" class="error">
   </div>
 </div>
 <div>
   <button id="field_5921f46e950a9" name="submit" style="display:block" value="field_5921f46e950a9">Submit
   </button>
 </div>
</form>

```

### Making field labels inline

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

<form id="form_5921f46e95834" action="?">
 <div class="widget field_5921f46e958b8" style="display:block">
   <label style="display:inline-block;margin-right:10px" for="field_5921f46e958b8">E-mail:</label>
   <input id="field_5921f46e958b8" name="email" value="" />
   <div style="color:yellow;background:red" class="error">
   </div>
 </div>
 <div>
   <button id="field_5921f46e95959" name="submit" style="display:block" value="field_5921f46e95959">Submit
   </button>
 </div>
</form>

```

### Defining Placeholders

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

<form id="form_5921f46e9611b" action="?">
 <div class="widget field_5921f46e9619e" style="display:block">
   <input id="field_5921f46e9619e" name="email" value="" />
   <div style="color:yellow;background:red" class="error">
   </div>
 </div>
 <div>
   <button id="field_5921f46e96242" name="submit" style="display:block" value="field_5921f46e96242">Submit
   </button>
 </div>
</form>

```

### Specifying Field Attributes

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
 <div class="widget field_5921f46e96a3c" style="display:block">
   <input id="field_5921f46e96a3c" name="email" value="" />
   <div style="color:yellow;background:red" class="error">
   </div>
 </div>
 <div>
   <button id="field_5921f46e96ad2" name="submit" style="display:block" value="field_5921f46e96ad2">Submit
   </button>
 </div>
</form>

```

### Adding different types of fields

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

<form action="some_script.php" method="post" class="some_class">
 <div class="widget field_5921f46e9732b" style="display:block">
   <label style="display:block" for="field_5921f46e9732b">Email:</label>
   <input id="field_5921f46e9732b" name="email" size="50" class="email" value="" />
   <div style="color:yellow;background:red" class="error">
   </div>
 </div>
 <div class="widget field_5921f46e9750d" style="display:block">
   <label style="display:block" for="field_5921f46e9750d">Comment:</label>
   <textarea id="field_5921f46e9750d" name="comment" cols="50" rows="10"></textarea>
   <div style="color:yellow;background:red" class="error">
   </div>
 </div>
 <div class="widget field_5921f46e97770" style="display:block">
   <label style="display:block" for="field_5921f46e97770">
   <input id="field_5921f46e97770" name="newsletter" type="checkbox" value="1" checked="checked" /> Receive Newsletter?</label>
   <input type="hidden" name="newsletter_submit" value="1" />
 </div>
 <div>
   <input id="field_5921f46e97bbd" name="key" type="hidden" value="value" />
   <div class="widget field_5921f46e97e87" style="display:block">
     <select id="field_5921f46e97e87" name="gender">
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
   <button id="field_5921f46e97f2f" name="submit" style="display:block" value="field_5921f46e97f2f">Submit
   </button>
   <button id="field_5921f46e97fc9" name="Cancel" style="display:block" value="field_5921f46e97fc9">Cancel
   </button>
 </div>
</form>

```

### Make all fields inline at once

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

<form id="form_5921f46e9919b" action="?">
 <div class="widget field_5921f46e99223" style="display:inline-block;vertical-align:text-top">
   <label style="display:block" for="field_5921f46e99223">First Name</label>
   <input id="field_5921f46e99223" name="fst_name" value="" />
   <div style="color:yellow;background:red" class="error">
   </div>
 </div>
 <div class="widget field_5921f46e992bd" style="display:inline-block;vertical-align:text-top">
   <label style="display:block" for="field_5921f46e992bd">Last Name</label>
   <input id="field_5921f46e992bd" name="lst_name" value="" />
   <div style="color:yellow;background:red" class="error">
   </div>
 </div>
 <div>
   <button id="field_5921f46e9934d" name="submit" style="display:inline-block;vertical-align:text-top" value="field_5921f46e9934d">Submit
   </button>
 </div>
</form>

```

### Make all fields readonly at once

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

<form id="form_5921f46e99d5f" action="?">
 <div class="widget field_5921f46e99de6" style="display:block">
   <label style="display:block" for="field_5921f46e99de6">First Name</label>
   <input id="field_5921f46e99de6" name="fst_name" value="" readonly="readonly" />
   <div style="color:yellow;background:red" class="error">
   </div>
 </div>
 <div class="widget field_5921f46e99e7f" style="display:block">
   <label style="display:block" for="field_5921f46e99e7f">Last Name</label>
   <input id="field_5921f46e99e7f" name="lst_name" value="" readonly="readonly" />
   <div style="color:yellow;background:red" class="error">
   </div>
 </div>
 <div>
   <button id="field_5921f46e99f13" name="submit" style="display:block" value="field_5921f46e99f13">Submit
   </button>
 </div>
</form>

```

### Prepopulate form with data

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

<form id="form_5921f46e9a98e" action="?">
 <div class="widget field_5921f46e9aa12" style="display:block">
   <label style="display:block" for="field_5921f46e9aa12">Name</label>
   <input id="field_5921f46e9aa12" name="name" value="Mary" />
   <div style="color:yellow;background:red" class="error">
   </div>
 </div>
 <div class="widget field_5921f46e9ab0c" style="display:block">
   <label style="display:block" for="field_5921f46e9ab0c">Email</label>
   <input id="field_5921f46e9ab0c" name="email" value="dontmaryme@doman.com" />
   <div style="color:yellow;background:red" class="error">
   </div>
 </div>
 <div class="widget field_5921f46e9ab9c" style="display:block">
   <select id="field_5921f46e9ab9c" name="job">
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
   <button id="field_5921f46e9ac34" name="submit" style="display:block" value="field_5921f46e9ac34">Submit
   </button>
 </div>
</form>

```

### Processing form submission

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