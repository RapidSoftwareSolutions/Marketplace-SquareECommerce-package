<?php

$app->post('/api/SquareECommerce/updateCustomer', function ($request, $response, $args) {
    
    $checkRequest = $this->validation;
    $validateRes = $checkRequest->validate($request, ['accessToken','customerId']);
    if(!empty($validateRes) && isset($validateRes['callback']) && $validateRes['callback']=='error') {
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($validateRes);
    } else {
        $post_data = $validateRes;
    }

    $query_str = 'https://connect.squareup.com/v2/customers/'.$post_data['args']['customerId'];
    
    $headers['Authorization'] = 'Bearer '.$post_data['args']['accessToken'];
    
    $body = [];
    if(!empty($post_data['args']['givenName'])) {
        $body['given_name'] = $post_data['args']['givenName'];
    }
    if(!empty($post_data['args']['familyName'])) {
        $body['family_name'] = $post_data['args']['familyName'];
    }
    if(!empty($post_data['args']['companyName'])) {
        $body['company_name'] = $post_data['args']['companyName'];
    }
    if(!empty($post_data['args']['nickname'])) {
        $body['nickname'] = $post_data['args']['nickname'];
    }
    if(!empty($post_data['args']['email'])) {
        $body['email_address'] = $post_data['args']['email'];
    }
    if(!empty($post_data['args']['phoneNumber'])) {
        $body['phone_number'] = $post_data['args']['phoneNumber'];
    }
    if(!empty($post_data['args']['referenceId'])) {
        $body['reference_id'] = $post_data['args']['referenceId'];
    }
    if(!empty($post_data['args']['note'])) {
        $body['note'] = $post_data['args']['note'];
    }
    if(!empty($post_data['args']['addressLine1'])) {
        $body['address']['address_line_1'] = $post_data['args']['addressLine1'];
    }
    if(!empty($post_data['args']['addressLine2'])) {
        $body['address']['address_line_2'] = $post_data['args']['addressLine2'];
    }
    if(!empty($post_data['args']['addressLine3'])) {
        $body['address']['address_line_3'] = $post_data['args']['addressLine3'];
    }
    if(!empty($post_data['args']['addressLocality'])) {
        $body['address']['locality'] = $post_data['args']['addressLocality'];
    }
    if(!empty($post_data['args']['addressSublocality'])) {
        $body['address']['sublocality'] = $post_data['args']['addressSublocality'];
    }
    if(!empty($post_data['args']['addressSublocality2'])) {
        $body['address']['sublocality_2'] = $post_data['args']['addressSublocality2'];
    }
    if(!empty($post_data['args']['addressSublocality3'])) {
        $body['address']['sublocality_3'] = $post_data['args']['addressSublocality3'];
    }
    if(!empty($post_data['args']['addressAdministrativeDistrictLevel1'])) {
        $body['address']['administrative_district_level_1'] = $post_data['args']['addressAdministrativeDistrictLevel1'];
    }
    if(!empty($post_data['args']['addressAdministrativeDistrictLevel2'])) {
        $body['address']['administrative_district_level_2'] = $post_data['args']['addressAdministrativeDistrictLevel2'];
    }
    if(!empty($post_data['args']['addressAdministrativeDistrictLevel3'])) {
        $body['address']['administrative_district_level_3'] = $post_data['args']['addressAdministrativeDistrictLevel3'];
    }
    if(!empty($post_data['args']['addressPostalCode'])) {
        $body['address']['postal_code'] = $post_data['args']['addressPostalCode'];
    }
    if(!empty($post_data['args']['addressCountry'])) {
        $body['address']['country'] = $post_data['args']['addressCountry'];
    }
    
    $client = $this->httpClient;
    
    try {

        $resp = $client->put( $query_str, [
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
