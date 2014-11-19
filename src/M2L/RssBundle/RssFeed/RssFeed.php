<?php
// src/M2L/RssBundle/RssFeed/RssFeed.php

namespace M2L\RssBundle\RssFeed;

class RssFeed {
	const SPORTS = "https://fr.news.yahoo.com/rss/sports";
	const TENNIS = "https://fr.news.yahoo.com/rss/tennis";
	const FOOT = "https://fr.news.yahoo.com/rss/football";
	
	public function read($feed, $nb_result) {
		$doc = new \DOMDocument();
		$doc->load($feed);
		
		$i = 0;
		$data = array();
		
		foreach($doc->getElementsByTagName('item') as $article) {
			$row = array();
			$row['titre'] = $article->getElementsByTagName('title')->item(0)->textContent;
			$description = $article->getElementsByTagName('description')->item(0)->textContent;
			$description_tab = split('</a>', $description);
			$description_tab = split('</p>', $description_tab[1]);
			$row['description'] = $description_tab[0];
			
			$data[] = $row;
			
			$i++;
			
			if($i == 3) {
				break;
			}
		}
		
		return $data;
	}
}
