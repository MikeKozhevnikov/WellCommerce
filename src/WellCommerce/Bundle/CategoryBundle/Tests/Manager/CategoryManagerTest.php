<?php
/*
 * WellCommerce Open-Source E-Commerce Platform
 * 
 * This file is part of the WellCommerce package.
 *
 * (c) Adam Piotrowski <adam@wellcommerce.org>
 * 
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 */

namespace WellCommerce\Bundle\CategoryBundle\Tests\Manager;

use WellCommerce\Bundle\CoreBundle\Test\Manager\AbstractManagerTestCase;
use WellCommerce\Bundle\CoreBundle\Manager\ManagerInterface;

/**
 * Class CategoryManagerTest
 *
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
class CategoryManagerTest extends AbstractManagerTestCase
{
    protected function get() : ManagerInterface
    {
        return $this->container->get('category.manager');
    }
}
