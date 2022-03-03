<?php

use Google\ApiCore\ApiException;
use Google\ApiCore\CredentialsWrapper;
use Google\ApiCore\Testing\GeneratedTest;
use Google\ApiCore\Testing\MockTransport;
use Google\Cloud\Billing\V1\BillingAccount;
use Google\Cloud\Billing\V1\CloudBillingClient;
use Google\Rpc\Code;

class GoogleTest extends GeneratedTest
{
     /**
     * @return TransportInterface
     */
    private function createTransport($deserialize = null)
    {
        return new MockTransport($deserialize);
    }

    /**
     * @return CredentialsWrapper
     */
    private function createCredentials()
    {
        return $this->getMockBuilder(CredentialsWrapper::class)->disableOriginalConstructor()->getMock();
    }

    /**
     * @return CloudBillingClient
     */
    private function createClient(array $options = [])
    {
        $options += [
            'credentials' => $this->createCredentials(),
        ];
        return new CloudBillingClient($options);
    }

   /**
     * @test
     */
    public function getBillingAccountTest()
    {
        $transport = $this->createTransport();
        $client = $this->createClient([
            'transport' => $transport,
        ]);
        $this->assertTrue($transport->isExhausted());
        // Mock response
        $name2 = 'name2-1052831874';
        $open = true;
        $displayName = 'displayName1615086568';
        $masterBillingAccount = 'masterBillingAccount1503143052';
        $expectedResponse = new BillingAccount();
        $expectedResponse->setName($name2);
        $expectedResponse->setOpen($open);
        $expectedResponse->setDisplayName($displayName);
        $expectedResponse->setMasterBillingAccount($masterBillingAccount);
        $transport->addResponse($expectedResponse);
        // Mock request
        $formattedName = $client->billingAccountName('[BILLING_ACCOUNT]');
        $response = $client->getBillingAccount($formattedName);
        $this->assertEquals($expectedResponse, $response);
        $actualRequests = $transport->popReceivedCalls();
        $this->assertSame(1, count($actualRequests));
        $actualFuncCall = $actualRequests[0]->getFuncCall();
        $actualRequestObject = $actualRequests[0]->getRequestObject();
        $this->assertSame('/google.cloud.billing.v1.CloudBilling/GetBillingAccount', $actualFuncCall);
        $actualValue = $actualRequestObject->getName();
        $this->assertProtobufEquals($formattedName, $actualValue);
        $this->assertTrue($transport->isExhausted());
    }
}