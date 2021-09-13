<?php

namespace Stripe;

/**
 * @internal
 * @coversNothing
 */
final class codegennedExampleTest extends \PHPUnit\Framework\TestCase
{
    use TestHelper;

    /** @before */
    protected function setUpService()
    {
        $this->client = new \Stripe\StripeClient(['api_key' => 'sk_test_123', 'api_base' => MOCK_URL]);
    }

    public function testListCustomer()
    {
        $this->expectsRequest('get', '/v1/customers');
        $result = $this->client->customers->all(['limit' => 3]);
        static::assertInstanceOf(\Stripe\Collection::class, $result);
        static::assertInstanceOf(\Stripe\Customer::class, $result->data[0]);
    }

    public function testRetrieveBalanceTransaction()
    {
        $this->expectsRequest('get', '/v1/balance_transactions/{id}');
        $result = $this->client->balanceTransactions->retrieve(
            '{id}',
            ['id' => 'txn_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\BalanceTransaction::class, $result);
    }

    public function testListBalanceTransaction()
    {
        $this->expectsRequest('get', '/v1/balance_transactions');
        $result = $this->client->balanceTransactions->all(['limit' => 3]);
        static::assertInstanceOf(\Stripe\Collection::class, $result);
        static::assertInstanceOf(\Stripe\BalanceTransaction::class, $result->data[0]);
    }

    public function testCreateCharge()
    {
        $this->expectsRequest('post', '/v1/charges');
        $result = $this->client->charges->create(
            [
                'amount' => 2000,
                'currency' => 'usd',
                'source' => 'tok_xxxx',
                'description' => 'My First Test Charge (created for API docs)',
            ]
        );
        static::assertInstanceOf(\Stripe\Charge::class, $result);
    }

    public function testRetrieveCharge()
    {
        $this->expectsRequest('get', '/v1/charges/{id}');
        $result = $this->client->charges->retrieve(
            '{id}',
            ['id' => 'ch_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Charge::class, $result);
    }

    public function testUpdateCharge()
    {
        $this->expectsRequest('post', '/v1/charges/{id}');
        $result = $this->client->charges->update(
            '{id}',
            ['metadata' => ['order_id' => '6735'], 'id' => 'ch_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Charge::class, $result);
    }

    public function testCaptureCharge()
    {
        $this->expectsRequest('post', '/v1/charges/{id}/capture');
        $result = $this->client->charges->capture(
            '{id}',
            ['id' => 'ch_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Charge::class, $result);
    }

    public function testListCharge()
    {
        $this->expectsRequest('get', '/v1/charges');
        $result = $this->client->charges->all(['limit' => 3]);
        static::assertInstanceOf(\Stripe\Collection::class, $result);
        static::assertInstanceOf(\Stripe\Charge::class, $result->data[0]);
    }

    public function testCreateCustomer()
    {
        $this->expectsRequest('post', '/v1/customers');
        $result = $this->client->customers->create(
            ['description' => 'My First Test Customer (created for API docs)']
        );
        static::assertInstanceOf(\Stripe\Customer::class, $result);
    }

    public function testRetrieveCustomer()
    {
        $this->expectsRequest('get', '/v1/customers/{id}');
        $result = $this->client->customers->retrieve(
            '{id}',
            ['id' => 'cus_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Customer::class, $result);
    }

    public function testUpdateCustomer()
    {
        $this->expectsRequest('post', '/v1/customers/{id}');
        $result = $this->client->customers->update(
            '{id}',
            ['metadata' => ['order_id' => '6735'], 'id' => 'cus_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Customer::class, $result);
    }

    public function testDeleteCustomer()
    {
        $this->expectsRequest('delete', '/v1/customers/{id}');
        $result = $this->client->customers->delete(
            '{id}',
            ['id' => 'cus_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Customer::class, $result);
    }

    public function testListCustomer2()
    {
        $this->expectsRequest('get', '/v1/customers');
        $result = $this->client->customers->all(['limit' => 3]);
        static::assertInstanceOf(\Stripe\Collection::class, $result);
        static::assertInstanceOf(\Stripe\Customer::class, $result->data[0]);
    }

    public function testRetrieveDispute()
    {
        $this->expectsRequest('get', '/v1/disputes/{id}');
        $result = $this->client->disputes->retrieve(
            '{id}',
            ['id' => 'dp_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Dispute::class, $result);
    }

    public function testUpdateDispute()
    {
        $this->expectsRequest('post', '/v1/disputes/{id}');
        $result = $this->client->disputes->update(
            '{id}',
            ['metadata' => ['order_id' => '6735'], 'id' => 'dp_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Dispute::class, $result);
    }

    public function testCloseDispute()
    {
        $this->expectsRequest('post', '/v1/disputes/{id}/close');
        $result = $this->client->disputes->close(
            '{id}',
            ['id' => 'dp_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Dispute::class, $result);
    }

    public function testListDispute()
    {
        $this->expectsRequest('get', '/v1/disputes');
        $result = $this->client->disputes->all(['limit' => 3]);
        static::assertInstanceOf(\Stripe\Collection::class, $result);
        static::assertInstanceOf(\Stripe\Dispute::class, $result->data[0]);
    }

    public function testRetrieveEvent()
    {
        $this->expectsRequest('get', '/v1/events/{id}');
        $result = $this->client->events->retrieve(
            '{id}',
            ['id' => 'evt_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Event::class, $result);
    }

    public function testListEvent()
    {
        $this->expectsRequest('get', '/v1/events');
        $result = $this->client->events->all(['limit' => 3]);
        static::assertInstanceOf(\Stripe\Collection::class, $result);
        static::assertInstanceOf(\Stripe\Event::class, $result->data[0]);
    }

    public function testCreateFile()
    {
        static::markTestSkipped('need test to intercept https://files.stripe.com issue');
        $this->expectsRequest('post', '/v1/files');
        $result = $this->client->files->create(
            ['purpose' => 'dispute_xxxxxxxxxxxxx', 'file' => '{a file descriptor}']
        );
        static::assertInstanceOf(\Stripe\File::class, $result);
    }

    public function testRetrieveFile()
    {
        $this->expectsRequest('get', '/v1/files/{id}');
        $result = $this->client->files->retrieve(
            '{id}',
            ['id' => 'file_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\File::class, $result);
    }

    public function testListFile()
    {
        $this->expectsRequest('get', '/v1/files');
        $result = $this->client->files->all(['limit' => 3]);
        static::assertInstanceOf(\Stripe\Collection::class, $result);
        static::assertInstanceOf(\Stripe\File::class, $result->data[0]);
    }

    public function testCreateFileLink()
    {
        $this->expectsRequest('post', '/v1/file_links');
        $result = $this->client->fileLinks->create(
            ['file' => 'file_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\FileLink::class, $result);
    }

    public function testRetrieveFileLink()
    {
        $this->expectsRequest('get', '/v1/file_links/{id}');
        $result = $this->client->fileLinks->retrieve(
            '{id}',
            ['id' => 'link_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\FileLink::class, $result);
    }

    public function testUpdateFileLink()
    {
        $this->expectsRequest('post', '/v1/file_links/{id}');
        $result = $this->client->fileLinks->update(
            '{id}',
            ['metadata' => ['order_id' => '6735'], 'id' => 'link_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\FileLink::class, $result);
    }

    public function testListFileLink()
    {
        $this->expectsRequest('get', '/v1/file_links');
        $result = $this->client->fileLinks->all(['limit' => 3]);
        static::assertInstanceOf(\Stripe\Collection::class, $result);
        static::assertInstanceOf(\Stripe\FileLink::class, $result->data[0]);
    }

    public function testRetrieveMandate()
    {
        $this->expectsRequest('get', '/v1/mandates/{id}');
        $result = $this->client->mandates->retrieve(
            '{id}',
            ['id' => 'mandate_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Mandate::class, $result);
    }

    public function testCreatePaymentIntent()
    {
        $this->expectsRequest('post', '/v1/payment_intents');
        $result = $this->client->paymentIntents->create(
            ['amount' => 2000, 'currency' => 'usd', 'payment_method_types' => []]
        );
        static::assertInstanceOf(\Stripe\PaymentIntent::class, $result);
    }

    public function testRetrievePaymentIntent()
    {
        $this->expectsRequest('get', '/v1/payment_intents/{id}');
        $result = $this->client->paymentIntents->retrieve(
            '{id}',
            ['id' => 'pi_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\PaymentIntent::class, $result);
    }

    public function testUpdatePaymentIntent()
    {
        $this->expectsRequest('post', '/v1/payment_intents/{id}');
        $result = $this->client->paymentIntents->update(
            '{id}',
            ['metadata' => ['order_id' => '6735'], 'id' => 'pi_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\PaymentIntent::class, $result);
    }

    public function testConfirmPaymentIntent()
    {
        $this->expectsRequest('post', '/v1/payment_intents/{id}/confirm');
        $result = $this->client->paymentIntents->confirm(
            '{id}',
            ['payment_method' => 'pm_card_visa', 'id' => 'pi_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\PaymentIntent::class, $result);
    }

    public function testCapturePaymentIntent()
    {
        $this->expectsRequest('post', '/v1/payment_intents/{id}/capture');
        $result = $this->client->paymentIntents->capture(
            '{id}',
            ['id' => 'pi_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\PaymentIntent::class, $result);
    }

    public function testCancelPaymentIntent()
    {
        $this->expectsRequest('post', '/v1/payment_intents/{id}/cancel');
        $result = $this->client->paymentIntents->cancel(
            '{id}',
            ['id' => 'pi_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\PaymentIntent::class, $result);
    }

    public function testListPaymentIntent()
    {
        $this->expectsRequest('get', '/v1/payment_intents');
        $result = $this->client->paymentIntents->all(['limit' => 3]);
        static::assertInstanceOf(\Stripe\Collection::class, $result);
        static::assertInstanceOf(\Stripe\PaymentIntent::class, $result->data[0]);
    }

    public function testCreateSetupIntent()
    {
        $this->expectsRequest('post', '/v1/setup_intents');
        $result = $this->client->setupIntents->create(
            ['payment_method_types' => []]
        );
        static::assertInstanceOf(\Stripe\SetupIntent::class, $result);
    }

    public function testRetrieveSetupIntent()
    {
        $this->expectsRequest('get', '/v1/setup_intents/{id}');
        $result = $this->client->setupIntents->retrieve(
            '{id}',
            ['id' => 'seti_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\SetupIntent::class, $result);
    }

    public function testUpdateSetupIntent()
    {
        $this->expectsRequest('post', '/v1/setup_intents/{id}');
        $result = $this->client->setupIntents->update(
            '{id}',
            ['metadata' => ['user_id' => '3435453'], 'id' => 'seti_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\SetupIntent::class, $result);
    }

    public function testConfirmSetupIntent()
    {
        $this->expectsRequest('post', '/v1/setup_intents/{id}/confirm');
        $result = $this->client->setupIntents->confirm(
            '{id}',
            ['payment_method' => 'pm_card_visa', 'id' => 'seti_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\SetupIntent::class, $result);
    }

    public function testCancelSetupIntent()
    {
        $this->expectsRequest('post', '/v1/setup_intents/{id}/cancel');
        $result = $this->client->setupIntents->cancel(
            '{id}',
            ['id' => 'seti_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\SetupIntent::class, $result);
    }

    public function testListSetupIntent()
    {
        $this->expectsRequest('get', '/v1/setup_intents');
        $result = $this->client->setupIntents->all(['limit' => 3]);
        static::assertInstanceOf(\Stripe\Collection::class, $result);
        static::assertInstanceOf(\Stripe\SetupIntent::class, $result->data[0]);
    }

    public function testListSetupAttempt()
    {
        $this->expectsRequest('get', '/v1/setup_attempts');
        $result = $this->client->setupAttempts->all(
            ['setup_intent' => 'seti_xxxxxxxxxxxxx', 'limit' => 3]
        );
        static::assertInstanceOf(\Stripe\Collection::class, $result);
        static::assertInstanceOf(\Stripe\SetupAttempt::class, $result->data[0]);
    }

    public function testCreatePayout()
    {
        $this->expectsRequest('post', '/v1/payouts');
        $result = $this->client->payouts->create(
            ['amount' => 1100, 'currency' => 'usd']
        );
        static::assertInstanceOf(\Stripe\Payout::class, $result);
    }

    public function testRetrievePayout()
    {
        $this->expectsRequest('get', '/v1/payouts/{id}');
        $result = $this->client->payouts->retrieve(
            '{id}',
            ['id' => 'po_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Payout::class, $result);
    }

    public function testUpdatePayout()
    {
        $this->expectsRequest('post', '/v1/payouts/{id}');
        $result = $this->client->payouts->update(
            '{id}',
            ['metadata' => ['order_id' => '6735'], 'id' => 'po_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Payout::class, $result);
    }

    public function testListPayout()
    {
        $this->expectsRequest('get', '/v1/payouts');
        $result = $this->client->payouts->all(['limit' => 3]);
        static::assertInstanceOf(\Stripe\Collection::class, $result);
        static::assertInstanceOf(\Stripe\Payout::class, $result->data[0]);
    }

    public function testCancelPayout()
    {
        $this->expectsRequest('post', '/v1/payouts/{id}/cancel');
        $result = $this->client->payouts->cancel(
            '{id}',
            ['id' => 'po_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Payout::class, $result);
    }

    public function testReversePayout()
    {
        $this->expectsRequest('post', '/v1/payouts/{id}/reverse');
        $result = $this->client->payouts->reverse(
            '{id}',
            ['id' => 'po_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Payout::class, $result);
    }

    public function testCreateProduct()
    {
        $this->expectsRequest('post', '/v1/products');
        $result = $this->client->products->create(['name' => 'Gold Special']);
        static::assertInstanceOf(\Stripe\Product::class, $result);
    }

    public function testRetrieveProduct()
    {
        $this->expectsRequest('get', '/v1/products/{id}');
        $result = $this->client->products->retrieve(
            '{id}',
            ['id' => 'prod_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Product::class, $result);
    }

    public function testUpdateProduct()
    {
        $this->expectsRequest('post', '/v1/products/{id}');
        $result = $this->client->products->update(
            '{id}',
            ['metadata' => ['order_id' => '6735'], 'id' => 'prod_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Product::class, $result);
    }

    public function testListProduct()
    {
        $this->expectsRequest('get', '/v1/products');
        $result = $this->client->products->all(['limit' => 3]);
        static::assertInstanceOf(\Stripe\Collection::class, $result);
        static::assertInstanceOf(\Stripe\Product::class, $result->data[0]);
    }

    public function testDeleteProduct()
    {
        $this->expectsRequest('delete', '/v1/products/{id}');
        $result = $this->client->products->delete(
            '{id}',
            ['id' => 'prod_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Product::class, $result);
    }

    public function testCreatePrice()
    {
        $this->expectsRequest('post', '/v1/prices');
        $result = $this->client->prices->create(
            [
                'unit_amount' => 2000,
                'currency' => 'usd',
                'recurring' => ['interval' => 'month'],
                'product' => 'prod_xxxxxxxxxxxxx',
            ]
        );
        static::assertInstanceOf(\Stripe\Price::class, $result);
    }

    public function testRetrievePrice()
    {
        $this->expectsRequest('get', '/v1/prices/{id}');
        $result = $this->client->prices->retrieve(
            '{id}',
            ['id' => 'price_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Price::class, $result);
    }

    public function testUpdatePrice()
    {
        $this->expectsRequest('post', '/v1/prices/{id}');
        $result = $this->client->prices->update(
            '{id}',
            ['metadata' => ['order_id' => '6735'], 'id' => 'price_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Price::class, $result);
    }

    public function testListPrice()
    {
        $this->expectsRequest('get', '/v1/prices');
        $result = $this->client->prices->all(['limit' => 3]);
        static::assertInstanceOf(\Stripe\Collection::class, $result);
        static::assertInstanceOf(\Stripe\Price::class, $result->data[0]);
    }

    public function testCreateRefund()
    {
        $this->expectsRequest('post', '/v1/refunds');
        $result = $this->client->refunds->create(['charge' => 'ch_xxxxxxxxxxxxx']);
        static::assertInstanceOf(\Stripe\Refund::class, $result);
    }

    public function testRetrieveRefund()
    {
        $this->expectsRequest('get', '/v1/refunds/{id}');
        $result = $this->client->refunds->retrieve(
            '{id}',
            ['id' => 're_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Refund::class, $result);
    }

    public function testUpdateRefund()
    {
        $this->expectsRequest('post', '/v1/refunds/{id}');
        $result = $this->client->refunds->update(
            '{id}',
            ['metadata' => ['order_id' => '6735'], 'id' => 're_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Refund::class, $result);
    }

    public function testListRefund()
    {
        $this->expectsRequest('get', '/v1/refunds');
        $result = $this->client->refunds->all(['limit' => 3]);
        static::assertInstanceOf(\Stripe\Collection::class, $result);
        static::assertInstanceOf(\Stripe\Refund::class, $result->data[0]);
    }

    public function testCreateToken()
    {
        $this->expectsRequest('post', '/v1/tokens');
        $result = $this->client->tokens->create(
            [
                'card' => [
                    'number' => '4242424242424242',
                    'exp_month' => '5',
                    'exp_year' => '2022',
                    'cvc' => '314',
                ],
            ]
        );
        static::assertInstanceOf(\Stripe\Token::class, $result);
    }

    public function testCreateToken2()
    {
        $this->expectsRequest('post', '/v1/tokens');
        $result = $this->client->tokens->create(
            [
                'bank_account' => [
                    'country' => 'US',
                    'currency' => 'usd',
                    'account_holder_name' => 'Jenny Rosen',
                    'account_holder_type' => 'individual',
                    'routing_number' => '110000000',
                    'account_number' => '000123456789',
                ],
            ]
        );
        static::assertInstanceOf(\Stripe\Token::class, $result);
    }

    public function testCreateToken3()
    {
        $this->expectsRequest('post', '/v1/tokens');
        $result = $this->client->tokens->create(
            ['pii' => ['id_number' => '000000000']]
        );
        static::assertInstanceOf(\Stripe\Token::class, $result);
    }

    public function testCreateToken4()
    {
        $this->expectsRequest('post', '/v1/tokens');
        $result = $this->client->tokens->create(
            [
                'account' => [
                    'individual' => ['first_name' => 'Jane', 'last_name' => 'Doe'],
                    'tos_shown_and_accepted' => true,
                ],
            ]
        );
        static::assertInstanceOf(\Stripe\Token::class, $result);
    }

    public function testCreateToken5()
    {
        $this->expectsRequest('post', '/v1/tokens');
        $result = $this->client->tokens->create(
            [
                'person' => [
                    'first_name' => 'Jane',
                    'last_name' => 'Doe',
                    'relationship' => ['owner' => true],
                ],
            ]
        );
        static::assertInstanceOf(\Stripe\Token::class, $result);
    }

    public function testCreateToken6()
    {
        $this->expectsRequest('post', '/v1/tokens');
        $result = $this->client->tokens->create(['cvc_update' => ['cvc' => '123']]);
        static::assertInstanceOf(\Stripe\Token::class, $result);
    }

    public function testRetrieveToken()
    {
        $this->expectsRequest('get', '/v1/tokens/{id}');
        $result = $this->client->tokens->retrieve('{id}', ['id' => 'tok_xxxx']);
        static::assertInstanceOf(\Stripe\Token::class, $result);
    }

    public function testCreatePaymentMethod()
    {
        $this->expectsRequest('post', '/v1/payment_methods');
        $result = $this->client->paymentMethods->create(
            [
                'type' => 'card',
                'card' => [
                    'number' => '4242424242424242',
                    'exp_month' => 5,
                    'exp_year' => 2022,
                    'cvc' => '314',
                ],
            ]
        );
        static::assertInstanceOf(\Stripe\PaymentMethod::class, $result);
    }

    public function testRetrievePaymentMethod()
    {
        $this->expectsRequest('get', '/v1/payment_methods/{id}');
        $result = $this->client->paymentMethods->retrieve(
            '{id}',
            ['id' => 'pm_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\PaymentMethod::class, $result);
    }

    public function testUpdatePaymentMethod()
    {
        $this->expectsRequest('post', '/v1/payment_methods/{id}');
        $result = $this->client->paymentMethods->update(
            '{id}',
            ['metadata' => ['order_id' => '6735'], 'id' => 'pm_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\PaymentMethod::class, $result);
    }

    public function testListPaymentMethod()
    {
        $this->expectsRequest('get', '/v1/payment_methods');
        $result = $this->client->paymentMethods->all(
            ['customer' => 'cus_xxxxxxxxxxxxx', 'type' => 'card']
        );
        static::assertInstanceOf(\Stripe\Collection::class, $result);
        static::assertInstanceOf(\Stripe\PaymentMethod::class, $result->data[0]);
    }

    public function testAttachPaymentMethod()
    {
        $this->expectsRequest('post', '/v1/payment_methods/{id}/attach');
        $result = $this->client->paymentMethods->attach(
            '{id}',
            ['customer' => 'cus_xxxxxxxxxxxxx', 'id' => 'pm_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\PaymentMethod::class, $result);
    }

    public function testDetachPaymentMethod()
    {
        $this->expectsRequest('post', '/v1/payment_methods/{id}/detach');
        $result = $this->client->paymentMethods->detach(
            '{id}',
            ['id' => 'pm_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\PaymentMethod::class, $result);
    }

    public function testCreatePaymentSource()
    {
        static::markTestSkipped('Polymorphic group');
        $this->expectsRequest('post', '/v1/customers/{parent_id}/sources');
        $result = $this->client->customers->createSource(
            '{parent_id}',
            ['source' => 'btok_xxxxxxxxxxxxx', 'parent_id' => 'cus_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\PaymentSource::class, $result);
    }

    public function testRetrievePaymentSource()
    {
        static::markTestSkipped('Polymorphic group');
        $this->expectsRequest('get', '/v1/customers/{parent_id}/sources/{id}');
        $result = $this->client->customers->retrieveSource(
            '{parent_id}',
            '{id}',
            ['parent_id' => 'cus_xxxxxxxxxxxxx', 'id' => 'ba_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\PaymentSource::class, $result);
    }

    public function testUpdateBankAccount()
    {
        static::markTestSkipped('Polymorphic group');
        $this->expectsRequest('post', '/v1/customers/{parent_id}/sources/{id}');
        $result = $this->client->bankAccounts->update(
            '{parent_id}',
            '{id}',
            [
                'metadata' => ['order_id' => '6735'],
                'parent_id' => 'cus_xxxxxxxxxxxxx',
                'id' => 'ba_xxxxxxxxxxxxx',
            ]
        );
        static::assertInstanceOf(\Stripe\BankAccount::class, $result);
    }

    public function testVerifyBankAccount()
    {
        static::markTestSkipped('Polymorphic group');
        $this->expectsRequest(
            'post',
            '/v1/customers/{parent_id}/sources/{id}/verify'
        );
        $result = $this->client->bankAccounts->verify(
            '{parent_id}',
            '{id}',
            [
                'amounts' => [],
                'parent_id' => 'cus_xxxxxxxxxxxxx',
                'id' => 'ba_xxxxxxxxxxxxx',
            ]
        );
        static::assertInstanceOf(\Stripe\BankAccount::class, $result);
    }

    public function testDeleteBankAccount()
    {
        static::markTestSkipped('Polymorphic group');
        $this->expectsRequest('delete', '/v1/customers/{parent_id}/sources/{id}');
        $result = $this->client->bankAccounts->delete(
            '{parent_id}',
            '{id}',
            ['parent_id' => 'cus_xxxxxxxxxxxxx', 'id' => 'ba_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\BankAccount::class, $result);
    }

    public function testListPaymentSource()
    {
        static::markTestSkipped('Polymorphic group');
        $this->expectsRequest('get', '/v1/customers/{parent_id}/sources');
        $result = $this->client->customers->allSources(
            '{parent_id}',
            [
                'object' => 'bank_account',
                'limit' => 3,
                'parent_id' => 'cus_xxxxxxxxxxxxx',
            ]
        );
        static::assertInstanceOf(\Stripe\Collection::class, $result);
        static::assertInstanceOf(\Stripe\PaymentSource::class, $result->data[0]);
    }

    public function testCreatePaymentSource2()
    {
        static::markTestSkipped('Polymorphic group');
        $this->expectsRequest('post', '/v1/customers/{parent_id}/sources');
        $result = $this->client->customers->createSource(
            '{parent_id}',
            ['source' => 'tok_xxxx', 'parent_id' => 'cus_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\PaymentSource::class, $result);
    }

    public function testRetrievePaymentSource2()
    {
        static::markTestSkipped('Polymorphic group');
        $this->expectsRequest('get', '/v1/customers/{parent_id}/sources/{id}');
        $result = $this->client->customers->retrieveSource(
            '{parent_id}',
            '{id}',
            ['parent_id' => 'cus_xxxxxxxxxxxxx', 'id' => 'card_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\PaymentSource::class, $result);
    }

    public function testUpdateBankAccount2()
    {
        static::markTestSkipped('Polymorphic group');
        $this->expectsRequest('post', '/v1/customers/{parent_id}/sources/{id}');
        $result = $this->client->bankAccounts->update(
            '{parent_id}',
            '{id}',
            [
                'name' => 'Jenny Rosen',
                'parent_id' => 'cus_xxxxxxxxxxxxx',
                'id' => 'card_xxxxxxxxxxxxx',
            ]
        );
        static::assertInstanceOf(\Stripe\BankAccount::class, $result);
    }

    public function testDeleteBankAccount2()
    {
        static::markTestSkipped('Polymorphic group');
        $this->expectsRequest('delete', '/v1/customers/{parent_id}/sources/{id}');
        $result = $this->client->bankAccounts->delete(
            '{parent_id}',
            '{id}',
            ['parent_id' => 'cus_xxxxxxxxxxxxx', 'id' => 'card_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\BankAccount::class, $result);
    }

    public function testListPaymentSource2()
    {
        static::markTestSkipped('Polymorphic group');
        $this->expectsRequest('get', '/v1/customers/{parent_id}/sources');
        $result = $this->client->customers->allSources(
            '{parent_id}',
            ['object' => 'card', 'limit' => 3, 'parent_id' => 'cus_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Collection::class, $result);
        static::assertInstanceOf(\Stripe\PaymentSource::class, $result->data[0]);
    }

    public function testRetrieveSource()
    {
        $this->expectsRequest('get', '/v1/sources/{id}');
        $result = $this->client->sources->retrieve(
            '{id}',
            ['id' => 'src_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Source::class, $result);
    }

    public function testUpdateSource()
    {
        $this->expectsRequest('post', '/v1/sources/{id}');
        $result = $this->client->sources->update(
            '{id}',
            ['metadata' => ['order_id' => '6735'], 'id' => 'src_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Source::class, $result);
    }

    public function testCreateSession()
    {
        $this->expectsRequest('post', '/v1/checkout/sessions');
        $result = $this->client->checkout->sessions->create(
            [
                'success_url' => 'https://example.com/success',
                'cancel_url' => 'https://example.com/cancel',
                'payment_method_types' => [],
                'line_items' => [],
                'mode' => 'payment',
            ]
        );
        static::assertInstanceOf(\Stripe\Checkout\Session::class, $result);
    }

    public function testRetrieveSession()
    {
        $this->expectsRequest('get', '/v1/checkout/sessions/{id}');
        $result = $this->client->checkout->sessions->retrieve(
            '{id}',
            ['id' => 'cs_test_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Checkout\Session::class, $result);
    }

    public function testListSession()
    {
        $this->expectsRequest('get', '/v1/checkout/sessions');
        $result = $this->client->checkout->sessions->all(['limit' => 3]);
        static::assertInstanceOf(\Stripe\Collection::class, $result);
        static::assertInstanceOf(\Stripe\Checkout\Session::class, $result->data[0]);
    }

    public function testCreateCoupon()
    {
        $this->expectsRequest('post', '/v1/coupons');
        $result = $this->client->coupons->create(
            [
                'percent_off' => 25,
                'duration' => 'repeating',
                'duration_in_months' => 3,
            ]
        );
        static::assertInstanceOf(\Stripe\Coupon::class, $result);
    }

    public function testRetrieveCoupon()
    {
        $this->expectsRequest('get', '/v1/coupons/{id}');
        $result = $this->client->coupons->retrieve('{id}', ['id' => '25_5OFF']);
        static::assertInstanceOf(\Stripe\Coupon::class, $result);
    }

    public function testUpdateCoupon()
    {
        $this->expectsRequest('post', '/v1/coupons/{id}');
        $result = $this->client->coupons->update(
            '{id}',
            ['metadata' => ['order_id' => '6735'], 'id' => 'co_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Coupon::class, $result);
    }

    public function testDeleteCoupon()
    {
        $this->expectsRequest('delete', '/v1/coupons/{id}');
        $result = $this->client->coupons->delete(
            '{id}',
            ['id' => 'co_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Coupon::class, $result);
    }

    public function testListCoupon()
    {
        $this->expectsRequest('get', '/v1/coupons');
        $result = $this->client->coupons->all(['limit' => 3]);
        static::assertInstanceOf(\Stripe\Collection::class, $result);
        static::assertInstanceOf(\Stripe\Coupon::class, $result->data[0]);
    }

    public function testPreviewCreditNote()
    {
        $this->expectsRequest('get', '/v1/credit_notes/preview');
        $result = $this->client->creditNotes->preview(
            ['invoice' => 'in_xxxxxxxxxxxxx', 'lines' => []]
        );
        static::assertInstanceOf(\Stripe\CreditNote::class, $result);
    }

    public function testCreateCreditNote()
    {
        $this->expectsRequest('post', '/v1/credit_notes');
        $result = $this->client->creditNotes->create(
            ['invoice' => 'in_xxxxxxxxxxxxx', 'lines' => []]
        );
        static::assertInstanceOf(\Stripe\CreditNote::class, $result);
    }

    public function testRetrieveCreditNote()
    {
        $this->expectsRequest('get', '/v1/credit_notes/{id}');
        $result = $this->client->creditNotes->retrieve(
            '{id}',
            ['id' => 'cn_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\CreditNote::class, $result);
    }

    public function testUpdateCreditNote()
    {
        $this->expectsRequest('post', '/v1/credit_notes/{id}');
        $result = $this->client->creditNotes->update(
            '{id}',
            ['metadata' => ['order_id' => '6735'], 'id' => 'cn_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\CreditNote::class, $result);
    }

    public function testListCreditNoteLineItem()
    {
        $this->expectsRequest('get', '/v1/credit_notes/{parent_id}/lines');
        $result = $this->client->creditNotes->allLines(
            '{parent_id}',
            ['limit' => 3, 'parent_id' => 'cn_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Collection::class, $result);
        static::assertInstanceOf(\Stripe\CreditNoteLineItem::class, $result->data[0]);
    }

    public function testPreviewCreditNote2()
    {
        $this->expectsRequest('get', '/v1/credit_notes/preview');
        $result = $this->client->creditNotes->preview(
            ['invoice' => 'in_xxxxxxxxxxxxx', 'lines' => []]
        );
        static::assertInstanceOf(\Stripe\CreditNote::class, $result);
    }

    public function testVoidCreditNoteCreditNote()
    {
        $this->expectsRequest('post', '/v1/credit_notes/{id}/void');
        $result = $this->client->creditNotes->voidCreditNote(
            '{id}',
            ['id' => 'cn_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\CreditNote::class, $result);
    }

    public function testListCreditNote()
    {
        $this->expectsRequest('get', '/v1/credit_notes');
        $result = $this->client->creditNotes->all(['limit' => 3]);
        static::assertInstanceOf(\Stripe\Collection::class, $result);
        static::assertInstanceOf(\Stripe\CreditNote::class, $result->data[0]);
    }

    public function testCreateCustomerBalanceTransaction()
    {
        $this->expectsRequest(
            'post',
            '/v1/customers/{parent_id}/balance_transactions'
        );
        $result = $this->client->customers->createBalanceTransaction(
            '{parent_id}',
            [
                'amount' => -500,
                'currency' => 'usd',
                'parent_id' => 'cus_xxxxxxxxxxxxx',
            ]
        );
        static::assertInstanceOf(\Stripe\CustomerBalanceTransaction::class, $result);
    }

    public function testRetrieveCustomerBalanceTransaction()
    {
        $this->expectsRequest(
            'get',
            '/v1/customers/{parent_id}/balance_transactions/{id}'
        );
        $result = $this->client->customers->retrieveBalanceTransaction(
            '{parent_id}',
            '{id}',
            ['parent_id' => 'cus_xxxxxxxxxxxxx', 'id' => 'cbtxn_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\CustomerBalanceTransaction::class, $result);
    }

    public function testUpdateCustomerBalanceTransaction()
    {
        $this->expectsRequest(
            'post',
            '/v1/customers/{parent_id}/balance_transactions/{id}'
        );
        $result = $this->client->customers->updateBalanceTransaction(
            '{parent_id}',
            '{id}',
            [
                'metadata' => ['order_id' => '6735'],
                'parent_id' => 'cus_xxxxxxxxxxxxx',
                'id' => 'cbtxn_xxxxxxxxxxxxx',
            ]
        );
        static::assertInstanceOf(\Stripe\CustomerBalanceTransaction::class, $result);
    }

    public function testListCustomerBalanceTransaction()
    {
        $this->expectsRequest(
            'get',
            '/v1/customers/{parent_id}/balance_transactions'
        );
        $result = $this->client->customers->allBalanceTransactions(
            '{parent_id}',
            ['limit' => 3, 'parent_id' => 'cus_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Collection::class, $result);
        static::assertInstanceOf(\Stripe\CustomerBalanceTransaction::class, $result->data[0]);
    }

    public function testCreateSession2()
    {
        $this->expectsRequest('post', '/v1/billing_portal/sessions');
        $result = $this->client->billingPortal->sessions->create(
            [
                'customer' => 'cus_xxxxxxxxxxxxx',
                'return_url' => 'https://example.com/account',
            ]
        );
        static::assertInstanceOf(\Stripe\BillingPortal\Session::class, $result);
    }

    public function testCreateConfiguration()
    {
        static::markTestSkipped('example issues');
        $this->expectsRequest('post', '/v1/billing_portal/configurations');
        $result = $this->client->billingPortal->configurations->create(
            [
                'features' => [
                    'customer_update' => ['allowed_updates' => [], 'enabled' => true],
                    'invoice_history' => ['enabled' => true],
                ],
                'business_profile' => [
                    'privacy_policy_url' => 'https://example.com/privacy',
                    'terms_of_service_url' => 'https://example.com/terms',
                ],
            ]
        );
        static::assertInstanceOf(\Stripe\BillingPortal\Configuration::class, $result);
    }

    public function testUpdateConfiguration()
    {
        $this->expectsRequest('post', '/v1/billing_portal/configurations/{id}');
        $result = $this->client->billingPortal->configurations->update(
            '{id}',
            [
                'business_profile' => [
                    'privacy_policy_url' => 'https://example.com/privacy',
                    'terms_of_service_url' => 'https://example.com/terms',
                ],
                'id' => 'bpc_xxxxxxxxxxxxx',
            ]
        );
        static::assertInstanceOf(\Stripe\BillingPortal\Configuration::class, $result);
    }

    public function testRetrieveConfiguration()
    {
        $this->expectsRequest('get', '/v1/billing_portal/configurations/{id}');
        $result = $this->client->billingPortal->configurations->retrieve(
            '{id}',
            ['id' => 'bpc_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\BillingPortal\Configuration::class, $result);
    }

    public function testListConfiguration()
    {
        $this->expectsRequest('get', '/v1/billing_portal/configurations');
        $result = $this->client->billingPortal->configurations->all(['limit' => 3]);
        static::assertInstanceOf(\Stripe\Collection::class, $result);
        static::assertInstanceOf(\Stripe\BillingPortal\Configuration::class, $result->data[0]);
    }

    public function testCreateTaxId()
    {
        $this->expectsRequest('post', '/v1/customers/{parent_id}/tax_ids');
        $result = $this->client->customers->createTaxId(
            '{parent_id}',
            [
                'type' => 'eu_vat',
                'value' => 'DE123456789',
                'parent_id' => 'cus_xxxxxxxxxxxxx',
            ]
        );
        static::assertInstanceOf(\Stripe\TaxId::class, $result);
    }

    public function testRetrieveTaxId()
    {
        $this->expectsRequest('get', '/v1/customers/{parent_id}/tax_ids/{id}');
        $result = $this->client->customers->retrieveTaxId(
            '{parent_id}',
            '{id}',
            ['id' => 'txi_xxxxxxxxxxxxx', 'parent_id' => 'cus_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\TaxId::class, $result);
    }

    public function testDeleteTaxId()
    {
        $this->expectsRequest('delete', '/v1/customers/{parent_id}/tax_ids/{id}');
        $result = $this->client->customers->deleteTaxId(
            '{parent_id}',
            '{id}',
            ['parent_id' => 'cus_xxxxxxxxxxxxx', 'id' => 'txi_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\TaxId::class, $result);
    }

    public function testListTaxId()
    {
        $this->expectsRequest('get', '/v1/customers/{parent_id}/tax_ids');
        $result = $this->client->customers->allTaxIds(
            '{parent_id}',
            ['limit' => 3, 'parent_id' => 'cus_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Collection::class, $result);
        static::assertInstanceOf(\Stripe\TaxId::class, $result->data[0]);
    }

    public function testCreateInvoice()
    {
        $this->expectsRequest('post', '/v1/invoices');
        $result = $this->client->invoices->create(
            ['customer' => 'cus_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Invoice::class, $result);
    }

    public function testRetrieveInvoice()
    {
        $this->expectsRequest('get', '/v1/invoices/{id}');
        $result = $this->client->invoices->retrieve(
            '{id}',
            ['id' => 'in_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Invoice::class, $result);
    }

    public function testUpdateInvoice()
    {
        $this->expectsRequest('post', '/v1/invoices/{id}');
        $result = $this->client->invoices->update(
            '{id}',
            ['metadata' => ['order_id' => '6735'], 'id' => 'in_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Invoice::class, $result);
    }

    public function testDeleteInvoice()
    {
        $this->expectsRequest('delete', '/v1/invoices/{id}');
        $result = $this->client->invoices->delete(
            '{id}',
            ['id' => 'in_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Invoice::class, $result);
    }

    public function testFinalizeInvoiceInvoice()
    {
        $this->expectsRequest('post', '/v1/invoices/{id}/finalize');
        $result = $this->client->invoices->finalizeInvoice(
            '{id}',
            ['id' => 'in_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Invoice::class, $result);
    }

    public function testPayInvoice()
    {
        $this->expectsRequest('post', '/v1/invoices/{id}/pay');
        $result = $this->client->invoices->pay(
            '{id}',
            ['id' => 'in_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Invoice::class, $result);
    }

    public function testSendInvoiceInvoice()
    {
        $this->expectsRequest('post', '/v1/invoices/{id}/send');
        $result = $this->client->invoices->sendInvoice(
            '{id}',
            ['id' => 'in_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Invoice::class, $result);
    }

    public function testVoidInvoiceInvoice()
    {
        $this->expectsRequest('post', '/v1/invoices/{id}/void');
        $result = $this->client->invoices->voidInvoice(
            '{id}',
            ['id' => 'in_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Invoice::class, $result);
    }

    public function testMarkUncollectibleInvoice()
    {
        $this->expectsRequest('post', '/v1/invoices/{id}/mark_uncollectible');
        $result = $this->client->invoices->markUncollectible(
            '{id}',
            ['id' => 'in_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Invoice::class, $result);
    }

    public function testListInvoice()
    {
        $this->expectsRequest('get', '/v1/invoices');
        $result = $this->client->invoices->all(['limit' => 3]);
        static::assertInstanceOf(\Stripe\Collection::class, $result);
        static::assertInstanceOf(\Stripe\Invoice::class, $result->data[0]);
    }

    public function testCreateInvoiceItem()
    {
        $this->expectsRequest('post', '/v1/invoiceitems');
        $result = $this->client->invoiceItems->create(
            ['customer' => 'cus_xxxxxxxxxxxxx', 'price' => 'price_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\InvoiceItem::class, $result);
    }

    public function testRetrieveInvoiceItem()
    {
        $this->expectsRequest('get', '/v1/invoiceitems/{id}');
        $result = $this->client->invoiceItems->retrieve(
            '{id}',
            ['id' => 'ii_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\InvoiceItem::class, $result);
    }

    public function testUpdateInvoiceItem()
    {
        $this->expectsRequest('post', '/v1/invoiceitems/{id}');
        $result = $this->client->invoiceItems->update(
            '{id}',
            ['metadata' => ['order_id' => '6735'], 'id' => 'ii_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\InvoiceItem::class, $result);
    }

    public function testDeleteInvoiceItem()
    {
        $this->expectsRequest('delete', '/v1/invoiceitems/{id}');
        $result = $this->client->invoiceItems->delete(
            '{id}',
            ['id' => 'ii_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\InvoiceItem::class, $result);
    }

    public function testListInvoiceItem()
    {
        $this->expectsRequest('get', '/v1/invoiceitems');
        $result = $this->client->invoiceItems->all(['limit' => 3]);
        static::assertInstanceOf(\Stripe\Collection::class, $result);
        static::assertInstanceOf(\Stripe\InvoiceItem::class, $result->data[0]);
    }

    public function testCreatePlan()
    {
        $this->expectsRequest('post', '/v1/plans');
        $result = $this->client->plans->create(
            [
                'amount' => 2000,
                'currency' => 'usd',
                'interval' => 'month',
                'product' => 'prod_xxxxxxxxxxxxx',
            ]
        );
        static::assertInstanceOf(\Stripe\Plan::class, $result);
    }

    public function testRetrievePlan()
    {
        $this->expectsRequest('get', '/v1/plans/{id}');
        $result = $this->client->plans->retrieve(
            '{id}',
            ['id' => 'price_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Plan::class, $result);
    }

    public function testUpdatePlan()
    {
        $this->expectsRequest('post', '/v1/plans/{id}');
        $result = $this->client->plans->update(
            '{id}',
            ['metadata' => ['order_id' => '6735'], 'id' => 'price_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Plan::class, $result);
    }

    public function testDeletePlan()
    {
        $this->expectsRequest('delete', '/v1/plans/{id}');
        $result = $this->client->plans->delete(
            '{id}',
            ['id' => 'price_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Plan::class, $result);
    }

    public function testListPlan()
    {
        $this->expectsRequest('get', '/v1/plans');
        $result = $this->client->plans->all(['limit' => 3]);
        static::assertInstanceOf(\Stripe\Collection::class, $result);
        static::assertInstanceOf(\Stripe\Plan::class, $result->data[0]);
    }

    public function testCreatePromotionCode()
    {
        $this->expectsRequest('post', '/v1/promotion_codes');
        $result = $this->client->promotionCodes->create(['coupon' => '25_5OFF']);
        static::assertInstanceOf(\Stripe\PromotionCode::class, $result);
    }

    public function testUpdatePromotionCode()
    {
        $this->expectsRequest('post', '/v1/promotion_codes/{id}');
        $result = $this->client->promotionCodes->update(
            '{id}',
            ['metadata' => ['order_id' => '6735'], 'id' => 'promo_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\PromotionCode::class, $result);
    }

    public function testRetrievePromotionCode()
    {
        $this->expectsRequest('get', '/v1/promotion_codes/{id}');
        $result = $this->client->promotionCodes->retrieve(
            '{id}',
            ['id' => 'promo_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\PromotionCode::class, $result);
    }

    public function testListPromotionCode()
    {
        $this->expectsRequest('get', '/v1/promotion_codes');
        $result = $this->client->promotionCodes->all(['limit' => 3]);
        static::assertInstanceOf(\Stripe\Collection::class, $result);
        static::assertInstanceOf(\Stripe\PromotionCode::class, $result->data[0]);
    }

    public function testCreateSubscription()
    {
        $this->expectsRequest('post', '/v1/subscriptions');
        $result = $this->client->subscriptions->create(
            ['customer' => 'cus_xxxxxxxxxxxxx', 'items' => []]
        );
        static::assertInstanceOf(\Stripe\Subscription::class, $result);
    }

    public function testRetrieveSubscription()
    {
        $this->expectsRequest('get', '/v1/subscriptions/{id}');
        $result = $this->client->subscriptions->retrieve(
            '{id}',
            ['id' => 'sub_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Subscription::class, $result);
    }

    public function testUpdateSubscription()
    {
        $this->expectsRequest('post', '/v1/subscriptions/{id}');
        $result = $this->client->subscriptions->update(
            '{id}',
            ['metadata' => ['order_id' => '6735'], 'id' => 'sub_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Subscription::class, $result);
    }

    public function testCancelSubscription()
    {
        $this->expectsRequest('delete', '/v1/subscriptions/{id}');
        $result = $this->client->subscriptions->cancel(
            '{id}',
            ['id' => 'sub_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Subscription::class, $result);
    }

    public function testListSubscription()
    {
        $this->expectsRequest('get', '/v1/subscriptions');
        $result = $this->client->subscriptions->all(['limit' => 3]);
        static::assertInstanceOf(\Stripe\Collection::class, $result);
        static::assertInstanceOf(\Stripe\Subscription::class, $result->data[0]);
    }

    public function testCreateSubscriptionItem()
    {
        $this->expectsRequest('post', '/v1/subscription_items');
        $result = $this->client->subscriptionItems->create(
            [
                'subscription' => 'sub_xxxxxxxxxxxxx',
                'price' => 'price_xxxxxxxxxxxxx',
                'quantity' => 2,
            ]
        );
        static::assertInstanceOf(\Stripe\SubscriptionItem::class, $result);
    }

    public function testRetrieveSubscriptionItem()
    {
        $this->expectsRequest('get', '/v1/subscription_items/{id}');
        $result = $this->client->subscriptionItems->retrieve(
            '{id}',
            ['id' => 'si_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\SubscriptionItem::class, $result);
    }

    public function testUpdateSubscriptionItem()
    {
        $this->expectsRequest('post', '/v1/subscription_items/{id}');
        $result = $this->client->subscriptionItems->update(
            '{id}',
            ['metadata' => ['order_id' => '6735'], 'id' => 'si_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\SubscriptionItem::class, $result);
    }

    public function testDeleteSubscriptionItem()
    {
        $this->expectsRequest('delete', '/v1/subscription_items/{id}');
        $result = $this->client->subscriptionItems->delete(
            '{id}',
            ['id' => 'si_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\SubscriptionItem::class, $result);
    }

    public function testListSubscriptionItem()
    {
        $this->expectsRequest('get', '/v1/subscription_items');
        $result = $this->client->subscriptionItems->all(
            ['subscription' => 'sub_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Collection::class, $result);
        static::assertInstanceOf(\Stripe\SubscriptionItem::class, $result->data[0]);
    }

    public function testCreateSubscriptionSchedule()
    {
        $this->expectsRequest('post', '/v1/subscription_schedules');
        $result = $this->client->subscriptionSchedules->create(
            [
                'customer' => 'cus_xxxxxxxxxxxxx',
                'start_date' => 1620753115,
                'end_behavior' => 'release',
                'phases' => [],
            ]
        );
        static::assertInstanceOf(\Stripe\SubscriptionSchedule::class, $result);
    }

    public function testRetrieveSubscriptionSchedule()
    {
        $this->expectsRequest('get', '/v1/subscription_schedules/{id}');
        $result = $this->client->subscriptionSchedules->retrieve(
            '{id}',
            ['id' => 'sub_sched_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\SubscriptionSchedule::class, $result);
    }

    public function testUpdateSubscriptionSchedule()
    {
        $this->expectsRequest('post', '/v1/subscription_schedules/{id}');
        $result = $this->client->subscriptionSchedules->update(
            '{id}',
            ['end_behavior' => 'release', 'id' => 'sub_sched_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\SubscriptionSchedule::class, $result);
    }

    public function testCancelSubscriptionSchedule()
    {
        $this->expectsRequest('post', '/v1/subscription_schedules/{id}/cancel');
        $result = $this->client->subscriptionSchedules->cancel(
            '{id}',
            ['id' => 'sub_sched_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\SubscriptionSchedule::class, $result);
    }

    public function testReleaseSubscriptionSchedule()
    {
        $this->expectsRequest('post', '/v1/subscription_schedules/{id}/release');
        $result = $this->client->subscriptionSchedules->release(
            '{id}',
            ['id' => 'sub_sched_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\SubscriptionSchedule::class, $result);
    }

    public function testListSubscriptionSchedule()
    {
        $this->expectsRequest('get', '/v1/subscription_schedules');
        $result = $this->client->subscriptionSchedules->all(['limit' => 3]);
        static::assertInstanceOf(\Stripe\Collection::class, $result);
        static::assertInstanceOf(\Stripe\SubscriptionSchedule::class, $result->data[0]);
    }

    public function testCreateTaxRate()
    {
        $this->expectsRequest('post', '/v1/tax_rates');
        $result = $this->client->taxRates->create(
            [
                'display_name' => 'VAT',
                'description' => 'VAT Germany',
                'jurisdiction' => 'DE',
                'percentage' => 16,
                'inclusive' => false,
            ]
        );
        static::assertInstanceOf(\Stripe\TaxRate::class, $result);
    }

    public function testRetrieveTaxRate()
    {
        $this->expectsRequest('get', '/v1/tax_rates/{id}');
        $result = $this->client->taxRates->retrieve(
            '{id}',
            ['id' => 'txr_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\TaxRate::class, $result);
    }

    public function testUpdateTaxRate()
    {
        $this->expectsRequest('post', '/v1/tax_rates/{id}');
        $result = $this->client->taxRates->update(
            '{id}',
            ['active' => false, 'id' => 'txr_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\TaxRate::class, $result);
    }

    public function testListTaxRate()
    {
        $this->expectsRequest('get', '/v1/tax_rates');
        $result = $this->client->taxRates->all(['limit' => 3]);
        static::assertInstanceOf(\Stripe\Collection::class, $result);
        static::assertInstanceOf(\Stripe\TaxRate::class, $result->data[0]);
    }

    public function testCreateUsageRecord()
    {
        $this->expectsRequest(
            'post',
            '/v1/subscription_items/{parent_id}/usage_records'
        );
        $result = $this->client->subscriptionItems->createUsageRecord(
            '{parent_id}',
            [
                'quantity' => 100,
                'timestamp' => 1571252444,
                'parent_id' => 'si_xxxxxxxxxxxxx',
            ]
        );
        static::assertInstanceOf(\Stripe\UsageRecord::class, $result);
    }

    public function testUsageRecordSummariesSubscriptionItem()
    {
        static::markTestSkipped('->usageRecordSummaries vs. ->allUsageRecordSummaries');
        $this->expectsRequest(
            'get',
            '/v1/subscription_items/{parent_id}/usage_record_summaries'
        );
        $result = $this->client->subscriptionItems->usageRecordSummaries(
            '{parent_id}',
            ['limit' => 3, 'parent_id' => 'si_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Collection::class, $result);
        static::assertInstanceOf(\Stripe\SubscriptionItem::class, $result->data[0]);
    }

    public function testCreateAccount()
    {
        $this->expectsRequest('post', '/v1/accounts');
        $result = $this->client->accounts->create(
            [
                'type' => 'custom',
                'country' => 'US',
                'email' => 'jenny.rosen@example.com',
                'capabilities' => [
                    'card_payments' => ['requested' => true],
                    'transfers' => ['requested' => true],
                ],
            ]
        );
        static::assertInstanceOf(\Stripe\Account::class, $result);
    }

    public function testRetrieveAccount()
    {
        $this->expectsRequest('get', '/v1/accounts/{id}');
        $result = $this->client->accounts->retrieve(
            '{id}',
            ['id' => 'acct_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Account::class, $result);
    }

    public function testUpdateAccount()
    {
        $this->expectsRequest('post', '/v1/accounts/{id}');
        $result = $this->client->accounts->update(
            '{id}',
            ['metadata' => ['order_id' => '6735'], 'id' => 'acct_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Account::class, $result);
    }

    public function testDeleteAccount()
    {
        $this->expectsRequest('delete', '/v1/accounts/{id}');
        $result = $this->client->accounts->delete(
            '{id}',
            ['id' => 'acct_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Account::class, $result);
    }

    public function testRejectAccount()
    {
        $this->expectsRequest('post', '/v1/accounts/{id}/reject');
        $result = $this->client->accounts->reject(
            '{id}',
            ['reason' => 'fraud', 'id' => 'acct_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Account::class, $result);
    }

    public function testListAccount()
    {
        $this->expectsRequest('get', '/v1/accounts');
        $result = $this->client->accounts->all(['limit' => 3]);
        static::assertInstanceOf(\Stripe\Collection::class, $result);
        static::assertInstanceOf(\Stripe\Account::class, $result->data[0]);
    }

    public function testCreateLoginLink()
    {
        $this->expectsRequest('post', '/v1/accounts/{parent_id}/login_links');
        $result = $this->client->accounts->createLoginLink(
            '{parent_id}',
            ['parent_id' => 'acct_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\LoginLink::class, $result);
    }

    public function testCreateAccountLink()
    {
        $this->expectsRequest('post', '/v1/account_links');
        $result = $this->client->accountLinks->create(
            [
                'account' => 'acct_xxxxxxxxxxxxx',
                'refresh_url' => 'https://example.com/reauth',
                'return_url' => 'https://example.com/return',
                'type' => 'account_onboarding',
            ]
        );
        static::assertInstanceOf(\Stripe\AccountLink::class, $result);
    }

    public function testRetrieveApplicationFee()
    {
        $this->expectsRequest('get', '/v1/application_fees/{id}');
        $result = $this->client->applicationFees->retrieve(
            '{id}',
            ['id' => 'fee_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\ApplicationFee::class, $result);
    }

    public function testListApplicationFee()
    {
        $this->expectsRequest('get', '/v1/application_fees');
        $result = $this->client->applicationFees->all(['limit' => 3]);
        static::assertInstanceOf(\Stripe\Collection::class, $result);
        static::assertInstanceOf(\Stripe\ApplicationFee::class, $result->data[0]);
    }

    public function testCreateApplicationFeeRefund()
    {
        $this->expectsRequest('post', '/v1/application_fees/{parent_id}/refunds');
        $result = $this->client->applicationFees->createRefund(
            '{parent_id}',
            ['parent_id' => 'fee_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\ApplicationFeeRefund::class, $result);
    }

    public function testRetrieveApplicationFeeRefund()
    {
        $this->expectsRequest(
            'get',
            '/v1/application_fees/{parent_id}/refunds/{id}'
        );
        $result = $this->client->applicationFees->retrieveRefund(
            '{parent_id}',
            '{id}',
            ['parent_id' => 'fee_xxxxxxxxxxxxx', 'id' => 'fr_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\ApplicationFeeRefund::class, $result);
    }

    public function testUpdateApplicationFeeRefund()
    {
        $this->expectsRequest(
            'post',
            '/v1/application_fees/{parent_id}/refunds/{id}'
        );
        $result = $this->client->applicationFees->updateRefund(
            '{parent_id}',
            '{id}',
            [
                'metadata' => ['order_id' => '6735'],
                'parent_id' => 'fee_xxxxxxxxxxxxx',
                'id' => 'fr_xxxxxxxxxxxxx',
            ]
        );
        static::assertInstanceOf(\Stripe\ApplicationFeeRefund::class, $result);
    }

    public function testListApplicationFeeRefund()
    {
        $this->expectsRequest('get', '/v1/application_fees/{parent_id}/refunds');
        $result = $this->client->applicationFees->allRefunds(
            '{parent_id}',
            ['limit' => 3, 'parent_id' => 'fee_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Collection::class, $result);
        static::assertInstanceOf(\Stripe\ApplicationFeeRefund::class, $result->data[0]);
    }

    public function testRetrieveCapability()
    {
        $this->expectsRequest('get', '/v1/accounts/{parent_id}/capabilities/{id}');
        $result = $this->client->accounts->retrieveCapability(
            '{parent_id}',
            '{id}',
            ['parent_id' => 'acct_xxxxxxxxxxxxx', 'id' => 'card_payments']
        );
        static::assertInstanceOf(\Stripe\Capability::class, $result);
    }

    public function testUpdateCapability()
    {
        $this->expectsRequest('post', '/v1/accounts/{parent_id}/capabilities/{id}');
        $result = $this->client->accounts->updateCapability(
            '{parent_id}',
            '{id}',
            [
                'requested' => true,
                'parent_id' => 'acct_xxxxxxxxxxxxx',
                'id' => 'card_payments',
            ]
        );
        static::assertInstanceOf(\Stripe\Capability::class, $result);
    }

    public function testCapabilitiesAccount()
    {
        static::markTestSkipped('->capabilities vs. ->allCapabilities');
        $this->expectsRequest('get', '/v1/accounts/{parent_id}/capabilities');
        $result = $this->client->accounts->capabilities(
            '{parent_id}',
            ['parent_id' => 'acct_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Collection::class, $result);
        static::assertInstanceOf(\Stripe\Account::class, $result->data[0]);
    }

    public function testListCountrySpec()
    {
        $this->expectsRequest('get', '/v1/country_specs');
        $result = $this->client->countrySpecs->all(['limit' => 3]);
        static::assertInstanceOf(\Stripe\Collection::class, $result);
        static::assertInstanceOf(\Stripe\CountrySpec::class, $result->data[0]);
    }

    public function testRetrieveCountrySpec()
    {
        $this->expectsRequest('get', '/v1/country_specs/{id}');
        $result = $this->client->countrySpecs->retrieve('{id}', ['id' => 'US']);
        static::assertInstanceOf(\Stripe\CountrySpec::class, $result);
    }

    public function testCreateExternalAccount()
    {
        static::markTestSkipped('Polymorphic group');
        $this->expectsRequest('post', '/v1/accounts/{parent_id}/external_accounts');
        $result = $this->client->accounts->createExternalAccount(
            '{parent_id}',
            [
                'external_account' => 'btok_xxxxxxxxxxxxx',
                'parent_id' => 'acct_xxxxxxxxxxxxx',
            ]
        );
        static::assertInstanceOf(\Stripe\ExternalAccount::class, $result);
    }

    public function testRetrieveExternalAccount()
    {
        static::markTestSkipped('Polymorphic group');
        $this->expectsRequest(
            'get',
            '/v1/accounts/{parent_id}/external_accounts/{id}'
        );
        $result = $this->client->accounts->retrieveExternalAccount(
            '{parent_id}',
            '{id}',
            ['parent_id' => 'acct_xxxxxxxxxxxxx', 'id' => 'ba_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\ExternalAccount::class, $result);
    }

    public function testUpdateBankAccount3()
    {
        static::markTestSkipped('Polymorphic group');
        $this->expectsRequest(
            'post',
            '/v1/accounts/{parent_id}/external_accounts/{id}'
        );
        $result = $this->client->bankAccounts->update(
            '{parent_id}',
            '{id}',
            [
                'metadata' => ['order_id' => '6735'],
                'parent_id' => 'acct_xxxxxxxxxxxxx',
                'id' => 'ba_xxxxxxxxxxxxx',
            ]
        );
        static::assertInstanceOf(\Stripe\BankAccount::class, $result);
    }

    public function testDeleteBankAccount3()
    {
        static::markTestSkipped('Polymorphic group');
        $this->expectsRequest(
            'delete',
            '/v1/accounts/{parent_id}/external_accounts/{id}'
        );
        $result = $this->client->bankAccounts->delete(
            '{parent_id}',
            '{id}',
            ['parent_id' => 'acct_xxxxxxxxxxxxx', 'id' => 'ba_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\BankAccount::class, $result);
    }

    public function testListExternalAccount()
    {
        static::markTestSkipped('Polymorphic group');
        $this->expectsRequest('get', '/v1/accounts/{parent_id}/external_accounts');
        $result = $this->client->accounts->allExternalAccounts(
            '{parent_id}',
            [
                'object' => 'bank_account',
                'limit' => 3,
                'parent_id' => 'acct_xxxxxxxxxxxxx',
            ]
        );
        static::assertInstanceOf(\Stripe\Collection::class, $result);
        static::assertInstanceOf(\Stripe\ExternalAccount::class, $result->data[0]);
    }

    public function testCreateExternalAccount2()
    {
        static::markTestSkipped('Polymorphic group');
        $this->expectsRequest('post', '/v1/accounts/{parent_id}/external_accounts');
        $result = $this->client->accounts->createExternalAccount(
            '{parent_id}',
            [
                'external_account' => 'tok_xxxx_debit',
                'parent_id' => 'acct_xxxxxxxxxxxxx',
            ]
        );
        static::assertInstanceOf(\Stripe\ExternalAccount::class, $result);
    }

    public function testRetrieveExternalAccount2()
    {
        static::markTestSkipped('Polymorphic group');
        $this->expectsRequest(
            'get',
            '/v1/accounts/{parent_id}/external_accounts/{id}'
        );
        $result = $this->client->accounts->retrieveExternalAccount(
            '{parent_id}',
            '{id}',
            ['parent_id' => 'acct_xxxxxxxxxxxxx', 'id' => 'card_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\ExternalAccount::class, $result);
    }

    public function testUpdateBankAccount4()
    {
        static::markTestSkipped('Polymorphic group');
        $this->expectsRequest(
            'post',
            '/v1/accounts/{parent_id}/external_accounts/{id}'
        );
        $result = $this->client->bankAccounts->update(
            '{parent_id}',
            '{id}',
            [
                'metadata' => ['order_id' => '6735'],
                'parent_id' => 'acct_xxxxxxxxxxxxx',
                'id' => 'card_xxxxxxxxxxxxx',
            ]
        );
        static::assertInstanceOf(\Stripe\BankAccount::class, $result);
    }

    public function testDeleteBankAccount4()
    {
        static::markTestSkipped('Polymorphic group');
        $this->expectsRequest(
            'delete',
            '/v1/accounts/{parent_id}/external_accounts/{id}'
        );
        $result = $this->client->bankAccounts->delete(
            '{parent_id}',
            '{id}',
            ['parent_id' => 'acct_xxxxxxxxxxxxx', 'id' => 'card_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\BankAccount::class, $result);
    }

    public function testListExternalAccount2()
    {
        static::markTestSkipped('Polymorphic group');
        $this->expectsRequest('get', '/v1/accounts/{parent_id}/external_accounts');
        $result = $this->client->accounts->allExternalAccounts(
            '{parent_id}',
            ['object' => 'card', 'limit' => 3, 'parent_id' => 'acct_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Collection::class, $result);
        static::assertInstanceOf(\Stripe\ExternalAccount::class, $result->data[0]);
    }

    public function testCreatePerson()
    {
        $this->expectsRequest('post', '/v1/accounts/{parent_id}/persons');
        $result = $this->client->accounts->createPerson(
            '{parent_id}',
            [
                'first_name' => 'Jane',
                'last_name' => 'Diaz',
                'parent_id' => 'acct_xxxxxxxxxxxxx',
            ]
        );
        static::assertInstanceOf(\Stripe\Person::class, $result);
    }

    public function testRetrievePerson()
    {
        $this->expectsRequest('get', '/v1/accounts/{parent_id}/persons/{id}');
        $result = $this->client->accounts->retrievePerson(
            '{parent_id}',
            '{id}',
            ['parent_id' => 'acct_xxxxxxxxxxxxx', 'id' => 'person_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Person::class, $result);
    }

    public function testUpdatePerson()
    {
        $this->expectsRequest('post', '/v1/accounts/{parent_id}/persons/{id}');
        $result = $this->client->accounts->updatePerson(
            '{parent_id}',
            '{id}',
            [
                'metadata' => ['order_id' => '6735'],
                'parent_id' => 'acct_xxxxxxxxxxxxx',
                'id' => 'person_xxxxxxxxxxxxx',
            ]
        );
        static::assertInstanceOf(\Stripe\Person::class, $result);
    }

    public function testDeletePerson()
    {
        $this->expectsRequest('delete', '/v1/accounts/{parent_id}/persons/{id}');
        $result = $this->client->accounts->deletePerson(
            '{parent_id}',
            '{id}',
            ['parent_id' => 'acct_xxxxxxxxxxxxx', 'id' => 'person_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Person::class, $result);
    }

    public function testListPerson()
    {
        $this->expectsRequest('get', '/v1/accounts/{parent_id}/persons');
        $result = $this->client->accounts->allPersons(
            '{parent_id}',
            ['limit' => 3, 'parent_id' => 'acct_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Collection::class, $result);
        static::assertInstanceOf(\Stripe\Person::class, $result->data[0]);
    }

    public function testCreateTopup()
    {
        $this->expectsRequest('post', '/v1/topups');
        $result = $this->client->topups->create(
            [
                'amount' => 2000,
                'currency' => 'usd',
                'description' => 'Top-up for Jenny Rosen',
                'statement_descriptor' => 'Top-up',
            ]
        );
        static::assertInstanceOf(\Stripe\Topup::class, $result);
    }

    public function testRetrieveTopup()
    {
        $this->expectsRequest('get', '/v1/topups/{id}');
        $result = $this->client->topups->retrieve(
            '{id}',
            ['id' => 'tu_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Topup::class, $result);
    }

    public function testUpdateTopup()
    {
        $this->expectsRequest('post', '/v1/topups/{id}');
        $result = $this->client->topups->update(
            '{id}',
            ['metadata' => ['order_id' => '6735'], 'id' => 'tu_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Topup::class, $result);
    }

    public function testListTopup()
    {
        $this->expectsRequest('get', '/v1/topups');
        $result = $this->client->topups->all(['limit' => 3]);
        static::assertInstanceOf(\Stripe\Collection::class, $result);
        static::assertInstanceOf(\Stripe\Topup::class, $result->data[0]);
    }

    public function testCancelTopup()
    {
        $this->expectsRequest('post', '/v1/topups/{id}/cancel');
        $result = $this->client->topups->cancel(
            '{id}',
            ['id' => 'tu_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Topup::class, $result);
    }

    public function testCreateTransfer()
    {
        $this->expectsRequest('post', '/v1/transfers');
        $result = $this->client->transfers->create(
            [
                'amount' => 400,
                'currency' => 'usd',
                'destination' => 'acct_xxxxxxxxxxxxx',
                'transfer_group' => 'ORDER_95',
            ]
        );
        static::assertInstanceOf(\Stripe\Transfer::class, $result);
    }

    public function testRetrieveTransfer()
    {
        $this->expectsRequest('get', '/v1/transfers/{id}');
        $result = $this->client->transfers->retrieve(
            '{id}',
            ['id' => 'tr_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Transfer::class, $result);
    }

    public function testUpdateTransfer()
    {
        $this->expectsRequest('post', '/v1/transfers/{id}');
        $result = $this->client->transfers->update(
            '{id}',
            ['metadata' => ['order_id' => '6735'], 'id' => 'tr_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Transfer::class, $result);
    }

    public function testListTransfer()
    {
        $this->expectsRequest('get', '/v1/transfers');
        $result = $this->client->transfers->all(['limit' => 3]);
        static::assertInstanceOf(\Stripe\Collection::class, $result);
        static::assertInstanceOf(\Stripe\Transfer::class, $result->data[0]);
    }

    public function testCreateTransferReversal()
    {
        $this->expectsRequest('post', '/v1/transfers/{parent_id}/reversals');
        $result = $this->client->transfers->createReversal(
            '{parent_id}',
            ['amount' => 100, 'parent_id' => 'tr_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\TransferReversal::class, $result);
    }

    public function testRetrieveTransferReversal()
    {
        $this->expectsRequest('get', '/v1/transfers/{parent_id}/reversals/{id}');
        $result = $this->client->transfers->retrieveReversal(
            '{parent_id}',
            '{id}',
            ['parent_id' => 'tr_xxxxxxxxxxxxx', 'id' => 'trr_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\TransferReversal::class, $result);
    }

    public function testUpdateTransferReversal()
    {
        $this->expectsRequest('post', '/v1/transfers/{parent_id}/reversals/{id}');
        $result = $this->client->transfers->updateReversal(
            '{parent_id}',
            '{id}',
            [
                'metadata' => ['order_id' => '6735'],
                'parent_id' => 'tr_xxxxxxxxxxxxx',
                'id' => 'trr_xxxxxxxxxxxxx',
            ]
        );
        static::assertInstanceOf(\Stripe\TransferReversal::class, $result);
    }

    public function testListTransferReversal()
    {
        $this->expectsRequest('get', '/v1/transfers/{parent_id}/reversals');
        $result = $this->client->transfers->allReversals(
            '{parent_id}',
            ['limit' => 3, 'parent_id' => 'tr_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Collection::class, $result);
        static::assertInstanceOf(\Stripe\TransferReversal::class, $result->data[0]);
    }

    public function testRetrieveEarlyFraudWarning()
    {
        $this->expectsRequest('get', '/v1/radar/early_fraud_warnings/{id}');
        $result = $this->client->radar->earlyFraudWarnings->retrieve(
            '{id}',
            ['id' => 'issfr_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Radar\EarlyFraudWarning::class, $result);
    }

    public function testListEarlyFraudWarning()
    {
        $this->expectsRequest('get', '/v1/radar/early_fraud_warnings');
        $result = $this->client->radar->earlyFraudWarnings->all(['limit' => 3]);
        static::assertInstanceOf(\Stripe\Collection::class, $result);
        static::assertInstanceOf(\Stripe\Radar\EarlyFraudWarning::class, $result->data[0]);
    }

    public function testApproveReview()
    {
        $this->expectsRequest('post', '/v1/reviews/{id}/approve');
        $result = $this->client->reviews->approve(
            '{id}',
            ['id' => 'prv_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Review::class, $result);
    }

    public function testRetrieveReview()
    {
        $this->expectsRequest('get', '/v1/reviews/{id}');
        $result = $this->client->reviews->retrieve(
            '{id}',
            ['id' => 'prv_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Review::class, $result);
    }

    public function testListReview()
    {
        $this->expectsRequest('get', '/v1/reviews');
        $result = $this->client->reviews->all(['limit' => 3]);
        static::assertInstanceOf(\Stripe\Collection::class, $result);
        static::assertInstanceOf(\Stripe\Review::class, $result->data[0]);
    }

    public function testCreateValueList()
    {
        $this->expectsRequest('post', '/v1/radar/value_lists');
        $result = $this->client->radar->valueLists->create(
            [
                'alias' => 'custom_ip_xxxxxxxxxxxxx',
                'name' => 'Custom IP Blocklist',
                'item_type' => 'ip_address',
            ]
        );
        static::assertInstanceOf(\Stripe\Radar\ValueList::class, $result);
    }

    public function testRetrieveValueList()
    {
        $this->expectsRequest('get', '/v1/radar/value_lists/{id}');
        $result = $this->client->radar->valueLists->retrieve(
            '{id}',
            ['id' => 'rsl_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Radar\ValueList::class, $result);
    }

    public function testUpdateValueList()
    {
        $this->expectsRequest('post', '/v1/radar/value_lists/{id}');
        $result = $this->client->radar->valueLists->update(
            '{id}',
            ['name' => 'Updated IP Block List', 'id' => 'rsl_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Radar\ValueList::class, $result);
    }

    public function testDeleteValueList()
    {
        $this->expectsRequest('delete', '/v1/radar/value_lists/{id}');
        $result = $this->client->radar->valueLists->delete(
            '{id}',
            ['id' => 'rsl_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Radar\ValueList::class, $result);
    }

    public function testListValueList()
    {
        $this->expectsRequest('get', '/v1/radar/value_lists');
        $result = $this->client->radar->valueLists->all(['limit' => 3]);
        static::assertInstanceOf(\Stripe\Collection::class, $result);
        static::assertInstanceOf(\Stripe\Radar\ValueList::class, $result->data[0]);
    }

    public function testCreateValueListItem()
    {
        $this->expectsRequest('post', '/v1/radar/value_list_items');
        $result = $this->client->radar->valueListItems->create(
            ['value_list' => 'rsl_xxxxxxxxxxxxx', 'value' => '1.2.3.4']
        );
        static::assertInstanceOf(\Stripe\Radar\ValueListItem::class, $result);
    }

    public function testRetrieveValueListItem()
    {
        $this->expectsRequest('get', '/v1/radar/value_list_items/{id}');
        $result = $this->client->radar->valueListItems->retrieve(
            '{id}',
            ['id' => 'rsli_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Radar\ValueListItem::class, $result);
    }

    public function testDeleteValueListItem()
    {
        $this->expectsRequest('delete', '/v1/radar/value_list_items/{id}');
        $result = $this->client->radar->valueListItems->delete(
            '{id}',
            ['id' => 'rsli_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Radar\ValueListItem::class, $result);
    }

    public function testListValueListItem()
    {
        $this->expectsRequest('get', '/v1/radar/value_list_items');
        $result = $this->client->radar->valueListItems->all(
            ['limit' => 3, 'value_list' => 'rsl_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Collection::class, $result);
        static::assertInstanceOf(\Stripe\Radar\ValueListItem::class, $result->data[0]);
    }

    public function testRetrieveAuthorization()
    {
        $this->expectsRequest('get', '/v1/issuing/authorizations/{id}');
        $result = $this->client->issuing->authorizations->retrieve(
            '{id}',
            ['id' => 'iauth_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Issuing\Authorization::class, $result);
    }

    public function testUpdateAuthorization()
    {
        $this->expectsRequest('post', '/v1/issuing/authorizations/{id}');
        $result = $this->client->issuing->authorizations->update(
            '{id}',
            ['metadata' => ['order_id' => '6735'], 'id' => 'iauth_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Issuing\Authorization::class, $result);
    }

    public function testApproveAuthorization()
    {
        $this->expectsRequest('post', '/v1/issuing/authorizations/{id}/approve');
        $result = $this->client->issuing->authorizations->approve(
            '{id}',
            ['id' => 'iauth_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Issuing\Authorization::class, $result);
    }

    public function testDeclineAuthorization()
    {
        $this->expectsRequest('post', '/v1/issuing/authorizations/{id}/decline');
        $result = $this->client->issuing->authorizations->decline(
            '{id}',
            ['id' => 'iauth_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Issuing\Authorization::class, $result);
    }

    public function testListAuthorization()
    {
        $this->expectsRequest('get', '/v1/issuing/authorizations');
        $result = $this->client->issuing->authorizations->all(['limit' => 3]);
        static::assertInstanceOf(\Stripe\Collection::class, $result);
        static::assertInstanceOf(\Stripe\Issuing\Authorization::class, $result->data[0]);
    }

    public function testCreateCardholder()
    {
        $this->expectsRequest('post', '/v1/issuing/cardholders');
        $result = $this->client->issuing->cardholders->create(
            [
                'type' => 'individual',
                'name' => 'Jenny Rosen',
                'email' => 'jenny.rosen@example.com',
                'phone_number' => '+18888675309',
                'billing' => [
                    'address' => [
                        'line1' => '1234 Main Street',
                        'city' => 'San Francisco',
                        'state' => 'CA',
                        'country' => 'US',
                        'postal_code' => '94111',
                    ],
                ],
            ]
        );
        static::assertInstanceOf(\Stripe\Issuing\Cardholder::class, $result);
    }

    public function testRetrieveCardholder()
    {
        $this->expectsRequest('get', '/v1/issuing/cardholders/{id}');
        $result = $this->client->issuing->cardholders->retrieve(
            '{id}',
            ['id' => 'ich_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Issuing\Cardholder::class, $result);
    }

    public function testUpdateCardholder()
    {
        $this->expectsRequest('post', '/v1/issuing/cardholders/{id}');
        $result = $this->client->issuing->cardholders->update(
            '{id}',
            ['metadata' => ['order_id' => '6735'], 'id' => 'ich_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Issuing\Cardholder::class, $result);
    }

    public function testListCardholder()
    {
        $this->expectsRequest('get', '/v1/issuing/cardholders');
        $result = $this->client->issuing->cardholders->all(['limit' => 3]);
        static::assertInstanceOf(\Stripe\Collection::class, $result);
        static::assertInstanceOf(\Stripe\Issuing\Cardholder::class, $result->data[0]);
    }

    public function testCreateCard()
    {
        $this->expectsRequest('post', '/v1/issuing/cards');
        $result = $this->client->issuing->cards->create(
            [
                'cardholder' => 'ich_xxxxxxxxxxxxx',
                'currency' => 'usd',
                'type' => 'virtual',
            ]
        );
        static::assertInstanceOf(\Stripe\Issuing\Card::class, $result);
    }

    public function testRetrieveCard()
    {
        $this->expectsRequest('get', '/v1/issuing/cards/{id}');
        $result = $this->client->issuing->cards->retrieve(
            '{id}',
            ['id' => 'ic_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Issuing\Card::class, $result);
    }

    public function testUpdateCard()
    {
        $this->expectsRequest('post', '/v1/issuing/cards/{id}');
        $result = $this->client->issuing->cards->update(
            '{id}',
            ['metadata' => ['order_id' => '6735'], 'id' => 'ic_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Issuing\Card::class, $result);
    }

    public function testListCard()
    {
        $this->expectsRequest('get', '/v1/issuing/cards');
        $result = $this->client->issuing->cards->all(['limit' => 3]);
        static::assertInstanceOf(\Stripe\Collection::class, $result);
        static::assertInstanceOf(\Stripe\Issuing\Card::class, $result->data[0]);
    }

    public function testCreateDispute()
    {
        $this->expectsRequest('post', '/v1/issuing/disputes');
        $result = $this->client->issuing->disputes->create(
            [
                'transaction' => 'ipi_xxxxxxxxxxxxx',
                'evidence' => [
                    'reason' => 'fraudulent',
                    'fraudulent' => ['explanation' => 'Purchase was unrecognized.'],
                ],
            ]
        );
        static::assertInstanceOf(\Stripe\Issuing\Dispute::class, $result);
    }

    public function testSubmitDispute()
    {
        $this->expectsRequest('post', '/v1/issuing/disputes/{id}/submit');
        $result = $this->client->issuing->disputes->submit(
            '{id}',
            ['id' => 'idp_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Issuing\Dispute::class, $result);
    }

    public function testRetrieveDispute2()
    {
        $this->expectsRequest('get', '/v1/issuing/disputes/{id}');
        $result = $this->client->issuing->disputes->retrieve(
            '{id}',
            ['id' => 'idp_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Issuing\Dispute::class, $result);
    }

    public function testUpdateDispute2()
    {
        $this->expectsRequest('post', '/v1/issuing/disputes/{id}');
        $result = $this->client->issuing->disputes->update(
            '{id}',
            [
                'evidence' => [
                    'reason' => 'not_received',
                    'not_received' => [
                        'expected_at' => 1590000000,
                        'explanation' => '',
                        'product_description' => 'Baseball cap',
                        'product_type' => 'merchandise',
                    ],
                ],
                'id' => 'idp_xxxxxxxxxxxxx',
            ]
        );
        static::assertInstanceOf(\Stripe\Issuing\Dispute::class, $result);
    }

    public function testListDispute2()
    {
        $this->expectsRequest('get', '/v1/issuing/disputes');
        $result = $this->client->issuing->disputes->all(['limit' => 3]);
        static::assertInstanceOf(\Stripe\Collection::class, $result);
        static::assertInstanceOf(\Stripe\Issuing\Dispute::class, $result->data[0]);
    }

    public function testRetrieveTransaction()
    {
        $this->expectsRequest('get', '/v1/issuing/transactions/{id}');
        $result = $this->client->issuing->transactions->retrieve(
            '{id}',
            ['id' => 'ipi_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Issuing\Transaction::class, $result);
    }

    public function testUpdateTransaction()
    {
        $this->expectsRequest('post', '/v1/issuing/transactions/{id}');
        $result = $this->client->issuing->transactions->update(
            '{id}',
            ['metadata' => ['order_id' => '6735'], 'id' => 'ipi_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Issuing\Transaction::class, $result);
    }

    public function testListTransaction()
    {
        $this->expectsRequest('get', '/v1/issuing/transactions');
        $result = $this->client->issuing->transactions->all(['limit' => 3]);
        static::assertInstanceOf(\Stripe\Collection::class, $result);
        static::assertInstanceOf(\Stripe\Issuing\Transaction::class, $result->data[0]);
    }

    public function testCreateConnectionToken()
    {
        $this->expectsRequest('post', '/v1/terminal/connection_tokens');
        $result = $this->client->terminal->connectionTokens->create([]);
        static::assertInstanceOf(\Stripe\Terminal\ConnectionToken::class, $result);
    }

    public function testCreateLocation()
    {
        $this->expectsRequest('post', '/v1/terminal/locations');
        $result = $this->client->terminal->locations->create(
            [
                'display_name' => 'My First Store',
                'address' => [
                    'line1' => '1234 Main Street',
                    'city' => 'San Francisco',
                    'country' => 'US',
                    'postal_code' => '94111',
                ],
            ]
        );
        static::assertInstanceOf(\Stripe\Terminal\Location::class, $result);
    }

    public function testRetrieveLocation()
    {
        $this->expectsRequest('get', '/v1/terminal/locations/{id}');
        $result = $this->client->terminal->locations->retrieve(
            '{id}',
            ['id' => 'tml_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Terminal\Location::class, $result);
    }

    public function testUpdateLocation()
    {
        $this->expectsRequest('post', '/v1/terminal/locations/{id}');
        $result = $this->client->terminal->locations->update(
            '{id}',
            ['display_name' => 'My First Store', 'id' => 'tml_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Terminal\Location::class, $result);
    }

    public function testDeleteLocation()
    {
        $this->expectsRequest('delete', '/v1/terminal/locations/{id}');
        $result = $this->client->terminal->locations->delete(
            '{id}',
            ['id' => 'tml_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Terminal\Location::class, $result);
    }

    public function testListLocation()
    {
        $this->expectsRequest('get', '/v1/terminal/locations');
        $result = $this->client->terminal->locations->all(['limit' => 3]);
        static::assertInstanceOf(\Stripe\Collection::class, $result);
        static::assertInstanceOf(\Stripe\Terminal\Location::class, $result->data[0]);
    }

    public function testCreateReader()
    {
        $this->expectsRequest('post', '/v1/terminal/readers');
        $result = $this->client->terminal->readers->create(
            [
                'registration_code' => 'puppies-plug-could',
                'label' => 'Blue Rabbit',
                'location' => 'tml_1234',
            ]
        );
        static::assertInstanceOf(\Stripe\Terminal\Reader::class, $result);
    }

    public function testRetrieveReader()
    {
        $this->expectsRequest('get', '/v1/terminal/readers/{id}');
        $result = $this->client->terminal->readers->retrieve(
            '{id}',
            ['id' => 'tmr_P400-123-456-789']
        );
        static::assertInstanceOf(\Stripe\Terminal\Reader::class, $result);
    }

    public function testUpdateReader()
    {
        $this->expectsRequest('post', '/v1/terminal/readers/{id}');
        $result = $this->client->terminal->readers->update(
            '{id}',
            ['label' => 'Blue Rabbit', 'id' => 'tmr_P400-123-456-789']
        );
        static::assertInstanceOf(\Stripe\Terminal\Reader::class, $result);
    }

    public function testDeleteReader()
    {
        $this->expectsRequest('delete', '/v1/terminal/readers/{id}');
        $result = $this->client->terminal->readers->delete(
            '{id}',
            ['id' => 'tmr_P400-123-456-789']
        );
        static::assertInstanceOf(\Stripe\Terminal\Reader::class, $result);
    }

    public function testListReader()
    {
        $this->expectsRequest('get', '/v1/terminal/readers');
        $result = $this->client->terminal->readers->all(['limit' => 3]);
        static::assertInstanceOf(\Stripe\Collection::class, $result);
        static::assertInstanceOf(\Stripe\Terminal\Reader::class, $result->data[0]);
    }

    public function testCreateOrder()
    {
        $this->expectsRequest('post', '/v1/orders');
        $result = $this->client->orders->create(
            [
                'currency' => 'usd',
                'email' => 'jenny.rosen@example.com',
                'items' => [],
                'shipping' => [
                    'name' => 'Jenny Rosen',
                    'address' => [
                        'line1' => '1234 Main Street',
                        'city' => 'San Francisco',
                        'state' => 'CA',
                        'country' => 'US',
                        'postal_code' => '94111',
                    ],
                ],
            ]
        );
        static::assertInstanceOf(\Stripe\Order::class, $result);
    }

    public function testRetrieveOrder()
    {
        $this->expectsRequest('get', '/v1/orders/{id}');
        $result = $this->client->orders->retrieve(
            '{id}',
            ['id' => 'or_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Order::class, $result);
    }

    public function testUpdateOrder()
    {
        $this->expectsRequest('post', '/v1/orders/{id}');
        $result = $this->client->orders->update(
            '{id}',
            ['metadata' => ['order_id' => '6735'], 'id' => 'or_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Order::class, $result);
    }

    public function testPayOrder()
    {
        $this->expectsRequest('post', '/v1/orders/{id}/pay');
        $result = $this->client->orders->pay(
            '{id}',
            ['source' => 'tok_xxxx', 'id' => 'or_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Order::class, $result);
    }

    public function testListOrder()
    {
        $this->expectsRequest('get', '/v1/orders');
        $result = $this->client->orders->all(['limit' => 3]);
        static::assertInstanceOf(\Stripe\Collection::class, $result);
        static::assertInstanceOf(\Stripe\Order::class, $result->data[0]);
    }

    public function testRetrieveOrderReturn()
    {
        $this->expectsRequest('get', '/v1/order_returns/{id}');
        $result = $this->client->orderReturns->retrieve(
            '{id}',
            ['id' => 'orret_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\OrderReturn::class, $result);
    }

    public function testListOrderReturn()
    {
        $this->expectsRequest('get', '/v1/order_returns');
        $result = $this->client->orderReturns->all(['limit' => 3]);
        static::assertInstanceOf(\Stripe\Collection::class, $result);
        static::assertInstanceOf(\Stripe\OrderReturn::class, $result->data[0]);
    }

    public function testCreateSku()
    {
        $this->expectsRequest('post', '/v1/skus');
        $result = $this->client->skus->create(
            [
                'attributes' => ['size' => 'Medium', 'gender' => 'Unisex'],
                'price' => 1500,
                'currency' => 'usd',
                'inventory' => ['type' => 'finite', 'quantity' => 500],
                'product' => 'prod_xxxxxxxxxxxxx',
            ]
        );
        static::assertInstanceOf(\Stripe\SKU::class, $result);
    }

    public function testRetrieveSku()
    {
        $this->expectsRequest('get', '/v1/skus/{id}');
        $result = $this->client->skus->retrieve(
            '{id}',
            ['id' => 'sku_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\SKU::class, $result);
    }

    public function testUpdateSku()
    {
        $this->expectsRequest('post', '/v1/skus/{id}');
        $result = $this->client->skus->update(
            '{id}',
            ['metadata' => ['order_id' => '6735'], 'id' => 'sku_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\SKU::class, $result);
    }

    public function testListSku()
    {
        $this->expectsRequest('get', '/v1/skus');
        $result = $this->client->skus->all(['limit' => 3]);
        static::assertInstanceOf(\Stripe\Collection::class, $result);
        static::assertInstanceOf(\Stripe\SKU::class, $result->data[0]);
    }

    public function testDeleteSku()
    {
        $this->expectsRequest('delete', '/v1/skus/{id}');
        $result = $this->client->skus->delete(
            '{id}',
            ['id' => 'sku_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\SKU::class, $result);
    }

    public function testRetrieveScheduledQueryRun()
    {
        $this->expectsRequest('get', '/v1/sigma/scheduled_query_runs/{id}');
        $result = $this->client->sigma->scheduledQueryRuns->retrieve(
            '{id}',
            ['id' => 'sqr_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Sigma\ScheduledQueryRun::class, $result);
    }

    public function testListScheduledQueryRun()
    {
        $this->expectsRequest('get', '/v1/sigma/scheduled_query_runs');
        $result = $this->client->sigma->scheduledQueryRuns->all(['limit' => 3]);
        static::assertInstanceOf(\Stripe\Collection::class, $result);
        static::assertInstanceOf(\Stripe\Sigma\ScheduledQueryRun::class, $result->data[0]);
    }

    public function testCreateReportRun()
    {
        $this->expectsRequest('post', '/v1/reporting/report_runs');
        $result = $this->client->reporting->reportRuns->create(
            [
                'report_type' => 'balance.summary.1',
                'parameters' => [
                    'interval_start' => 1522540800,
                    'interval_end' => 1525132800,
                ],
            ]
        );
        static::assertInstanceOf(\Stripe\Reporting\ReportRun::class, $result);
    }

    public function testRetrieveReportRun()
    {
        $this->expectsRequest('get', '/v1/reporting/report_runs/{id}');
        $result = $this->client->reporting->reportRuns->retrieve(
            '{id}',
            ['id' => 'frr_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\Reporting\ReportRun::class, $result);
    }

    public function testListReportRun()
    {
        $this->expectsRequest('get', '/v1/reporting/report_runs');
        $result = $this->client->reporting->reportRuns->all(['limit' => 3]);
        static::assertInstanceOf(\Stripe\Collection::class, $result);
        static::assertInstanceOf(\Stripe\Reporting\ReportRun::class, $result->data[0]);
    }

    public function testRetrieveReportType()
    {
        $this->expectsRequest('get', '/v1/reporting/report_types/{id}');
        $result = $this->client->reporting->reportTypes->retrieve(
            '{id}',
            ['id' => 'balance.summary.1']
        );
        static::assertInstanceOf(\Stripe\Reporting\ReportType::class, $result);
    }

    public function testListReportType()
    {
        $this->expectsRequest('get', '/v1/reporting/report_types');
        $result = $this->client->reporting->reportTypes->all([]);
        static::assertInstanceOf(\Stripe\Collection::class, $result);
        static::assertInstanceOf(\Stripe\Reporting\ReportType::class, $result->data[0]);
    }

    public function testCreateWebhookEndpoint()
    {
        static::markTestSkipped('stripe-mock issue');
        $this->expectsRequest('post', '/v1/webhook_endpoints');
        $result = $this->client->webhookEndpoints->create(
            [
                'url' => 'https://example.com/my/webhook/endpoint',
                'enabled_events' => [],
            ]
        );
        static::assertInstanceOf(\Stripe\WebhookEndpoint::class, $result);
    }

    public function testRetrieveWebhookEndpoint()
    {
        $this->expectsRequest('get', '/v1/webhook_endpoints/{id}');
        $result = $this->client->webhookEndpoints->retrieve(
            '{id}',
            ['id' => 'we_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\WebhookEndpoint::class, $result);
    }

    public function testUpdateWebhookEndpoint()
    {
        $this->expectsRequest('post', '/v1/webhook_endpoints/{id}');
        $result = $this->client->webhookEndpoints->update(
            '{id}',
            ['url' => 'https://example.com/new_endpoint', 'id' => 'we_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\WebhookEndpoint::class, $result);
    }

    public function testListWebhookEndpoint()
    {
        $this->expectsRequest('get', '/v1/webhook_endpoints');
        $result = $this->client->webhookEndpoints->all(['limit' => 3]);
        static::assertInstanceOf(\Stripe\Collection::class, $result);
        static::assertInstanceOf(\Stripe\WebhookEndpoint::class, $result->data[0]);
    }

    public function testDeleteWebhookEndpoint()
    {
        $this->expectsRequest('delete', '/v1/webhook_endpoints/{id}');
        $result = $this->client->webhookEndpoints->delete(
            '{id}',
            ['id' => 'we_xxxxxxxxxxxxx']
        );
        static::assertInstanceOf(\Stripe\WebhookEndpoint::class, $result);
    }
}
