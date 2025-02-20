# Laravel API Project

## Overview

This project is a Laravel-based RESTful API that provides authentication, user management, projects, project attributes, and timesheet functionalities.

-   Project is live at http://16.171.64.133

-   API Schema documentation: http://16.171.64.133/api/documentation

-   MYSQL dump file is in `storage/dump/database.sql`
-   Postman collection json file: `storage/dump/Laravel Backend Assessment.postman_collection.json`

-   GitHub Repository: https://github.com/Creative-developers/laravel-backend-assessmet

-   Test credentials:
    -   email: `testuser@gmail.com`
    -   Password: `test1122`

---

## Setting up the Project

-   Run `composer install` to install the dependencies
-   Run `php artisan migrate` to run the migrations
-   Run `php artisan serve` or run it by using `valet` to run the project on local
-   Run `php artisan db:seed` to seed the database with sample data

---

## Running seeders

-   User Seeder
-   Attribute Seeder (it will generate the data with name field (department, start_date, end_date & price))
-   Project Seeder ( it will generate 10 projects with attribute values, assign the random users to the project and assign random attribute values and create timesheet entries)

---

## Packages

-   `Laravel Passport` for Authentication
-   `l5-swagger` for Swagger API Documentation

---

## Features

-   User Authentication (Register, Login, Logout)
-   User Management (CRUD operations)
-   Project Management (CRUD operations and EAV)
-   Attribute & Attribute Values Management
-   Timesheet Logging

---

## Project Structure and Routes

### Available Routes

### Auth Routes

-   `api/login` generates `access_token` that needs to be added in the Authorization header as `Bearer {access_token}`

| Method | Route           | Description         | Request Parameters                     | Auth Required |
| ------ | --------------- | ------------------- | -------------------------------------- | ------------- |
| POST   | `/api/register` | Register a new user | first name, last name, email, password | No            |
| POST   | `/api/login`    | Login user          | email, password                        | No            |
| POST   | `/api/logout`   | Logout user         | None (Requires Bearer Token)           | Yes           |

---

### User Routes

| Method | Route                          | Description                | Request Parameters                     | Auth Required |
| ------ | ------------------------------ | -------------------------- | -------------------------------------- | ------------- |
| GET    | `/api/users`                   | Get list of users          | None                                   | Yes           |
| POST   | `/api/users`                   | Create a new user          | first_name, last_name, email, password | Yes           |
| GET    | `/api/users/{user}`            | Get a user by ID           | user (User ID)                         | Yes           |
| PUT    | `/api/users/{user}`            | Update user details        | first_name, last_name, email, password | Yes           |
| DELETE | `/api/users/{user}`            | Delete a user              | user (User ID)                         | Yes           |
| GET    | `/api/users/{user}/projects`   | Get user projects          | user (User ID)                         | Yes           |
| GET    | `/api/users/{user}/timesheets` | Get user logged timesheets | user (User ID)                         | Yes           |

---

### Attribute Routes

| Method | Route                         | Description                  | Request Parameters                          | Auth Required |
| ------ | ----------------------------- | ---------------------------- | ------------------------------------------- | ------------- |
| GET    | `/api/attributes`             | Get all attributes           | None                                        | Yes           |
| POST   | `/api/attributes`             | Create a new attribute       | Attribute details (e.g., name, type)        | Yes           |
| GET    | `/api/attributes/{attribute}` | Get a single attribute by ID | attribute (Attribute ID)                    | Yes           |
| PUT    | `/api/attributes/{attribute}` | Update an existing attribute | attribute (Attribute ID), attribute details | Yes           |
| DELETE | `/api/attributes/{attribute}` | Delete an attribute          | attribute (Attribute ID)                    | Yes           |

---

### Attribute Value Routes

| Method | Route                                   | Description                        | Request Parameters                  | Auth Required |
| ------ | --------------------------------------- | ---------------------------------- | ----------------------------------- | ------------- |
| GET    | `/api/attributeValues`                  | Get all attribute values           | None                                | Yes           |
| GET    | `/api/attributeValues/{attributeValue}` | Get a single attribute value by ID | attributeValue (Attribute Value ID) | Yes           |
| DELETE | `/api/attributeValues/{attributeValue}` | Delete an attribute value          | attributeValue (Attribute Value ID) | Yes           |

---

### Project Routes

| Method     | Route                                        | Description                  | Request Parameters                                                        | Auth Required |
| ---------- | -------------------------------------------- | ---------------------------- | ------------------------------------------------------------------------- | ------------- |
| **GET**    | `/api/projects`                              | Get all projects             | `filters[name]` (from Project model)                                      | Yes           |
|            |                                              |                              | Supports operators: `<`, `>`, `=`, `like` (e.g., `filters[price][<]=150`) |               |
| **POST**   | `/api/projects`                              | Create a new project         | Project details (e.g., name, description, etc.)                           | Yes           |
| **GET**    | `/api/projects/{project}`                    | Get a single project         | `project` (Project ID)                                                    | Yes           |
| **PUT**    | `/api/projects/{project}`                    | Update an existing project   | `project` (Project ID), Project details                                   | Yes           |
| **DELETE** | `/api/projects/{project}`                    | Delete a project             | `project` (Project ID)                                                    | Yes           |
| **POST**   | `/api/projects/{project}/assign-user/{user}` | Assign a user to a project   | `project_id` (Project ID), `user_id` (User ID)                            | Yes           |
| **DELETE** | `/api/projects/{project}/unassign/{user}`    | Remove a user from a project | `project_id` (Project ID), `user_id` (User ID)                            | Yes           |

---

### Example for Creating and Updating a Project

```json
{
    "name": "Project 2B",
    "status": 1,
    "attributes": [
        {
            "attribute_id": 1,
            "value": "Sales" // Value is the column in attributeValue
        },
        {
            "attribute_id": 2,
            "value": "2025-02-01"
        },
        {
            "attribute_id": 3,
            "value": "2025-02-11"
        }
    ]
}
```

### Filters Example

-   You can apply filters when fetching projects. Filters follow this format: for eg

-   for eg /api/projects?filters[name]=Project A&filters[department]=IT
    where `name` is from project model and `department` is from attribute model and value `IT` is the attribute value.

-   also for filters for eg: api/projects?filters[department]=IT&filters[name]=Project A&filters[price][<]=150

-   you can use operators: `<`, `>`, `=`, `like` to filter values. and include many filters separated by `&`

---

### Timesheet Routes

| Method     | Route                         | Description                  | Request Parameters                                       | Auth Required |
| ---------- | ----------------------------- | ---------------------------- | -------------------------------------------------------- | ------------- |
| **GET**    | `/api/timesheets`             | Get all timesheets           | N/A                                                      | Yes           |
| **POST**   | `/api/timesheets`             | Create a new timesheet       | Timesheet details (e.g., hours worked, project ID, etc.) | Yes           |
| **GET**    | `/api/timesheets/{timesheet}` | Get a single timesheet by ID | `timesheet` (Timesheet ID)                               | Yes           |
| **PUT**    | `/api/timesheets/{timesheet}` | Update an existing timesheet | `timesheet` (Timesheet ID), Timesheet details            | Yes           |
| **DELETE** | `/api/timesheets/{timesheet}` | Delete a timesheet           | `timesheet` (Timesheet ID)                               | Yes           |

---

```

```
