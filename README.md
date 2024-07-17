# Laravel API with Job Queue, Database, and Event Handling

## Description.

This project demonstrates how to use Laravel to create an API with task queues, database operations, migrations, and event handling.

## Installation.

1. Clone the repository:

   ## bash
   git clone 
   cd 

2. Set dependencies with Composer:

    ## bash
    composer install
    composer require predis/predis

3. Create an .env file with the following database settings:

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=laravel_api
    DB_USERNAME=root
    DB_PASSWORD=

4. Generate the application key:

    ## bash
    php artisan key:generate

5. Run the migrations to create the necessary tables:

    ## bash
    php artisan migrate

6. Start the task queue worker to process queued jobs (make sure Redis is properly configured in your .env file):

    ## bash
    php artisan queue:work

   Note: Ensure Redis is properly configured in your .env file. Example configuration:

   QUEUE_CONNECTION=redis
   REDIS_CLIENT=predis
   REDIS_HOST=127.0.0.1
   REDIS_PASSWORD=null
   REDIS_PORT=6379

7. Usage.
The API has a single /submit endpoint that accepts a POST request with the following JSON structure:

curl -X POST http://your-domain.com/api/submit \
        -H "Content-Type: application/json" \
        -d '{
        "name": "John Doe",
        "email": "john.doe@example.com",
        "message": "This is a test message."
        }'


Response:
If the request is processed successfully:


{
    "message": "Submission received and is being processed"
}

In case of a validation error:

{
    "errors": {
        "name": ["The name field is required."],
        "email": ["The email field is required."],
        "message": ["The message field is required."]
    }
}

In case of an internal server error:

{
    "error": "Failed to process submission"
}

8. Testing
   A simple Unit test has been created to test the API. Run the command to run the tests:
