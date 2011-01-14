<?php

namespace Bundle\CSSBundle\Twig\StyleSheets;

class Node extends \Twig_Node
{
    /**
     * @param 	integer 							$lineno
     * @param 	string 								$tag (optional)
     * @return 	void
     */
    public function __construct($lineno, $tag = null)
    {
        parent::__construct(array(), array(), $lineno, $tag);
    }

    /**
     * @param \Twig_Compiler $compiler
     * @return void
     */
    public function compile(\Twig_Compiler $compiler)
    {
        $compiler->addDebugInfo($this);

        $compiler
            ->write("echo \$this->env->getExtension('css')->render();\n");
    }
}
