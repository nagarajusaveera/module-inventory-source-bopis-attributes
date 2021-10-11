<?php
/**
 * Copyright © Walmart, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Walmart\InventorySourceBopisAttributes\Api\Data;

use Magento\InventoryInStorePickupApi\Api\Data\PickupLocationInterface as VendorPickupLocationInterface;

/**
 * Represents sources projection on In-Store Pickup context.
 * Realisation must follow immutable DTO concept.
 * Partial immutability done according to restriction of current Extension Attributes implementation.
 *
 * @api
 */
interface PickupLocationInterface extends VendorPickupLocationInterface
{
    public const INSTORE_PICKUP_ENABLED = 'instore_pickup_enabled';
    public const CURBSIDE_ENABLED = 'curbside_enabled';
    public const LEAD_TIME = 'lead_time';
    public const TIMEZONE = 'timezone';
    public const DAYLIGHT_SAVING = 'daylight_saving';
    public const PARKING_SPOTS_ENABLED = 'parking_spots_enabled';
    public const CUSTOM_PARKING_SPOT_ENABLED = 'custom_parking_spot_enabled';

}
