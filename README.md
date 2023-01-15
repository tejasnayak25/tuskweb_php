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

<code>Something to keep in mind - If you are ever going to change the "baseDir" setting in the "settings.php" file, make sure to change the same in the .htaccess files too.</code>

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
