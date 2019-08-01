---
title: API Reference

language_tabs:
- php
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://noboat.test/docs/collection.json)

<!-- END_INFO -->

#general
<!-- START_57e3b4272508c324659e49ba5758c70f -->
## Display a listing of the resource.

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("http://noboat.test/api/user/login", [
    'headers' => [
            "Authorization" => "Bearer {token}",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```bash
curl -X POST "http://noboat.test/api/user/login" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL("http://noboat.test/api/user/login");

let headers = {
    "Authorization": "Bearer {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/user/login`


<!-- END_57e3b4272508c324659e49ba5758c70f -->

<!-- START_7500c63828c1ba57680234e355fcbbce -->
## List backpacks

List all the public viewable packs using pagination

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("http://noboat.test/api/packs", [
    'headers' => [
            "Authorization" => "Bearer {token}",
            "Content-Type" => "application/json",
        ],
    'json' => [
            "page" => "5",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```bash
curl -X GET -G "http://noboat.test/api/packs" \
    -H "Authorization: Bearer {token}" \
    -H "Content-Type: application/json" \
    -d '{"page":5}'

```

```javascript
const url = new URL("http://noboat.test/api/packs");

let headers = {
    "Authorization": "Bearer {token}",
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "page": 5
}

fetch(url, {
    method: "GET",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": {
        "id": 0,
        "name": "Dr. Chauncey Lubowitz III",
        "image": "\/storage\/packs\/pHVEjQRz1Dc8RQxgXXLAfO4yZZUHpHbkU0CH3Dfw.png",
        "cost": 100,
        "heart_count": 241,
        "item_count": 10,
        "weight_ounces": 10,
        "weight_imperial": "0.6 lb.",
        "weight_metric": "0.3 kg."
    }
}
```

### HTTP Request
`GET api/packs`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    page | integer |  optional  | optional The page number to return.

<!-- END_7500c63828c1ba57680234e355fcbbce -->

<!-- START_7213f238adb4daadf1bde8f76c4b1b4e -->
## Display the specified resource.

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("http://noboat.test/api/packs/1", [
    'headers' => [
            "Authorization" => "Bearer {token}",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```bash
curl -X GET -G "http://noboat.test/api/packs/1" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL("http://noboat.test/api/packs/1");

let headers = {
    "Authorization": "Bearer {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": {
        "id": 1,
        "name": "Kim's Pack",
        "image": "",
        "cost": 30,
        "heart_count": 2,
        "item_count": 6,
        "weight_ounces": 51.69,
        "weight_imperial": "3.2 lb.",
        "weight_metric": "1.5 kg.",
        "user": {
            "data": {
                "trail_name": "Mark King"
            }
        },
        "season": {
            "data": {
                "name": "Summer"
            }
        },
        "categories": {
            "data": [
                {
                    "name": "Food",
                    "description": "THis is really good",
                    "total_ounces": 0,
                    "total_cost": 0,
                    "item_count": 2,
                    "items": {
                        "data": [
                            {
                                "name": "My tent",
                                "description": "",
                                "purchase_link": "",
                                "image": "",
                                "cost_each": 0,
                                "quantity": 2,
                                "ounces_each": 0,
                                "imperial_each": "0 lb.",
                                "metric_each": "0 kg."
                            }
                        ]
                    }
                },
                {
                    "name": "Tent",
                    "description": "Sleepy time!",
                    "total_ounces": 51.69,
                    "total_cost": 30,
                    "item_count": 4,
                    "items": {
                        "data": [
                            {
                                "name": "bed",
                                "description": "sdf df",
                                "purchase_link": "",
                                "image": "",
                                "cost_each": 10,
                                "quantity": 3,
                                "ounces_each": 17.23,
                                "imperial_each": "1.1 lb.",
                                "metric_each": "0.5 kg."
                            },
                            {
                                "name": "blanket",
                                "description": "sdf df dfsd f",
                                "purchase_link": "",
                                "image": "",
                                "cost_each": 0,
                                "quantity": 1,
                                "ounces_each": 0,
                                "imperial_each": "0 lb.",
                                "metric_each": "0 kg."
                            }
                        ]
                    }
                }
            ]
        }
    }
}
```

### HTTP Request
`GET api/packs/{pack}`


<!-- END_7213f238adb4daadf1bde8f76c4b1b4e -->

<!-- START_37b2ac89fbef2e2e50c9c6fac4819308 -->
## Store a newly created resource in storage.

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("http://noboat.test/api/user/pack_likes", [
    'headers' => [
            "Authorization" => "Bearer {token}",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```bash
curl -X POST "http://noboat.test/api/user/pack_likes" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL("http://noboat.test/api/user/pack_likes");

let headers = {
    "Authorization": "Bearer {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/user/pack_likes`


<!-- END_37b2ac89fbef2e2e50c9c6fac4819308 -->

<!-- START_b73c2b558dc3e8404e0c4f19343f5f43 -->
## Remove the specified resource from storage.

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->delete("http://noboat.test/api/user/pack_likes/1", [
    'headers' => [
            "Authorization" => "Bearer {token}",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```bash
curl -X DELETE "http://noboat.test/api/user/pack_likes/1" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL("http://noboat.test/api/user/pack_likes/1");

let headers = {
    "Authorization": "Bearer {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE api/user/pack_likes/{pack_like}`


<!-- END_b73c2b558dc3e8404e0c4f19343f5f43 -->

<!-- START_6b18976a4e58014af7c633fb0dfb2f5a -->
## Display a listing of the resource.

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("http://noboat.test/api/user/packs", [
    'headers' => [
            "Authorization" => "Bearer {token}",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```bash
curl -X GET -G "http://noboat.test/api/user/packs" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL("http://noboat.test/api/user/packs");

let headers = {
    "Authorization": "Bearer {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/user/packs`


<!-- END_6b18976a4e58014af7c633fb0dfb2f5a -->

<!-- START_b4b6b36efebab952ef4db0fbc7f12dc2 -->
## Store a newly created resource in storage.

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("http://noboat.test/api/user/packs", [
    'headers' => [
            "Authorization" => "Bearer {token}",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```bash
curl -X POST "http://noboat.test/api/user/packs" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL("http://noboat.test/api/user/packs");

let headers = {
    "Authorization": "Bearer {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/user/packs`


<!-- END_b4b6b36efebab952ef4db0fbc7f12dc2 -->

<!-- START_001999645f0f3dc2f37d8130c1e279c7 -->
## Display the specified resource.

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("http://noboat.test/api/user/packs/1", [
    'headers' => [
            "Authorization" => "Bearer {token}",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```bash
curl -X GET -G "http://noboat.test/api/user/packs/1" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL("http://noboat.test/api/user/packs/1");

let headers = {
    "Authorization": "Bearer {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/user/packs/{pack}`


<!-- END_001999645f0f3dc2f37d8130c1e279c7 -->

<!-- START_92d994d1ccef1f9f0b38dbdb6d87b4ac -->
## Update the specified resource in storage.

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->put("http://noboat.test/api/user/packs/1", [
    'headers' => [
            "Authorization" => "Bearer {token}",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```bash
curl -X PUT "http://noboat.test/api/user/packs/1" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL("http://noboat.test/api/user/packs/1");

let headers = {
    "Authorization": "Bearer {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT api/user/packs/{pack}`

`PATCH api/user/packs/{pack}`


<!-- END_92d994d1ccef1f9f0b38dbdb6d87b4ac -->

<!-- START_9116aa63467e667526d7fbfb57564db0 -->
## Remove the specified resource from storage.

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->delete("http://noboat.test/api/user/packs/1", [
    'headers' => [
            "Authorization" => "Bearer {token}",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```bash
curl -X DELETE "http://noboat.test/api/user/packs/1" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL("http://noboat.test/api/user/packs/1");

let headers = {
    "Authorization": "Bearer {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE api/user/packs/{pack}`


<!-- END_9116aa63467e667526d7fbfb57564db0 -->


