<?php
/**
 * Copyright © Walmart, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Walmart\InventorySourceBopisAttributes\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

/**
 * Represents sources projection on In-Store Pickup context.
 * Realisation must follow immutable DTO concept.
 * Partial immutability done according to restriction of current Extension Attributes implementation.
 *
 * @api
 */
interface PickupOpeningHoursInterface extends ExtensibleDataInterface
{
    const SOURCE_CODE = 'source_code';
    const DAY_OF_WEEK = 'day_of_week';
    const OPEN_HOUR = 'open_hour';
    const CLOSE_HOUR = 'close_hour';

    /**
     * Set Extension Attributes for Pickup Location.
     *
     * @param \Walmart\InventorySourceBopisAttributes\Api\Data\PickupOpeningHoursExtensionInterface|null $extensionAttributes
     *
     * @return void
     */
    public function setExtensionAttributes(\Walmart\InventorySourceBopisAttributes\Api\Data\PickupOpeningHoursExtensionInterface $extensionAttributes): void;

    /**
     * Get Extension Attributes of Pickup Location.
     *
     * @return \Walmart\InventorySourceBopisAttributes\Api\Data\PickupOpeningHoursExtensionInterface|null
     */
    public function getExtensionAttributes(): ?PickupOpeningHoursExtensionInterface;

}
