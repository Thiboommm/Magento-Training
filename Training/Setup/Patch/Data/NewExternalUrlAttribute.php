<?php

namespace Convert\Training\Setup\Patch\Data;

use Magento\Catalog\Model\Product;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;

class NewExternalUrlAttribute implements DataPatchInterface
{
    private ModuleDataSetupInterface $moduleDataSetup;
    private EavSetupFactory $eavSetupFactory;

    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        EavSetupFactory          $eavSetupFactory
    )
    {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->eavSetupFactory = $eavSetupFactory;
    }

    public function apply(): void
    {
        $this->moduleDataSetup->getConnection()->startSetup();
        $eavSetup = $this->eavSetupFactory->create();
        $eavSetup->addAttribute(
            Product::ENTITY,
            'external_url',
            [
                'group' => 'General',
                'type' => 'text',
                'label' => 'External Url',
                'frontend' => '',
                'backend' => '',
                'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
                'visible_on_front' => false,
                'input' => 'textarea',
                'required' => false,
                'sort_order' => 40,
                'is_used_in_grid' => false,
                'is_filterable_in_grid' => false,
            ]
        );
        $this->moduleDataSetup->getConnection()->endSetup();
    }

    /**
     * {@inheritdoc}
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function getAliases()
    {
        return [];
    }
}