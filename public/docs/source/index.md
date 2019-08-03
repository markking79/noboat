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

#Authentication

APIs for logging in
<!-- START_3338623ec1be24c33c9d05357cb399fb -->
## Login

Login and return the bearer token

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("http://noboat.test/api/public/login", [
    'headers' => [
            "Content-Type" => "application/json",
        ],
    'json' => [
            "email" => "test@test.com",
            "password" => "password",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```bash
curl -X POST "http://noboat.test/api/public/login" \
    -H "Content-Type: application/json" \
    -d '{"email":"test@test.com","password":"password"}'

```

```javascript
const url = new URL("http://noboat.test/api/public/login");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "email": "test@test.com",
    "password": "password"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "access_token": "{token}",
    "token_type": "Bearer",
    "expires_at": "2029-08-02 04:16:22"
}
```
> Example response (401):

```json
{
    "message": "Unauthorized"
}
```

### HTTP Request
`POST api/public/login`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    email | required |  optional  | The user's email address.
    password | required |  optional  | The user's password.

<!-- END_3338623ec1be24c33c9d05357cb399fb -->

#Packs

APIs for listing and viewing packs
<!-- START_cada61ef55ca6b8d0b311205a8f15402 -->
## List backpacks

List all the public viewable packs using pagination

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("http://noboat.test/api/public/packs", [
    'query' => [
            "page" => "1",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```bash
curl -X GET -G "http://noboat.test/api/public/packs" 
```

```javascript
const url = new URL("http://noboat.test/api/public/packs");

    let params = {
            "page": "1",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
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
    "data": [
        {
            "id": 1,
            "name": "one",
            "image": "",
            "cost": 30,
            "heart_count": 2,
            "item_count": 6,
            "weight_ounces": 51.69,
            "weight_imperial": "3.2 lb.",
            "weight_metric": "1.5 kg.",
            "season": {
                "data": {
                    "name": "Summer"
                }
            }
        },
        {
            "id": 5,
            "name": "two",
            "image": "",
            "cost": 30,
            "heart_count": 2,
            "item_count": 6,
            "weight_ounces": 51.69,
            "weight_imperial": "3.2 lb.",
            "weight_metric": "1.5 kg.",
            "season": {
                "data": {
                    "name": "Summer"
                }
            }
        },
        {
            "id": 6,
            "name": "three",
            "image": "",
            "cost": 30,
            "heart_count": 2,
            "item_count": 6,
            "weight_ounces": 51.69,
            "weight_imperial": "3.2 lb.",
            "weight_metric": "1.5 kg.",
            "season": {
                "data": {
                    "name": "Summer"
                }
            }
        },
        {
            "id": 7,
            "name": "four",
            "image": "",
            "cost": 30,
            "heart_count": 2,
            "item_count": 6,
            "weight_ounces": 51.69,
            "weight_imperial": "3.2 lb.",
            "weight_metric": "1.5 kg.",
            "season": {
                "data": {
                    "name": "Summer"
                }
            }
        }
    ],
    "meta": {
        "pagination": {
            "total": 4,
            "count": 4,
            "per_page": 21,
            "current_page": 1,
            "total_pages": 1,
            "links": {}
        }
    }
}
```

### HTTP Request
`GET api/public/packs`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    page |  optional  | The page number.

<!-- END_cada61ef55ca6b8d0b311205a8f15402 -->

<!-- START_56bdd6111788516f2d03cc102020b722 -->
## Get a backpack

Get a pack and all the attached details

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("http://noboat.test/api/public/packs/1", [
    'query' => [
            "id" => "1",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```bash
curl -X GET -G "http://noboat.test/api/public/packs/1" 
```

```javascript
const url = new URL("http://noboat.test/api/public/packs/1");

    let params = {
            "id": "1",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
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
        "name": "one",
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
`GET api/public/packs/{pack}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    id |  required  | The pack id.

<!-- END_56bdd6111788516f2d03cc102020b722 -->

#User Packs

APIs for listing and viewing user's packs
<!-- START_6b18976a4e58014af7c633fb0dfb2f5a -->
## List user&#039;s backpacks

List all the user's packs using pagination

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("http://noboat.test/api/user/packs", [
    'headers' => [
            "Accept" => "application/json",
            "Authorization" => "Bearer {token}",
        ],
    'query' => [
            "page" => "1",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```bash
curl -X GET -G "http://noboat.test/api/user/packs" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL("http://noboat.test/api/user/packs");

    let params = {
            "page": "1",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
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
    "message": "Unauthorized"
}
```

### HTTP Request
`GET api/user/packs`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    page |  optional  | The page number.

<!-- END_6b18976a4e58014af7c633fb0dfb2f5a -->

<!-- START_b4b6b36efebab952ef4db0fbc7f12dc2 -->
## Store a newly created resource in storage.

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("http://noboat.test/api/user/packs", [
    'headers' => [
            "Accept" => "application/json",
            "Authorization" => "Bearer {token}",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```bash
curl -X POST "http://noboat.test/api/user/packs" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL("http://noboat.test/api/user/packs");

let headers = {
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
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
            "Accept" => "application/json",
            "Authorization" => "Bearer {token}",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```bash
curl -X GET -G "http://noboat.test/api/user/packs/1" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL("http://noboat.test/api/user/packs/1");

let headers = {
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
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
            "Accept" => "application/json",
            "Authorization" => "Bearer {token}",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```bash
curl -X PUT "http://noboat.test/api/user/packs/1" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL("http://noboat.test/api/user/packs/1");

let headers = {
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
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
            "Accept" => "application/json",
            "Authorization" => "Bearer {token}",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```bash
curl -X DELETE "http://noboat.test/api/user/packs/1" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL("http://noboat.test/api/user/packs/1");

let headers = {
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
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

#general
<!-- START_37b2ac89fbef2e2e50c9c6fac4819308 -->
## Store a newly created resource in storage.

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("http://noboat.test/api/user/pack_likes", [
    'headers' => [
            "Accept" => "application/json",
            "Authorization" => "Bearer {token}",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```bash
curl -X POST "http://noboat.test/api/user/pack_likes" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL("http://noboat.test/api/user/pack_likes");

let headers = {
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
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
            "Accept" => "application/json",
            "Authorization" => "Bearer {token}",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```bash
curl -X DELETE "http://noboat.test/api/user/pack_likes/1" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL("http://noboat.test/api/user/pack_likes/1");

let headers = {
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
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


