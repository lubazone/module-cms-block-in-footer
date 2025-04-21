<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of FooterCmsBlock
 *
 * @author rafiqul
 */

namespace LubaZone\CmsBlockInFooter\Model\Category\Attribute\Source;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;
use Magento\Cms\Model\ResourceModel\Block\CollectionFactory;

class FooterCmsBlock extends AbstractSource {

    protected $blockCollectionFactory;

    public function __construct(CollectionFactory $blockCollectionFactory) {
        $this->blockCollectionFactory = $blockCollectionFactory;
    }

    public function getAllOptions() {
        if ($this->_options === null) {
            $this->_options = [['value' => '', 'label' => __('-- Please Select --')]];

            $collection = $this->blockCollectionFactory->create();
            foreach ($collection as $block) {
                $this->_options[] = ['value' => $block->getIdentifier(), 'label' => $block->getTitle()];
            }
        }
        return $this->_options;
    }
}
