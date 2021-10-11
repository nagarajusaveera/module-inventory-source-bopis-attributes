<?php
/**
 * Copyright © Walmart, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Walmart\InventorySourceBopisAttributes\Plugin\InventoryApi\SourceRepository;

use Magento\Framework\DataObject;
use Magento\InventoryApi\Api\Data\SourceExtensionInterface;
use Magento\InventoryApi\Api\Data\SourceInterface;
use Magento\InventoryApi\Api\SourceRepositoryInterface;
use Walmart\InventorySourceBopisAttributes\Api\Data\PickupLocationInterface as Location;

/**
 * Set data to Source itself from its extension attributes to save these values to `inventory_source` DB table.
 */
class SaveInStorePickupPlugin
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
        SourceInterface $source
    ): array {
        if (!$source instanceof DataObject) {
            return [$source];
        }

        $extensionAttributes = $source->getExtensionAttributes();
        $this->setFrontendName($source, $extensionAttributes);
        $this->setInstorePickupEnabled($source, $extensionAttributes);
        $this->setCurbsideEnabled($source, $extensionAttributes);
        $this->setLeadTime($source, $extensionAttributes);
        $this->setTimezone($source, $extensionAttributes);
        $this->setDaylightSaving($source, $extensionAttributes);
        $this->setParkingSpotsEnabled($source, $extensionAttributes);
        $this->setCustomParkingSpotEnabled($source, $extensionAttributes);

        if ($extensionAttributes !== null) {
            $source->setData(Location::IS_PICKUP_LOCATION_ACTIVE, $extensionAttributes->getIsPickupLocationActive());
            $source->setData(Location::FRONTEND_DESCRIPTION, $extensionAttributes->getFrontendDescription());
            $source->setData(Location::INSTORE_PICKUP_ENABLED, $extensionAttributes->getInstorePickupEnabled());
            $source->setData(Location::CURBSIDE_ENABLED,
            $extensionAttributes->getCurbsideEnabled());
            $source->setData(Location::LEAD_TIME, 
            $extensionAttributes->getLeadTime());
            $source->setData(Location::TIMEZONE, 
            $extensionAttributes->getTimezone());
            $source->setData(Location::DAYLIGHT_SAVING, 
            $extensionAttributes->getDaylightSaving());
            $source->setData(Location::PARKING_SPOTS_ENABLED, $extensionAttributes->getParkingSpotsEnabled());
            $source->setData(Location::CUSTOM_PARKING_SPOT_ENABLED, $extensionAttributes->getCustomParkingSpotEnabled());
        }

        return [$source];
    }

    /**
     * Set Frontend Name to Source.
     * Extension Attributes are not set and Source Frontend Name is missed -> use Source Name
     * Extension Attributes are not set and Source Frontend Name is set -> do nothing
     * Extension Attributes are set and Frontend Name attribute is missed -> use Source Name
     * Extension Attributes are set and Frontend Name attribute is set -> use Frontend Name attribute
     *
     * @param SourceInterface|DataObject $source
     * @param SourceExtensionInterface|null $extensionAttributes
     */
    private function setFrontendName(SourceInterface $source, ?SourceExtensionInterface $extensionAttributes): void
    {
        if ($extensionAttributes === null && $source->getData(Location::FRONTEND_NAME) === null ||
            $extensionAttributes && !$extensionAttributes->getFrontendName()
        ) {
            $source->setData(Location::FRONTEND_NAME, $source->getName());
            return;
        }

        if ($extensionAttributes) {
            $source->setData(Location::FRONTEND_NAME, $extensionAttributes->getFrontendName());
        }
    }

    /**
     * Set Instore Pickup Enabled to Source.
     *
     * @param SourceInterface|DataObject $source
     * @param SourceExtensionInterface|null $extensionAttributes
     */
    private function setInstorePickupEnabled(SourceInterface $source, ?SourceExtensionInterface $extensionAttributes): void
    {
        if ($extensionAttributes) {
            $source->setData(Location::INSTORE_PICKUP_ENABLED, $extensionAttributes->getInstorePickupEnabled());
        }
    }

    /**
     * Set Curbside Enabled to Source.
     *
     * @param SourceInterface|DataObject $source
     * @param SourceExtensionInterface|null $extensionAttributes
     */
    private function setCurbsideEnabled(SourceInterface $source, ?SourceExtensionInterface $extensionAttributes): void
    {
        if ($extensionAttributes) {
            $source->setData(Location::CURBSIDE_ENABLED, $extensionAttributes->getCurbsideEnabled());
        }
    }

    /**
     * Set Lead Time to Source.
     *
     * @param SourceInterface|DataObject $source
     * @param SourceExtensionInterface|null $extensionAttributes
     */
    private function setLeadTime(SourceInterface $source, ?SourceExtensionInterface $extensionAttributes): void
    {
        if ($extensionAttributes) {
            $source->setData(Location::LEAD_TIME, $extensionAttributes->getLeadTime());
        }
    }

    /**
     * Set Timezone to Source.
     *
     * @param SourceInterface|DataObject $source
     * @param SourceExtensionInterface|null $extensionAttributes
     */
    private function setTimezone(SourceInterface $source, ?SourceExtensionInterface $extensionAttributes): void
    {
        if ($extensionAttributes) {
            $source->setData(Location::TIMEZONE, $extensionAttributes->getTimezone());
        }
    }

    /**
     * Set Daylight Saving to Source.
     *
     * @param SourceInterface|DataObject $source
     * @param SourceExtensionInterface|null $extensionAttributes
     */
    private function setDaylightSaving(SourceInterface $source, ?SourceExtensionInterface $extensionAttributes): void
    {
        if ($extensionAttributes) {
            $source->setData(Location::DAYLIGHT_SAVING, $extensionAttributes->getDaylightSaving());
        }
    }

    /**
     * Set Parking Sopts Enabled to Source.
     *
     * @param SourceInterface|DataObject $source
     * @param SourceExtensionInterface|null $extensionAttributes
     */
    private function setParkingSpotsEnabled(SourceInterface $source, ?SourceExtensionInterface $extensionAttributes): void
    {
        if ($extensionAttributes) {
            $source->setData(Location::PARKING_SPOTS_ENABLED, $extensionAttributes->getParkingSpotsEnabled());
        }
    }

    /**
     * Set Custom Parking Sopts Enabled to Source.
     *
     * @param SourceInterface|DataObject $source
     * @param SourceExtensionInterface|null $extensionAttributes
     */
    private function setCustomParkingSpotEnabled(SourceInterface $source, ?SourceExtensionInterface $extensionAttributes): void
    {
        if ($extensionAttributes) {
            $source->setData(Location::CUSTOM_PARKING_SPOT_ENABLED, $extensionAttributes->getCustomParkingSpotEnabled());
        }
    }

}
