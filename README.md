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

<form id="form_5918f59b23741" action="?">
 <div class="widget field_5918f59b23d03" style="display:block">
   <input id="field_5918f59b23d03" name="email" value="" />
   <div style="color:yellow;background:red" class="error">
   </div>
 </div>
 <div>
   <button id="field_5918f59b23e93" name="submit" style="display:block" value="field_5918f59b23e93">Submit
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

<form id="form_5918f59b25ce7" action="?">
 <div class="widget field_5918f59b25d69" style="display:block">
   <label style="display:block" for="field_5918f59b25d69">E-mail: </label>
   <input id="field_5918f59b25d69" name="email" value="" />
   <div style="color:yellow;background:red" class="error">
   </div>
 </div>
 <div>
   <button id="field_5918f59b25e04" name="submit" style="display:block" value="field_5918f59b25e04">Submit
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

<form id="form_5918f59b265dc" action="?">
 <div class="widget field_5918f59b2665e" style="display:block">
   <label style="display:inline-block;margin-right:10px" for="field_5918f59b2665e">E-mail:</label>
   <input id="field_5918f59b2665e" name="email" value="" />
   <div style="color:yellow;background:red" class="error">
   </div>
 </div>
 <div>
   <button id="field_5918f59b26701" name="submit" style="display:block" value="field_5918f59b26701">Submit
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

<form id="form_5918f59b26e47" action="?">
 <div class="widget field_5918f59b26ec6" style="display:block">
   <input id="field_5918f59b26ec6" name="email" value="" />
   <div style="color:yellow;background:red" class="error">
   </div>
 </div>
 <div>
   <button id="field_5918f59b26f86" name="submit" style="display:block" value="field_5918f59b26f86">Submit
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

<form id="my_form" action="some_script.php" method="post" class="some_class">
 <div class="widget field_5918f59b276eb" style="display:block">
   <input id="field_5918f59b276eb" name="email" value="" />
   <div style="color:yellow;background:red" class="error">
   </div>
 </div>
 <div>
   <button id="field_5918f59b27781" name="submit" style="display:block" value="field_5918f59b27781">Submit
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

<form action="some_script.php" method="post" class="some_class">
 <div class="widget field_5918f59b27fe4" style="display:block">
   <label style="display:block" for="field_5918f59b27fe4">Email:</label>
   <input id="field_5918f59b27fe4" name="email" size="50" class="email" value="" />
   <div style="color:yellow;background:red" class="error">
   </div>
 </div>
 <div class="widget field_5918f59b281bc" style="display:block">
   <label style="display:block" for="field_5918f59b281bc">Comment:</label>
   <textarea id="field_5918f59b281bc" name="comment" cols="50" rows="10"></textarea>
   <div style="color:yellow;background:red" class="error">
   </div>
 </div>
 <div class="widget field_5918f59b28436" style="display:block">
   <label style="display:block" for="field_5918f59b28436">
   <input id="field_5918f59b28436" name="newsletter" type="checkbox" value="1" checked="checked" /> Receive Newsletter?</label>
   <input type="hidden" name="newsletter_submit" value="1" />
 </div>
 <div>
   <input id="field_5918f59b28860" name="key" type="hidden" value="value" />
   <div class="widget field_5918f59b28b3a" style="display:block">
     <select id="field_5918f59b28b3a" name="gender">
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
   <button id="field_5918f59b28be8" name="submit" style="display:block" value="field_5918f59b28be8">Submit
   </button>
   <button id="field_5918f59b28c84" name="Cancel" style="display:block" value="field_5918f59b28c84">Cancel
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

<form id="form_5918f59b29e38" action="?">
 <div class="widget field_5918f59b29ebe" style="display:inline-block;vertical-align:text-top">
   <label style="display:block" for="field_5918f59b29ebe">First Name</label>
   <input id="field_5918f59b29ebe" name="fst_name" value="" />
   <div style="color:yellow;background:red" class="error">
   </div>
 </div>
 <div class="widget field_5918f59b29f57" style="display:inline-block;vertical-align:text-top">
   <label style="display:block" for="field_5918f59b29f57">Last Name</label>
   <input id="field_5918f59b29f57" name="lst_name" value="" />
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

echo $form;
```

Outputs:

```html

<form id="form_5918f59b2a811" action="?">
 <div class="widget field_5918f59b2a894" style="display:block">
   <label style="display:block" for="field_5918f59b2a894">First Name</label>
   <input id="field_5918f59b2a894" name="fst_name" value="" readonly="readonly" />
   <div style="color:yellow;background:red" class="error">
   </div>
 </div>
 <div class="widget field_5918f59b2a925" style="display:block">
   <label style="display:block" for="field_5918f59b2a925">Last Name</label>
   <input id="field_5918f59b2a925" name="lst_name" value="" readonly="readonly" />
   <div style="color:yellow;background:red" class="error">
   </div>
 </div>
</form>
<form action="?">
 <div class="widget field_5918f59b2a894" style="display:block">
   <label style="display:block" for="field_5918f59b2a894">First Name</label>
   <input name="fst_name" value="" readonly="readonly" />
   <div style="color:yellow;background:red" class="error">
   </div>
 </div>
 <div class="widget field_5918f59b2a925" style="display:block">
   <label style="display:block" for="field_5918f59b2a925">Last Name</label>
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

<form id="form_5918f59b2b789" action="?">
 <div class="widget field_5918f59b2b808" style="display:block">
   <label style="display:block" for="field_5918f59b2b808">Name</label>
   <input id="field_5918f59b2b808" name="name" value="Mary" />
   <div style="color:yellow;background:red" class="error">
   </div>
 </div>
 <div class="widget field_5918f59b2b8a3" style="display:block">
   <label style="display:block" for="field_5918f59b2b8a3">Email</label>
   <input id="field_5918f59b2b8a3" name="email" value="dontmaryme@doman.com" />
   <div style="color:yellow;background:red" class="error">
   </div>
 </div>
 <div class="widget field_5918f59b2b925" style="display:block">
   <select id="field_5918f59b2b925" name="job">
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