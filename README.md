Overview
=======================

Allows people to manage their backpack weights and view the packs of other hikers.


Live Website
=======================

[https://nobo.at](https://nobo.at)


Requirements
============

* Composer
* npm
* Node
* Redis
* PHP >= 7.1.3
* BCMath PHP Extension
* Ctype PHP Extension
* JSON PHP Extension
* Mbstring PHP Extension
* OpenSSL PHP Extension
* PDO PHP Extension
* Tokenizer PHP Extension
* XML PHP Extension
* Exif


Installation
============

    cd /home/userfolder
    
    git init
    
    git --work-tree=/home/userfolder pull https://markking79@github.com/markking79/noboat.git
    
    nano .env.example (change all & save as .env)
    
    nano .env (add: APP_ENV=production)
    
    composer install
    
    npm install
    
    php artisan migrate
    
    php artisan db:seed
    
    php artisan key:generate
    
    php artisan passport:keys
    
    php artisan storage:link
    
    php artisan config:cache
    
    npm run production
  
    
Installing jpegoptim
============

    * Used to optimize the images being uploaded, not required
    
    jpegoptim -V (check if installed)
    
    yum install -y epel-release
    yum install jpegoptim
    
    
Setup cPanel (if needed)
============

    nano /var/cpanel/userdata/USERNAME/DOMAIN.COM
    nano /var/cpanel/userdata/USERNAME/DOMAIN.COM_SSL
    
    Change the documentroot variable to include /public instead of /public_html
    Example:
    documentroot: /home/USERNAME/public
       
    /scripts/rebuildhttpdconf
    service httpd restart
    

Update Pulls From GitHub
============

    cd /home/nobo
    
    git --work-tree=/home/nobo pull https://markking79@github.com/markking79/noboat.git
    
    npm run production
    
Generate the API docs
============   
   php artisan apidoc:generate
    
Push Changes To GitHub
============
    
    * edit files
    
    cd /local/project/on/desktop/folder 

    git add . && git commit -m "updated comment" && git push origin master 
