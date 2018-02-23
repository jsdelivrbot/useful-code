<!-- 改這個 /etc/nginx/sites-enabled/default -->

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