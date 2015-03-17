<?php

namespace M2L\RssBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use M2L\RssBundle\RssFeed\RssFeed;

class DefaultController extends Controller
{
    public function voirAction($nb, $ligue)
    {
		$service_rss = $this->container->get('m2l.rss_reader');

		switch($ligue) {
			case 'foot' :
				$feedType = RssFeed::FOOT;
				break;
			case 'tennis' :
				$feedType = RssFeed::TENNIS;
				break;
			case 'sports' :
				$feedType = RssFeed::SPORTS;
				break;
		}
		
		$flux = $service_rss->read($feedType, $nb);
		
        return $this->render('M2LRssBundle:Default:index.html.twig', array('flux' => $flux));
    }
}
