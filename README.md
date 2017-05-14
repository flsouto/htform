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

<form action="action">
 <div class="widget 5918ecafdd1e5" style="display:block">
   <input name="email" value="" />
   <div style="color:yellow;background:red" class="error">
   </div>
 </div>
 <div>
   <button name="submit" style="display:block" value="5918ecafdd37a">Submit
   </button>
 </div>
</form>

```

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

<form action="action">
 <div class="widget 5918ecafdf30d" style="display:block">
   <label style="display:block" for="5918ecafdf30d">E-mail: </label>
   <input name="email" value="" />
   <div style="color:yellow;background:red" class="error">
   </div>
 </div>
 <div>
   <button name="submit" style="display:block" value="5918ecafdf3ab">Submit
   </button>
 </div>
</form>

```

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

<form action="action">
 <div class="widget 5918ecafdfc0b" style="display:block">
   <label style="display:inline-block;margin-right:10px" for="5918ecafdfc0b">E-mail:</label>
   <input name="email" value="" />
   <div style="color:yellow;background:red" class="error">
   </div>
 </div>
 <div>
   <button name="submit" style="display:block" value="5918ecafdfcac">Submit
   </button>
 </div>
</form>

```

```php
<?php
require 'vendor/autoload.php';
use FlSouto\HtForm;

$form = new HtForm();
$form->textin('email')->placeholder('#mdx:h use
user@domain.com');
$form->button('Submit');

echo $form;
```

Outputs:

```html

<form action="action">
 <div class="widget 5918ecafe0443" style="display:block">
   <input name="email" value="" />
   <div style="color:yellow;background:red" class="error">
   </div>
 </div>
 <div>
   <button name="submit" style="display:block" value="5918ecafe04eb">Submit
   </button>
 </div>
</form>

```

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

<form id="my_form" method="post" action="some_script.php" class="some_class">
 <div class="widget 5918ecafe0c73" style="display:block">
   <input name="email" value="" />
   <div style="color:yellow;background:red" class="error">
   </div>
 </div>
 <div>
   <button name="submit" style="display:block" value="5918ecafe0d0d">Submit
   </button>
 </div>
</form>

```

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

<form method="post" action="some_script.php" class="some_class">
 <div class="widget 5918ecafe1510" style="display:block">
   <label style="display:block" for="5918ecafe1510">Email:</label>
   <input name="email" size="50" class="email" value="" />
   <div style="color:yellow;background:red" class="error">
   </div>
 </div>
 <div class="widget 5918ecafe16e0" style="display:block">
   <label style="display:block" for="5918ecafe16e0">Comment:</label>
   <textarea name="comment" cols="50" rows="10"></textarea>
   <div style="color:yellow;background:red" class="error">
   </div>
 </div>
 <div class="widget 5918ecafe19c1" style="display:block">
   <label style="display:block" for="5918ecafe19c1">
   <input name="newsletter" type="checkbox" value="1" checked="checked" /> Receive Newsletter?</label>
   <input type="hidden" name="newsletter_submit" value="1" />
 </div>
 <div>
   <input name="key" type="hidden" value="value" />
   <div class="widget 5918ecafe207c" style="display:block">
     <select name="gender">
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
   <button name="submit" style="display:block" value="5918ecafe2130">Submit
   </button>
   <button name="Cancel" style="display:block" value="5918ecafe21cc">Cancel
   </button>
 </div>
</form>

```

```php
<?php
require 'vendor/autoload.php';
use FlSouto\HtForm;

$form = new HtForm();
$form->inline(true);
$form->textin('fst_name')->label('First Name');
$form->textin('lst_name')->label('Last Name');

echo $form;
```

Outputs:

```html

<form action="action">
 <div class="widget 5918ecafe33a2" style="display:inline-block;vertical-align:text-top">
   <label style="display:block" for="5918ecafe33a2">First Name</label>
   <input name="fst_name" value="" />
   <div style="color:yellow;background:red" class="error">
   </div>
 </div>
 <div class="widget 5918ecafe3440" style="display:inline-block;vertical-align:text-top">
   <label style="display:block" for="5918ecafe3440">Last Name</label>
   <input name="lst_name" value="" />
   <div style="color:yellow;background:red" class="error">
   </div>
 </div>
</form>

```

```php
<?php
require 'vendor/autoload.php';
use FlSouto\HtForm;

$form = new HtForm();
$form->readonly(true);
   $form->textin('fst_name')->label('First Name');
   $form->textin('lst_name')->label('Last Name');

echo $form;
```

Outputs:

```html

<form action="action">
 <div class="widget 5918ecafe3da9" style="display:block">
   <label style="display:block" for="5918ecafe3da9">First Name</label>
   <input name="fst_name" value="" readonly="readonly" />
   <div style="color:yellow;background:red" class="error">
   </div>
 </div>
 <div class="widget 5918ecafe3e43" style="display:block">
   <label style="display:block" for="5918ecafe3e43">Last Name</label>
   <input name="lst_name" value="" readonly="readonly" />
   <div style="color:yellow;background:red" class="error">
   </div>
 </div>
</form>

```

```php
<?php
require 'vendor/autoload.php';
use FlSouto\HtForm;

$form = new HtForm();
   $form->textin('name')->label('Name');
   $form->textin('email')->label('Email');
   $form->select('job')->caption("Job:")->options([1=>'Secretary',2=>'Manager',3=>'Programmer']);

   $form->context([
       'name' => 'Mary',
       'email' => 'dontmaryme@doman.com',
       'job' => 1
   ]);

echo $form;
```

Outputs:

```html

<form action="action">
 <div class="widget 5918ecafe47c7" style="display:block">
   <label style="display:block" for="5918ecafe47c7">Name</label>
   <input name="name" value="Mary" />
   <div style="color:yellow;background:red" class="error">
   </div>
 </div>
 <div class="widget 5918ecafe4862" style="display:block">
   <label style="display:block" for="5918ecafe4862">Email</label>
   <input name="email" value="dontmaryme@doman.com" />
   <div style="color:yellow;background:red" class="error">
   </div>
 </div>
 <div class="widget 5918ecafe48dc" style="display:block">
   <select name="job">
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
</form>

```