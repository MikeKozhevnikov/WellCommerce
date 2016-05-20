<?php

/*
 * This file is part of the Ivory Lucene Search package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace WellCommerce\Bundle\SearchBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use WellCommerce\Bundle\CoreBundle\DependencyInjection\Configuration as BaseConfiguration;

/**
 * Class Configuration
 *
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
class Configuration extends BaseConfiguration
{
    //@formatter:off
    protected function addCustomConfigurationNode()
    {
        $builder = new TreeBuilder();
        $node    =
            $builder->root('engines')
                    ->useAttributeAsKey('name')
                    ->prototype('array')
                        ->children()
                            ->arrayNode('adapter')->isRequired()
                                ->children()
                                    ->scalarNode('class')->isRequired()->end()
                                    ->arrayNode('options')
                                        ->useAttributeAsKey('name')
                                        ->prototype('scalar')->end()
                                    ->end()
                                ->end()
                            ->end()
                            ->arrayNode('query_builder')->isRequired()
                                ->children()
                                    ->scalarNode('class')->isRequired()->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end();

        return $node;
    }
    //@formatter:on
}
