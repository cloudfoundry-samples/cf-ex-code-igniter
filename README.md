CloudFoundry PHP example application: CodeIgniter
=================================================

This is an example application which can be run on CloudFoundry using the PHP Buildpack.

This is a very simple CodeIgniter application which demonstrates how to setup the project
structure to run CodeIgniter applications.

Usage
=====

Clone the app and put it to CloudFoundry.

```
git clone https://github.com/dmikusa-pivotal/cf-ex-code-igniter cd cf-ex-code-igniter
cf push
```

After pushing, you'll see that the application started successfully and the URL for the demo.
Copy the URL and paste it into your browser.  You should now see the welcome page for a new
Code Igniter app.

