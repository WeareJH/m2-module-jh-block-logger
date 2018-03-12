<?php
declare(strict_types=1);

namespace Jh\BlockLogger\Framework\View\Element;

use Jh\BlockLogger\Api\View\Element\AnnotatorInterface;
use Magento\Framework\Escaper;
use Magento\Framework\View\Element\AbstractBlock;
use Magento\Framework\View\Element\BlockInterface;
use Magento\Framework\View\Element\Template;

/**
 * Layout Element Annotator
 *
 * Default implementation
 *
 * @author Max Bucknell <max@wearejh.com>
 */
class Annotator implements AnnotatorInterface
{
    /**
     * @var Escaper
     */
    private $escaper;

    public function __construct(
        Escaper $escaper
    ) {
        $this->escaper = $escaper;
    }

    /**
     * Annotate a block's output.
     *
     * @param string $name
     * @param string $output
     * @param BlockInterface $block
     * @return string
     */
    public function annotateBlock(string $name, string $output, BlockInterface $block)
    {
        $rawData = [
            'name' => $name,
            'type' => 'block',
            'block_type' => get_class($block)
        ];

        if ($block instanceof Template) {
            $rawData['template'] = $block->getTemplate();
            $rawData['template_file'] = $block->getTemplateFile();
        }

        if ($block instanceof AbstractBlock) {
            $rawData['args'] = $this->prepareArgs($block->getData());
        }

        $data = \json_encode($rawData, JSON_FORCE_OBJECT);

        return <<<HTML
<!-- m2({$name}) {$data} -->
{$output}
<!-- /m2({$name}) -->
HTML;
    }

    private function prepareArgs(array $data): array
    {
        $result = [];

        foreach ($data as $key => $value) {
            if (\is_array($value)) {
                $result[$key] = $this->prepareArgs($value);
            } else if (\is_object($value) && !($value instanceof \JsonSerializable)) {
                $result[$key] = get_class($value);
            } else if (\is_string($value)) {
                $result[$key] = $this->escaper->escapeHtml($value);
            } else { // scalar
                $result[$key] = $value;
            }
        }

        return $result;
    }

    /**
     * Annotate a container's output
     *
     * @param string $name
     * @param string $output
     * @return string
     */
    public function annotateContainer(string $name, string $output)
    {
        $data = \json_encode([
            'name' => $name,
            'type' => 'container'
        ]);

        return <<<HTML
<!-- m2({$name}) {$data} -->
{$output}
<!-- /m2({$name}) -->
HTML;
    }

    /**
     * Annotate a ui_component's output
     *
     * @param string $name
     * @param string $output
     * @return string
     */
    public function annotateUiComponent(string $name, string $output)
    {
        $data = \json_encode([
            'name' => $name,
            'type' => 'ui_component'
        ]);

        return <<<HTML
<!-- m2({$name}) {$data} -->
{$output}
<!-- /m2({$name}) -->
HTML;
    }
}