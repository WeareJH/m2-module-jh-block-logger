<?php

namespace Jh\BlockLogger\Framework\View\Element;

use Jh\BlockLogger\Api\View\Element\AnnotatorInterface;
use Magento\Framework\View\Element\AbstractBlock;
use Magento\Framework\View\Element\BlockInterface;

class BlockInterfacePlugin
{
    /**
     * @var AnnotatorInterface
     */
    private $annotator;

    public function __construct(
        AnnotatorInterface $annotator
    ) {
        $this->annotator = $annotator;
    }

    /**
     * Wrapped so that all blocks get this, not just ones done in layout.
     * 
     * @param BlockInterface $subject
     * @param \Closure $proceed
     * @return string
     */
    public function aroundToHtml(
        BlockInterface $subject,
        \Closure $proceed
    ) {
        $result = $proceed();
        $name = 'unknown.block';

        if ($subject instanceof AbstractBlock) {
            $name = $subject->getNameInLayout() ?? $name;
        }

        return $this->annotator->annotateBlock(
            $name,
            $result ?: '',
            $subject
        );
    }
}
