<?php

namespace Bundle\CSSBundle\Twig\StyleSheet;

use Bundle\CSSBundle\Twig\StyleSheet\Node;

class TokenParser extends \Twig_TokenParser
{
    /**
     * @param 	\Twig_Token  $token
     * @return	\Bundle\CSSBundle\Twig\StyleSheetNode
     */
    public function parse(\Twig_Token $token)
    {
        $lineno = $token->getLine();
        $stream = $this->parser->getStream();

        $value = $this->parser->getExpressionParser()->parseExpression();
        $stream->expect(\Twig_Token::BLOCK_END_TYPE);

        return new Node($value, $lineno, $this->getTag());
    }

    /**
     * @return string
     */
    public function getTag()
    {
        return 'stylesheet';
    }
}
