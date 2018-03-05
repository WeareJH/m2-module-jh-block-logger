<?php declare(strict_types=1);

namespace Jh\BlockLogger\Api\View\Element;

use Magento\Framework\View\Element\BlockInterface;

/**
 * Layout Element Annotator.
 *
 * Interface to wrap output of all blocks, ui_components, and containers.
 *
 * @author Max Bucknell <max@wearejh.com>
 */
interface AnnotatorInterface
{
    /**
     * @param string $name
     * @param string $output
     * @param BlockInterface $block
     * @return string
     */
    public function annotateBlock(string $name, string $output, BlockInterface $block);

    /**
     * @param string $name
     * @param string $output
     * @return string
     */
    public function annotateContainer(string $name, string $output);

    /**
     * @param string $name
     * @param string $output
     * @return string
     */
    public function annotateUiComponent(string $name, string $output);
}