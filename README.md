## Inspiration
Many companies have a host of databases for managing various aspects of their business.  These aspects may include their SAP system, purchase/order records, manufacturing logs, and more.  After collecting this data, most organizations want to access it within their applications.  This requires either a direct database connection, or the development of a REST api.  But, each of these methods have problems.  Direct connections are prone to security issues and are not scalable, especially when multiple servers are involved.  Meanwhile, a REST api offers string security and flexibility, but can be cumbersome, repetitive, and time consuming to develop.  That is where this project comes in.  Our application makes it easy for businesses to build and deploy REST apis to facilitate interactions between their apps and databases.

## What it does
Our project allows visitors to easily construct a REST api for their database using a simple, no-code interface.  Simply enter basic information about you database schema, select the language and framework you would like your api built in, and build your project.  Within moments, you will receive a zipped-up application which, when deployed, will serve as a fully-functional REST api to interface with your database!

## Project stack
Our project was built using [Laravel](https://laravel.com), the popular PHP framework.  Our app uses Laravel's eloquent ORM for managing the database, and so would be compatible with a range of databases.  We used [MySQL](https://www.mysql.com) in development, however.  Our app made use of [Tailwind](https://tailwindcss.com), [Alpine](https://alpinejs.dev), and [HTMX](https://htmx.org) to implement styling and various interactive frontend features.

## Challenges we overcame
One challenge we overcame was the question of how to dynamically generate code files to create the apis, and populate them with schema and routes based on the user's input.  Our idea was to use Laravel's built-in blade template renderer to easily render these files.  Normally, blade is used to dynamically render html to be used on the front end of an application.  We made use of this in our app.  But, we figured out that we could also use it to generate code for our generated apis.  So, we used blade directives to dynamically generate python code to create a flask app to server as an api to the user's database.  We also had to avoid naming conflicts between data entered by our users, and keywords used in programming languages like python.  This was solved by prepending any output used to create functions or classes that was generated from user input to our app with a randomly generated (but constant throughout the build) string.

Another challenge we were able to overcome in to was the handling of foreign key relationships in our generated apis.  Initially, we were storing attributes on tables entered by the user with a simple boolean attribute, called "is_foreign".  But, this proved to not be enough, because in order to generate the models in our generated database with the correct relationships to match the user schema, we need to know which attribute on another table that attribute references.  So, we adjusted our db schema for our app a bit, removing the boolean "is_foreign" attribute with a new "foreign_id" attribute, which is a foreign key referencing another attribute in our database.  Because all attributes are related to a table record entered by the user, this one small change allows us to tell both what other tables a given table is related to, and which attributes they use to relate to that other table.  

## Accomplishments that we're proud of
The idea for this project originated began when Jacob was researching the different organizations involved in this hackathon.  While researching Alloy Automation, whose products automate various api interactions, Jacob had the idea to automate the creation of REST apis themselves.  After doing some research, he found that there is no comprehensive online service for generating REST apis.  So, we are proud that we were able to come up with and deliver a novel piece of software that serves a purpose not commonly met in the larger market.

We are also proud of the ingenuity and problem-solving abilities we demonstrated in solving the problems listed above, and others that we did not mention.  Many problems that arose in building this project required true outside-the-box thinking, and we are proud that we were able to come up with creative solutions to these issues.

## Purpose

This app was developed for the [DeveloperWeek 2024](https://developerweek-2024-hackathon.devpost.com) Hackathon by Jacob Graham and Daniel Ellingson.  It was entered as a submission to the overall competition, and not any of the individual contests.

## About Jacob Graham

[Jacob Graham](https://jacob-t-graham.com) is an aspiring software developer and entrepreneur from Northeast Ohio.  He graduated from Grove City College in 
December of 2023 with a B.S. in Computer Science and a minor in Cybersecurity.  He is currently employed as an application developer at the Wooster Brush Company, where he is using his skills to updated and modernize many of the company's business processes.  He also runs a web development business, and is interested in interesting and innovative entrepreneurship opportunities.

## About Daniel Ellingson

[Daniel Ellingson](https://danielellingson.eiseldel.net/) is a web developer and game design enthusiast. He graduated from CSU, Chico in December 2020 with a B.S. in Computer Science. He is currently employed at University of the Pacific, where he helps maintain and develop features for the university's Drupal site.

## Thank You!

Thank you for taking the time to review our project.  If you have any questions, feel free to contact [Jacob](https://jacob-t-graham.com/contact).
