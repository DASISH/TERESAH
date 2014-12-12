# Data Types

## Get data types

`GET /api/v1/data-types.json(?limit=20)` will return all available data types you can request information about. See documentation of "Get an data type" for details on how to query for a specific data type.

### Parameters

Name  | Type    | Description
----- | ------- | -----------
limit | integer | The number of data types to list per page/response.
page  | integer | Return the specific page from the paginated result set.

### Request

```
$ curl http://teresah.dasish.eu/api/v1/data-types.json
```

### Response

```json
{
  "status": {
    "code": 200
  },
  "data_types": {
    "total": 8,
    "per_page": 5,
    "current_page": 1,
    "last_page": 2,
    "from": 1,
    "to": 5,
    "data": [
      {
        "id": 10,
        "label": "Description",
        "slug": "description",
        "description": "General description of the tool",
        "rdf_mapping": "http://purl.org/dc/elements/1.1/description",
        "linkable": 0,
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


## Get an data type

`GET /api/v1/data-types/{id}.json` will return specific available data type you can request information about.

### Request

```
$ curl http://teresah.dasish.eu/api/v1/data-types/5.json
```

### Response

```json
{
  "status": {
    "code": 200
  },
  "id": 12,
  "label": "Developer",
  "slug": "developer",
  "description": "Organization or person who developed the tool",
  "rdf_mapping": "http://purl.org/dc/elements/1.1/creator",
  "linkable": 1,
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


## Create an data type

`POST /api/v1/data-types.json` will create a new data type.

### Parameters

Name        | Type    | Description
-----       | ------- | -----------
user_id     | integer | **Required** The identifier for the user *(automatically filled from the authentication)*.
label       | string  | **Required** The unique label/name for the data type.
slug        | string  | The slug for the data type *(automatically generated from the label)*.
description | string  | The description of the data type.
rdf_mapping | string  | RDF mapping of the data type.
linkable    | boolean | Data type is linkable?

### Request

```
$ curl -X POST --data-binary @payload.json http://teresah.dasish.eu/api/v1/data-types.json
```

```json
{
  "label": "description",
  "description": "General description of the tool",
  "rdf_mapping": "http://purl.org/dc/elements/1.1/description",
  "linkable": false
}
```

### Response

```json
{
  "status": {
    "code": 201,
    "message": "Data Type was successfully registered."
  }
}
```


## Update the data type

`PUT/PATCH /api/v1/data-types/{id}.json` will update the specific data type from the parameters passed.

### Request

```
$ curl -X PATCH --data-binary @payload.json http://teresah.dasish.eu/api/v1/data-types/18.json
```

```json
{
  "label": "platform",
  "description": "Platform the tool runs on"
}
```

### Response

```json
{
  "status": {
    "code": 200,
    "message": "Data Type was successfully updated."
  }
}
```


## Delete data type

`DELETE /api/v1/data-types/{id}.json` will delete the specific data type and return *200 OK* if that was successful. If you don't not have access to delete the data type, you'll receive a *403 Forbidden*.

### Request

```
$ curl -X DELETE http://teresah.dasish.eu/api/v1/data-types/15.json
```

### Response

```json
{
  "status": {
    "code": 200,
    "message": "Data Type was successfully deleted."
  }
}
```
