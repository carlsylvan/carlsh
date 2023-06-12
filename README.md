# carlsh

carlsh is made with php and MySQL. It is a rest api for displaying and adding sellers and products to an imagined second hand store as json objects.

# installation

Clone the repo https://github.com/carlsylvan/carlsh.git and use for example XAMPP for running apache and MySQL. Put the project in htdocs in XAMPP. Run the carlsh.db file to set up the MySQL database.

# usage

Use for example Postman to GET/POST/PUT to the following endpoints, with localhost/carlsh/:  
GET:  
/sellers to display all sellers and the products they want to sell.  
/seller/{id} to display one seller and their products.  
/products to display all products  
/product/{id} to display a product

POST (json):  
/sellers to add a seller to the database  
{  
"first_name": string,  
"last_name": string,  
"email": string,  
"phone": string,  
}

/products to add a product to the database  
{  
"title": string,  
"description": string,  
"price": number,  
"seller_id": number,  
"category_id": number,  
"size_id": number,  
"color_id": number,  
"brand_id": number,  
"added": null, (DATETIME is auto generated in MySQL)  
"sold": null  
}

PUT:  
/product/{id} to set a product as sold
