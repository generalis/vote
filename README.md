# vote
Easy vote app based on simple saving question and answer files to helps make a voting.

Main concept:
file      | description
----------|:-----------
backend.php | file with CRU(D) functions to create file with random name cache/date_xyz.hph
date_xyz.php   | include created question and naswers in table
index.php | include last cache/date_xyz.php file with question and answers table and create form
