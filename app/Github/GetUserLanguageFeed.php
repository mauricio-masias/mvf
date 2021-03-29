<?php
namespace App\Github;

use App\Github\CurlHelper;

class GetUserLanguageFeed implements UserInterface
{
    private $repos;
    private $repos_request;
    private $repos_property;
    private $token;
    
    
    public function __construct($token)
    {
        $this->repos = 'https://api.github.com/users/[username]/repos';
        $this->repos_request = 'GET';
        $this->repos_property = 'languages_url';
        $this->token = ($token != '') ? $token : false;
    }

    
    public function getUserFeed($username): array
    {
        return CurlHelper::getFeed(
            str_replace('[username]', $username, $this->repos), 
            $this->repos_request, 
            $this->token, 
            $username
        );
    }

    public function findPreferedLanguage($repos, $username): array
    {
        $languages = [];
        $results = [];

        foreach($repos as $repo){
            $languages[] = CurlHelper::getFeed(
                $repo[$this->repos_property], 
                $this->repos_request, 
                $this->token, 
                $username
            );
        }

        foreach($languages as $values){
            foreach($values as $key => $val){
                $results[] = $key;
            }
        }

        $sort = array_count_values($results);
        
        return count($sort) > 0 ?
            array_keys($sort, max($sort)) :
            [];
    }
    
}
