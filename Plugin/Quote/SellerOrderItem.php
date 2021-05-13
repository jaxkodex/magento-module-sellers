<?php
/**
 * Copyright © SuperCoolCo All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace SuperCoolCo\Sellers\Plugin\Quote;

class SellerOrderItem
{

    public function aroundConvert(
        \Magento\Quote\Model\Quote\Item\ToOrderItem $subject,
        \Closure $proceed,
        \Magento\Quote\Model\Quote\Item\AbstractItem $item,
        $additional = []) {
      $orderItem = $proceed($item, $additional);
      $orderItem->setSeller($item->getSeller());
      return $orderItem;
    }
}

