<?php
/**
 * Copyright © SuperCoolCo All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace SuperCoolCo\Sellers\Plugin\Sales\Api;

use Magento\Sales\Api\Data\OrderExtensionFactory;

class OrderItemRepositoryInterface
{
  protected $extensionFactory;

  public function __construct(OrderExtensionFactory $extensionFactory) {
    $this->extensionFactory = $extensionFactory;
  }

  public function afterGet(
    \Magento\Sales\Api\OrderItemRepositoryInterface $subject,
    \Magento\Sales\Api\Data\OrderItemInterface $entity,
    $id) {
    $seller = $entity->getData('seller');

    $extensionAttributes = $entity->getExtensionAttributes();
    $extensionAttributes->setSeller($seller);
    $entity->setExtensionAttributes($extensionAttributes);
    
    return $entity;
  }

  public function afterGetList(
      \Magento\Sales\Api\OrderItemRepositoryInterface $subject,
      \Magento\Sales\Api\Data\OrderItemSearchResultInterface $entity) {
    $items = $entity->getItems();

    foreach ($items as &$item) {
      $seller = $item->getData('seller');
      $extensionAttributes = $item->getExtensionAttributes();
      $extensionAttributes = $extensionAttributes ? $extensionAttributes : $this->extensionFactory->create();
      $extensionAttributes->setSeller($seller);
      $item->setExtensionAttributes($extensionAttributes);
    }
    
    return $entity;
  }
}

