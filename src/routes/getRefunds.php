<?php

$app->post('/api/SquareECommerce/getRefunds', function ($request, $response, $args) {
    
    $checkRequest = $this->validation;
    $validateRes = $checkRequest->validate($request, ['accessToken','locationId']);
    if(!empty($validateRes) && isset($validateRes['callback']) && $validateRes['callback']=='error') {
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($validateRes);
    } else {
        $post_data = $validateRes;
    }

    $query_str = 'https://connect.squareup.com/v2/locations/'.$post_data['args']['locationId'].'/refunds';
    
    $headers['Authorization'] = 'Bearer '.$post_data['args']['accessToken'];
    
    $query = [];
    if(!empty($post_data['args']['beginTime'])) {
        $query['begin_time'] = $post_data['args']['beginTime'];
    }
    if(!empty($post_data['args']['endTime'])) {
        $query['end_time'] = $post_data['args']['endTime'];
    }
    if(!empty($post_data['args']['sortOrder'])) {
        $query['sort_order'] = $post_data['args']['sortOrder'];
    }
    if(!empty($post_data['args']['cursor'])) {
        $query['cursor'] = $post_data['args']['cursor'];
    }
    
    $client = $this->httpClient;
    
    try {

        $resp = $client->get( $query_str, [
            'headers' => $headers,
            'query' => $query
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
