# Activities

## Get activities

`GET /api/v1/activities.json(?limit=20)` will return all activities you can request information about. Available activity event types *(actions)* are *1 = Created*, *2 = Updated*, *3 = Deleted*, *4 = Restored*. See documentation of "Get a single activity" for details on how to query for a specific activity.

### Parameters

Name  | Type    | Description
----- | ------- | -----------
limit | integer | The number of activities to list per page/response.
page  | integer | Return the specific page from the paginated result set.

### Request

```
$ curl http://teresah.dasish.eu/api/v1/activities.json?limit=3
```

### Response

```json
{
  "status": {
    "code": 200
  },
  "activities": {
    "total": 6223,
    "per_page": 3,
    "current_page": 1,
    "last_page": 2075,
    "from": 1,
    "to": 3,
    "data": [
      {
        "id": 12431,
        "target_type": "User",
        "target_id": 4,
        "action": 2,
        "user_id": 4,
        "metadata": "{\"name\":\"Dwight Schrute\"}",
        "ip_address": "127.0.0.1",
        "user_agent": "curl/7.35.0",
        "referer": null,
        "created_at": "2014-12-10T15:30:58+00:00",
        "updated_at": "2014-12-10T15:30:58+00:00",
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


## Get an activity

`GET /api/v1/activities/{id}.json` will return specific activity you can request information about.

### Request

```
$ curl http://teresah.dasish.eu/api/v1/activities/12407.json
```

### Response

```json
{
  "status": {
    "code": 200
  },
  "id": 12407,
  "target_type": "Signup",
  "target_id": 4,
  "action": 1,
  "user_id": 4,
  "metadata": "{\"name\":\"Dwight Schrute\"}",
  "ip_address": "10.0.2.2",
  "user_agent": "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.65 Safari/537.36",
  "referer": "http://teresah.dasish.eu/signup",
  "created_at": "2014-11-26T10:19:58+00:00",
  "updated_at": "2014-11-26T10:19:58+00:00",
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
