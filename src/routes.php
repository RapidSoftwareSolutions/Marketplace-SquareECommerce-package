<?php
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
    'deleteSingleCustomer',
    'createCustomerCard',
    'deleteCustomerCard',
    'metadata'
];
foreach($routes as $file) {
    require __DIR__ . '/../src/routes/'.$file.'.php';
}

