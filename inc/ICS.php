<?php
    class ICS{
        const DT_FORMAT = 'Ymd\THis';
        public $events;
        public function __construct($events){
            if(count($events) > 0) {
                for($p = 0; $p <= (count($events)-1); $p++) {
                    foreach($events[$p] as $key => $val) {
                        $events[$p][$key] = $this->sanitize_val($val, $key);
                    }
                }
            }
            $this->events = $events;
        }
        function prepare(){
            $cp = array();
            $cp[] = 'BEGIN:VCALENDAR';
            $cp[] = 'VERSION:2.0';
            $cp[] = 'PRODID:-//hacksw/handcal//NONSGML v1.0//EN';
            $cp[] = 'CALSCALE:GREGORIAN';

            $cp[] = 'BEGIN:VTIMEZONE';
            $cp[] = 'TZID:America/Los_Angeles';
            $cp[] = 'X-LIC-LOCATION:America/Los_Angeles';
            $cp[] = 'BEGIN:DAYLIGHT';
            $cp[] = 'TZOFFSETFROM:-0800';
            $cp[] = 'TZOFFSETTO:-0700';
            $cp[] = 'TZNAME:PDT';
            $cp[] = 'DTSTART:19700308T020000';
            $cp[] = 'RRULE:FREQ=YEARLY;BYMONTH=3;BYDAY=2SU';
            $cp[] = 'END:DAYLIGHT';
            $cp[] = 'BEGIN:STANDARD';
            $cp[] = 'TZOFFSETFROM:-0700';
            $cp[] = 'TZOFFSETTO:-0800';
            $cp[] = 'TZNAME:PST';
            $cp[] = 'DTSTART:19701101T020000';
            $cp[] = 'RRULE:FREQ=YEARLY;BYMONTH=11;BYDAY=1SU';
            $cp[] = 'END:STANDARD';
            $cp[] = 'END:VTIMEZONE';

            if(count($this->events) > 0) {
                for($p = 0; $p <= (count($this->events)-1); $p++) {
                    $cp[]='BEGIN:VEVENT';
                    foreach($this->events[$p] as $key => $val) {
                        $cp[] = strtoupper($key).':'.$val;
                    }
                    $cp[] = 'SEQUENCE:3';
                    $cp[] = 'STATUS:CONFIRMED';
                    $cp[] = 'END:VEVENT';
                }
            }
            $cp[] = 'END:VCALENDAR';
            return implode("\r\n", $cp);
        }
        private function sanitize_val($val, $key = false){
            switch($key) {
                case 'dtend':
                case 'dtstamp':
                case 'dtstart':
                    //$val = 'TZID=America/Los_Angeles:'.$this->format_timestamp($val);
                    $val = $this->format_timestamp($val);
                    break;
                default:
                    // $val = $this->escape_string($val);
            }
            return $val;
        }
        private function format_timestamp($timestamp){
            $dt = new DateTime($timestamp);
            return $dt->format(self::DT_FORMAT);
        }
        private function escape_string($str){
            return preg_replace('/([,;])/','\$1', $str);
        }
        public function escapeString($string) {
            return preg_replace('/([\,;])/','\\\$1', $string);
        }
        public function shorter_version($string, $length) {
            if (strlen($string) >= $length) {
                return substr($string, 0, $length);
            } else {
                return $string;
            }
        }
        public function getplaintextintrofromhtml($html, $numchars) {
            $html = strip_tags($html);
            $html = html_entity_decode($html, ENT_QUOTES, 'UTF-8');
            $html = mb_substr($html, 0, $numchars, 'UTF-8');
            $html .= "…";
            return $html;
        }
    }
