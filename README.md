# Introduction to Web Spider

## Affan Rehman
### CMS ID: 374064

Welcome to `index.php`! This PHP script is a web crawler designed to traverse websites and extract information using the `WebSpider` class.

## Functionality

- **Purpose**: The script initiates a web crawling process starting from a seed URL.
- **Operation**: It fetches HTML content, extracts information like title and meta description, displays it, and explores linked pages within a depth limit.
  
### How to Operate

1. **Initialization**: Instantiate the `WebSpider` class in your PHP file.
    ```php
    $spider = new WebSpider('https://example.com', 3);
    ```
    Replace `'https://example.com'` with your desired seed URL and adjust the depth limit accordingly.

2. **Start Crawling**: Execute the `crawl()` method to begin the crawling process.
    ```php
    $spider->crawl();
    ```

### Changing the Crawling Website

To crawl a different website, modify the seed URL in the `WebSpider` instantiation:
```php
$spider = new WebSpider('https://newwebsite.com', 3);


#Study Material

link1: https://www.php.net/manual/en/class.domdocument.php
link2: https://www.php.net/manual/en/language.oop5.php
