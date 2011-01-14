
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