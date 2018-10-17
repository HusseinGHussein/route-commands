<?php
/**
 * Created by PhpStorm.
 * User: kofo
 * Date: 10/16/18
 * Time: 6:39 PM
 */

namespace kofo\RouteCommands;


class RouteCommands
{
    /**
     * Get the url path after the set prefix
     * @param string $path
     * @return string
     */
    public function getPathAfterPrefix($path = ''){
        if(is_null($path) || $path == ''){
            $path = \Illuminate\Support\Facades\Request::path();
        }
        return str_after($path,config('commands.route_prefix').'/');
    }

    /**
     * Generate array item for specific option/arguments
     * @param $option
     * @return array
     */
    public function generateOptionPair($option){
        $pair = [];
        if(str_contains($option,['-','--'])){
            if(str_contains($option,'=')){
                $split = explode('=',$option);
                $pair['key'] = $split[0];
                $pair['value'] = $split[1];
            }
            else{
                $pair['key'] = $option;
                $pair['value'] = true;
            }
        }
        else{
            //TODO Guess key
            echo 'will have to guess key';
        }
        return $pair;
    }

    /**
     * Generate all array items based on command string
     * @param $string
     * @return array
     */
    public function generateAllOptions($string){
        $words = explode(' ',$string);
        $options[0] = $words[0];
        if(count($words) > 1)
        {
            for($i=1;$i<count($words);$i++){
                $pair = $this->generateOptionPair($words[$i]);
                $options[$pair['key']] = $pair['value'];
            }

        }
        return $options;
    }

}