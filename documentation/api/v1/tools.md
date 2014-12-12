# Tools

## Get tools

`GET /api/v1/tools.json(?limit=20)` will return all available tools you can request information about. See documentation of "Get a tool" for details on how to query for a specific tool.

### Parameters

Name  | Type    | Description
----- | ------- | -----------
limit | integer | The number of tools to list per page/response.
page  | integer | Return the specific page from the paginated result set.

### Request

```
$ curl http://teresah.dasish.eu/api/v1/tools.json?limit=2
```

### Response

```json
{
  "status": {
    "code": 200
  },
  "tools": {
    "total": 676,
    "per_page": 3,
    "current_page": 1,
    "last_page": 226,
    "from": 1,
    "to": 3,
    "data": [
      {
        "id": 1280,
        "name": "TypePad",
        "slug": "typepad",
        "user_id": 3,
        "created_at": "2014-11-25T09:24:37+00:00",
        "updated_at": "2014-11-25T09:24:37+00:00",
        "deleted_at": null,
        "user": {
          "id": 3,
          "name": "TERESAH",
          "locale": "en",
          "created_at": "2014-11-25T09:24:31+00:00",
          "updated_at": "2014-11-25T09:24:31+00:00",
          "deleted_at": null
        },
        "data_sources": [
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
            "pivot": {
              "tool_id": 1280,
              "data_source_id": 5,
              "created_at": "2014-11-25 09:24:39",
              "updated_at": "2014-11-25 09:24:39"
            }
          },
          ...
        ]
      },
      ...
    ]
  }
}
```


## Search tools

`GET /api/v1/tools/search.json?q={keyword}(?limit=20)` will return all available tools you can request information about that match your search criteria.

### Parameters

Name  | Type    | Description
----- | ------- | -----------
q     | string  | The search keyword. TERESAH tries to match tool name with the provided keyword.
limit | integer | The number of tools to list per page/response.
page  | integer | Return the specific page from the paginated result set.

### Request

```
$ curl http://teresah.dasish.eu/api/v1/tools/search.json?q=ruby&limit=10
```

### Response

```json
{
  "status": {
    "code": 200
  },
  "tools": {
    "total": 2,
    "per_page": 10,
    "current_page": 1,
    "last_page": 1,
    "from": 1,
    "to": 2,
    "data": [
      {
        "id": 1134,
        "name": "Ruby on Rails",
        "slug": "ruby-on-rails",
        "user_id": 3,
        "created_at": "2014-11-25T09:24:36+00:00",
        "updated_at": "2014-11-25T09:24:36+00:00",
        "deleted_at": null,
        "user": {
          "id": 3,
          "name": "TERESAH",
          "locale": "en",
          "password_reset_sent_at": null,
          "created_at": "2014-11-25T09:24:31+00:00",
          "updated_at": "2014-11-25T09:24:31+00:00",
          "deleted_at": null
        },
        "data_sources": [
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
            "pivot": {
              "tool_id": 1134,
              "data_source_id": 5,
              "created_at": "2014-11-25 09:24:38",
              "updated_at": "2014-11-25 09:24:38"
            }
          },
          ...
        ]
      },
      ...
    ]
  }
}
```


## Get a tool

`GET /api/v1/tools/{id}.json` will return specific available tool you can request information about.

### Request

```
$ curl http://teresah.dasish.eu/api/v1/tools/1280.json
```

### Response

```json
{
  "status": {
    "code": 200
  },
  "id": 1280,
  "name": "TypePad",
  "slug": "typepad",
  "user_id": 3,
  "created_at": "2014-11-25T09:24:37+00:00",
  "updated_at": "2014-11-25T09:24:37+00:00",
  "user": {
    "id": 3,
    "name": "TERESAH",
    "locale": "en",
    "created_at": "2014-11-25T09:24:31+00:00",
    "updated_at": "2014-11-25T09:24:31+00:00",
    "deleted_at": null
  },
  "data_sources": [
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
      "pivot": {
        "tool_id": 1280,
        "data_source_id": 5,
        "created_at": "2014-11-25 09:24:39",
        "updated_at": "2014-11-25 09:24:39"
      },
      "data": [
        {
          "id": 10372,
          "data_source_id": 5,
          "tool_id": 1280,
          "user_id": 4,
          "data_type_id": 13,
          "value": "blog",
          "slug": "blog",
          "created_at": "2014-11-25T09:25:23+00:00",
          "updated_at": "2014-12-03T14:08:54+00:00",
          "deleted_at": null,
          "user": {
            "id": 4,
            "name": "Dwight Schrute",
            "locale": "en",
            "created_at": "2014-11-26T10:19:57+00:00",
            "updated_at": "2014-12-10T15:30:58+00:00",
            "deleted_at": null
          },
          "data_type": {
            "id": 13,
            "label": "Keyword",
            "slug": "keyword",
            "description": "Free form keywords describing the tool",
            "rdf_mapping": "http://purl.org/dc/elements/1.1/subject",
            "linkable": 1,
            "user_id": 3,
            "created_at": "2014-11-25T09:24:32+00:00",
            "updated_at": "2014-11-25T09:24:32+00:00",
            "deleted_at": null
          }
        },
        ...
      ]
    },
    ...
  ]
}
```


