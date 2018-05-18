<?php
  class Article{
    private $article_id,$title,$topic,$body,$tags,$date,$user,$likes;

    public function __construct($article_id,$title,$topic,$body,$tags,$date,$user,$likes){
      $this->article_id = $article_id;
      $this->title = $title;
      $this->topic = $topic;
      $this->body = $body;
      $this->tags = $tags;
      $this->date = $date;
      $this->user = $user;
      $this->likes = $likes;
    }

    public function getId(){
      return $this->article_id;
    }
    public function getTitle(){
      return $this->title;
    }
    public function getTopic(){
      return $this->topic;
    }
    public function getBody(){
      return $this->body;
    }
    public function getTags(){
      return $this->tags;
    }
    public function getDate(){
      return $this->date;
    }
    public function getUser(){
      return $this->user;
    }
    public function getLikes(){
      return $this->likes;
    }
  }

?>
