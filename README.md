# Drupal8-feedback-module
This is an example module to work with Drupal 8 form, entity and drush API.
## Getting Started
You need Drupal 8 build runing. This works on a fresh Drupal 8 installation.
## Built With
Drupal Console and Drush 9
## What this module do?
When visit the path /feedback, you will see a following feedback form. If a user is logged in, the email field we be populated with their email address. All fields are mandatory.
When click submit the data will be saved to the database. You will then see a confirmation message saying the submission has been saved. The table should have the following schema:
Table name: custom_feedback
Id – integer, autoincrement
first_name – varchar
last_name – varchar
category – varchar
message – text
submitted_at – datetime
When visit /results you will see a list of submissions from the above form in a tabular format.
When run the command `drush archive-messages`. Any message that is over 1 week old is deleted from the database.
