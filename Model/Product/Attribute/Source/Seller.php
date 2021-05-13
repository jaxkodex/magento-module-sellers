<?php
/**
 * Copyright © SuperCoolCo All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace SuperCoolCo\Sellers\Model\Product\Attribute\Source;

class Seller extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{
	protected $objectManager;
	protected $customerFactory;
	protected $customers;

	public function __construct(
		\Magento\Framework\ObjectManagerInterface $objectManager,
		\Magento\Customer\Model\CustomerFactory $customerFactory,
		\Magento\Customer\Model\Customer $customers
		) {
		$this->objectManager    = $objectManager;
		$this->customerFactory = $customerFactory;
		$this->customers = $customers;
	}

	/**
	 * getAllOptions
	 *
	 * @return array
	 */
	public function getAllOptions() {
		$customerList = $this->customers->getCollection()->addAttributeToSelect("*")->load();

    $ret = [];

    foreach ($customerList as $customer) {
      $ret[] = [
          'value' => $customer->getId(),
          'label' => __($customer->getSellerName() . ' - ' . $customer->getFirstname() . ' ' . $customer->getLastname())
      ];
    }

		return $ret;
	}
}

