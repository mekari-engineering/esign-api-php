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

# Authorization

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

# Global Sign

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

# PSRE Sign

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

# Stamping

## Stamp
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

# Document

## Get Document List
The `getDocumentList` method is part of the `Document class`. It's used to get a list of documents from the eSign API.

###Parameters
The method takes the following parameters:

+ $page: The page number.
+ $limit: The number of documents per page.
+ $token: The authentication token.
+ $category (optional): The category of the documents (global, psre).
+ $signing_status (optional): The signing status of the documents (in_progress, completed, voided, declined).
+ $stamping_status (optional): The stamping status of the documents (none, in_progress, pending, failed, success).

### Return Value
If the request is successful, the method returns an associative array containing the response data from the API. If the request fails, it throws an exception with an error message.

### Usage
Here's an example of how to use the `getDocumentList` method:

```
$document = $client->document();
$page = 1;
$limit = 10;
$token = 'your-token';
$category = 'your-category';
$signing_status = 'your-signing-status';
$stamping_status = 'your-stamping-status';

try {
    $data = $document->getDocumentList($page, $limit, $token, $category, $signing_status, $stamping_status);
    echo 'Documents: ' . print_r($data, true);
} catch (\Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
```

## Get Document Detail
The `getDocumentDetail` method is part of the `Document` class. It's used to get the details of a specific document from the eSign API.

### Parameters
The method takes the following parameters:

+ $documentId: The ID of the document.
+ $token: The authentication token.

### Return Value
If the request is successful, the method returns an associative array containing the response data from the API. If the request fails, it throws an exception with an error message.

### Usage
Here's an example of how to use the `getDocumentDetail` method:

```
$document = $client->document();
$documentId = 'your-document-id';
$token = 'your-token';

try {
    $data = $document->getDocumentDetail($documentId, $token);
    echo 'Document Details: ' . print_r($data, true);
} catch (\Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
```

## Download Document
The `downloadDocument` method is part of the `Document` class. It's used to download a specific document from the eSign API.

### Parameters
The method takes the following parameters:

+ $documentId: The ID of the document.
+ $token: The authentication token.

### Return Value
If the request is successful, the method returns the downloaded document. If the request fails, it throws an exception with an error message.

### Usage
Here's an example of how to use the `downloadDocument` method:

```
$document = $client->document();
$documentId = 'your-document-id';
$token = 'your-token';

try {
    $data = $document->downloadDocument($documentId, $token);
    file_put_contents($documentId . '.pdf', $data);
    echo 'Document downloaded successfully.';
} catch (\Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
```

## Resend Document
The `resendDocument` method is part of the `Document` class. It's used to resend a specific document from the eSign API.

### Parameters
The method takes the following parameters:

+ $documentId: The ID of the document.
+ $token: The authentication token.

### Return Value
If the request is successful, the method returns the response data from the API. If the request fails, it throws an exception with an error message.

### Usage
Here's an example of how to use the `resendDocument` method:

```
$document = $client->document();
$documentId = 'your-document-id';
$token = 'your-token';

try {
    $data = $document->resendDocument($documentId, $token);
    echo 'Document resent successfully.';
} catch (\Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
```

## Void Document
The `voidDocument` method is part of the `Document` class. It's used to void a specific document in the eSign API.

### Parameters
The method takes the following parameters:

+ $documentId: The ID of the document.
+ $token: The authentication token.
+ $reason: The reason for voiding the document.

### Return Value
If the request is successful, the method returns the response data from the API. If the request fails, it throws an exception with an error message.

### Usage
Here's an example of how to use the `voidDocument` method:

```
$document = $client->document();
$documentId = 'your-document-id';
$token = 'your-token';
$reason = 'your-reason';

try {
    $data = $document->voidDocument($documentId, $token, $reason);
    echo 'Document voided successfully.';
} catch (\Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
```

## Delete Document
The `deleteDocument` method is part of the `Document` class. It's used to delete a specific document from the eSign API.

### Parameters
The method takes the following parameters:

+ $documentId: The ID of the document.
+ $token: The authentication token.

### Return Value
If the request is successful, the method returns the response data from the API. If the request fails, it throws an exception with an error message.

### Usage
Here's an example of how to use the `deleteDocument` method:

