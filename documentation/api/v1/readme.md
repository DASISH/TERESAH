# TERESAH API documentation

TODO: Extend and clean up the API documentation.

TODO: Check and correct the API access domain (api.teresah.dasish.eu?) mentioned in the documentation

TODO: Update the API request and response examples.

## Introduction

TERESAH provides a [RESTful](http://en.wikipedia.org/wiki/Representational_state_transfer "Wikipedia: Representational state transfer") [application programming interface (API)](http://en.wikipedia.org/wiki/Application_programming_interface "Wikipedia: Application programming interface") where each type of resource has a URI that you can interact with. API follows the principles of a RESTful web service wherever possible. It uses versioning to allow backwards-incompatible modifications in the service without affecting clients using older versions of the API.

This technical document is intended for developers building applications using the TERESAH API. Basic knowledge in programming is required to use the API. The API is independent from any programming language.


## Schema, request and response data formats

All API access is over HTTP(S), and by default accessed from the *api.teresah.dasish.eu* domain.

All data is sent and received in UTF-8 character encoding as JavaScript Object Notation (JSON) format. The Content-Type header must always be specified. Generally the *application/json; charset=utf-8* content-type is supported. Please note, that setting the Content-Type header is purposely omitted in the API documentation examples.

All timestamps are returned in the ISO 8601 format (YYYY-MM-DDTHH:MM:SSZ).


## Authentication

All API requests are required to be authenticated with an API key and identified with a User-Agent header. Please note, that setting the X-Auth-Token and User-Agent headers are purposely omitted in the API documentation examples. You can request your private API key from the "Manage API Keys" page.

### Identify your integration

You must include a User-Agent header with the name of your integration and a link to it (or your email address instead of link) so we can get in touch if needed. If you don't supply this header, you will receive a *400 Bad Request*. Here are few valid examples on how to identify your integration.

* User-Agent: TERESAH (http://teresah.dasish.eu/)
* User-Agent: TERESAH (http://teresah.dasish.eu/, teresah@example.org)
* User-Agent: TERESAH Crawler (your.name@example.org)

```
$ curl -H "X-Auth-Token: API_KEY" -A "TERESAH (http://teresah.dasish.eu/)" http://teresah.dasish.eu/api/v1/users.json
```

### Authenticating using an API key

API requests using an API key require an X-Auth-Token header. If you don't supply this header, you will receive a *401 Unauthorized*. Here's an example of using an API key to query available users:

```
$ curl -H "X-Auth-Token: API_KEY" http://teresah.dasish.eu/api/v1/users.json
```


## Rate limiting

The TERESAH API only allows clients to make a limited number of requests per hour. You can perform up to *600 request per hour* from the same IP address. If you exceed this limit, you'll get a *429 Too Many Requests* response for subsequent requests. It is considered best practice for applications to monitor their current rate limit status and dynamically throttle requests if necessary. All response headers include your current rate limit status in *X-RateLimit-Limit* and *X-RateLimit-Remaining* header.


## Available API endpoints

TERESAH provides the following API endpoints to interact with.

* Activities
* Data Sources
* Data Types
* Logins
* Tools & Tool data
* Users
