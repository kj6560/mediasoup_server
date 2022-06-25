# Simple MVC PHP Framework created by Keshav Jha


 
#Video Conferencing Service
##Running the code

run npm install then npm start to run the application. Then open your browser at https://localhost:3016 or your own defined port/url in the config file.
(optional) edit the src/config.js file according to your needs and replace the ssl/key.pem ssl/cert.pem certificates with your own.
if errors then run :

sudo npm install -g --unsafe-perm=true --allow-root
##Deployment

in config.js replace the announcedIP with your public ip address of the server and modify the port you want to serve it in.
add firewall rules of the port of the webpage (default 3000) and the rtc connections (default udp as well as tcp 40000-49999) for the machine.
