<?php
// src/M2L/RssBundle/RssFeed/RssFeed.php

namespace M2L\RssBundle\RssFeed;

class RssFeed {
	const SPORTS = "https://fr.news.yahoo.com/rss/sports";
	const TENNIS = "https://fr.news.yahoo.com/rss/tennis";
	const FOOT = "https://fr.news.yahoo.com/rss/football";
	
	public function read($feed=SPORTS, $nb_result) {
		$doc = new \DOMDocument();
		$doc->load($feed);
		
		$i = 0;
		$data = array();
		
		foreach($doc->getElementsByTagName('item') as $article) {
			$row = array();
			$row['titre'] = $article->getElementsByTagName('title')->item(0)->textContent;
			$description = $article->getElementsByTagName('description')->item(0)->textContent;
			$link = $article->getElementsByTagName('link')->item(0)->textContent;
			
			if(explode('</a>', $description)) {
				$description_tab = explode('</a>', $description);
			} else {
				$description_tab = $description;
			}
			
			if(isset($description_tab[1])) {
				$description_tab = explode('</p>', $description_tab[1]);
			} else {
				$description_tab[0] = $description;
			}
			
			$row['description'] = $description_tab[0];
			$row['link'] = $link;
			
			$data[] = $row;
			
			$i++;
			
			if($i == $nb_result) {
				break;
			}
		}
		
		return $data;
	}
}
