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

```
<form id="5918e65e204d6"><div class="widget 5918e65e20c04" style="display:block">

<input id="5918e65e20c04" name="email" value="" />
<div style="color:yellow;background:red" class="error">

</div>
</div><button id="5918e65e20e11" name="Submit" style="display:block" value="5918e65e20e11">Submit</button></form>
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

```
<form id="5918e65e215b3"><div class="widget 5918e65e2162f" style="display:block">
<label style="display:block" for="5918e65e2162f">E-mail: </label>
<input id="5918e65e2162f" name="email" value="" />
<div style="color:yellow;background:red" class="error">

</div>
</div><button id="5918e65e216c9" name="Submit" style="display:block" value="5918e65e216c9">Submit</button></form>
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

```
<form id="5918e65e21989"><div class="widget 5918e65e21a04" style="display:block">
<label style="display:inline-block;margin-right:10px" for="5918e65e21a04">E-mail:</label>
<input id="5918e65e21a04" name="email" value="" />
<div style="color:yellow;background:red" class="error">

</div>
</div><button id="5918e65e21aa7" name="Submit" style="display:block" value="5918e65e21aa7">Submit</button></form>
```

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

```
<form id="5918e65e21d18"><div class="widget 5918e65e21d91" style="display:block">

<input id="5918e65e21d91" name="email" placeholder="user@domain.com" value="" />
<div style="color:yellow;background:red" class="error">

</div>
</div><button id="5918e65e21e2b" name="Submit" style="display:block" value="5918e65e21e2b">Submit</button></form>
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

```
<form id="my_form" method="POST" action="some_script.php" class="some_class"><div class="widget 5918e65e22143" style="display:block">

<input id="5918e65e22143" name="email" value="" />
<div style="color:yellow;background:red" class="error">

</div>
</div><button id="5918e65e221d8" name="Submit" style="display:block" value="5918e65e221d8">Submit</button></form>
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

```
<form id="my_form" method="POST" action="some_script.php" class="some_class"><div class="widget 5918e65e22553" style="display:block">
<label style="display:block" for="5918e65e22553">Email:</label>
<input id="5918e65e22553" name="email" size="50" class="email" value="" />
<div style="color:yellow;background:red" class="error">

</div>
</div><div class="widget 5918e65e22749" style="display:block">
<label style="display:block" for="5918e65e22749">Comment:</label>
<textarea id="5918e65e22749" name="comment" cols="50" rows="10"></textarea>
<div style="color:yellow;background:red" class="error">

</div>
</div><div class="widget 5918e65e229c6" style="display:block">
<label style="display:block" for="5918e65e229c6"><input id="5918e65e229c6" name="newsletter" type="checkbox" value="1" checked="checked" /> Receive Newsletter?</label><input type="hidden" name="newsletter_submit" value="1" />
</div><input id="5918e65e22deb" name="key" type="hidden" value="value" /><div class="widget 5918e65e2316d" style="display:block">

<select id="5918e65e2316d" name="gender">
	<option value="0">Choose Gender: </option>	<option value="M">Male</option>
	<option value="F">Female</option>
</select>
<div style="color:yellow;background:red" class="error">

</div>
</div><button id="5918e65e23221" name="Submit" style="display:block" value="5918e65e23221">Submit</button><button id="5918e65e232bf" name="Cancel" style="display:block" value="5918e65e232bf">Cancel</button></form>
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

```
<form id="5918e65e2370d"><div class="widget 5918e65e23792" style="display:inline-block;vertical-align:text-top">
<label style="display:block" for="5918e65e23792">First Name</label>
<input id="5918e65e23792" name="fst_name" value="" />
<div style="color:yellow;background:red" class="error">

</div>
</div><div class="widget 5918e65e23829" style="display:inline-block;vertical-align:text-top">
<label style="display:block" for="5918e65e23829">Last Name</label>
<input id="5918e65e23829" name="lst_name" value="" />
<div style="color:yellow;background:red" class="error">

</div>
</div></form>
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

```
<form id="5918e65e23aff"><div class="widget 5918e65e23b7f" style="display:block">
<label style="display:block" for="5918e65e23b7f">First Name</label>
<input id="5918e65e23b7f" name="fst_name" value="" readonly="readonly" />
<div style="color:yellow;background:red" class="error">

</div>
</div><div class="widget 5918e65e23c0c" style="display:block">
<label style="display:block" for="5918e65e23c0c">Last Name</label>
<input id="5918e65e23c0c" name="lst_name" value="" readonly="readonly" />
<div style="color:yellow;background:red" class="error">

</div>
</div></form>
```