# CSSBundle

This is currently a work in progress

## What CSS Bundle is for 

CSSBundle will enable you to add your CSS files properly in your templates using "stylesheet" and "stylesheets" tags
It will

* minify and merge your css file in a production environment
* allow you to write your CSS file as twig templates, in order to manage variables in and write more clever CSS in a "LESS" fashion
* adds CSS3 compatibility so that you don't have to write 4 different instruction for your border-radius and gradiant stuff

## Installation

 git submodule add git://github.com/ihqs/CSSBundle.git src/vendor/CSSBundle
 git submodule update --init

Then add the module to the Kernel : in the registerBundles method add

 new Bundle\CSSBundle\CSSBundle()
 
Then, declare the module in your application's configuration file. In YML you'll do
 
 css.config: ~
 
The next and last step will be to add the bundle's routes to your routing configuration. In a routing.yml file, you'll write

 css:
    resource: CSSBundle/Resources/config/routing/main.xml
    prefix: /css
 
And now you are ready to play !
For more informations, please read the Resources/doc/index.rst file.

## To do

* Clean up code
* Write a minifier renderer
* Write Useful Twig tags (like import)
* Write CSS3 Twig tags
* Add documentation
* Add javadoc to every method