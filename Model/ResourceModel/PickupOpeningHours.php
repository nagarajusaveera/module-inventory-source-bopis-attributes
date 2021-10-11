<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Walmart\InventorySourceBopisAttributes\Model\ResourceModel;

use Exception;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Model\ResourceModel\Db\Context;
use Magento\Framework\Model\ResourceModel\PredefinedId;
use Walmart\InventorySourceBopisAttributes\Api\Data\PickupOpeningHoursInterface;

/**
 * Implementation of basic operations for Source entity for specific db layer
 */
class PickupOpeningHours extends AbstractDb
{
    /**
     * Provides possibility of saving entity with predefined/pre-generated id
     */
    use PredefinedId;

    /**#@+
     * Constants related to specific db layer
     */
    const TABLE_NAME_INVENTORY_SOURCE_OPENING_HOURS = 'inventory_source_opening_hours';
    /**#@-*/

    /**
     * Primary key auto increment flag
     *
     * @var bool
     */
    protected $_isPkAutoIncrement = false;

    /**
     * @param Context $context
     * @param null $connectionName
     */
    public function __construct(
        Context $context,
        $connectionName = null
    ) {
        parent::__construct($context, $connectionName);
    }

    /**
     * @inheritdoc
     */
    protected function _construct()
    {
        $this->_init(self::TABLE_NAME_INVENTORY_SOURCE_OPENING_HOURS, PickupOpeningHoursInterface::SOURCE_OPEN_HOURS_ID);
        $this->addUniqueField(
            [
                'field' => PickupOpeningHoursInterface::SOURCE_CODE,
                'title' => 'SOURCE CODE'
            ]
        );
    }

    /**
     * @inheritdoc
     */
    public function load(AbstractModel $object, $value, $field = null)
    {
        parent::load($object, $value, $field);
        /** @var SourceInterface $object */
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function save(AbstractModel $object)
    {
        $connection = $this->getConnection();
        $connection->beginTransaction();
        try {
            $object->isObjectNew(!$this->isObjectNotNew($object));
            parent::save($object);
            $connection->commit();
        } catch (Exception $e) {
            $connection->rollBack();
            throw $e;
        }
        return $this;
    }
}
