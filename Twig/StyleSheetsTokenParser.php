<?php

namespace Bundle\CSSBundle\Twig;

use Bundle\CSSBundle\Twig\StyleSheetsNode;

class StyleSheetsTokenParser extends \Twig_TokenParser
{
    /**
     * @param 	\Twig_Token  $token
     * @return 	\Bundle\CSSBundle\Twig\StyleSheetsNode
     */
    public function parse(\Twig_Token $token)
    {
        $lineno = $token->getLine();
        $stream = $this->parser->getStream();
        $stream->expect(\Twig_Token::BLOCK_END_TYPE);

        return new StyleSheetsNode($lineno, $this->getTag());
    }

    /**
     * @return string
     */
    public function getTag()
    {
        return 'stylesheets';
    }
}
