# tuskweb_php
A MVT structured backend module for php. Get your webpages online with this easy framework.

## Introduction
Backend programming these days for us, programmers, has been blessed with wonderful languages.
Meanwhile, PHP is being avoided due to reasons of it being uneasy. But when compared to others, hosting PHP is a lot simpler and lots of hosts are available for PHP which is not the same in case of others.

So, TuskWeb - PHP is here to save your day with its pre-built modules that are going to make backend programming fun and easy.
All the cool features are now also available in PHP!

So with no further ado, let's get started.

## Requirements
1) Basic knowledge of PHP.
2) A system which can run PHP.
3) A code editor like VSCode.
4) A PHP server. Eg: Xampp.

## Installation
There is nothing to install here.
Just clone this repository and if you don't know how to do this, <a href="https://docs.github.com/en/repositories/creating-and-managing-repositories/cloning-a-repository">click this</a>.

Now, we are all set to get into the development stage.

## Terms
### 1) tuskweb_php
This is the framework which you will be working with.

### 2) tuskweb_modules
This folder contains the core of tuskweb_php. It is highly advised not to meddle with it.

### 3) workspace
This is the folder which will be containing most of your project's backend data.

### 4) templates
This folder will be containing all of your templates, which are your frontend pages.

### 5) static
The static folder will be containing all of your static data, i.e., your javascript and css files.

### 6) media
The media folder will be containing all of the media that belongs to your site.

### 7) .htaccess
These files are a part of the routing and the security system. They deny direct access to your code and keep your code safe. They also play a major role in the routing system.

### 8) settings.php
This is the settings file where you will be managing your webapp settings which include baseDir and others.

### 9) index.php
Something you need not worry about. This keeps your website working.

## 

This was all for the introduction.

Now let's build a simple website.

## Step 1: Creating a Route
Open the "urls.php" file in the workspace folder.

Initially it will have something like this
```php
$urlpatterns = array(
    path("/", "home", "Home"),
    path("/404", "404", "404")
);
```

Here the first parameter passed to the path function is the pattern of the url which you want to add, the second parameter is the name of the view(function) which you want to execute when the page is visited and the last parameter is the name of the pattern. The name is going to be used to get the pattern in other files. This will allow you to dynamically change the pattern, i.e., if you change "/" to "/home" without changing the name of the pattern, you won't have to change the urls in other files. We will learn more about this as we proceed.

For creating a new pattern, add this to the array
```php
path(pattern, view, name)
```
For example,
```php
path("/page", "page", "page")
```

For paths with dynamic variables, i.e., a dynamic path, we use this
```php
path("/something/[str:varname]/page", view, name)
```
Or
```php
path("/something/[num:varname]/page", view, name)
```
This will create a new route in your website. But this alone won't work because you haven't setup your "page" view yet.

## Step 2: Creating a View
Open your "views.php" file in the workspace folder.

It will have something like this
```php
$views =
    array(
        "home" => function () {
            render("/home.php", array("title" => "TuskWeb"));
        },
        "404" => function () {
            render("/404.php", array("view" => "one", "title" => "404"));
        }
    );
```

Here, views is the array which will be holding all of your views.
Every element of this array is a function will be executed when the user visits the page with the url which is associated with the view.

To create a view, you need to add an element to the array, whose syntax looks like
```php
"view_name" => function (list of args) {
    // Here goes the executable statements which may include a render function, a redirect or statements to handle a form output.
}
```

For example
```php
"page" => function () {
    render("/page.php", array("title"=>"Page"));
}
```

For urls with dynamic variables, we use this
```php
"page" => function ($varname) {
    render("/page.php", array("data"=>$varname , "title"=>"Page"));
}
```
As for where this variable comes from, it directly comes from the url.
For example, w.r.t the above mentioned routes example, if the user visits "/something/example-page/page", then the value of the variable $varname will be "example-page"

Now that your view is all set, the next step is to create the "page.php" file.

## Creating a template
Open your templates folder and create a "page.php" file.

This file will hold the webpage to be loaded for the "/page" route.

It may contain something like this
```php
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="<?php echo loadStatic("/main.css"); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body style="background: url('<?php echo loadMedia('/logo.jpg'); ?>');background-size:cover;background-position:center;">
<div class="card w-75 p-3 shadow-sm text-center" style="position:absolute;left:12.5%;bottom:10%;">
    <p>Thanks for using TuskWeb!</p>
    <a class="p-2 rounded-sm text-white bg-dark" href="https://github.com/tj-likes-coding/tuskweb_php">Visit our Github page here!</a>
</div>
<a class="credits text-black-50" href="https://www.pexels.com/photo/gray-elephant-figurine-1289845/">Photo by Magda Ehlers</a>
</body>
</html>
```

And now when you start up your server and visit the url you created, your webpage will be loaded.

Before we end this tutorial, a few things you need to keep in mind.

## Things To Know - Important
1) If you are ever going to change the "baseDir" setting in the "settings.php" file, make sure to change the same in the .htaccess files too.
2) If your folder isn't in the root folder of your server, then only set the "baseDir" setting, else let it be "".
3) The first parameter of the render function is the name of the template file preceded by a "/" while the second parameter is an array of the variables you want to pass to your page from the backend.
4) loadStatic and loadMedia are functions to load static files and media files respectively.
5) These are not the only things TuskWeb_PHP can do. This was just a basic tutorial. More tutorials will be uploaded in the Wiki Page.

Hope you had a nice day!

Thanks for using TuskWeb - PHP.
