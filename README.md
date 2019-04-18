# TimebankTracker
The repo with code for Dr. Zeitz's Timebank day tracker. 
## Background
This project was for Dr.Zeitz so that she may have a more efficent way to keep track of students and the timebank days they use. She wanted a Webpage that will be hosted on the UMW cs website. It is written in PHP and HTML using mySQL.
###### What is a Timebank Day
A Timebank day is a day that can be used on an individual assignment when needed so that you can extend the due date of the assignment by one day. Timebank days MUST be used **BEFORE** the inital due date of the assignment.
## To Download
To download this webpage please download the repo provided and put it somwhere to webhost it.

## Required Documents
This webpage has a CSV format That must be used for each of the functionalites.
###### Files to change
To ensure this works you must go into the db.SQL file provided and change line 1 to the name of your database.
![alt text](https://github.com/sujiko/TimebankTracker/blob/master/ReadmeImages/Screen%20Shot%202019-04-18%20at%2012.23.33%20PM.png)
Then change the insert into admin down near the bottom, removing students and changing the second word in the encode from project to which encodekey is desired, this also needs to be reflected in the config file.
![alt text](https://github.com/sujiko/TimebankTracker/blob/master/ReadmeImages/Screen%20Shot%202019-04-18%20at%2012.23.38%20PM.png)
You need to make a config file two directories up from where you put the index code. A config file should be named config.php and should like this:
![alt text](https://github.com/sujiko/TimebankTracker/blob/master/ReadmeImages/example%20config.png)
#### Student CSV
The Student CSV should not have column names in it.The CSV title should be in the format of Semester_ClassNumber.csv where the semester and class number change based on the class. The columns should be in the order of: *pid , StudentFirstName , StudentLastName* where pid is the students' UMW ID. All stdents for all sections of the course number should be in this file. 
#### Assignments CSV
The Assignments CSV should also not have column names in it.The CSV title should be in the format of Semester_ClassNumber_Work.csv where the word Work does not change the semester and class number should match the one for the Student CSV. The columns should be in the order of: *ProjectName , DueDate* where duedate is in the format of 'm/d/Y'.
