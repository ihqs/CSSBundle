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
        if($this->container->get('kernel')->getEnvironment() == 'dev')
        {
            foreach($this->container->get('css_files') as $stylesheet)
            {
                $stylesheet = trim(str_replace('\\', '_', $stylesheet));
                $stylesheet = trim(str_replace('/', '_', $stylesheet));
                $stylesheet = trim(str_replace('.', '__', $stylesheet));
                if(empty($stylesheet)) { continue; }
                
                $links[] = '<link type="text/css" rel="stylesheet" href="' . $this->container->get('router')->generate('css_file', array('file' => $stylesheet)) . '" />';
            }
        }
        
        else
        {
            $links[] = '<link type="text/css" rel="stylesheet" href="' . $this->container->get('router')->generate('css_all') . '" />';
        }
        
        return implode("\n", $links);
    }
    
    public function getName()
    {
        return 'css';
    }
}