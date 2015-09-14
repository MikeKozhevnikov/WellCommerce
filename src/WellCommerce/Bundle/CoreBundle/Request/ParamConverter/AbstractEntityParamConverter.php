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

namespace WellCommerce\Bundle\CoreBundle\Request\ParamConverter;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use WellCommerce\Bundle\CoreBundle\Repository\RepositoryInterface;

/**
 * Class AbstractEntityParamConverter
 *
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
abstract class AbstractEntityParamConverter implements ParamConverterInterface
{
    /**
     * @var RepositoryInterface
     */
    protected $repository;

    /**
     * @var int
     */
    protected $requestParameter = 'id';

    /**
     * @param RepositoryInterface $repository
     */
    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function apply(Request $request, ParamConverter $configuration)
    {
        $entity = $this->findByRequestParameter($request);

        if (!$configuration->isOptional() && null === $entity) {
            throw new NotFoundHttpException(sprintf('Entity of type "%s" was not found for parameter "%s"', $configuration->getClass(), $this->requestParameter));
        }

        $param = $configuration->getName();
        $request->attributes->set($param, $entity);

        return true;
    }

    protected function findByRequestParameter(Request $request)
    {
        $id = (int)$request->request->get($this->requestParameter);

        return $this->repository->find($id);
    }

    public function supports(ParamConverter $configuration)
    {
        if (null === $configuration->getClass()) {
            return false;
        }

        return in_array($configuration->getClass(), $this->getSupportedTypes());
    }

    protected function getSupportedTypes()
    {
        return [];
    }
}
