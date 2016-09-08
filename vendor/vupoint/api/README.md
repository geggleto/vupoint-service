# API Stateless Services

## Email Service

- REQUIRED
    - array to
    - string from
    - string subject
    - string body
    
- OPTIONAL
    - array cc
    - array bcc

- EXAMPLE

`curl -X POST -d "to[]=a@a.com&from=b@b.com&subject=Test&body=Test" /email`


## Excel service
- REQUIRED
    - string filename
    - array sheets
        - string name
        - int rows
        - int cols
        - array data of size [rows][cols]

- EXAMPLE
- Look at the ExcelServiceTest 