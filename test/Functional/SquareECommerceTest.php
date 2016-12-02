<?php

namespace Test\Functional;

require_once(__DIR__ . '/../../src/Models/checkRequest.php');

class SquareECommerceTest extends BaseTestCase {
    
    public function testPackage() {
        
        $routes = [
            'getAccessToken',
            'refreshAccessToken',
            'revokeSingleAccessToken',
            'revokeTokens',
            'getLocations',
            'chargeCard',
            'getTransactions',
            'captureSingleTransaction',
            'voidSingleTransaction',
            'retrieveSingleTransaction',
            'createRefund',
            'getRefunds',
            'createCustomer',
            'getCustomers',
            'updateCustomer',
            'getSingleCustomer',
            'createCustomerCard',
            'deleteCustomerCard',
            'deleteSingleCustomer'
        ];
        
        foreach($routes as $file) {
            $var = '{  
                        "args":{  
                            "accessToken":"sq0atp-Hc8593dqpg3vM837cAJsXg",
                            "customerId": "QEMCM8ZRWX0APZ7CRZK32109N0",
                            "locationId": "8JH8RC5FK8D9M"
                        }
                    }';
            $post_data = json_decode($var, true);

            $response = $this->runApp('POST', '/api/SquareECommerce/'.$file, $post_data);

            $this->assertEquals(200, $response->getStatusCode(), 'Error in '.$file.' method');
        }
    }
    
}
