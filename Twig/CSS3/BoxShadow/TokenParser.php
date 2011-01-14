<?php

namespace Bundle\CSSBundle\Twig\CSS3\BoxShadow;

use Bundle\CSSBundle\Twig\CSS3\Base\TokenParser as BaseTokenParser;

class TokenParser extends BaseTokenParser
{
    public function getTag()
    {
        return "box_shadow";
    }
    
    public function renderOpera()
    {
        return "box-shadow: " . $this->value . ";";
    }
    
    public function renderMozilla()
    {
        return "-moz-box-shadow: " . $this->value . ";";
    }
    
    public function renderWebkit()
    {
        return "-webkit-box-shadow: " . $this->value . ";";
    }
    
    public function renderKHtml()
    {
        return "-khtml-box-shadow: " . $this->value . ";";
    }
    
    public function renderInternetExplorer()
    {
        // huk. Do we really have to use those filters ? :x
    }
}
