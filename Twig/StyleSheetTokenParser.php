<?php

namespace Bundle\CSSBundle\Twig;

use Bundle\CSSBundle\Twig\StyleSheetNode;

class StyleSheetTokenParser extends \Twig_TokenParser
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

        return new StyleSheetNode($value, $lineno, $this->getTag());
    }

    /**
     * @return string
     */
    public function getTag()
    {
        return 'stylesheet';
    }
}
