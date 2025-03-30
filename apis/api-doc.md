## Base URL = `http://localhost:6789/web-project-the-a-team`

Example complete URL : `{http://localhost:6789/web-project-the-a-team}` `{/apis/programmes.php}`

> #### The first curlybase section is `{base_url}` and the second section is the api endpoint `{api_endpoint}` the complete valid URL looks like this:


> `http://localhost:6789/web-project-the-a-team/apis/programmes.php` (to get all programmes list)



## Programmes list

`{base_url}/apis/programmes.php` (to get all programmes list)<br>
`{base_url}/apis/programmes.php?query=science&level=1` (to get only programmes which has 'science' in its title and is level `1` which is undergrad)

## Programme description

`{base_url}/apis/programme.php?id=1` (get program descriptions based on the program id)


## Modules list

`{base_url}/apis/modules.php?id=1` (get all modules list based on program id)

## Module description

`{base_url}/apis/module.php?id=1` (get module description based on the module id)

## List of Programmes which shares a module

`{base_url}/apis/module-programmes.php?id=6` (get list of programmes which shares a specific module based on module ID)

## Register interest 

`POST http://localhost:6789/web-project-the-a-team/apis/register-interest.php`

### Description
This endpoint allows users to register their interest in a specific academic program.

### Request

#### Headers
- `Content-Type: application/json` (required)

#### Body Parameters
| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| StudentName | string | Yes | Full name of the student registering interest |
| Email | string | Yes | Valid email address of the student |
| ProgrammeID | integer | Yes | Unique identifier of the program the student is interested in |

#### Example Request
```json
{
  "StudentName": "Himmat Rai",
  "Email": "himmat.rai@example.com",
  "ProgrammeID": 1
}
```

### Response

#### Success Response
- **Status Code**: 201 Created
- **Content Type**: application/json

#### Example Response
```json
{
  "message": "Interest registration successful",
  "interestID": "6",
  "data": {
    "StudentName": "Himmat Rai",
    "Email": "himmat.rai@example.com",
    "ProgrammeID": 1
  }
}
```

#### Error Responses

#### Missing Required Fields
- **Status Code**: 400 Bad Request
- **Content Type**: application/json

```json
{
  "message": "Missing required fields",
  "fields": ["StudentName", "Email"]
}
```

#### Invalid Email Format
- **Status Code**: 400 Bad Request
- **Content Type**: application/json

```json
{
  "message": "Invalid email address"
}
```

#### Server Error
- **Status Code**: 500 Internal Server Error
- **Content Type**: application/json

```json
{
  "message": "Registration failed",
  "error": "Error message details"
}
```
