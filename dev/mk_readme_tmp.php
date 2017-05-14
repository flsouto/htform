<?php

$mdx='php /www/flsouto/mdx/process.php';
$mdxfy='php /www/flsouto/mdx/mdxfy.php';
$textract='php /www/flsouto/textract/process.php';

$output = `$mdxfy tests/HtFormTest.php`;
$output = str_replace("/mdx", "/mdx echo \$form", $output);
$output = str_replace("use", "#mdx:h use\nuse", $output);
$output = str_replace("require", "#mdx:h require\nrequire", $output);
file_put_contents("tmp.php",$output);

$output = `$textract tmp.php`;
$output = str_replace(" -o", " -o httidy", $output);
file_put_contents("README.mdx", $output);

exec("$mdx README.mdx tmp.php > README.md");
//exec("rm README.mdx");
//exec("rm tmp.php");