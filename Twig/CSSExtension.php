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
        $this->container = $container;
    }
    
    public function getTokenParsers()
    {
        $stylesheets = array(
            // {% stylesheet "/path/to/css/file" %}
            new StyleSheet\TokenParser(),
            
            // {% stylesheets %}
            new StyleSheets\TokenParser(),
        );
        
        $css3TokenParser = array();
        foreach($this->container->getParameter('css.twig.extension.css3.tokenparsers') as $tokenParser)
        {
          $css3TokenParser[] = new $tokenParser();
        }
        
        return array_merge($stylesheets, $css3TokenParser);
    }
    
    public function renderAttribute($type, $value)
    {
        if(!$this->container->has('css.twig.tokenparser.' . $type))
        {
            throw new \RuntimeException('The CSS attribute "' . $type . '" has no attached service');
        }
        
        return $this->container->get('css.twig.tokenparser.' . $type)->render($value);
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