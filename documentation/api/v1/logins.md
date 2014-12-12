# Logins

## Get logins

`GET /api/v1/logins.json(?limit=20)` will return all logins you can request information about. See documentation of "Get a login" for details on how to query for a specific login record.

### Parameters

Name  | Type    | Description
----- | ------- | -----------
limit | integer | The number of logins to list per page/response.
page  | integer | Return the specific page from the paginated result set.

### Request

```
$ curl http://teresah.dasish.eu/api/v1/logins.json?limit=3
```

### Response

```json
{
  "status": {
    "code": 200
  },
  "logins": {
    "total": 8,
    "per_page": 3,
    "current_page": 1,
    "last_page": 3,
    "from": 1,
    "to": 3,
    "data": [
      {
        "id": 8,
        "user_id": 4,
        "ip_address": "10.0.2.2",
        "user_agent": "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.71 Safari/537.36",
        "referer": "http://teresah.dasish.eu/login",
        "via_remember": 0,
        "created_at": "2014-12-05T11:00:25+00:00",
        "updated_at": "2014-12-05T11:00:25+00:00",
        "deleted_at": null,
        "user": {
          "id": 4,
          "name": "Dwight Schrute",
          "locale": "en",
          "created_at": "2014-11-26T10:19:57+00:00",
          "updated_at": "2014-12-10T15:30:58+00:00",
          "deleted_at": null
        }
      },
      ...
    ]
  }
}
```


## Get a login record

`GET /api/v1/logins/{id}.json` will return specific login record you can request information about.

### Request

```
$ curl http://teresah.dasish.eu/api/v1/logins/7.json
```

### Response

```json
{
  "status": {
    "code": 200
  },
  "id": 7,
  "user_id": 4,
  "ip_address": "10.0.2.2",
  "user_agent": "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.71 Safari/537.36",
  "referer": "http://teresah.dasish.eu/login",
  "created_at": "2014-12-05T09:24:26+00:00",
  "updated_at": "2014-12-05T09:24:26+00:00",
  "user": {
    "id": 4,
    "name": "Dwight Schrute",
    "locale": "en",
    "created_at": "2014-11-26T10:19:57+00:00",
    "updated_at": "2014-12-10T15:30:58+00:00",
    "deleted_at": null
  }
}
```
