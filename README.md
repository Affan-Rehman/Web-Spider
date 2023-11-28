#Web Spider

## Affan Rehman
### CMS ID: 374064

Welcome to `index.php`! This PHP script is a web crawler designed to traverse websites and extract information using the `WebSpider` class.

## Functionality

- **Purpose**: The script initiates a web crawling process starting from a seed URL.
- **Operation**: It fetches HTML content, extracts information like# Web Spider and Data Display Interface

## Overview

This PHP-based web spider is designed to crawl websites, extract information, and maintain data consistency by saving extracted details to files. Additionally, it includes a web interface to facilitate user input for crawling and displays the extracted data.

## File Saving Mechanism

The spider saves extracted information in two main files:
- `file.txt`: Contains details extracted from crawled URLs (e.g., titles, meta descriptions).
- `crawl_results.txt`: Appends the overall crawl results for reference.

### Data Consistency

To maintain data consistency:
- The spider utilizes file append mode to prevent overwriting existing data.
- Each crawl session's results are added to `crawl_results.txt` without affecting previous entries.
- Information from different URLs is saved separately in `file.txt`, ensuring each URL's details are stored distinctly.

## Web Interface

The PHP-based web interface allows users to input URLs for crawling and displays the extracted information.

### Usage

1. **Input**: Users can input a URL in the provided form.
2. **Extraction**: The spider extracts information (such as titles and meta descriptions) from the submitted URL.
3. **Display**: Extracted details are displayed on the interface for user reference.
   
### Implementation Details

- The web interface is integrated into `index.php`.
- Users can input a URL through a simple form and trigger the crawling process by clicking the "Crawl" button.
- Extracted data is displayed directly on the interface upon completion of the crawling process.

## Additional Resources

- For details on the file-saving mechanism and data consistency: [PHP File Handling Documentation](https://www.php.net/manual/en/function.fopen.php)
- To understand PHP-based web interfaces: [PHP Forms Guide](https://www.php.net/manual/en/tutorial.forms.php)

## Note

Ensure proper server configurations and permissions for file writing operations. Adjust file paths and permissions as needed for proper functioning.
 title and meta description, displays it, and explores linked pages within a depth limit.
  
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

Just input a url in the form, and click crawl, it will crawl it if it exists, if not, it will display error!

# Study Material

link1: https://www.php.net/manual/en/class.domdocument.php
link2: https://www.php.net/manual/en/language.oop5.php
