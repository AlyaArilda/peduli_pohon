# Peduli Pohon

Peduli Pohon is a Laravel-based RESTful API developed to support a tree management and environmental reporting application. The backend provides authentication, tree data management, article management, favorites, environmental reports, categories, profile management, and password recovery functionality.

The API is designed to manage structured tree information, user accounts, educational articles, tree favorites, and reports related to tree conditions or locations.

# Features
# Authentication and User Management
 User registration and login
 Authentication using Laravel Sanctum
 Authenticated user information endpoint
 User logout
 Profile update
 Profile photo deletion
 Password reset request through email
 Password reset using a reset token
 Password hashing using Laravel's Hash facade

# Tree Management
The tree management module provides CRUD functionality for tree data.
Supported data includes:
 Tree name
 Tree category
 Tree image
 Description
 Benefits
 Person in charge
 Person in charge photo
 Person in charge phone number
 Address
 Tree height
 Canopy information
 Suitable usage information

The API also supports:
 Category and user relationship loading
 Image upload and storage
 Image replacement during updates
 Removal of stored images when tree records are deleted
 HTML tag sanitization for tree benefit descriptions

# Article Management
The article module provides CRUD functionality for environmental articles.
Supported functionality includes:
 Retrieve the latest articles
 Retrieve article details
 Create articles
 Update articles
 Delete articles
 Article image upload
 Analyst photo upload
 Replacement and deletion of existing images
 HTML tag sanitization for article content

# Favorite Management
Users can manage their favorite trees through the favorite module.
Available functionality includes:
 Retrieve favorite records
 Create a favorite
 Prevent duplicate favorites using firstOrCreate
 Retrieve a specific favorite
 Delete a favorite
 Relationship loading between users and trees

# Environmental Reports
Authenticated users can submit reports related to trees or environmental conditions.
Report data includes:
 Tree location
 Time the condition was discovered
 Damage description
 Damage photo
 Reporter name
 Reporter phone number
 Reporter email
 Report status

The reporting system also:
 Associates reports with the authenticated user
 Supports multiple date and time input formats
 Stores optional damage photos
 Determines the initial report status based on the submitted location
 Provides authenticated users with access to their own reports

# Category Management
The category endpoint provides access to available tree categories used by the tree management module.

# API Endpoints
Because these routes are defined in routes/api.php, Laravel applies the /api prefix to the following endpoints.

# Authentication
POST= /api/login           -> Authenticate a user            
POST= /api/register        -> Register a new user            
POST= /api/forgot-password -> Request a password reset link  
POST= /api/reset-password  -> Reset a user's password        
POST= /api/logout -> Logout the authenticated user  
GET= /api/user -> Retrieve the authenticated user

# Profile
POST= /api/profile/update -> Update user profile 
DELETE= /api/profile/photo -> Delete profile photo

# Trees
GET= /api/api-pohons      -> Retrieve tree records
POST= /api/api-pohons      -> Create a tree record 
GET= /api/api-pohons/{id} -> Retrieve tree details 
PUT/PATCH= /api/api-pohons/{id} -> Update a tree record  
DELETE= /api/api-pohons/{id} -> Delete a tree record 

# Articles
GET= /api/api-artikels -> Retrieve articles       
POST= /api/api-artikels -> Create an article       
GET= /api/api-artikels/{id} -> Retrieve article details 
PUT/PATCH= /api/api-artikels/{id} -> Update an article        
DELETE= /api/api-artikels/{id} -> Delete an article       

# Favorites
GET= /api/api-favorites -> Retrieve favorite records 
POST= /api/api-favorites -> Add a tree to favorites   
GET= /api/api-favorites/{id} -> Retrieve a favorite record 
PUT/PATCH= /api/api-favorites/{id} -> Update a favorite record   
DELETE= /api/api-favorites/{id} -> Remove a favorite         

# Reports
GET= /api/laporans -> Retrieve reports belonging to the authenticated user
POST= /api/laporans -> Submit a new report                                 
GET= /api/laporans/{id} -> Retrieve a report                                    
PUT/PATCH= /api/laporans/{id} -> Update a report                                      
DELETE= /api/laporans/{id} -> Delete a report                                     

# Categories
GET= /api/kategoris -> Retrieve available tree categories

# Technology Stack
 PHP
 Laravel
 Laravel Sanctum
 MySQL
 RESTful API
 Eloquent ORM
 Laravel Storage
 Composer

# Installation
1. Clone the Repository
git clone https://github.com/AlyaArilda/peduli_pohon.git
cd peduli_pohon
2. Install PHP Dependencies
composer install
3. Install Frontend Dependencies
npm install
4. Configure Environment
Create a .env file from the provided example:
cp .env.example .env
Configure the database and other required environment variables in .env.
5. Generate Application Key
php artisan key:generate
6. Run Database Migrations
php artisan migrate
7. Create Storage Link
Because the application stores uploaded images using Laravel's public storage disk, create the symbolic link with:
php artisan storage:link
8. Run the Application
php artisan serve

The API can then be accessed through the Laravel application URL.
# Authentication

Protected API endpoints use Laravel Sanctum authentication.
Users must authenticate through the login endpoint before accessing protected resources. The authenticated user is available through Laravel's request authentication system.

Example protected request:
Authorization: Bearer {token}

# File Storage
The application uses Laravel's public storage disk for uploaded files.
Tree images are stored under:
storage/app/public/gambar_pohon
Person-in-charge photos are stored under:
storage/app/public/foto_pj
Article and analyst images are stored under their respective application storage directories.
The application also removes previously stored images when an image is replaced or when its associated record is deleted.

# Validation
The API implements Laravel request validation for incoming data.
Examples of validated fields include:
 Required and optional string fields
 Email addresses
 Password confirmation
 Existing category and tree relationships
 Uploaded image types
 Uploaded image size limits
 Report status values
 Array-based tree suitability information

This validation helps maintain consistent data before it is stored in the database.

# API Design
The backend follows a RESTful API structure using Laravel resource controllers.
The API separates major application domains into dedicated controllers, including:
 AuthController
 DataPohonController
 DataArtikelController
 DataFavoriteController
 DataKategoriController
 DataLaporanController
 ForgotPasswordController
Resource routes are used for tree, article, favorite, and report management.

# Development Focus
This project demonstrates backend development practices using Laravel, including:
 RESTful API development
 Authentication and authorization
 Laravel Sanctum
 Eloquent relationships
 Request validation
 CRUD operations
 File upload and storage management
 Password reset functionality
 User-specific data retrieval
 API resource handling
 Database-driven application development

# License
This project is developed for educational and application development purposes.
