echapa
======

The pitch
---------

Echapa is aimed to ease quick testing of PHP project. You don't have to worry about configuration anymore.

It's a simple command line tool for Web Developers. It configures and starts an apache server in the current directory.

The server is started without any host/domain special conf, only the HTTP port. It's the easiest way to access your projects from mobile devices.

Even if it's a good choice for quick testing, echapa can only be use for stable projects, especially if you have a lot of them.

Set up
------

The simplest way is to add an alias (in your .bashrc or something...).

```
alias echapa="php ~/path/to/echapa/echapa.php"
```

Usage
-----

Just do :

```
cd my-project-dir
echapa
```

You'll see the welcome message.

```
Starting echapa ;-)

Adding custom vhost...
Reloading apache...

Serving /home/user/my-project-dir
at http://localhost:9999
```

> If the server is already started, echapa only reloads the configuration.

Then, when you wan't to cut this access, just hit `ctrl+c`, you see the goodbye display.

```
Removing custom vhost...
Reloading apache...

echapa OUT - KTHXBYE
```

> Echapa will just reload the configuration if the server was already started at the beginning.

Options
-------
You can choose the port to listen by passing an arguement like this :
```
echapa p=9999
```
or
```
echapa port=9999
```

TODO
----

* Set up log files
* Support other PHP web servers (nginx, lighttpd)
* Some kind of volatile configuration through command line parameters
* Some kind of persistent configuration through flat-file
