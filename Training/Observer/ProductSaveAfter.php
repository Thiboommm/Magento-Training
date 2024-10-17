<?php

namespace Convert\Training\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Convert\Training\Logger\Logger;

class ProductSaveAfter implements ObserverInterface
{

    private Logger $logger;

    public function __construct(
        Logger $logger,
    )
    {
        $this->logger = $logger;
    }

    public function execute(Observer $observer)
    {
        $product = $observer->getEvent()->getProduct();
        $productId = $product->getId();
        $productName = $product->getName();
        $message = "'$productName' was saved with the ID '$productId'.";
        $this->logMessage($message);
    }

    public function logMessage($message): void
    {
        $this->logger->info($message);
    }
}
