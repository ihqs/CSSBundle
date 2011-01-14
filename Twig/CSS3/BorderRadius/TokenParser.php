<?php

namespace Bundle\CSSBundle\Twig\CSS3\BorderRadius;

use Bundle\CSSBundle\Twig\CSS3\Base\TokenParser as BaseTokenParser;

class TokenParser extends BaseTokenParser
{
    public function getTag()
    {
        return "border_radius";
    }
    
    public function renderOpera()
    {
        return "border-radius: " . $this->value . ";";
    }
    
    public function renderMozilla()
    {
        return "-moz-border-radius: " . $this->value . ";";
    }
    
    public function renderWebkit()
    {
        return "-webkit-border-radius: " . $this->value . ";";
    }
    
    public function renderKHtml()
    {
        return "-khtml-border-radius: " . $this->value . ";";
    }
    
    public function renderInternetExplorer()
    {
        // huk. Do we really have to use those .htc files ? :x
    }
}
