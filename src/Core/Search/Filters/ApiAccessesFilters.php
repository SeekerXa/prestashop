<?php
/**
 * Copyright since 2007 PrestaShop SA and Contributors
 * PrestaShop is an International Registered Trademark & Property of PrestaShop SA
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/OSL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to https://devdocs.prestashop.com/ for more information.
 *
 * @author    PrestaShop SA and Contributors <contact@prestashop.com>
 * @copyright Since 2007 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 */

declare(strict_types=1);

namespace PrestaShop\PrestaShop\Core\Search\Filters;

use PrestaShop\PrestaShop\Core\Exception\InvalidArgumentException;
use PrestaShop\PrestaShop\Core\Grid\Definition\Factory\ApiAccessGridDefinitionFactory;
use PrestaShop\PrestaShop\Core\Search\Filters;

final class ApiAccessesFilters extends Filters
{
    /** @var string */
    protected $filterId = ApiAccessGridDefinitionFactory::GRID_ID;

    /**
     * @var int
     */
    private $applicationId;

    /**
     * @param array $filters
     * @param $filterId
     *
     * @throws InvalidArgumentException
     */
    public function __construct(array $filters = [], $filterId = '')
    {
        if (!isset($filters['filters']['application_id'])) {
            throw new InvalidArgumentException(sprintf('%s filters expect a application_id filter', static::class));
        }

        $this->applicationId = (int) $filters['filters']['application_id'];

        parent::__construct($filters, $filterId);
    }

    /**
     * @return int
     */
    public function getApplicationId(): int
    {
        return $this->applicationId;
    }

    /**
     * {@inheritdoc}
     */
    public static function getDefaults(): array
    {
        return [
            'limit' => 10,
            'offset' => 0,
            'orderBy' => 'id_api_access',
            'sortOrder' => 'desc',
            'filters' => [],
        ];
    }
}
