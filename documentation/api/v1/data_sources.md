# Data Sources

## Get data sources

`GET /api/v1/data-sources.json(?limit=20)` will return all available data sources you can request information about. See documentation of "Get an data source" for details on how to query for a specific data source.

### Parameters

Name  | Type    | Description
----- | ------- | -----------
limit | integer | The number of data sources to list per page/response.
page  | integer | Return the specific page from the paginated result set.

### Request

```
$ curl http://teresah.dasish.eu/api/v1/data-sources.json
```

### Response

```json
{
  "status": {
    "code": 200
  },
  "data_sources": {
    "total": 4,
    "per_page": 20,
    "current_page": 1,
    "last_page": 1,
    "from": 1,
    "to": 4,
    "data": [
      {
        "id": 5,
        "name": "TERESAH",
        "slug": "teresah",
        "description": "TERESAH (Tools E-Registry for E-Social science, Arts and Humanities) is a cross-community tools knowledge registry aimed at researchers in the Social Sciences and Humanities (SSH). It aims to provide an authoritative listing of the software tools currently in use in those domains, and to allow their users to make transparent the methods and applications behind them.",
        "homepage": "http://teresah.dasish.eu/",
        "user_id": 3,
        "created_at": "2014-11-25T09:24:32+00:00",
        "updated_at": "2014-11-25T09:24:32+00:00",
        "deleted_at": null,
        "user": {
          "id": 3,
          "name": "TERESAH",
          "locale": "en",
          "created_at": "2014-11-25T09:24:31+00:00",
          "updated_at": "2014-11-25T09:24:31+00:00",
          "deleted_at": null
        }
      },
      ...
    ]
  }
}
```


## Get an data source

`GET /api/v1/data-sources/{id}.json` will return specific available data source you can request information about.

### Request

```
$ curl http://teresah.dasish.eu/api/v1/data-sources/5.json
```

### Response

```json
{
  "status": {
    "code": 200
  },
  "id": 5,
  "name": "TERESAH",
  "slug": "teresah",
  "description": "TERESAH (Tools E-Registry for E-Social science, Arts and Humanities) is a cross-community tools knowledge registry aimed at researchers in the Social Sciences and Humanities (SSH). It aims to provide an authoritative listing of the software tools currently in use in those domains, and to allow their users to make transparent the methods and applications behind them.",
  "homepage": "http://teresah.dasish.eu/",
  "user_id": 3,
  "created_at": "2014-11-25T09:24:32+00:00",
  "updated_at": "2014-11-25T09:24:32+00:00",
  "user": {
    "id": 3,
    "name": "TERESAH",
    "locale": "en",
    "created_at": "2014-11-25T09:24:31+00:00",
    "updated_at": "2014-11-25T09:24:31+00:00",
    "deleted_at": null
  }
}
```


## Create an data source

`POST /api/v1/data-sources.json` will create a new data source.

### Parameters

Name        | Type    | Description
-----       | ------- | -----------
name        | string  | **Required** The unique name for the data source.
slug        | string  | The slug for the data source *(automatically generated from the name)*.
description | string  | The description of the data source.
homepage    | string  | The homepage of the data source.
user_id     | integer | **Required** The identifier for the user *(automatically filled from the authentication)*.

### Request

```
$ curl -X POST --data-binary @payload.json http://teresah.dasish.eu/api/v1/data-sources.json
```

```json
{
  "name": "TERESAH",
  "description": "TERESAH (Tools E-Registry for E-Social science, Arts and Humanities) is a cross-community tools knowledge registry aimed at researchers in the Social Sciences and Humanities (SSH). It aims to provide an authoritative listing of the software tools currently in use in those domains, and to allow their users to make transparent the methods and applications behind them.",
  "homepage": "http://teresah.dasish.eu/"
}
```

### Response

```json
{
  "status": {
    "code": 201,
    "message": "Data Source was successfully registered."
  }
}
```


## Update the data source

`PUT/PATCH /api/v1/data-sources/{id}.json` will update the specific data source from the parameters passed.

### Request

```
$ curl -X PATCH --data-binary @payload.json http://teresah.dasish.eu/api/v1/data-sources/5.json
```

```json
{
  "name": "Wikipedia",
  "description": "Wikipedia is a free-access, free content Internet encyclopedia, supported and hosted by the non-profit Wikimedia Foundation."
}
```

### Response

```json
{
  "status": {
    "code": 200,
    "message": "Data Source was successfully updated."
  }
}
```


## Delete data source

`DELETE /api/v1/data-sources/{id}.json` will delete the specific data source and return *200 OK* if that was successful. If you don't not have access to delete the data source, you'll receive a *403 Forbidden*.

### Request

```
$ curl -X DELETE http://teresah.dasish.eu/api/v1/data-sources/5.json
```

### Response

```json
{
  "status": {
    "code": 200,
    "message": "Data Source was successfully deleted."
  }
}
```
