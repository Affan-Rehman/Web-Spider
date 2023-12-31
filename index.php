<?php

class WebSpider
{
    private $urlQueue;
    private $crawledUrls;
    private $depthLimit;

    public function __construct($seedUrl, $depthLimit = 1)
    {
        $this->urlQueue = new SplQueue();
        $this->urlQueue->enqueue($seedUrl);
        $this->crawledUrls = [];
        $this->depthLimit = $depthLimit;
    }

    public function crawl()
    {
        while (!$this->urlQueue->isEmpty()) {
            $url = $this->urlQueue->dequeue();

            if (in_array($url, $this->crawledUrls)) {
                continue;
            }

            $this->crawledUrls[] = $url;

            $content = $this->fetchPage($url);
            if (!$content) {
                continue;
            }

            $extractedInfo = $this->extractInfo($content);
            $this->displayInfo($url, $extractedInfo);

            $depth = count($this->crawledUrls);

            if ($depth >= $this->depthLimit) {
                continue;
            }

            $extractedUrls = $this->extractUrls($content);
            foreach ($extractedUrls as $url) {
                $this->urlQueue->enqueue($url);
            }
        }
    }
    
    //Fetching Page Content
        private function fetchPage($url)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);

        $content = curl_exec($curl);
        if (!$content) {
            $error = curl_error($curl);
            echo "Error fetching page: $error\n";
            return null;
        }

        curl_close($curl);
        return $content;
    }
    
    //Extracting URLs
        private function extractUrls($content)
    {
        $extractedUrls = [];

        $dom = new DOMDocument();
        @$dom->loadHTML($content);

        $anchors = $dom->getElementsByTagName('a');
        foreach ($anchors as $anchor) {
            $href = $anchor->getAttribute('href');
            if (strpos($href, 'http') === 0) {
                $extractedUrls[] = $href;
            }
        }

        return $extractedUrls;
    }

    //Extracting info
        private function extractInfo($content)
    {
        $extractedInfo = [];

        $dom = new DOMDocument();
        @$dom->loadHTML($content);

        $titleElement = $dom->getElementsByTagName('title');
        if ($titleElement->length > 0) {
            $extractedInfo['title'] = $titleElement->item(0)->textContent;
        }

        $metaDescriptionElement = $dom->getElementsByTagName('meta');
        foreach ($metaDescriptionElement as $element) {
            if ($element->getAttribute('name') === 'description') {
                $extractedInfo['metaDescription'] = $element->getAttribute('content');
                break;
            }
        }


        return $extractedInfo;
    }

    //Now simply displaying retrieved data
    private function displayInfo($url, $extractedInfo)
    {
        echo "URL: " . $url . "\n";
        if (isset($extractedInfo['title'])) {
            echo "Title: " . $extractedInfo['title'] . "\n";
        }
        if (isset($extractedInfo['metaDescription'])) {
            echo "Meta Description: " . $extractedInfo['metaDescription'] . "\n";
        }


        echo "\n";
    }
}

// Now usage
$spider = new WebSpider('https://www.google.com.pk/', 3);
$spider->crawl();
