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

namespace Mollie\Tests\Integration\Subscription\Action;

use Mollie\Exception\Code\ExceptionCode;
use Mollie\Shared\Infrastructure\Exception\MollieDatabaseException;
use Mollie\Subscription\Action\UpdateRecurringOrderAction;
use Mollie\Subscription\DTO\UpdateRecurringOrderData;
use Mollie\Tests\Integration\BaseTestCase;
use Mollie\Tests\Integration\Factory\MolRecurringOrderFactory;

class UpdateRecurringOrderActionTest extends BaseTestCase
{
    public function testItSuccessfullyUpdatesRecord(): void
    {
        /** @var \MolRecurringOrder $recurringOrder */
        $recurringOrder = MolRecurringOrderFactory::initialize()->create();

        $this->assertDatabaseHas(\MolRecurringOrder::class, [
            'id_mol_recurring_order' => $recurringOrder->id,
            'total_tax_incl' => $recurringOrder->total_tax_incl,
        ]);

        /** @var UpdateRecurringOrderAction $updateRecurringOrderAction */
        $updateRecurringOrderAction = $this->getService(UpdateRecurringOrderAction::class);

        $updateRecurringOrderAction->run(UpdateRecurringOrderData::create(
            (int) $recurringOrder->id,
            99.99
        ));

        $this->assertDatabaseHas(\MolRecurringOrder::class, [
            'id_mol_recurring_order' => $recurringOrder->id,
            'total_tax_incl' => 99.99,
        ]);
    }

    public function testItUnsuccessfullyUpdatesRecordFailedToFindRecurringOrder(): void
    {
        /** @var UpdateRecurringOrderAction $updateRecurringOrderAction */
        $updateRecurringOrderAction = $this->getService(UpdateRecurringOrderAction::class);

        $this->expectException(MollieDatabaseException::class);
        $this->expectExceptionCode(ExceptionCode::INFRASTRUCTURE_FAILED_TO_FIND_RECORD);
        $this->expectExceptionMessageRegExp('/' . \MolRecurringOrder::class . '/');

        $updateRecurringOrderAction->run(UpdateRecurringOrderData::create(
            0,
            99.99
        ));
    }
}
