# Website for John
REST API website to get the latest news about specified persons, using the Twitter API.

## Installation
Hi John, i made website for you. Now you have possibility to get the latest news about your specified persons using REST API of your website.\
To install this website you need to follow this list:
1. You need to find the database configuration file, it is located in the following path: `/config/db.php`.
In this file you need to replace the data that I have selected in upper case with your data for connecting to the database.
1. Now you need to apply database migrations using the following command: `yii migrate`.
1. After that, you need to add your **Bearer Token** to the following configuration file: `/config/params.php`

## API Documentation
### Persons
`GET /persons` — Get list of users.\
`HEAD /persons` — Get users metadata.\
`POST /persons` — Add new person to watchlist.\
`GET /persons/XYZ` — Getting information on a specific user with id equal to XYZ.\
`HEAD /persons/XYZ` — Getting metadata on a specific user with id equal to XYZ.\
`PATCH /persons/XYZ` и `PUT /users/XYZ` — Change user information with id equal to XYZ.\
`DELETE /persons/XYZ` — Removing a user with id equal to XYZ.\
`OPTIONS /persons` — Getting supported methods by which you can call / persons.\
`OPTIONS /persons/XYZ` — Getting supported methods by which you can access /users/XYZ
### Tweets
`GET /persons/tweets` — Get latest tweets of all persons of your list.\
`GET /persons/XYZ/tweets` — Get latest tweets of person with id equal to XYZ.\