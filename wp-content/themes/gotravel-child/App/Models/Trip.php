<?php
 
namespace Models;
 
use \Illuminate\Database\Eloquent\Model;
 
class Trip extends Model {
     
    protected $table = 'mtt_trips';

    protected $adults;
    protected $children;
    protected $activity;
    protected $optional;

    protected $stop1; // zoho product array
    protected $stop2; // zoho product array


    protected $fillable = [

    ];

    
     
}
 
?>