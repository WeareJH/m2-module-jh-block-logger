<?php

namespace Jh\BlockLogger\Layout;

use Magento\Framework\View\Layout as Subject;

class Logger
{
    /**
     * @param Subject $subject
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

        return <<<HTML
<!-- {$type} -->
{$output}
<!-- / {$type} -->
HTML;
    }

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