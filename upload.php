<?php

$directory_self = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);

$directory_uploads = $_SERVER['DOCUMENT_ROOT'] . $directory_self . 'images/';
$uploadForm = 'http://' . $_SERVER['HTTP_HOST'] . $directory_self . 'upload.php';
$fieldName = 'file';

($_FILES[$fieldname]['error'] == 0) or error($errors[$_FILES[$fieldname]['error']], $uploadForm); 

@is_uploaded_file($_FILES[$fieldname]['tmp_name']) or error('not an HTTP upload', $uploadForm); 


@getimagesize($_FILES[$fieldname]['tmp_name']) or error('only image uploads are allowed', $uploadForm);

$now = time();
while(file_exists($uploadFilename = $directory_uploads.$now.'-'.$_FILES[$fieldname]['name'])) 
{
	$now++;
}
echo uploadFilename;

@move_uploaded_file($_FILES[$fieldname]['tmp_name'], $uploadFilename) 
    or error('receiving directory insuffiecient permission', $uploadForm);





function error($error, $location, $seconds = 5) 
{ 
    //header("Refresh: $seconds; URL="$location""); 
    echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"'."n". 
    '"http://www.w3.org/TR/html4/strict.dtd">'."nn". 
    '<html lang="en">'."n". 
    '    <head>'."n". 
    '        <meta http-equiv="content-type" content="text/html; charset=iso-8859-1">'."nn". 
    '        <link rel="stylesheet" type="text/css" href="stylesheet.css">'."nn". 
    '    <title>Upload error</title>'."nn". 
    '    </head>'."nn". 
    '    <body>'."nn". 
    '    <div id="Upload">'."nn". 
    '        <h1>Upload failure</h1>'."nn". 
    '        <p>An error has occurred: '."nn". 
    '        <span class="red">' . $error . '...</span>'."nn". 
    '         The upload form is reloading</p>'."nn". 
    '     </div>'."nn". 
    '</html>'; 
    exit; 
}


?>