<?php

namespace Bundle\CSSBundle\Twig\CSS3\Base;

use Bundle\CSSBundle\Twig\CSS3\Base\Node;

abstract class TokenParser extends \Twig_TokenParser
{
    protected $value;
    
    /**
     * @param 	\Twig_Token $token
     * 
     * @return	\Twig_NodeInterface
     */
    public function parse(\Twig_Token $token)
    {
        $lineno = $token->getLine();
        $stream = $this->parser->getStream( );

        $value = $this->parser->getExpressionParser()->parseExpression();
        
        $stream->expect(\Twig_Token::BLOCK_END_TYPE);
        
        return new Node($this->getTag(), $value, $lineno, $this->getTag());
    }
    
    public function render($value)
    {
        $this->value = $value;
        
        $results = array("");
        
        $reflector = new \ReflectionClass($this);
        foreach($reflector->getMethods() as $method)
        { 
            if(strpos($method->name, "render") === 0 && strlen($method->name) > 6)
            {
                $results[] = "    " . $method->invoke($this);
            }
          
        }
        
        $results[] = "";
        return implode("\n", $results);
    }
}
