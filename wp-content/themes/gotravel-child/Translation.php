<?php
namespace MyTigreTrip;

class Translation
{
    protected $domain = 'en';
    protected $json;

    public function __construct($domain = 'en')
    {
        $this->domain = $domain;
        $this->json = file_get_contents(__DIR__."/languages/$this->domain.json");
        $this->json = json_decode($this->json, true);
    }

    public function mtt($key, $print = true)
    {
      //  print_r($json_data);
        if ($print) {
            echo $this->json[$key];
        } else {
            return $this->json[$key];
        }
    }

    public  function mttValue($key,$values, $print = true)
    {

    }

    public function printJson()
    {
        print_r($this->json);
    }
}
