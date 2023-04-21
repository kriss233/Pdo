# PHP Mentored Education Program, Module 10: SQL, PDO

## Requirements
The goal of this exercise to create a very simple inventory for products which should consist the following features:

- List the inventory items, whereis a page should contain the maximum of 10 products.
  If the overall number of products exceeds the maximum of 10 then on the bottom of the list there should be links so the users will be able to
  navigate between the pages.
  In the list for each item you must display all the details for a given product, the name, category, description, the creation and update dates (if it was updated earlier) and a button for the Update Page.
- Users should be able to add new products, each product should include the product's name, description, category and the creation date. All of the items must be saved into the database.
- Users should be able to update the products. If a product was updated, the date and time of the modification should be displayed along with other details.
- The form must be validated on the server side. The validation should be the following:
    - Product name, category are mandatory, description is optional.
    - The max length of the description is 500 characters.
    - The max length of the product category and the name is 64 characters. 

Important notes:
For the database communication use PDO.

## Steps to follow

1. Create a new folder and site in your Homestead environment. Under the databases section in Homestead.yaml add a new
   database called mep_db_task. Run vagrant up.

2. Download a MySQL Client, e.g. HeidiSQL (https://www.heidisql.com/). You can use this application to connect to a database.

3. Add a new session called "mep-db-task". Use the IP Address from the top of your Homestead.yaml configuration as the
   Hostname / IP in HeidiSQL. For the User use "homestead" and for the password "secret". Click "Open" and now you should be
   able to access the newly created database.

4. Create a new table in the "mep_db_task" database called products. You can write either an SQL command, or use the user interface. It should
   contain the following fields:

   id, Datatype: INT, Unsigned, Default Value: AUTO_INCREMENT
   name, DataType: VARCHAR, Lenght: 64, NOT NULL
   category, DataType: VARCHAR, Lenght: 64, NOT NULL
   description, DataType: TEXT, ALLOWED NULL
   created_at, DataType: DATETIME, NOT NULL, Default Value: NOW()
   updated_at, DataType: DATETIME, ALLOWED NULL

5. Clone this repository into your newly created Homestead site.
   The repository consists an index.php file, which is a template for your Inventory app. You will need to update it in a way to
   satisfy the requirements listed above.

7. Create a ProductForm Class.
    - It should have the following properties: name (string), category (string), description (string), id (integer and optional)
    - It should have only one method, called validate that will implement the validation rules for the product described above.
      The method needs to return with a boolean value based on the validation results.

8. Create a Product Class
    - A Product Class needs to have exactly the same properties as the ProductForm. Instantiate this class once the ProductForm was validated and everything is OK with the data.

9. Create a new Class called ProductRepository
    - Implement a method called "save" with a parameter called $product with the type Product, which saves the data into the newly created table
    - Implement a method called "update" that requires a parameter called $product with the type Product. Within the method implement the logic to
      update the product that has this specific id in the table.
    - Implement a method called "get" that requires an integer parameter called id. The method should return the product with the specific ID or return null.
    - Implement a method called "getAll". The fetchPage method should have a parameter page (integer, with the default value 1).
      If the value is 1, return the first 10 products, if the page is 2 return the next 10 products so starting from 10 to 20, if the page is 3 return
      products 20-30, and so on..

10. Update the index.php in a way to satisfy the requirements described above. So, it must list the products with the usage of getAll method.

11. Update the save-process.php file to follow this flow:
    - If $_POST superglobal is empty, return to index.php.
    - If it has data: Instantiate a ProductForm class, set their properties with the use of the data sent by the form (use $_POST superglobal).
    - Validate the form inputs with the usage of validate method. If it's valid, create a Product object, if invalid, return to the index.php and display an error message.
    - If the data is valid proceed with the save.

12. Update the update-process.php file to follow this flow:
    - If $_POST superglobal is empty, return to index.php.
    - If it has data: Instantiate a ProductForm class, set their properties with the use of the data sent by the form (use $_POST superglobal).
    - Validate the form inputs with the usage of validate method. If it's valid, create a Product object, if invalid, return to the index.php and display an error message.
    - If the data is valid proceed with the update.
