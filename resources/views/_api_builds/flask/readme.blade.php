Hello, welcome to your new Flask api for interacting with your database.  Contained here are steps to help you get your new api up and running.

1) If you downloaded this file, it means you already built your api using our application.  Great!  That means most of the work is already done.
   Begin by setting up this flask app to run as you would a normal flask application. https://flask.palletsprojects.com/en/2.2.x/tutorial/deploy/
2) Once you have your app set up to run in production mode, create a .env file in the same directory as app.py.  This is where the credentials for
   interacting with your database will be stored.
3) Define the following keys in you .env file:

        db_user: user account you will use to interact with your database.
        db_password: password for user account defined in db_user.
        db_host: host where your database is hosted, oftentimes it is "localhost",
        db_name: name of the database on the host that this api interfaces with.
        db_filename: name of the file used to store the database for file-based databases like sqlite.

    NOTE: You will not need to define ever key for your api in all cases, it depends what type of database you are using.
        SQLite only requires that db_filename be filled.
        MySQL and PostgreSQL both require every key listed above except db_filename to be filled.

Example .env configuration:
------------------------------------------------
db_user=sales_admin
db_password=sales_32479058
db_host=localhost
db_name=SALES
db_filename=
------------------------------------------------

Visit https://<your_domain_name>/docs to see generated documentation.