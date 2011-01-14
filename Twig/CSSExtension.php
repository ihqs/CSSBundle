<?php

namespace Bundle\CSSBundle\Twig;

class CSSExtension extends \Twig_Extension
{
    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface
     */
    protected $container;
     
    /**
     * @param 	$container
		 * @return 	void
		 */
    public function __construct($container)
    {
        $this->container   = $container;
    }
    
    public function getTokenParsers()
    {
        return array(
            // {% stylesheet "/path/to/css/file" %}
            new StyleSheetTokenParser(),
            
            // {% stylesheets %}
            new StyleSheetsTokenParser(),
        );
    }
    
    public function addFile($file)
    {
        $css_files = ($this->container->has('css_files')) ?
            $this->container->get('css_files') :
            array();
        
        array_push($css_files, $file);
        
        $this->container->set('css_files', $css_files);
    }
    
    public function render()
    {
        if(!$this->container->has('css_files'))
        {
            return ;
        }
        
        $links = array();
        foreach($this->container->get('css_files') as $stylesheet)
        {
           $links[] = '<link type="text/css" rel="stylesheet" href="' . $stylesheet . '" />';
        }
        
        return implode("\n", $links);
    }
    
    public function getName()
    {
        return 'css';
    }
}