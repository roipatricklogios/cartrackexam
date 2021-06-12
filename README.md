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



FOR DB: (I'm totally new to heroku and postgresql...Thank You for your understaning)

Table movie
Columns
1. m_id (AI)
2. m_title
3. m_director (int)
4. m_showing (date)
5. m_casts (text)
6. created_at
7. updated_at

Table director
Table Columns
1. d_id
2. d_name
3. created_at
4. updated_at


