<?php
/**
 * Copyright © SuperCoolCo All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace SuperCoolCo\Sellers\Observer\Sales;

class QuoteItemSetProduct implements \Magento\Framework\Event\ObserverInterface
{

  /**
   * Execute observer
   *
   * @param \Magento\Framework\Event\Observer $observer
   * @return void
   */
  public function execute(\Magento\Framework\Event\Observer $observer) {
    $product = $observer->getEvent()->getData('product');
    $quoteItem = $observer->getEvent()->getData('quote_item');

    $quoteItem->setSeller($product->getSeller());

    return $this;
  }
}

