<?php
class CalendarData extends _EntitySerialize {
    private $id;
    private $title;
    private $start;
    private $end;
    private $startTime;
    private $endTime;
    private $url;
    private $auth;
    private $color;
    private $textColor;
    private $allDay = true;

    public function __construct() {
    }

    public function SetId($id) {
        $this->id = $id;
    }
    public function SetTitle($title) {
        $this->title = $title;
    }
    public function SetStartDate($startDate) {
        $this->start = $startDate;
    }
    public function SetStartTime($startTime) {
        $this->startTime = $startTime;
    }
    public function SetEndDate($endDate) {
        $this->end = $endDate;
    }
    public function SetEndTime($endTime) {
        $this->endTime = $endTime;
    }
    public function SetUrl($url) {
        $this->url = $url;
    }
    public function SetAuth($auth) {
        $this->auth = $auth;
    }
    public function SetColor($color) {
        $this->color = $color;
    }
    public function SetTextColor($textColor) {
        $this->textColor = $textColor;
    }
    public function GetId() {
        return $this->id;
    }
    public function GetTitle() {
        return $this->title;
    }
    public function GetStartDate() {
        return $this->start;
    }
    public function GetStartTime() {
        return $this->startTime;
    }
    public function GetEndDate() {
        return $this->end;
    }
    public function GetEndTime() {
        return $this->endTime;
    }
    public function GetUrl() {
        return $this->url;
    }
    public function GetAuth() {
        return $this->auth;
    }
    public function GetColor() {
        return $this->color;
    }
    public function GetTextColor() {
        return $this->textColor;
    }
    public function SetFullDate() {
        if (!is_null($this->end) && !is_null($this->endTime)) {
            $this->end .= 'T' . $this->endTime;
            $this->allDay = false;
        } elseif (!is_null($this->endTime)) {
            $this->end = $this->start .'T' . $this->endTime;
            $this->allDay = false;
        }
        if (!is_null($this->startTime)) {
            $this->start .= 'T' . $this->startTime;
            $this->allDay = false;
        }
    }
    /**
     * Array de nombre de propiedades a excluir
     * @param array $propsUnserialized
     * @return string
     */
    public function serialize($propsUnserialized = NULL) {
        $properties = get_object_vars($this);
        if (!is_null($propsUnserialized)) {
            foreach ($propsUnserialized as $property) {
                unset($properties[$property]);
            }
        }
        parent::setObject($properties);
        return parent::serialize();
    }
    public function toString() {
        $text = $this->title . ' | ' . $this->start;
        if (!empty($this->end)) {
            $text .= ' / ' . $this->end;
        }
        if (!empty($this->auth)) {
            $text .= ' [ __USER__ ]';
        }
        return $text;
    }
}
