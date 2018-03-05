<?php

namespace Jh\BlockLogger\Layout;

use Jh\BlockLogger\Api\View\Element\AnnotatorInterface;
use Magento\Framework\View\Layout as Subject;

class Logger
{
    /**
     * @var Annotator
     */
    private $annotator;

    /**
     * @var Subject\Data\Structure
     */
    private $layoutStructure;

    /**
     * Logger constructor.
     *
     * @param AnnotatorInterface $annotator
     * @param Subject\Data\Structure $layoutStructure
     */
    public function __construct(
        AnnotatorInterface $annotator,
        Subject\Data\Structure $layoutStructure
    ) {
        $this->annotator = $annotator;
        $this->layoutStructure = $layoutStructure;
    }

    /**
     * Wrap view element render to annotate.
     *
     * @param Subject $subject
     * @param \Closure $proceed
     * @param string $name
     * @return string
     */
    public function aroundRenderNonCachedElement(
        Subject $subject,
        \Closure $proceed,
        $name
    ) {
        $type = $this->getType($subject, $name);
        $output = $proceed($name);

        switch ($type) {
            case 'block':
                return $this->annotator->annotateBlock($name, $output, $subject->getBlock($name));
            case 'container':
                return $this->annotator->annotateContainer($name, $output);
            case 'ui_component':
                return $this->annotator->annotateUiComponent($name, $output);
            default:
                return $output;
        }
    }

    /**
     * Get the type of element (block, container, ui_component)
     *
     * @param Subject $layout
     * @param $name
     * @return string
     */
    private function getType(
        Subject $layout,
        $name
    ) {
        if ($layout->isBlock($name)) {
            return 'block';
        } else if ($layout->isUiComponent($name)) {
            return 'ui_component';
        } else if ($layout->isContainer($name)) {
            return 'container';
        }
    }
}