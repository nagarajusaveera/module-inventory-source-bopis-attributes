<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Walmart\InventorySourceBopisAttributes\Model\ResourceModel\PickupOpeningHours;

use Magento\Framework\Data\Collection\Db\FetchStrategyInterface;
use Magento\Framework\Data\Collection\EntityFactoryInterface;
use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\Event\ManagerInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Walmart\InventorySourceBopisAttributes\Model\ResourceModel\PickupOpeningHours as PickupOpeningHoursResourceModel;
use Walmart\InventorySourceBopisAttributes\Model\PickupOpeningHours as PickupOpeningHoursModel;
use Walmart\InventorySourceBopisAttributes\Api\Data\PickupOpeningHoursInterface;
use Psr\Log\LoggerInterface;

/**
 * Resource Collection of Source entities
 *
 * @api
 */
class Collection extends AbstractCollection
{

    /**
     * @var string
     */
    protected $_idFieldName = 'source_open_hours_id';

    /**
     * @inheritdoc
     */
    protected function _construct()
    {
        $this->_init(PickupOpeningHoursModel::class, PickupOpeningHoursResourceModel::class);
    }

    /**
     * @inheritdoc
     */
    public function load($printQuery = false, $logQuery = false)
    {
        parent::load($printQuery, $logQuery);
        return $this;
    }
}