## Create a tool

`POST /api/v1/tools.json` will create a new tool.

### Parameters

Name    | Type    | Description
-----   | ------- | -----------
name    | string  | **Required** The unique name for the tool.
slug    | string  | The slug for the tool *(automatically generated from the name)*.
user_id | integer | **Required** The identifier for the user *(automatically filled from the authentication)*.

### Request

```
$ curl -X POST --data-binary @payload.json http://teresah.dasish.eu/api/v1/tools.json
```

```json
{
  "name": "Ruby on Rails"
}
```

### Response

```json
{
  "status": {
    "code": 201,
    "message": "Tool was successfully created."
  }
}
```


## Update the tool

`PUT/PATCH /api/v1/tools/{id}.json` will update the specific tool from the parameters passed.

### Request

```
$ curl -X PATCH --data-binary @payload.json http://teresah.dasish.eu/api/v1/tools/1371.json
```

```json
{
  "name": "Laravel Framework"
}
```

### Response

```json
{
  "status": {
    "code": 200,
    "message": "Tool was successfully updated."
  }
}
```


## Delete tool

`DELETE /api/v1/tools/{id}.json` will delete the specific tool and return *200 OK* if that was successful. If you don't not have access to delete the tool, you'll receive a *403 Forbidden*.

### Request

```
$ curl -X DELETE http://teresah.dasish.eu/api/v1/tools/37.json
```

### Response

```json
{
  "status": {
    "code": 200,
    "message": "Tool was successfully deleted."
  }
}
```


## Attach data source to tool

`POST /api/v1/tools/{tool_id}/data-sources.json` will attach data source to specified tool from the parameters passed.

### Parameters

Name           | Type    | Description
-----          | ------- | -----------
tool_id        | integer | **Required** The identifier for the tool.
data_source_id | integer | **Required** The identifier for the data source.

### Request

```
$ curl -X POST --data-binary @payload.json http://teresah.dasish.eu/api/v1/tools/1371/data-sources.json
```

```json
{
  "data_source_id": 3
}
```

### Response

```json
{
  "status": {
    "code": 201,
    "message": "Data Source was successfully attached to Tool."
  }
}
```


## Detach data source from tool

`DELETE /api/v1/tools/{tool_id}/data-sources/{data_source_id}.json` will detach data source from the specified tool from the parameters passed.

### Parameters

Name           | Type    | Description
-----          | ------- | -----------
tool_id        | integer | **Required** The identifier for the tool.
data_source_id | integer | **Required** The identifier for the data source.

### Request

```
$ curl -X DELETE http://teresah.dasish.eu/api/v1/tools/1371/data-sources/3.json
```

### Response

```json
{
  "status": {
    "code": 200,
    "message": "Data Source was successfully detached from Tool."
  }
}
```


## Add tool data to data source

`POST /api/v1/tools/{tool_id}/data-sources/{data_source_id}/data.json` will create a new data entry for the specified tool, under the specified data source.

### Parameters

Name           | Type    | Description
-----          | ------- | -----------
tool_id        | integer | **Required** The identifier for the tool.
data_source_id | integer | **Required** The identifier for the data source.
data_type_id   | integer | **Required** The identifier for the data type.
user_id        | integer | **Required** The identifier for the user *(automatically filled from the authentication)*.
value          | string  | **Required** The content for the data entry.
slug           | string  | The slug for the data entry *(automatically generated from the value)*.

### Request

```
$ curl -X POST --data-binary @payload.json http://teresah.dasish.eu/api/v1/tools/1371/data-sources/5/data.json
```

```json
{
  "data_type_id": 2,
  "value": "Ruby on Rails, or simply Rails, is an open source web application framework written in Ruby."
}
```

### Response

```json
{
  "status": {
    "code": 201,
    "message": "Data entry was successfully created for the Data Source."
  }
}
```


## Update tool data in data source

`PUT/PATCH /api/v1/tools/{tool_id}/data-sources/{data_source_id}/data/{id}.json` will update the specific tool data from the parameters passed.

### Request

```
$ curl -X PATCH --data-binary @payload.json http://teresah.dasish.eu/api/v1/tools/1371/data-sources/5/data/11011.json
```

```json
{
  "data_type_id": 1,
  "value": "Ruby on Rails"
}
```

### Response

```json
{
  "status": {
    "code": 200,
    "message": "Data entry was successfully updated for the Data Source."
  }
}
```


## Delete tool data from the data source

`DELETE /api/v1/tools/{tool_id}/data-sources/{data_source_id}/data/{id}.json` will delete the specific tool data and return *200 OK* if that was successful. If you don't not have access to delete the tool data, you'll receive a *403 Forbidden*.

### Request

```
$ curl -X DELETE http://teresah.dasish.eu/api/v1/tools/1371/data-sources/5/data/11011.json
```

### Response

```json
{
  "status": {
    "code": 200,
    "message": "Data entry was successfully deleted from the Data Source."
  }
}
```
