<?php

namespace Bundle\CSSBundle\Twig\CSS3\Base;

class Node extends \Twig_Node
{
    protected $type;
    
    /**
     * @param 	string 											$type
     * @param 	\Twig_NodeInterface 				$value
     * @param 	integer 										$lineno
     * @param 	string 											$tag (optional)
     * @return 	void
     */
    public function __construct($type, \Twig_NodeInterface $value, $lineno, $tag = null)
    {
        $this->type = $type;
        parent::__construct(array('value' => $value), array(), $lineno, $tag);
    }

    /**
     * @param \Twig_Compiler $compiler
     * @return void
     */
    public function compile(\Twig_Compiler $compiler)
    {
        $compiler->addDebugInfo($this);

        $compiler
            ->write("echo \$this->env->getExtension('css')->renderAttribute('" . $this->type . "',")
            ->subcompile($this->getNode('value'))
            ->raw(");\n");
    }
}
