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
}
