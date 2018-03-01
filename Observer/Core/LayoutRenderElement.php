<?php

namespace Jh\BlockLogger\Observer\Core;

class LayoutRenderElement implements \Magento\Framework\Event\ObserverInterface
{

    /**
     * Execute observer
     *
     * @param \Magento\Framework\Event\Observer $observer
     * @return void
     */
    public function execute(
        \Magento\Framework\Event\Observer $observer
    )
    {
        $event = $observer->getEvent();
        $layout = $event->getLayout();
        $name = $event->getElementName();
        $block = $layout->getBlock($name);
        $transport = $event->getTransport();

        if ($block instanceof \Magento\Framework\View\Element\AbstractBlock) {
            $output = $transport->getData('output');
            $transport->setData('output',
                sprintf("<!-- BLOCK_START %s -->\n<!-- TEMPLATE %s -->\n%s<!-- BLOCK_END %s -->",
                    $block->getNameInLayout(),
                    $block->getTemplateFile(),
                    $output,
                    $block->getNameInLayout()
                )
            );
        }
    }
}
