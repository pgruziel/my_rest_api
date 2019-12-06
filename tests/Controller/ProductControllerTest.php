<?php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProductControllerTest extends WebTestCase
{
    public function testGetLastProductIdEndpoint()
    {
        $client = static::createClient();
        $client->request('GET', '/product/get-last-id');
        $lastProductId = (int) json_decode($client->getResponse()->getContent(), true)['id'];
        $this->assertGreaterThan(0, $lastProductId);
    }

    public function testGetPriceEndpoint()
    {
        $client = static::createClient();
        $client->request('GET', '/product/get-last-id');
        $lastProductId = (int) json_decode($client->getResponse()->getContent(), true)['id'];
        $countryCode = 'us';
        $client->request('GET', '/product/get-price/' . $lastProductId . '/' . $countryCode);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
