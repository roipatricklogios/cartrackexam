1. Clone to your local machine
2. In POSTMAN
    a. http://localhost/cartrackexam/api/actions/pulldata.php - (GET) to Show all data in DB
    b. http://localhost/cartrackexam/api/actions/search.php?id=4 - (GET) id = for ID of Movie
    c. http://localhost/cartrackexam/api/actions/create.php = (POST) to create a movie
        i. Header = Content-Type => application/json
        ii. Body - raw Eg.
          {
              "title": "Underworld 1",
              "director" : 3,
              "showing" : "2020-12-12",
              "casts" : "Selene, Michael, Viktor, Markus, Amelia"
          }
    d. http://localhost/cartrackexam/api/actions/update.php = (PUT) = For Updating the Movie
    e. http://localhost/cartrackexam/api/actions/delete.php = (DELETE) = for deleting movie
    
    
*** I did not create the CRUD for the director You can place it manually
