<?php

$app->post('/api/SquareECommerce/createCustomerCard', function ($request, $response, $args) {
    
    $checkRequest = $this->validation;
    $validateRes = $checkRequest->validate($request, ['accessToken','customerId','cardNonce']);
    if(!empty($validateRes) && isset($validateRes['callback']) && $validateRes['callback']=='error') {
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($validateRes);
    } else {
        $post_data = $validateRes;
    }

    $query_str = 'https://connect.squareup.com/v2/customers/'.$post_data['args']['customerId'].'/cards';
    
    $headers['Authorization'] = 'Bearer '.$post_data['args']['accessToken'];
    
    $body['card_nonce'] = $post_data['args']['cardNonce'];

    if(!empty($post_data['args']['cardholderName'])) {
        $body['cardholder_name'] = $post_data['args']['cardholderName'];
    }
    if(!empty($post_data['args']['billingAddressLine1'])) {
        $body['billing_address']['address_line_1'] = $post_data['args']['billingAddressLine1'];
    }
    if(!empty($post_data['args']['billingAddressLine2'])) {
        $body['billing_address']['address_line_2'] = $post_data['args']['billingAddressLine2'];
    }
    if(!empty($post_data['args']['billingAddressLine3'])) {
        $body['billing_address']['address_line_3'] = $post_data['args']['billingAddressLine3'];
    }
    if(!empty($post_data['args']['billingLocality'])) {
        $body['billing_address']['locality'] = $post_data['args']['billingLocality'];
    }
    if(!empty($post_data['args']['billingSublocality'])) {
        $body['billing_address']['sublocality'] = $post_data['args']['billingSublocality'];
    }
    if(!empty($post_data['args']['billingSublocality2'])) {
        $body['billing_address']['sublocality_2'] = $post_data['args']['billingSublocality2'];
    }
    if(!empty($post_data['args']['billingSublocality3'])) {
        $body['billing_address']['sublocality_3'] = $post_data['args']['billingSublocality3'];
    }
    if(!empty($post_data['args']['billingAdministrativeDistrictLevel1'])) {
        $body['billing_address']['administrative_district_level_1'] = $post_data['args']['billingAdministrativeDistrictLevel1'];
    }
    if(!empty($post_data['args']['billingAdministrativeDistrictLevel2'])) {
        $body['billing_address']['administrative_district_level_2'] = $post_data['args']['billingAdministrativeDistrictLevel2'];
    }
    if(!empty($post_data['args']['billingAdministrativeDistrictLevel3'])) {
        $body['billing_address']['administrative_district_level_3'] = $post_data['args']['billingAdministrativeDistrictLevel3'];
    }
    if(!empty($post_data['args']['billingPostalCode'])) {
        $body['billing_address']['postal_code'] = $post_data['args']['billingPostalCode'];
    }
    if(!empty($post_data['args']['billingCountry'])) {
        $body['billing_address']['country'] = $post_data['args']['billingCountry'];
    }
    
    $client = $this->httpClient;
    
    try {

        $resp = $client->post( $query_str, [
            'headers' => $headers,
            'json' => $body
        ]);
        $responseBody = $resp->getBody()->getContents();
  
        if(in_array($resp->getStatusCode(), ['200', '201', '202', '203', '204'])) {
            $result['callback'] = 'success';
            if(empty(json_decode($responseBody, true))) {
                $result['contextWrites']['to']['status_msg'] = "Api return no results";
            } else {
                $result['contextWrites']['to'] = is_array($responseBody) ? $responseBody : json_decode($responseBody);
            }
        } else {
            $result['callback'] = 'error';
            $result['contextWrites']['to']['status_code'] = 'API_ERROR';
            $result['contextWrites']['to']['status_msg'] = json_decode($responseBody);
        }

    } catch (\GuzzleHttp\Exception\ClientException $exception) {

        $responseBody = $exception->getResponse()->getBody()->getContents();
        if(empty(json_decode($responseBody))) {
            $out = $responseBody;
        } else {
            $out = json_decode($responseBody);
        }
        $result['callback'] = 'error';
        $result['contextWrites']['to']['status_code'] = 'API_ERROR';
        $result['contextWrites']['to']['status_msg'] = $out;

    } catch (GuzzleHttp\Exception\ServerException $exception) {

        $responseBody = $exception->getResponse()->getBody()->getContents();
        if(empty(json_decode($responseBody))) {
            $out = $responseBody;
        } else {
            $out = json_decode($responseBody);
        }
        $result['callback'] = 'error';
        $result['contextWrites']['to']['status_code'] = 'API_ERROR';
        $result['contextWrites']['to']['status_msg'] = $out;

    } catch (GuzzleHttp\Exception\ConnectException $exception) {

        $responseBody = $exception->getResponse()->getBody(true);
        $result['callback'] = 'error';
        $result['contextWrites']['to']['status_code'] = 'INTERNAL_PACKAGE_ERROR';
        $result['contextWrites']['to']['status_msg'] = 'Something went wrong inside the package.';

    }
    
    return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);
    
});
