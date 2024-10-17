<?php

namespace Convert\Training\Plugin;

use Convert\Training\Logger\Logger;
use Magento\Catalog\Model\ResourceModel\Product as ProductResourceModel;
use Magento\Catalog\Model\Product;
use Magento\Framework\App\RequestInterface;


class NotificationAfterSavePlugin
{
    private Logger $logger;
    private RequestInterface $request;

    public function __construct(
        Logger           $logger,
        RequestInterface $request
    )
    {
        $this->logger = $logger;
        $this->request = $request;
    }

    /**
     * @param ProductResourceModel $subject
     * @param Product $product
     * @return Product[]
     */
    public function beforeSave(
        ProductResourceModel $subject,
        Product              $product,
    ): array
    {
        $productId = $product->getId();
        $productName = $product->getName();
        $beforeMessage = "BEFORE: '$productName' was saved with the ID '$productId'.";
        $this->logger->info($beforeMessage);
        return [$product];
    }

//    public function afterSave(
//        ProductResourceModel $subject,
//        ProductResourceModel $result,
//    )
//    {
//        $params = $this->request->getParams();
//        $productId = $params['id'];
//        $productName = $params['product']['name'];
//        $beforeMessage = "AFTER: '$productName' was saved with the ID '$productId'.";
//        $this->logger->info($beforeMessage);
//    }
}
