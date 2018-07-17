<!-- deploy nuxt.js -->
https://segmentfault.com/a/1190000012774650
1. npm run build
2. upload .nuxt, .package.json, nuxt.config.js
3. pm2 start npm --name "my-nuxt" -- run start




<!-- 改這個 /etc/nginx/sites-enabled/default -->
<!-- 用express router也可以 -->

server {
    listen 80;

    server_name kichi.mounts-studio.com;

    location / {
        proxy_pass http://127.0.0.1:3000;
    }
}

<!-- 裝逼版 -->
upstream kichi{
    server 127.0.0.1:3000;
}

upstream test{
    server 127.0.0.1:3001;
}

server {
    listen 80;

    location /kichi/ {
        proxy_pass http://kichi;
        rewrite ^/kichi/(.*)$ /$1 break;
    }

    location /test/ {
        proxy_pass http://test;
        rewrite ^/test/(.*)$ /$1 break;
    }
}