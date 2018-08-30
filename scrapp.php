<?php
require 'simple_html_dom.php';
$html = new simple_html_dom();
// 8, 32, 5, 17, 27, 41, 2, 19, 24, 51, 34, 6, 15, 47, 35, 29, 13, 39, 20, 22, 26, 30
for($i=1;$i<=7;$i++) {
  // Load a file
  $html->load_file('http://www.thebluebook.com/search.html?region=30&class=1640&page='.$i);
  $element = $html->find(".single_result_wrapper");
  foreach($element as $p)
  { 
    $companyName = $p->find('.media-body > .cname')[0]->plaintext;
    $city = $p->find('.media-body > .addy_wrapper > span[itemprop=addressLocality]')[0]->plaintext;
    $countryCode = $p->find('.media-body > .addy_wrapper > span[itemprop=addressRegion]')[0]->plaintext;
    $pincode = $p->find('.media-body > .addy_wrapper > span[itemprop=postalCode]')[0]->plaintext;
    $telephone = $p->find('.media-body > .addy_wrapper > span[itemprop=telephone]')[0]->plaintext;
    $website = !empty($p->find('.media-body > ul[class=result-list] > a[class=website-link]')[0]->attr['href']) ? $p->find('.media-body > ul[class=result-list] > a[class=website-link]')[0]->attr['href'] : '';

    $data = $companyName.',' .$city.',' .$countryCode.',' .$pincode.',' .$telephone.',' .$website;
    file_put_contents('data.txt', trim($data).PHP_EOL, FILE_APPEND);  
    echo $data.'<br>';
  }
}
?>