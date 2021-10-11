<?php
/**
 * Copyright © Walmart, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Walmart\InventorySourceBopisAttributes\Plugin\InventoryApi\SourceRepository;

use Magento\Framework\DataObject;
use Walmart\InventorySourceBopisAttributes\Api\Data\PickupOpeningHoursExtensionInterface;
use Walmart\InventorySourceBopisAttributes\Api\Data\PickupOpeningHoursInterface;
use Magento\InventoryApi\Api\SourceRepositoryInterface;

/**
 * Set data to Source itself from its extension attributes to save these values to `inventory_source_opening_hours` DB table.
 */
class SavePickupOpeningHoursPlugin
{
    /**
     * Persist the In-Store pickup attribute on Source save
     *
     * @param SourceRepositoryInterface $subject
     * @param SourceInterface $source
     *
     * @return array
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function beforeSave(
        SourceRepositoryInterface $subject,
        PickupOpeningHoursInterface $source
    ): array {
        if (!$source instanceof DataObject) {
            return [$source];
        }

        $extensionAttributes = $source->getExtensionAttributes();
        $this->setDayOfWeek($source, $extensionAttributes);
        $this->setOpenHour($source, $extensionAttributes);
        $this->setCloseHour($source, $extensionAttributes);

        if ($extensionAttributes !== null) {
            $source->setData($source::DAY_OF_WEEK, $extensionAttributes->getDayOfWeek());
            $source->setData($source::OPEN_HOUR, $extensionAttributes->getOpenHour());
            $source->setData($source::CLOSE_HOUR, $extensionAttributes->getCloseHour());
        }

        return [$source];
    }

    /**
     * Set Day of week.
     *
     * @param SourceInterface|DataObject $source
     * @param SourceExtensionInterface|null $extensionAttributes
     */
    private function setDayOfWeek(PickupOpeningHoursInterface $source, ?PickupOpeningHoursExtensionInterface $extensionAttributes): void
    {
        if ($extensionAttributes) {
            $source->setData($source::DAY_OF_WEEK, $extensionAttributes->getDayOfWeek());
        }
    }

    /**
     * Set Open hour.
     *
     * @param SourceInterface|DataObject $source
     * @param SourceExtensionInterface|null $extensionAttributes
     */
    private function setOpenHour(PickupOpeningHoursInterface $source, ?PickupOpeningHoursExtensionInterface $extensionAttributes): void
    {
        if ($extensionAttributes) {
            $source->setData($source::OPEN_HOUR, $extensionAttributes->getOpenHour());
        }
    }

    /**
     * Set Close hour.
     *
     * @param SourceInterface|DataObject $source
     * @param SourceExtensionInterface|null $extensionAttributes
     */
    private function setCloseHour(PickupOpeningHoursInterface $source, ?PickupOpeningHoursExtensionInterface $extensionAttributes): void
    {
        if ($extensionAttributes) {
            $source->setData($source::CLOSE_HOUR, $extensionAttributes->getCloseHour());
        }
    }

}
