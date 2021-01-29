<?php

namespace CodeBlog\FeedRss;

use \DOMDocument;
use DOMElement;

/**
 * Class CodeBlog FeedRss
 *
 * @author Whallysson Avelino <https://github.com/whallysson>
 * @package CodeBlog\FeedRss
 */
class FeedRss
{
    /** @var DOMElement|false */
    protected $rss;

    /** @var DOMDocument|bool */
    protected $xml;

    /** @var */
    protected $channel;

    /** @var string */
    protected $title;

    /** @var string */
    protected $link;

    /** @var bool */
    protected $googleMerchant = false;

    /** @var bool */
    protected $facebookAds = false;

    /**
     * FeedRss constructor.
     * @param bool|null $facebookAds
     * @param bool|null $googleMerchant
     */
    public function __construct(?bool $facebookAds = false, ?bool $googleMerchant = false)
    {
        $this->xml = new DOMDocument('1.0', 'utf-8');
        $this->xml->formatOutput = true;

        //Rss
        $this->rss = $this->xml->createElement('rss');
        $this->rss->setAttribute('version', '2.0');
        $this->rss->setAttribute('xmlns:dc', 'http://purl.org/dc/elements/1.1');

        if ($facebookAds) {
            $this->facebookAds = true;
        }

        if ($googleMerchant) {
            $this->googleMerchant = true;
            $this->rss->setAttribute('xmlns:g', 'http://base.google.com/ns/1.0');
        }
    }

    /**
     * @param string $title
     * @param string $link
     * @param string $description
     * @param string|null $language
     */
    public function setChannel(string $title, string $link, string $description, ?string $language = 'pt-BR'): void
    {
        $this->title = $title;
        $this->link = $link;

        // channel
        $this->channel = $this->xml->createElement('channel');

        $this->channel->appendChild(
            $this->xml->createElement('title', $title)
        );
        $this->channel->appendChild(
            $this->xml->createElement('link', $link)
        );
        $this->channel->appendChild(
            $this->xml->createElement('description', $description)
        );
        $this->channel->appendChild(
            $this->xml->createElement('language', $language)
        );

        $this->rss->appendChild($this->channel);
    }

    /**
     * @param string $url
     * @param string|null $title
     * @param string|null $link
     */
    public function setChannelImage(string $url, ?string $title = null, ?string $link = null): void
    {
        if (!empty($this->channel)) {
            $image = $this->xml->createElement('image');

            $image->appendChild($this->xml->createElement('title', (!empty($title) ? $title : $this->title)));
            $image->appendChild($this->xml->createElement('link', (!empty($link) ? $link : $this->link)));
            $image->appendChild($this->xml->createElement('url', $url));

            $this->channel->appendChild($image);
        }
    }

    /**
     * @param array $data
     */
    public function renderRss(array $data): void
    {
        if (empty($data)) {
            return;
        }

        $data = json_decode(json_encode($data));

        // Items
        foreach ($data as $item) {

            $title = $this->strLimitChars($this->strClean($item->title), 150, '');
            $description = $this->strLimitChars($this->strClean($item->description), 5000, '');

            // item element
            $itemElement = $this->xml->createElement("item");

            // title
            $itemElement->appendChild($this->xml->createElement('title', $title));

            // description Element
            $itemDescription = $this->xml->createElement('description');
            $itemDescription->appendChild($this->xml->createCDATASection($description));
            $itemElement->appendChild($itemDescription);

            $dtPub = date('D, d M Y H:i:s O', strtotime($item->publication));
            $itemElement->appendChild($this->xml->createElement('pubDate', $dtPub));

            // enclosure
            $itemEnclosure = $this->xml->createElement('enclosure');
            $itemEnclosure->setAttribute('url', $item->image->url);
            $itemEnclosure->setAttribute('type', 'image/*');
            $itemEnclosure->setAttribute('length', 0);
            $itemElement->appendChild($itemEnclosure);

            // image
            $itemImage = $this->xml->createElement('image');

            $imageTitle = $this->xml->createElement('title');
            $imageTitle->appendChild($this->xml->createCDATASection($item->image->title));

            $itemImage->appendChild($this->xml->createElement('link', $item->link));
            $itemImage->appendChild($this->xml->createElement('url', $item->image->url));
            $itemImage->appendChild($imageTitle);

            $itemElement->appendChild($itemImage);
            //image - end

            // others
            $itemElement->appendChild($this->xml->createElement('link', $item->link));
            $itemElement->appendChild($this->xml->createElement('guid', $item->link));


            //FB ADS PRODUCTS
            if ($this->facebookAds && !empty($item->facebook_ads)) {
                $this->setFacebookAds($itemElement, $item->facebook_ads);
            }

            // GOOGLE MERCHANT
            if ($this->googleMerchant && !empty($item->google_merchant)) {
                $this->setGoogleMerchant($itemElement, $item->google_merchant, $title, $description);
            }

            $this->channel->appendChild($itemElement);
        }

        $this->xml->appendChild($this->rss);

        header('Content-type: text-xml');
        echo $this->xml->saveXML();
    }

    /**
     * @param DOMElement $itemElement
     * @param object $item
     */
    private function setFacebookAds(DOMElement $itemElement, object $item): void
    {
        /*
         * https://www.facebook.com/business/help/120325381656392?id=725943027795860
         * Items required:
         * id, title, description, availability, condition, price, link, image_link, brand
         */

        $required = ['id', 'availability', 'condition', 'price', 'image_link', 'brand'];

        $itemElement->appendChild($this->xml->createElement('id', $item->id));
        $itemElement->appendChild($this->xml->createElement('image_link', $item->image_link));
        $itemElement->appendChild($this->xml->createElement('condition', $item->condition)); // new, refurbished, used.
        $itemElement->appendChild($this->xml->createElement('price', $item->price));
        $itemElement->appendChild($this->xml->createElement('availability',
            $item->availability)); // in stock | out of stock
        $itemElement->appendChild($this->xml->createElement('brand', htmlspecialchars($item->brand)));

        foreach ($item as $key => $value) {
            if (!in_array($key, $required)) {
                $itemElement->appendChild($this->xml->createElement($key, $value));
            }
        }
    }

    /**
     * @param DOMElement $itemElement
     * @param object $item
     * @param string $title
     * @param string $description
     */
    private function setGoogleMerchant(DOMElement $itemElement, object $item, string $title, string $description): void
    {
        $required = ['title', 'description'];

        $itemElement->appendChild($this->xml->createElement('g:title', $title));

        $gItemDescription = $this->xml->createElement('g:description');
        $gItemDescription->appendChild($this->xml->createCDATASection($description));
        $itemElement->appendChild($gItemDescription);

        foreach ($item as $key => $value) {
            if (!in_array($key, $required)) {
                $itemElement->appendChild($this->xml->createElement("g:{$key}", $value));
            }
        }
    }

    /**
     * @param string $string
     * @param int $limit
     * @param string $pointer
     * @return string
     */
    private function strLimitChars(string $string, int $limit, string $pointer = "..."): string
    {
        $string = trim(filter_var($string, FILTER_SANITIZE_SPECIAL_CHARS));
        if (mb_strlen($string) <= $limit) {
            return $string;
        }

        $chars = mb_substr($string, 0, mb_strrpos(mb_substr($string, 0, $limit), " "));
        return "{$chars}{$pointer}";
    }

    /**
     * @param string $string
     * @return string
     */
    private function strClean(string $string): string
    {
        return str_replace('&', 'e', htmlspecialchars($string));
    }
}