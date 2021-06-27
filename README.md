# HBz

## Web and Internet Engineering Project - 2021
We have developed a forum for the community of users of the Bolzano university. It consists of three main features: 
* A Q&A forum where users can post, answer, comment and vote posts
* A Chat for users to communicate with other users within the platform 
* A Booking platform to contact professors of the university


# Introduction

The aim of this report is to highlight the structure of the project, explain how the workload was balanced and point out any difficulty that we might have encountered

# Our mood and behavior

The group was composed by Ulises Sosa, Balawal Sultan, Filippo Cenacchi and Andres Tanesini. Although preserving synchronization and coordination during a team project isn’t an easy task, we tried to communicate effectively, and we used Trello for keeping track of the work to do. 

# User stories
## Landing page
User normally lands on the homepage. If the user is not registered it will click on the register button where he/she will be redirected to the register.php webpage. Else, the user will click on ask a question and will be redirected to the login.php webpage to login. A logged user will be able to access all the services through the navbar. The main features of our platform are: the forum, the chat and the office hours booking webpage.

## Registering
New user should fill up basic information about themselves that will be validated dynamically through AJAX requests. Required fields, email, password and repeat password and user role (used to differentiate our user e.g. students/professors). Once the form is filled in the user submits the form, the information will be validated server side and if valid inserted into the user database. If this step is complete successfully the user will be redirected to the login webpage, otherwise an empty form will be reloaded.

## Login
A registered user insert his/her credentials, click on the login button and will be redirect to the forum page. If user insert invalid credentials a message is displayed and the login page is reloaded.

## Forgotten password
An user that forgot his/her password can use the link displayed in the login webpage to demand a new one. After inserting name, surname and email in the forgotten password form an email will be sent with a code. Such code will be used to validate the user in order to change the password. If the code sent to the email is valid the user will be allowed to reset the password. Otherwise, an error message will be displayed, the code field will be cleared and the user is given an attempt to re-insert a valid code.

## Post a question in the forum
The user clicks on the button "write a new question" and page with an editor will be loaded. The user insert a title for the question, the body of the question and eventually some tags. If the title and the body are filled in the question is posted and the user is redirected to the page of the posted question. Otherwise, an error will be displayed and the user will be redirected to the forum.

## Forum
User is presented with all the question posted to the forum. The user can choose to either search a specific question in the search bar or sort the questions in a certain order (popularity or most recent) or browse all the questions using the paginator. Furthermore, questions can be filtered by means of tags at the bottom of each particular question.

## Chat
The user can access the chat through the navbar. On the chat page you will  see on the left the contacts and groups are and on the right you will see all the message history. On the top-right panel you will the see the menu button and once you click on it you will see different interfaces based on the chat (group/private).

## Office hours
If the user is a student, he/she can use the office hours feature to search when a professor is available for a meeting. On the page you will see fields that helps the user to find the professors of his/her course. On the result table the user will be presented with the professors of the course and there will be a button which prepares a standard email asking the professor for an office hour appointment.

## Contacts
On the contacts page the user will se all the other users of the website and it will be possible to access their profile.

## Profile
In the profile you will se basic information about the user, the questions/answers posted and you can chat with such user using the chat button.


#Division of tasks

It felt natural to divide the load of the project into two main tasks, front-end and back-end. While Ulises and Balawal were responsible for the backend of the platform, Andres and Filippo were in charge of the front-end.
Balawal was responsible mainly for the chat, the office hours and the database design.
Ulises was resonsible mainly for the forum, the scraper for retrieving the information for the database, the register and the login page.
Andrés was responsible for the layout and the aesthetic of the website and the office hours.
Filippo was responsible of the contact page and the the chat graphical interface.


#Structure of the project



#Techniques used

As it was a Java project, since the beginning we focused a lot on keeping a non-static stance. Instead to create long classes with lots of poorly related stuff and static methods in them, we decided to create more classes, each containing a small portion of code and a constructor. This way we could easily access the methods by creating instances of the classes.
The retrieved data was treated as an InputStream, which was then passed to a proper method to be deserialized thanks to an ObjectMapper. During the deserializing process we made use of json setters for identifying the properties, and the @JsonIgnoreProperties tag to skip over superfluous ones.
The analysis was completed using streams, which made it easier to perform the needed operation on the available amount of data.
For handling files, both the input and the json ones, we relied on a useful tool, the ClassLoader.
Logging was planned according to the possible messages a user could receive whenever it was just an information about the current action of the program, we logged them as an info, in case of malfunctions we logged them as errors.

#Difficulties and considerations

We didn’t encounter lots of difficulties and challenges, however we decided to list here the main things that gave us some thoughts.
While Andres thought that the streams (mainly employed in the Analyzer class) revealed themselves to be very helpful, but their use wasn’t very intuitive at first. The testing also required some more extra planning and researches before we headed into that part.
Lucia was already more familiar with the project, as she had already worked on it in sight of the previous session, so she already knew how to deal with most parts of it.
Overall, this project revealed itself to be a good opportunity to practice what we learnt during the course in a more concrete setting. It also gave us a good insight of what it means to work together as a team on an application program, both on the technical and human side.



