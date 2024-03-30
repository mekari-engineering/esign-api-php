# Initializing the EsignApiClient SDK
The `EsignApiClient` class is the main entry point for interacting with the eSign API. Here's how to initialize it:

## Prerequisites
Before you can initialize the `EsignApiClient`, you need to have the following:

+ Client ID: This is the ID of your eSign API client.
+ Client Secret: This is the secret of your eSign API client.
+ Production Flag: This is a boolean flag indicating whether you're using the production environment. It's optional and defaults to `false`.

## Initialization
To initialize the `EsignApiClient`, you need to create a new instance of the `EsignApiClient` class and pass your client ID and client secret to the constructor. If you're using the production environment, you should also pass `true` as the third argument.

Here's an example:

```
<?php
$clientId = 'your-client-id';
$clientSecret = 'your-client-secret';
$production = true; // or false if you're not using the production environment

$client = new EsignApiPhp\EsignApiClient($clientId, $clientSecret, $production);
?>
```

# Next Steps
After initializing the `EsignApiClient`, you can use its methods to interact with the eSign API. For example, you can use the `auth` method to get an instance of the `Auth` class, which provides methods for getting user authentication tokens and refresh tokens:

```
<?php
$auth = $client->auth();
?>
```

## Get Auth Token
The `getUserAuthToken` method is part of the Auth class. It's used to get a user authentication token from the eSign API.

### Parameters
The method takes one parameter:

```$code: The authorization code.```

### Return Value
If the request is successful, the method returns an associative array containing the response data from the API. If the request fails, it throws an exception with an error message.

### Usage
Here's an example of how to use the `getUserAuthToken` method:

```
<?php
$auth = $client->auth();
$code = 'your-authorization-code';

try {
    $data = $auth->getUserAuthToken($code);
    echo 'Access Token: ' . $data['access_token'];
} catch (\Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
?>
```

## Get Refresh Token
The `getRefreshToken` method is part of the `Auth` class. It's used to get a new access token from the eSign API using a refresh token.

### Parameters
The method takes one parameter:

```$refreshToken: The refresh token.```

### Return Value
If the request is successful, the method returns an associative array containing the response data from the API. If the request fails, it throws an exception with an error message.

### Usage
Here's an example of how to use the `getRefreshToken` method:

```
<?php
$auth = $client->auth();
$refreshToken = 'your-refresh-token';

try {
    $data = $auth->getRefreshToken($refreshToken);
    echo 'New Access Token: ' . $data['access_token'];
} catch (\Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
?>
```

## Request Global Sign
The `requestGlobalSign` method is part of the `GlobalSign` class. It's used to request a global sign for a document from the eSign API.

### Parameters
The method takes the following parameters:

+ $doc: The document to be signed `(base64)`.
+ $filename: The name of the file.
+ $signers: The signers of the document.
+ $signing_order: ordered signing or not.
+ $callback_url: The callback URL to which the API should send the response.
+ $token: The authentication token.

### Return Value
If the request is successful, the method returns an associative array containing the response data from the API. If the request fails, it throws an exception with an error message.

### Usage
Here's an example of how to use the `requestGlobalSign` method:

```
<?php
$globalSign = $client->globalSign();
$doc = 'your-document';
$filename = 'your-filename';
$signers = ['signer1', 'signer2'];
$signing_order = true //optional, default false;
$callback_url = 'your-callback-url';
$token = 'your-token';

try {
    $data = $globalSign->requestGlobalSign($doc, $filename, $signers, $signing_order, $callback_url, $token);
    echo 'Document ID: ' . $data['id'];
} catch (\Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
?>
```

## Request PSRE Sign
The `requestPsreSign` method is part of the `PsreSign` class. It's used to request a PSRE sign for a document from the eSign API.

### Parameters
The method takes the following parameters:

+ $doc: The document to be signed `(base64)`.
+ $filename: The name of the file.
+ $signers: The signers of the document.
+ $signing_order: ordered signing or not.
+ $callback_url: The callback URL to which the API should send the response.
+ $token: The authentication token.

### Return Value
If the request is successful, the method returns an associative array containing the response data from the API. If the request fails, it throws an exception with an error message.

### Usage
Here's an example of how to use the `requestPsreSign` method:

```
<?php
$globalSign = $client->psreSign();
$doc = 'your-document';
$filename = 'your-filename';
$signers = ['signer1', 'signer2'];
$signing_order = true //optional, default false;
$callback_url = 'your-callback-url';
$token = 'your-token';

try {
    $data = $globalSign->requestGlobalSign($doc, $filename, $signers, $signing_order, $callback_url, $token);
    echo 'Document ID: ' . $data['id'];
} catch (\Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
?>
```

## Generate Signing URL
The `generateSigningUrl` method is part of the `PsreSign` class. It's used to generate a signing URL for a document from the eSign API.

### Parameters
The method takes the following parameters:

+ $documentId: The ID of the document.
+ $token: The authentication token.

### Return Value
If the request is successful, the method returns an associative array containing the response data from the API. If the request fails, it throws an exception with an error message.

### Usage
Here's an example of how to use the `generateSigningUrl` method:

```
<?php
$psreSign = $client->psreSign();
$documentId = 'your-document-id';
$token = 'your-token';

try {
    $data = $psreSign->generateSigningUrl($documentId, $token);
    echo 'Document ID: ' . $data['id'];
} catch (\Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
```

## Stamping
The `stamp` method is part of the `Stamping` class. It's used to stamp a document with an annotation from the eSign API.

### Parameters
The method takes the following parameters:

+ $doc: The document to be stamped.
+ $filename: The name of the file.
+ $annotation: The annotation to be stamped on the document.
+ $callback_url: The callback URL to which the API should send the response.
+ $token: The authentication token.

### Return Value
If the request is successful, the method returns an associative array containing the response data from the API. If the request fails, it throws an exception with an error message.

### Usage
Here's an example of how to use the `stamp` method:

```
$stamping = $client->stamping();
$doc = 'your-document';
$filename = 'your-filename';
$annotation = 'your-annotation';
$callback_url = 'your-callback-url';
$token = 'your-token';

try {
    $data = $stamping->stamp($doc, $filename, $annotation, $callback_url, $token);
    echo 'Document ID: ' . $data['id'];
} catch (\Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
```