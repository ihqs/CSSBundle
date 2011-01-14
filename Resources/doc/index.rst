
# Installation
==============

## Add the repository to your project
=====================================

 git submodule add git://github.com/ihqs/CSSBundle.git src/vendor/CSSBundle

Then add the module to the Kernel : in the registerBundles method add

 new Bundle\CSSBundle\CSSBundle()
 
Then, declare the module in your application's configuration file. In YML you'll do
 
 css.config: ~
 
The next and last step will be to add the bundle's routes to your routing configuration. In a routing.yml file, you'll write

 css:
    resource: CSSBundle/Resources/config/routing/main.xml
    prefix: /css
 
And now you are ready to play !

# Usage 
=======

## Adding a stylesheet
======================

To add a stylesheet from a Bundle

 {% stylesheet "Bundle\MyBundle\myFile.css %}

or 

 {% stylesheet "Application\MyBundle\myFile.css %}

The file "myFile.css" must be present in the MyBundle/Resources/public/ folder
You can also add sub-folders like that 

 {% stylesheet "Bundle\MyBundle\css\myFile.css %}

If you want to add a file on the web folder, just type

 {% stylesheet "css/myFile.css" %} if you file is in your web/css folder

## Adding stylesheets to your HTML code
=======================================

Just add {% stylesheets %} in your Twig template where you want to add your stylesheets

## Adding CSS3 variables in your CSS files
==========================================

* {% border_radius "2em" %} will display a border-radius instruction for every browser (except Internet Explorer at the time we are writing those lines)
* {% box_shadow "2px" %} will do the same for a box-shadow instruction

## Feel free to abuse Twig in your CSS files !
==============================================

You can define news variables and then use it in your files, like
 {% set color_main %}green{% endset %}

 body
 {
   background-color: {{ color_main }}
 }
 
Have fun.