```
$document = $client->document();
$documentId = 'your-document-id';
$token = 'your-token';

try {
    $data = $document->deleteDocument($documentId, $token);
    echo 'Document deleted successfully.';
} catch (\Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
```

# Auto Sign

## Create Auto Sign
The `createAutoSign` method is part of the `AutoSign` class. It's used to create an auto sign request in the eSign API.

### Parameters
The method takes the following parameters:

+ $docMakerEmails: An array of document maker emails.
+ $signerEmails: An array of signer emails.
+ $token: The authentication token.

### Return Value
If the request is successful, the method returns the response data from the API. If the request fails, it throws an exception with an error message.

### Usage
Here's an example of how to use the `createAutoSign` method:

```
$autoSign = $client->autoSign();
$docMakerEmails = ['docmaker1@example.com', 'docmaker2@example.com'];
$signerEmails = ['signer1@example.com', 'signer2@example.com'];
$token = 'your-token';

try {
    $data = $autoSign->createAutoSign($docMakerEmails, $signerEmails, $token);
    echo 'AutoSign created successfully.';
} catch (\Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
```

## Update Auto Sign
The `updateAutoSign` method is part of the `AutoSign` class. It's used to update an auto sign request in the eSign API.

### Parameters
The method takes the following parameters:

+ $id: The ID of the auto sign request.
+ $docMakerEmail: The email of the document maker.
+ $signerEmail: The email of the signer.
+ $token: The authentication token.

### Return Value
If the request is successful, the method returns the response data from the API. If the request fails, it throws an exception with an error message.

### Usage
Here's an example of how to use the `updateAutoSign` method:

```
$autoSign = $client->autoSign();
$id = 'your-autosign-id';
$docMakerEmail = 'docmaker@example.com';
$signerEmail = 'signer@example.com';
$token = 'your-token';

try {
    $data = $autoSign->updateAutoSign($id, $docMakerEmail, $signerEmail, $token);
    echo 'AutoSign updated successfully.';
} catch (\Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
```

## Delete Auto Sign
The `deleteAutoSign` method is part of the `AutoSign` class. It's used to delete an auto sign request in the eSign API.

### Parameters
The method takes the following parameters:

+ $id: The ID of the auto sign request.
+ $token: The authentication token.

### Return Value
If the request is successful, the method returns true. If the request fails, it throws an exception with an error message.

### Usage
Here's an example of how to use the `deleteAutoSign` method:

```
$autoSign = $client->autoSign();
$id = 'your-autosign-id';
$token = 'your-token';

try {
    $result = $autoSign->deleteAutoSign($id, $token);
    if ($result) {
        echo 'AutoSign deleted successfully.';
    }
} catch (\Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
```

## Detail Auto Sign
The `detailAutoSign` method is part of the `AutoSign` class. It's used to get the details of an auto sign request from the eSign API.

### Parameters
The method takes the following parameters:

+ $id: The ID of the auto sign request.
+ $token: The authentication token.

### Return Value
If the request is successful, the method returns an associative array containing the response data from the API. If the request fails, it throws an exception with an error message.

### Usage
Here's an example of how to use the `detailAutoSign` method:

```
$autoSign = $client->autoSign();
$id = 'your-autosign-id';
$token = 'your-token';

try {
    $data = $autoSign->detailAutoSign($id, $token);
    echo 'AutoSign Details: ' . print_r($data, true);
} catch (\Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
```

## List Auto Sign
The `listAutoSign` method is part of the `AutoSign` class. It's used to get a list of auto sign requests from the eSign API.

### Parameters
The method takes the following parameters:

+ $docMakerEmail: The email of the document maker.
+ $signerEmail: The email of the signer.
+ $page: The page number.
+ $limit: The number of items per page.
+ $token: The authentication token.

### Return Value
If the request is successful, the method returns an associative array containing the response data from the API. If the request fails, it throws an exception with an error message.

### Usage
Here's an example of how to use the `listAutoSign` method:

```
$autoSign = $client->autoSign();
$docMakerEmail = 'docmaker@example.com';
$signerEmail = 'signer@example.com';
$page = 1;
$limit = 10;
$token = 'your-token';

try {
    $data = $autoSign->listAutoSign($docMakerEmail, $signerEmail, $page, $limit, $token);
    echo 'AutoSign List: ' . print_r($data, true);
} catch (\Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
```