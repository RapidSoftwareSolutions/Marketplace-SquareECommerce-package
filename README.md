[![](https://scdn.rapidapi.com/RapidAPI_banner.png)](https://rapidapi.com/package/SquareECommerce/functions?utm_source=RapidAPIGitHub_SquareEcommFunctions&utm_medium=button&utm_content=RapidAPI_GitHub)

# SquareECommerce Package
Accept, process and filter online payments through Square.
* Domain: squareup.com
* Credentials: clientId, clientSecret

## Using the API:
The square API uses OAuth. To start using it, first create an app:


0. Head over to [squareup.com](https://squareup.com/signup?v=developers) and create an account to start using the API. 
1. Visit [https://connect.squareup.com/apps](https://connect.squareup.com/apps) and sign in.
2. Register an application: - Click "New Application" - Enter a name for your application and click Create App. (Note that your application name can't include the word Square.)
3. After you complete the registration you will see Application ID and Application Secret. **For development, please only use the sandbox ID and Secret!**

![](https://imgur.com/download/Gr55ARs)

Than, you can use the Sandbox access token (found at the bottom of the page) in order to test the API from the RapidAPI console:

![](https://imgur.com/download/IlOm7Fd)

## SquareECommerce.getAccessToken
This endpoint allows to obtain accessToken from SquareECommerce.

| Field       | Type       | Description
|-------------|------------|----------
| clientId    | credentials| Required: API key obtained from Square ECommerce.
| clientSecret| credentials| Required: API secret  obtained from Square ECommerce.
| code        | String     | Required: Authorization code.


## SquareECommerce.refreshAccessToken
This endpoint allows to renew acceesToken.

| Field       | Type       | Description
|-------------|------------|----------
| clientId    | credentials| Required: API key obtained from Square ECommerce.
| clientSecret| credentials| Required: API secret  obtained from Square ECommerce.
| accessToken | String     | Required: accessToken obtained from getAccessToken method.


## SquareECommerce.revokeSingleAccessToken
This endpoint allows to revoke an access token generated with the OAuth flow.

| Field       | Type       | Description
|-------------|------------|----------
| clientId    | credentials| Required: API key obtained from Square ECommerce.
| clientSecret| credentials| Required: API secret  obtained from Square ECommerce.
| accessToken | String     | Required: accessToken obtained from getAccessToken method.


## SquareECommerce.revokeTokens
This endpoint allows to revoke all merchant's access tokens.

| Field       | Type       | Description
|-------------|------------|----------
| clientId    | credentials| Required: API key obtained from Square ECommerce.
| clientSecret| credentials| Required: API secret  obtained from Square ECommerce.
| merchantId  | String     | Required: The ID of the merchant whose token you want to revoke.


## SquareECommerce.getLocations
This endpoint provides the details for all of a business's locations.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Required: Valid AccessToken.


## SquareECommerce.chargeCard
Charges a card represented by a card nonce or a customer's card on file.

| Field                               | Type  | Description
|-------------------------------------|-------|----------
| accessToken                         | String| Required: Valid AccessToken.
| locationId                          | String| Required: The ID of the location to associate the created transaction with.
| idempotencyKey                      | String| Required: A value you specify that uniquely identifies this transaction among transactions you've created.
| amount                              | String| Required: The amount of money to charge.
| currency                            | String| Required: The type of currency, in ISO 4217 format. For example, the currency code for US dollars is USD. The value of currency must match the currency associated with the business that is charging the card.
| cardNonce                           | String| Optional: A nonce generated from the SqPaymentForm that represents the card to charge. The application that provides a nonce to this endpoint must be the same application that generated the nonce with the SqPaymentForm. Otherwise, the nonce is invalid.Do not provide a value for this field if you provide a value for customer_card_id.
| customerCardId                      | String| Optional: The ID of the customer card on file to charge. Do not provide a value for this field if you provide a value for card_nonce.
| delayCapture                        | String| Optional: If true, the request will only perform an Auth on the provided card. Default value: false
| referenceId                         | String| Optional: An optional ID you can associate with the transaction for your own purposes (such as to associate the transaction with an entity ID in your own database). This value cannot exceed 40 characters.
| note                                | String| Optional: An optional note to associate with the transaction. This value cannot exceed 60 characters.
| customerId                          | String| Optional: The ID of the customer to associate this transaction with. This field is required if you provide a value for customer_card_id, and optional otherwise.
| buyerEmailAddress                   | String| Optional: The buyer's email address, if available.
| billingAddressLine1                 | String| Optional: The first line of the buyer's billing address.
| billingAddressLine2                 | String| Optional: The second line of the buyer's billing address.
| billingAddressLine3                 | String| Optional: The third line of the buyer's billing address.
| billingLocality                     | String| Optional: The city or town of the buyer's billing address.
| billingSublocality                  | String| Optional: A civil region within the address's locality of the buyer's billing address.
| billingSublocality2                 | String| Optional: A civil region within the address's sublocality of the buyer's billing address.
| billingSublocality3                 | String| Optional: A civil region within the address's sublocality2 of the buyer's billing address.
| billingAdministrativeDistrictLevel1 | String| Optional: A civil entity within the address's country of the buyer's billing address. In the US, this is the state.
| billingAdministrativeDistrictLevel2 | String| Optional: A civil entity within the address's administrative_district_level_1 of the buyer's billing address.
| billingAdministrativeDistrictLevel3 | String| Optional: A civil entity within the address's administrative_district_level_2 of the buyer's billing address.
| billingPostalCode                   | String| Optional: The billing address's postal code.
| billingCountry                      | String| Optional: The billing address's country, in ISO 3166-1-alpha-2 format.
| shippingAddressLine1                | String| Optional: The first line of the buyer's shipping address.
| shippingAddressLine2                | String| Optional: The second line of the buyer's shipping address.
| shippingAddressLine3                | String| Optional: The third line of the buyer's shipping address.
| shippingLocality                    | String| Optional: The city or town of the buyer's shipping address.
| shippingSublocality                 | String| Optional: A civil region within the address's locality of the buyer's shipping address.
| shippingSublocality2                | String| Optional: A civil region within the address's sublocality of the buyer's shipping address.
| shippingSublocality3                | String| Optional: A civil region within the address's sublocality2 of the buyer's shipping address.
| shippingAdministrativeDistrictLevel1| String| Optional: A civil entity within the address's country of the buyer's shipping address. In the US, this is the state.
| shippingAdministrativeDistrictLevel2| String| Optional: A civil entity within the address's administrative_district_level_1 of the buyer's shipping address.
| shippingAdministrativeDistrictLevel3| String| Optional: A civil entity within the address's administrative_district_level_2 of the buyer's shipping address.
| shippingPostalCode                  | String| Optional: The shipping address's postal code.
| shippingCountry                     | String| Optional: The shipping address's country, in ISO 3166-1-alpha-2 format.


## SquareECommerce.getTransactions
This endpoint returns lists transactions for a particular location.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Required: Valid AccessToken.
| locationId | String| Required: The ID of the location to list transactions for.
| beginTime  | String| Optional: The beginning of the requested reporting period, in RFC 3339 format (2016-01-31T00:00:00Z). Default value: The current time minus one year.
| endTime    | String| Optional: The end of the requested reporting period, in RFC 3339 format (2016-01-31T00:00:00Z). Default value: The current time.
| sortOrder  | String| Optional: The order in which results are listed in the response (ASC for oldest first, DESC for newest first). Default value: DESC
| cursor     | String| Optional: A pagination cursor returned by a previous call to this endpoint. Provide this to retrieve the next set of results for your original query.


## SquareECommerce.captureSingleTransaction
This endpoint allows to capture a transaction that was created with the Charge endpoint with a delay_capture value of true.

| Field        | Type  | Description
|--------------|-------|----------
| accessToken  | String| Required: Valid AccessToken.
| locationId   | String| Required: The ID of the location to list transactions for.
| transactionId| String| Required: The ID of the transaction.


## SquareECommerce.voidSingleTransaction
This endpoint allows to cancel a transaction that was created with the Charge endpoint with a delay_capture value of true.

| Field        | Type  | Description
|--------------|-------|----------
| accessToken  | String| Required: Valid AccessToken.
| locationId   | String| Required: The ID of the location to list transactions for.
| transactionId| String| Required: The ID of the transaction.


## SquareECommerce.retrieveSingleTransaction
This endpoint allows to retrieve details for a single transaction.

| Field        | Type  | Description
|--------------|-------|----------
| accessToken  | String| Required: Valid AccessToken.
| locationId   | String| Required: The ID of the location to list transactions for.
| transactionId| String| Required: The ID of the transaction.


## SquareECommerce.createRefund
This endpoint allows to create a refund

| Field         | Type  | Description
|---------------|-------|----------
| accessToken   | String| Required: Valid AccessToken.
| locationId    | String| Required: The ID of the original transaction's associated location.
| transactionId | String| Required: The ID of the original transaction that includes the tender to refund.
| idempotencyKey| String| Required: A value you specify that uniquely identifies this refund among refunds you've created for the tender.
| tenderId      | String| Required: The ID of the tender to refund.
| amount        | String| Required: The amount of money, in the lowest in the smallest denomination of the currency indicated by currency. For example, when currency_code is USD, amount is in cents.
| currency      | String| Required: The type of currency, in ISO 4217 format. For example, the currency code for US dollars is USD.
| reason        | String| Optional: A description of the reason for the refund. Default value: Refund via API


## SquareECommerce.getRefunds
This endpoint returns lists refunds for one of a business's locations.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Required: Valid AccessToken.
| locationId | String| Required: The ID of the location to list refunds for.
| beginTime  | String| Optional: The beginning of the requested reporting period, in RFC 3339 format (2016-01-31T00:00:00Z). Default value: The current time minus one year.
| endTime    | String| Optional: The end of the requested reporting period, in RFC 3339 format (2016-01-31T00:00:00Z). Default value: The current time.
| sortOrder  | String| Optional: The order in which results are listed in the response (ASC for oldest first, DESC for newest first). Default value: DESC
| cursor     | String| Optional: A pagination cursor returned by a previous call to this endpoint. Provide this to retrieve the next set of results for your original query.


## SquareECommerce.createCustomer
This endpoint creates a new customer for a business, which can have associated cards on file.

| Field                              | Type  | Description
|------------------------------------|-------|----------
| accessToken                        | String| Required: Valid AccessToken.
| givenName                          | String| Optional: The customer's given (i.e., first) name.
| familyName                         | String| Optional: The customer's family (i.e., last) name.
| companyName                        | String| Optional: The name of the customer's company.
| nickname                           | String| Optional: A nickname for the customer.
| email                              | String| Optional: The customer's email address.
| phoneNumber                        | String| Optional: The customer's phone number.
| referenceId                        | String| Optional: An optional second ID you can set to associate the customer with an entity in another system.
| note                               | String| Optional: An optional note to associate with the customer.
| addressLine1                       | String| Optional: The first line of the address.
| addressLine2                       | String| Optional: The second line of the address, if any.
| addressLine3                       | String| Optional: The third line of the address, if any.
| addressLocality                    | String| Optional: The city or town of the address.
| addressSublocality                 | String| Optional: A civil region within the address's locality, if any.
| addressSublocality2                | String| Optional: A civil region within the address's sublocality, if any.
| addressSublocality3                | String| Optional: A civil region within the address's sublocality2, if any.
| addressAdministrativeDistrictLevel1| String| Optional: A civil entity within the address's country. In the US, this is the state.
| addressAdministrativeDistrictLevel2| String| Optional: A civil entity within the address's administrative_district_level_1. In the US, this is the county.
| addressAdministrativeDistrictLevel3| String| Optional: A civil entity within the address's administrative_district_level_2, if any.
| addressPostalCode                  | String| Optional: The address's postal code.
| addressCountry                     | String| Optional: The address's country, in ISO 3166-1-alpha-2 format.


## SquareECommerce.getCustomers
This endpoint returns lists a business's customers.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Required: Valid AccessToken.
| cursor     | String| Optional: A pagination cursor returned by a previous call to this endpoint. Provide this to retrieve the next set of results for your original query.


## SquareECommerce.updateCustomer
This endpoint updates the details of an existing customer.

| Field                              | Type  | Description
|------------------------------------|-------|----------
| accessToken                        | String| Required: Valid AccessToken.
| customerId                         | String| Required: The ID of the customer to update.
| givenName                          | String| Optional: The customer's given (i.e., first) name.
| familyName                         | String| Optional: The customer's family (i.e., last) name.
| companyName                        | String| Optional: The name of the customer's company.
| nickname                           | String| Optional: A nickname for the customer.
| email                              | String| Optional: The customer's email address.
| phoneNumber                        | String| Optional: The customer's phone number.
| referenceId                        | String| Optional: An optional second ID you can set to associate the customer with an entity in another system.
| note                               | String| Optional: An optional note to associate with the customer.
| addressLine1                       | String| Optional: The first line of the address.
| addressLine2                       | String| Optional: The second line of the address, if any.
| addressLine3                       | String| Optional: The third line of the address, if any.
| addressLocality                    | String| Optional: The city or town of the address.
| addressSublocality                 | String| Optional: A civil region within the address's locality, if any.
| addressSublocality2                | String| Optional: A civil region within the address's sublocality, if any.
| addressSublocality3                | String| Optional: A civil region within the address's sublocality2, if any.
| addressAdministrativeDistrictLevel1| String| Optional: A civil entity within the address's country. In the US, this is the state.
| addressAdministrativeDistrictLevel2| String| Optional: A civil entity within the address's administrative_district_level_1. In the US, this is the county.
| addressAdministrativeDistrictLevel3| String| Optional: A civil entity within the address's administrative_district_level_2, if any.
| addressPostalCode                  | String| Optional: The address's postal code.
| addressCountry                     | String| Optional: The address's country, in ISO 3166-1-alpha-2 format.


## SquareECommerce.getSingleCustomer
This endpoint returns details for a single customer.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Required: Valid AccessToken.
| customerId | String| Required: The ID of the customer to retrieve.


## SquareECommerce.createCustomerCard
Adds a card on file to an existing customer.

| Field                              | Type  | Description
|------------------------------------|-------|----------
| accessToken                        | String| Required: Valid AccessToken.
| customerId                         | String| Required: The ID of the customer to link the card on file to.
| cardNonce                          | String| Required: A card nonce representing the credit card to link to the customer.
| cardholderName                     | String| Optional: The cardholder's name.
| billingAddressLine1                | String| Optional: The first line of the buyer's billing address.
| billingAddressLine2                | String| Optional: The second line of the buyer's billing address.
| billingAddressLine3                | String| Optional: The third line of the buyer's billing address.
| billingLocality                    | String| Optional: The city or town of the buyer's billing address.
| billingSublocality                 | String| Optional: A civil region within the address's locality of the buyer's billing address.
| billingSublocality2                | String| Optional: A civil region within the address's sublocality of the buyer's billing address.
| billingSublocality3                | String| Optional: A civil region within the address's sublocality2 of the buyer's billing address.
| billingAdministrativeDistrictLevel1| String| Optional: A civil entity within the address's country of the buyer's billing address. In the US, this is the state.
| billingAdministrativeDistrictLevel2| String| Optional: A civil entity within the address's administrative_district_level_1 of the buyer's billing address.
| billingAdministrativeDistrictLevel3| String| Optional: A civil entity within the address's administrative_district_level_2 of the buyer's billing address.
| billingPostalCode                  | String| Optional: The billing address's postal code.
| billingCountry                     | String| Optional: The billing address's country, in ISO 3166-1-alpha-2 format.


## SquareECommerce.deleteCustomerCard
This endpoint removes a card on file from a customer.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Required: Valid AccessToken.
| customerId | String| Required: The ID of the customer to delete.
| cardId     | String| Required: The ID of the card on file to delete.


## SquareECommerce.deleteSingleCustomer
This endpoint deletes a customer from a business, along with any linked cards on file.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Required: Valid AccessToken.
| customerId | String| Required: The ID of the customer to delete.

