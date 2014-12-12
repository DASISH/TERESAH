# Users

## Available user levels

TERESAH supports *four (4)* different user levels. User level dictates how user can interact with TERESAH.

* **Authenticated user:** User with registered account. Can edit own profile and create lists of tools.
* **Collaborator:** Authenticated user with collaborator status. Can add and edit tools and data types.
* **Supervisor:** Authenticated user with supervisor status. Can add, edit and remove tools, data types, data sources, list activities, and harvest other data sources.
* **Administrator:** Authenticated user with administrator status. Has full access to all administrative functions.


## Get users

`GET /api/v1/users.json(?limit=20)` will return all available users you can request information about. See documentation of "Get a user" for details on how to query for a specific user.

### Parameters

Name  | Type    | Description
----- | ------- | -----------
limit | integer | The number of users to list per page/response.
page  | integer | Return the specific page from the paginated result set.

### Request

```
$ curl http://teresah.dasish.eu/api/v1/users.json?limit=2
```

### Response

```json
{
  "users": {
    "total": 2,
    "per_page": 3,
    "current_page": 1,
    "last_page": 1,
    "from": 1,
    "to": 2,
    "data": [
      {
        "id": 6,
        "email_address": "teresah@example.org",
        "name": "TERESAH",
        "locale": "en",
        "created_at": "2014-09-23T07:20:26+00:00",
        "updated_at": "2014-09-23T07:20:26+00:00",
        "deleted_at": null,
        "logins": []
      },
      {
        "id": 7,
        "email_address": "dwight.schrute@dundermifflin.com",
        "name": "Dwight Schrute",
        "locale": "en",
        "created_at": "2014-09-23T07:27:34+00:00",
        "updated_at": "2014-09-24T07:29:58+00:00",
        "deleted_at": null,
        "logins": [
          {
            "id": 1,
            "user_id": 7,
            "ip_address": "10.0.2.2",
            "user_agent": "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.120 Safari/537.36",
            "referer": "http://teresah.dasish.eu/login",
            "via_remember": 0,
            "created_at": "2014-09-24T07:29:59+00:00",
            "updated_at": "2014-09-24T07:29:59+00:00",
            "deleted_at": null
          }
        ]
      }
    ]
  }
}
```


## Get a user

`GET /api/v1/users/{id}.json` will return specific available user you can request information about.

### Request

```
$ curl http://teresah.dasish.eu/api/v1/users/37.json
```

### Response

```json
{
  "status": {
    "code": 200
  },
  "id": 37,
  "name": "Dwight Schrute",
  "locale": "en",
  "created_at": "2014-11-26T10:19:57+00:00",
  "updated_at": "2014-12-05T10:12:50+00:00",
  "logins": [
    {
      "id": 1,
      "user_id": 37,
      "ip_address": "10.0.2.2",
      "user_agent": "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.65 Safari/537.36",
      "referer": "http://teresah.dasish.eu/login",
      "via_remember": 0,
      "created_at": "2014-11-26T10:23:23+00:00",
      "updated_at": "2014-11-26T10:23:23+00:00",
      "deleted_at": null
    }
  ]
}
```


## Create a user account

`POST /api/v1/users.json` will create a new user account. Please note, that signing up via the social media is available via the user interface only.

### Parameters

Name                  | Type    | Description
-----                 | ------- | -----------
email_address         | string  | **Required** The email address for the user.
password              | string  | **Required** The password for the user. Password should be at least 8 characters long.
password_confirmation | string  | **Required** The password confirmation should match submitted password.
name                  | string  | **Required** The name for the user.
locale                | string  | **Required** The locale for the user (available locales are *en* and *sv*).
active                | boolean | **Required** Is the user account activated by default?
user_level            | integer | **Required** The user level for the user. Available levels are: *1 = authenticated user*, *2 = collaborator*, *3 = supervisor*, *4 = administrator*.

### Request

```
$ curl -X POST --data-binary @payload.json http://teresah.dasish.eu/api/v1/users.json
```

```json
{
  "email_address": "dwight.schrute@dundermifflin.com",
  "password": "password",
  "password_confirmation": "password",
  "name": "Dwight Schrute",
  "locale": "en",
  "active": true,
  "user_level": 1
}
```

### Response

```json
{
  "status": {
    "code": 201,
    "message": "User Account was successfully created."
  }
}
```


## Update the user account

`PUT/PATCH /api/v1/users/{id}.json` will update the specific user account from the parameters passed.

### Request

```
$ curl -X PATCH --data-binary @payload.json http://teresah.dasish.eu/api/v1/users/37.json
```

```json
{
  "email_address": "dwight@dundermifflin.com",
  "name": "Dwight Schrute",
  "user_level": 3
}
```

### Response

```json
{
  "status": {
    "code": 200,
    "message": "User Account was successfully updated."
  }
}
```


## Delete user account

`DELETE /api/v1/users/{id}.json` will delete the specific user account and return *200 OK* if that was successful. If you don't not have access to delete the user account, you'll receive a *403 Forbidden*.

### Request

```
$ curl -X DELETE http://teresah.dasish.eu/api/v1/users/37.json
```

### Response

```json
{
  "status": {
    "code": 200,
    "message": "User Account was successfully deleted."
  }
}
```
