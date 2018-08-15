# FileGrabber for Suitcore

## What is it?
Grab a file from outer space and save into your universe.

## How To use ?
install via composer :
```shell
composer require suitcore/filegrabber
```
Use in you file :
```php
<?php

use Suitcore\FileGrabber\FileGrabber;

$url = 'https://somewhere_on_the_internet/file_name';
$file = app(FileGrabber::class)->from($url);

// or you can use facade instead

use FileGrab;
// or
use Suitcore\FileGrabber\Facades\FileGrab;

$url = 'https://somewhere_on_the_internet/file_name';
$file = FileGrab::from($url); 

```

## Result
If success, the result is class Suitcore\File\File which is inherit from Symfony\Component\HttpFoundation\File\File.
If not, you will get boolean false as the result.

## To Deal with Large files or stream mode, you can add second parameter with value true.
```shell
$file = app(FileGrabber::class)->from($url, true);
// or
$file = FileGrab::from($url, true);
```

## The File exist in temporary folder, so after file grabbed, then modify or move it to another place.
```shell
// move to another folder
$file->move('/home/my/another/folder', 'new_name_with.extension');
```

## Author
[@daemon144key](http://github.com/daemon144key) and [contributors](https://github.com/suitcore/filegrabber/graphs/contributors).
