 # MVF  

Console application for showing the prefered programing language of a Github user. 

Clone and install:
```
 git clone git@github.com:mauricio-masias/mvf.git
 cd mvf
 composer install
 mv .env.example .env
 nano .env <-- add Github token here
```

    |--------------------------------------------------------------------------
    |
    |   This app runs on Laravel - Zero
    |   Files under PSR2 format
    |
    |   Commands under /app/commands
    |   - PreferedDevLanguageCommand
    |   - ClearCacheCommand
    |
    |   This will be a single command App, which take username as single parameter
    |
    |
    |   ASSUMPTIONS
    |   - Feed will be serialized and stored in memory (cache)
    |   - Github API request will need Authorization: token set on .env file (GITHUB_TOKEN)
    |   - The App can run without the token, but will be limited to fewer attempts per day (Github policy). 
    |   - A second command will be used to clear cache.
    |
    

Controls:

To Access help menu:
```
php mvf
```
To Run the app:
```
php mvf search mauricio-masias
``` 
To clear cache:
```
php mvf clear
```
To clear all cache including folders
```
php mvf clear --flush  
```
To run test suite (from root folder):
```
vendor/bin/phpunit
```    
