<?php

namespace Bundle\CSSBundle\Twig\StyleSheets;

class TokenParser extends \Twig_TokenParser
{
    /**
     * @param 	\Twig_Token  $token
     * @return 	\Bundle\CSSBundle\Twig\StyleSheets\Node
     */
    public function parse(\Twig_Token $token)
    {
        $lineno = $token->getLine();
        $stream = $this->parser->getStream();
        $stream->expect(\Twig_Token::BLOCK_END_TYPE);

        return new Node($lineno, $this->getTag());
    }

    /**
     * @return string
     */
    public function getTag()
    {
        return 'stylesheets';
    }
}
