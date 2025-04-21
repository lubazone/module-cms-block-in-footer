<?php

namespace LubaZone\CmsBlockInFooter\Setup\Patch\Data;

use Magento\Eav\Setup\EavSetupFactory;
use Magento\Catalog\Model\Category;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;

class AddFooterStaticBlock implements DataPatchInterface
{
    private $moduleDataSetup;
    private $eavSetupFactory;

    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        EavSetupFactory $eavSetupFactory
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->eavSetupFactory = $eavSetupFactory;
    }

    public function apply()
    {
        $this->moduleDataSetup->getConnection()->startSetup();

        $eavSetup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);

        // Check if attribute already exists
        $attribute = $eavSetup->getAttribute(Category::ENTITY, 'footer_static_block');
        if (!$attribute) {
            $eavSetup->addAttribute(
                Category::ENTITY,
                'footer_static_block',
                [
                    'type' => 'varchar',
                    'label' => 'Footer Static Block',
                    'input' => 'select',
                    'source' => \LubaZone\CmsBlockInFooter\Model\Category\Attribute\Source\FooterCmsBlock::class,
                    'required' => false,
                    'sort_order' => 100,
                    'global' => ScopedAttributeInterface::SCOPE_STORE,
                    'group' => 'Content',
                    'visible' => true,
                    'default' => '',
                ]
            );
        }

        $this->moduleDataSetup->getConnection()->endSetup();
    }

    public static function getDependencies(): array
    {
        return [];
    }

    public function getAliases(): array
    {
        return [];
    }
}
