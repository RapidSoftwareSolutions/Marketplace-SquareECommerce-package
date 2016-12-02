<?php

$app->post('/api/SquareECommerce/chargeCard', function ($request, $response, $args) {
    
    $checkRequest = $this->validation;
    $validateRes = $checkRequest->validate($request, ['accessToken','locationId','idempotencyKey','amount','currency']);
    if(!empty($validateRes) && isset($validateRes['callback']) && $validateRes['callback']=='error') {
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($validateRes);
    } else {
        $post_data = $validateRes;
    }

    $query_str = 'https://connect.squareup.com/v2/locations/'.$post_data['args']['locationId'].'/transactions';
    
    $headers['Authorization'] = 'Bearer '.$post_data['args']['accessToken'];
    
    $body['idempotency_key'] = $post_data['args']['idempotencyKey'];
    $body['amount_money']['amount'] = (int) $post_data['args']['amount'];
    $body['amount_money']['currency'] = $post_data['args']['currency'];
    
    if(!empty($post_data['args']['cardNonce'])) {
        $body['card_nonce'] = $post_data['args']['cardNonce'];
    }
    if(!empty($post_data['args']['customerCardId'])) {
        $body['customer_card_id'] = $post_data['args']['customerCardId'];
    }
    if(!empty($post_data['args']['delayCapture'])) {
        $body['delay_capture'] = $post_data['args']['delayCapture'];
    }
    if(!empty($post_data['args']['referenceId'])) {
        $body['reference_id'] = $post_data['args']['referenceId'];
    }
    if(!empty($post_data['args']['note'])) {
        $body['note'] = $post_data['args']['note'];
    }
    if(!empty($post_data['args']['customerId'])) {
        $body['customer_id'] = $post_data['args']['customerId'];
    }
    if(!empty($post_data['args']['buyerEmailAddress'])) {
        $body['buyer_email_address'] = $post_data['args']['buyerEmailAddress'];
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
    if(!empty($post_data['args']['shippingAddressLine1'])) {
        $body['shipping_address']['address_line_1'] = $post_data['args']['shippingAddressLine1'];
    }
    if(!empty($post_data['args']['shippingAddressLine2'])) {
        $body['shipping_address']['address_line_2'] = $post_data['args']['shippingAddressLine2'];
    }
    if(!empty($post_data['args']['shippingAddressLine3'])) {
        $body['shipping_address']['address_line_3'] = $post_data['args']['shippingAddressLine3'];
    }
    if(!empty($post_data['args']['shippingLocality'])) {
        $body['shipping_address']['locality'] = $post_data['args']['shippingLocality'];
    }
    if(!empty($post_data['args']['shippingSublocality'])) {
        $body['shipping_address']['sublocality'] = $post_data['args']['shippingSublocality'];
    }
    if(!empty($post_data['args']['shippingSublocality2'])) {
        $body['shipping_address']['sublocality_2'] = $post_data['args']['shippingSublocality2'];
    }
    if(!empty($post_data['args']['shippingSublocality3'])) {
        $body['shipping_address']['sublocality_3'] = $post_data['args']['shippingSublocality3'];
    }
    if(!empty($post_data['args']['shippingAdministrativeDistrictLevel1'])) {
        $body['shipping_address']['administrative_district_level_1'] = $post_data['args']['shippingAdministrativeDistrictLevel1'];
    }
    if(!empty($post_data['args']['shippingAdministrativeDistrictLevel2'])) {
        $body['shipping_address']['administrative_district_level_2'] = $post_data['args']['shippingAdministrativeDistrictLevel2'];
    }
    if(!empty($post_data['args']['shippingAdministrativeDistrictLevel3'])) {
        $body['shipping_address']['administrative_district_level_3'] = $post_data['args']['shippingAdministrativeDistrictLevel3'];
    }
    if(!empty($post_data['args']['shippingPostalCode'])) {
        $body['shipping_address']['postal_code'] = $post_data['args']['shippingPostalCode'];
    }
    if(!empty($post_data['args']['shippingCountry'])) {
        $body['shipping_address']['country'] = $post_data['args']['shippingCountry'];
    }
    
    $client = $this->httpClient;
    
    try {

        $resp = $client->post( $query_str, [
            'json' => $body,
            'headers' => $headers
        ]);
        $responseBody = $resp->getBody()->getContents();
  
        if(in_array($resp->getStatusCode(), ['200', '201', '202', '203', '204'])) {
            $result['callback'] = 'success';
            $result['contextWrites']['to'] = is_array($responseBody) ? $responseBody : json_decode($responseBody);
            if(empty($result['contextWrites']['to'])) {
                $result['contextWrites']['to'] = "empty list";
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
