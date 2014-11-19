<?php

namespace M2L\RssBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use M2L\RssBundle\RssFeed\RssFeed;

class DefaultController extends Controller
{
    public function testAction()
    {
		$service_rss = $this->container->get('m2l.rss_reader');
		
		$flux = $service_rss->read(RssFeed::SPORTS, 2);
		
        return $this->render('M2LRssBundle:Default:index.html.twig', array('flux' => $flux));
    }
}
