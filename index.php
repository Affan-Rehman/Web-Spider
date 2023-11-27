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

    // Other methods will be added incrementally...
}