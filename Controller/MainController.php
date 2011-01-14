<?php

namespace Bundle\CSSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller as BaseController;
use Symfony\Component\Templating\Storage\FileStorage as Storage;


class MainController extends BaseController
{
    public function mainAction()
    {
      
    }
    
    public function allAction()
    {  
      
    }
    
    public function fileAction($file)
    {
        $path     = $this->decodeFilePath($file);   
        $renderer = $this->get('twig.renderer');
        
        return $this->createResponse(
            $renderer->evaluate(new Storage($path, $renderer)),
            200,
            array('Content-Type' => 'text/css; charset=' . $this->get('twig')->getCharset() )
        );
    }
    
    public function decodeFilePath($file)
    {
        // dumb replacements
        list($dirs, $ext) = explode('__', $file);
        $dirs = explode('_', $dirs);
        
        // getting file's namespace is set
        $namespace = array_shift($dirs);
        
        // building to the proper path
        $bundleDirs = $this->get('kernel')->getBundleDirs();
        if(array_key_exists($namespace, $bundleDirs))
        {
            $bundle   = array_shift($dirs);
            $root_dir = $bundleDirs[$namespace] . '/' . $bundle . '/Resources/public/';
        }
                
        else
        {
           $root_dir = $this->container->get('kernel')->getRootDir() . '/../web/' . $namespace . '/';
        }
        
        // returning realpath or throw everything to the trashcan
        $path = $root_dir . implode('/', $dirs) . '.' . $ext;
        $realpath = realpath($path);
        
        if($realpath === false)
        {
            throw new \InvalidArgumentException('The $file argument "' . $file .'" doesn\'t match a valid css file');
        }
        
        return $realpath;
    }
}
