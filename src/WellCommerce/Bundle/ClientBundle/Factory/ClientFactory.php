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

namespace WellCommerce\Bundle\ClientBundle\Factory;

use Doctrine\Common\Collections\ArrayCollection;
use WellCommerce\Bundle\ClientBundle\Entity\Client;
use WellCommerce\Bundle\CoreBundle\Factory\AbstractFactory;

/**
 * Class ClientFactory
 *
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
class ClientFactory extends AbstractFactory implements ClientFactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function create()
    {
        $client = new Client();
        $client->setAddresses(new ArrayCollection());
        $client->setConditionsAccepted(true);
        $client->setDiscount(0);
        $client->setNewsletterAccepted(true);
        $client->setSalt(base_convert(sha1(uniqid(mt_rand(), true)), 16, 36));

        return $client;
    }
}
