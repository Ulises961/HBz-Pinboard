# HBz

## Web and Internet Engineering Project - 2021

We have developed a forum for the community of users of the Bolzano university.

It consists of three main features: 
* A Q&A forum where users can post, answer, comment and vote posts
* A Chat for users to communicate with other users within the platform 
* A Booking platform to contact professors of the university

## Deployment
To deploy the website follow the instructions in [DEPLOYMENT.md](./DEPLOYMENT.md)

## Introduction
The aim of this report is to highlight the structure of the project, explain how the workload was balanced and point out any difficulty that we might have encountered.

## Our mood and behavior
The group was composed by Ulises Sosa, Balawal Sultan, Filippo Cenacchi and Andres Tanesini. Although preserving synchronization and coordination during a team project isn’t an easy task, we tried to communicate effectively, and we used Trello for keeping track of the work to do. 

## User stories

### Landing page
User normally lands on the homepage. If the user is not registered it will click on the register button where he/she will be redirected to the register.php webpage. Else, the user will click on ask a question and will be redirected to the login.php webpage to login. A logged user will be able to access all the services through the navbar. The main features of our platform are: the forum, the chat and the office hours booking webpage.

### Registration page
New user should fill up basic information about themselves that will be validated dynamically through AJAX requests. Required fields, email, password and repeat password and user role (used to differentiate our user e.g. students/professors). Once the form is filled in the user submits the form, the information will be validated server side and if valid inserted into the user database. If this step is complete successfully the user will be redirected to the login webpage, otherwise an empty form will be reloaded.

### Login page
A registered user insert his/her credentials, click on the login button and will be redirect to the forum page. If user insert invalid credentials a message is displayed and the login page is reloaded.

### Forgotten password
An user that forgot his/her password can use the link displayed in the login webpage to demand a new one. After inserting name, surname and email in the forgotten password form an email will be sent with a code. Such code will be used to validate the user in order to change the password. If the code sent to the email is valid the user will be allowed to reset the password. Otherwise, an error message will be displayed, the code field will be cleared and the user is given an attempt to re-insert a valid code.

### Forum page
User is presented with all the question posted to the forum. The user can choose to either search a specific question in the search bar or sort the questions in a certain order (popularity or most recent) or browse all the questions using the paginator. Furthermore, questions can be filtered by means of tags at the bottom of each particular question.

### Post a question in the forum
The user clicks on the button "write a new question" and page with an editor will be loaded. The user insert a title for the question, the body of the question and eventually some tags. If the title and the body are filled in the question is posted and the user is redirected to the page of the posted question. Otherwise, an error will be displayed and the user will be redirected to the forum.

### Profile & Contacts page
In the profile you will se basic information about yourself, the questions you asked and questions to wich you gave an answer. To see the profile of another user you can find said user on the contacts page and visit his profile, while if you want to chat with this user on his profile page you will find a button which will redirect you to the chat and start a conversation with him.

### Chat
The user can access the chat through the navbar.
The chat interface is divided into two main pannels conversations and message.
On the conversations pannel you will find all the ongoing and blocked conversations as well as the button to create a new group chat, while on the message pannel you will find the message history of the selected conversation and the menu which depending on the conversation (group or private) will present different options.

### Office hours
Users can use the office hours feature to search when a professor is available for a meeting. On the page you will see fields that helps the user to find the professors of his/her course. On the result table the user will be presented with the professors of the course and there will be a button which prepares a standard email asking the professor for an office hour appointment.


## Division of tasks
It felt natural to divide the load of the project into two main tasks, front-end and back-end. While Ulises and Balawal were responsible for the backend of the platform, Andres and Filippo were in charge of the front-end.
Balawal was responsible mainly for the chat, the office hours and the database design.
Ulises was resonsible mainly for the forum, the scraper for retrieving the information for the database, the register and the login page.
Andrés was responsible for the layout and the aesthetic of the website and the office hours.
Filippo was responsible of the contact page and the the chat graphical interface.


## Structure of the project
Our website architecture is based on the MVC architetctural pattern. In our architecture javascript acts as the controller, php and the database as the model and the views are distributed on the main pages of our website.

We decided to establish some conventions for our project to make it easier to understand what our code does.

Each main page of our website starts with an uppercase letter.

Each of the subfolders of the php folder contain files which start with one of the following keywords: 
* get -> if a filename starts with get it means that it will retrieve data from the database;
* load -> if a filename starts with load the it means that the file will get some data from the database and load some component(HTML element) into the page;
* insert -> if a filename starts with insert that means that the file will insert some data into the database;

Similairly to views in the MVC pattern we decided to introduce the concept of components which are HTML elements that are used more than once in a given page and are used in the load files.

## Difficulties and considerations
We didn’t encounter lots of difficulties and challenges, however we decided to list here the main things that gave us some thoughts.
* Ulises: I found difficult to debug functionalities without a testing suite this led to exponential testing time.
* Balawal: the main challenge I faced was to make php and javascript work together and simililarly to Ulises debugging the website since it was to figure out if the bug was on javascript, php or at the database level.
* Andrés: for me was hard to understand how to make these different technologies work together.
* Filippo: 

As a group it was hard to work with different operating systems, help each to configure the development enviroment, finding a suitable timeslot for arranging meetings and updating each other on the work done.


