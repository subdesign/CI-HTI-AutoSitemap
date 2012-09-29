# Codeigniter "How-to-implement" series part 2 - *Auto Sitemap*

*This series objective is to demonstrate how to implement several libraries into Codeigniter*

***

#### Auto Sitemap is a method generating sitemap.xml automatically in your cms. Using sitemap library by Philipp Dörner <pd@signalkraft.com>

## 1. Installation

Edit (or make a new one) robots.txt file in you root directory, and type into the following line:

    Sitemap: sitemap.xml

Copy the package files into the corresponding folders

## 2. Setup

First you have to edit the **sitemaprunner.php** in the libraries folder. What it does, it queries the database for parts of you site that are reachable, so you need these links in you sitemap file. As you can see, in my cms are news, static pages, events and galleries, so their links will be available for the robots in the sitemap file.

Second, you have to put **rewrite_sitemap()** helper method call into you controller, after the _save_ CRUD method run successful. So in my case I put this line after my new news article (new static page, new gallery and new event) was saved. (In the example controller you find only one example for demonstrating purpose).

Also you have to use it on UPDATE and DELETE crud calls, because the content of your site would be changed, your site needs to be up to date.

## 3. More options

You can setup more options for sitemap than only *loc*, like *lastmod*, *changefreq*, *priority*, you can find more information what they do on [http://www.sitemaps.org/protocol.html](http://www.sitemaps.org/protocol.html)

## 4. Notes

If you have any questions feel free to contact me at the email address below.

## 5. Author

The solution provided by Barna Szalai <b.sz@devartpro.com>


