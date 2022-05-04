<?php
    // short code for catalyst Iframe
    add_shortcode(
        'podcasts_iframe',
        function ($attr) {
            global $assets_uri;
            $a = shortcode_atts(array('link' => ''), $attr);
            $content = '';
            if (!empty($a['link'])) {
                $content .= '<iframe src="' . esc_url($a['link']) . '" id="frame" style="width:100%;height:1200px;border: solid 1px #b1b1b14d;"></iframe>';
            } else {
                $content .= '';
            }
            return $content;
        }
    );
    // add short code for catalyst
    add_shortcode(
        'podcasts',
        function ($attr) {
            global $assets_uri;
            $a = shortcode_atts(array('link' => '', 'limit' => 100, 'inline' => false), $attr);
            $inline_layout = ($a['inline'] || $a['inline'] == 'true') ? true : false;
            if ($inline_layout) {
                ?>
                <style>
                    .watch-and-listen .podcast-feed{
                        display: flex;
                        flex-wrap: wrap;
                        align-items: flex-end;
                        justify-content: space-between;
                    }
                </style>
                <?php
            }
            $content = '';
            if (!empty($a['link'])) {
                $items = retrieve_audio_url($a['link']);

                foreach ($items as $key => $item) {
                    $content .= '<div class="' . ($inline_layout ? '' : 'col-sm-24') . ' podcast-container">
                    <div class="media-content podcast" data-audio="audio' . esc_attr($key) . '">
                            <div class="media-icon-container">
                                <img src="' . esc_url($assets_uri) . '/images/icons/play-icon.jpg" class="play-icon">
                            </div>
                            <div class="podcast-info">
                                <h6>
                                    <span>' . esc_html($item['title']) . '</span>
                                </h6>
                                <span class="date">' . esc_html(date('F d, Y', strtotime($item['pubDate']))) . '</span>                        
                            </div>
                            
                            <div>
                                <audio id="audio' . esc_attr($key) . '" controlsList="nodownload">
                                    <source src="' . esc_url($item['link_audio']) . '">
                                </audio>
                            </div>
                        </div>
                    </div>';
                    if ($key == $a['limit'] - 1) {
                        break;
                    }
                }
            }
            return $content;
        }
    );

    function retrieve_audio_url($link)
    {
        $Data = array();
        if (filter_var($link, FILTER_VALIDATE_URL)) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $link);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $Content = curl_exec($ch);
            curl_close($ch);
            if ($Content && !empty($Content) && $Content != '') {
                $xml = simplexml_load_string($Content, 'SimpleXMLElement', LIBXML_NOCDATA);
                $json = json_encode($xml);
                $array = json_decode($json, true);
                if (array_key_exists('channel', $array)) {
                    $channel = $array['channel'];
                    if (array_key_exists('item', $channel)) {
                        $item = $array['channel']['item'];
                        if ($item && !empty($item) && count($item) > 0) {
                            foreach ($item as $SingleItem) {
                                $title = $SingleItem['title'];
                                $pubDate = $SingleItem['pubDate'];
                                $link_website = isset($SingleItem['link']) ? $SingleItem['link'] : '';
                                if ($SingleItem['enclosure']) {
                                    $link_audio = $SingleItem['enclosure']['@attributes']['url'];
                                    $link_audio_type = $SingleItem['enclosure']['@attributes']['type'];
                                    $link_audio_length = $SingleItem['enclosure']['@attributes']['length'];

                                    array_push(
                                        $Data,
                                        array(
                                            'title' => $title,
                                            'link_website' => $link_website,
                                            'link_audio' => $link_audio,
                                            'link_audio_type' => $link_audio_type,
                                            'link_audio_length' => $link_audio_length,
                                            'pubDate' => $pubDate
                                        )
                                    );
                                }
                            }
                        }
                    }
                }
            }
        }

        return $Data;
    }
