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

<form id="form_5921f5a068b82" action="?">
 <div class="widget field_5921f5a06919e" style="display:block">
   <input id="field_5921f5a06919e" name="email" value="" />
   <div style="color:yellow;background:red" class="error">
   </div>
 </div>
 <div>
   <button id="field_5921f5a069335" name="submit" style="display:block" value="field_5921f5a069335">Submit
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

<form id="form_5921f5a06b024" action="?">
 <div class="widget field_5921f5a06b0b5" style="display:block">
   <label style="display:block" for="field_5921f5a06b0b5">E-mail: </label>
   <input id="field_5921f5a06b0b5" name="email" value="" />
   <div style="color:yellow;background:red" class="error">
   </div>
 </div>
 <div>
   <button id="field_5921f5a06b153" name="submit" style="display:block" value="field_5921f5a06b153">Submit
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

<form id="form_5921f5a06b987" action="?">
 <div class="widget field_5921f5a06ba1a" style="display:block">
   <label style="display:inline-block;margin-right:10px" for="field_5921f5a06ba1a">E-mail:</label>
   <input id="field_5921f5a06ba1a" name="email" value="" />
   <div style="color:yellow;background:red" class="error">
   </div>
 </div>
 <div>
   <button id="field_5921f5a06babf" name="submit" style="display:block" value="field_5921f5a06babf">Submit
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

<form id="form_5921f5a06c2f4" action="?">
 <div class="widget field_5921f5a06c385" style="display:block">
   <input id="field_5921f5a06c385" name="email" value="" />
   <div style="color:yellow;background:red" class="error">
   </div>
 </div>
 <div>
   <button id="field_5921f5a06c42d" name="submit" style="display:block" value="field_5921f5a06c42d">Submit
   </button>
 </div>
</form>

```

### Specifying Form Attributes

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
 <div class="widget field_5921f5a06cbaa" style="display:block">
   <input id="field_5921f5a06cbaa" name="email" value="" />
   <div style="color:yellow;background:red" class="error">
   </div>
 </div>
 <div>
   <button id="field_5921f5a06cc6d" name="submit" style="display:block" value="field_5921f5a06cc6d">Submit
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
 <div class="widget field_5921f5a06d498" style="display:block">
   <label style="display:block" for="field_5921f5a06d498">Email:</label>
   <input id="field_5921f5a06d498" name="email" size="50" class="email" value="" />
   <div style="color:yellow;background:red" class="error">
   </div>
 </div>
 <div class="widget field_5921f5a06d67d" style="display:block">
   <label style="display:block" for="field_5921f5a06d67d">Comment:</label>
   <textarea id="field_5921f5a06d67d" name="comment" cols="50" rows="10"></textarea>
   <div style="color:yellow;background:red" class="error">
   </div>
 </div>
 <div class="widget field_5921f5a06d8e1" style="display:block">
   <label style="display:block" for="field_5921f5a06d8e1">
   <input id="field_5921f5a06d8e1" name="newsletter" type="checkbox" value="1" checked="checked" /> Receive Newsletter?</label>
   <input type="hidden" name="newsletter_submit" value="1" />
 </div>
 <div>
   <input id="field_5921f5a06dd1f" name="key" type="hidden" value="value" />
   <div class="widget field_5921f5a06dffe" style="display:block">
     <select id="field_5921f5a06dffe" name="gender">
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
   <button id="field_5921f5a06e0b3" name="submit" style="display:block" value="field_5921f5a06e0b3">Submit
   </button>
   <button id="field_5921f5a06e150" name="Cancel" style="display:block" value="field_5921f5a06e150">Cancel
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

<form id="form_5921f5a06f3b7" action="?">
 <div class="widget field_5921f5a06f447" style="display:inline-block;vertical-align:text-top">
   <label style="display:block" for="field_5921f5a06f447">First Name</label>
   <input id="field_5921f5a06f447" name="fst_name" value="" />
   <div style="color:yellow;background:red" class="error">
   </div>
 </div>
 <div class="widget field_5921f5a06f4e3" style="display:inline-block;vertical-align:text-top">
   <label style="display:block" for="field_5921f5a06f4e3">Last Name</label>
   <input id="field_5921f5a06f4e3" name="lst_name" value="" />
   <div style="color:yellow;background:red" class="error">
   </div>
 </div>
 <div>
   <button id="field_5921f5a06f576" name="submit" style="display:inline-block;vertical-align:text-top" value="field_5921f5a06f576">Submit
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

<form id="form_5921f5a070b61" action="?">
 <div class="widget field_5921f5a070bf6" style="display:block">
   <label style="display:block" for="field_5921f5a070bf6">First Name</label>
   <input id="field_5921f5a070bf6" name="fst_name" value="" readonly="readonly" />
   <div style="color:yellow;background:red" class="error">
   </div>
 </div>
 <div class="widget field_5921f5a070c91" style="display:block">
   <label style="display:block" for="field_5921f5a070c91">Last Name</label>
   <input id="field_5921f5a070c91" name="lst_name" value="" readonly="readonly" />
   <div style="color:yellow;background:red" class="error">
   </div>
 </div>
 <div>
   <button id="field_5921f5a070d25" name="submit" style="display:block" value="field_5921f5a070d25">Submit
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

<form id="form_5921f5a071732" action="?">
 <div class="widget field_5921f5a0717b9" style="display:block">
   <label style="display:block" for="field_5921f5a0717b9">Name</label>
   <input id="field_5921f5a0717b9" name="name" value="Mary" />
   <div style="color:yellow;background:red" class="error">
   </div>
 </div>
 <div class="widget field_5921f5a071857" style="display:block">
   <label style="display:block" for="field_5921f5a071857">Email</label>
   <input id="field_5921f5a071857" name="email" value="dontmaryme@doman.com" />
   <div style="color:yellow;background:red" class="error">
   </div>
 </div>
 <div class="widget field_5921f5a0718e7" style="display:block">
   <select id="field_5921f5a0718e7" name="job">
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
   <button id="field_5921f5a071986" name="submit" style="display:block" value="field_5921f5a071986">Submit
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