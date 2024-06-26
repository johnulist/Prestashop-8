<?php
/**
 * Mollie       https://www.mollie.nl
 *
 * @author      Mollie B.V. <info@mollie.nl>
 * @copyright   Mollie B.V.
 * @license     https://github.com/mollie/PrestaShop/blob/master/LICENSE.md
 *
 * @see        https://github.com/mollie/PrestaShop
 * @codingStandardsIgnoreStart
 */

declare(strict_types=1);

namespace Mollie\Subscription\Repository;

use Mollie\Shared\Infrastructure\Repository\AbstractRepository;

if (!defined('_PS_VERSION_')) {
    exit;
}

class CombinationRepository extends AbstractRepository implements CombinationRepositoryInterface
{
    public function __construct()
    {
        parent::__construct(\Combination::class);
    }

    public function getById(int $id): \Combination
    {
        return new \Combination($id);
    }
}
