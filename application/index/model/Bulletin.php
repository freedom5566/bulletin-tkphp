<?php
namespace app\index\model;

use think\Model;

class Bulletin extends Model
{
    //默認id
    //標題
    protected $title;
    //內文
    protected $article;
    //作者
    protected $author;

}