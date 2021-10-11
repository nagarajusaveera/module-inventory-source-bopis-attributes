<?php
/**
 * Copyright © Walmart, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Walmart\InventorySourceBopisAttributes\Model;

use Magento\Framework\Model\AbstractExtensibleModel;
use Walmart\InventorySourceBopisAttributes\Model\ResourceModel\PickupOpeningHours as PickupOpeningHoursResourceModel;
use Walmart\InventorySourceBopisAttributes\Api\Data\PickupOpeningHoursExtensionInterface;
use Walmart\InventorySourceBopisAttributes\Api\Data\PickupOpeningHoursInterface;

/**
 * {@inheritdoc}
 *
 * @codeCoverageIgnore
 */
class PickupOpeningHours extends AbstractExtensibleModel implements PickupOpeningHoursInterface
{
    /**
     * @inheritdoc
     */
    protected function _construct()
    {
        $this->_init(PickupOpeningHoursResourceModel::class);
    }

    /**
     * @inheritdoc
     */
    public function getExtensionAttributes(): ?PickupOpeningHoursExtensionInterface
    {
        $extensionAttributes = $this->_getExtensionAttributes();
        if (null === $extensionAttributes) {
            $extensionAttributes = $this->extensionAttributesFactory->create(PickupOpeningHoursInterface::class);
            $this->setExtensionAttributes($extensionAttributes);
        }
        return $extensionAttributes;
    }

    /**
     * @inheritdoc
     */
    public function setExtensionAttributes(PickupOpeningHoursExtensionInterface $extensionAttributes): void
    {
        $this->_setExtensionAttributes($extensionAttributes);
    }
}
